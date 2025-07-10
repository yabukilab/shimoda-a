<?php
require_once 'db.php';

// 商品IDの取得
$product_ids = [];
foreach ($_GET as $key => $value) {
  if (preg_match('/^id\d+$/', $key)) {
    $product_ids[] = (int)$value;
  }
}

if (empty($product_ids)) {
  echo "商品が指定されていません。";
  exit;
}

// 商品名の取得
$sql = "SELECT product_name FROM products WHERE product_id IN (" . implode(',', array_fill(0, count($product_ids), '?')) . ")";
$stmt = $db->prepare($sql);
$stmt->execute($product_ids);
$product_names = $stmt->fetchAll(PDO::FETCH_COLUMN);
$combined_product_name = implode(', ', array_map('htmlspecialchars', $product_names));

// 最新日付取得
$sql_latest_date = "SELECT MAX(DATE(recorded_at)) as latest_date FROM price_history WHERE product_id IN (" . implode(',', array_fill(0, count($product_ids), '?')) . ")";
$stmt = $db->prepare($sql_latest_date);
$stmt->execute($product_ids);
$latest_date = $stmt->fetchColumn();

if (!$latest_date) {
  echo "価格データが見つかりませんでした。";
  exit;
}

// 12ヶ月前の日付
$start_date = (new DateTime($latest_date))->modify('-11 months')->format('Y-m-d');

// データ取得
$sql = "
  SELECT DATE(ph.recorded_at) as date,
         s.store_name,
         SUM(ph.price) as total_price
    FROM price_history ph
    JOIN stores s ON ph.store_id = s.store_id
   WHERE ph.product_id IN (" . implode(',', array_fill(0, count($product_ids), '?')) . ")
     AND DATE(ph.recorded_at) BETWEEN ? AND ?
   GROUP BY s.store_id, DATE(ph.recorded_at)
   ORDER BY DATE(ph.recorded_at), s.store_name
";
$params = array_merge($product_ids, [$start_date, $latest_date]);
$stmt = $db->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 商品ごとの詳細価格を取得（同様に絞る）
$detail_sql = "
  SELECT DATE(ph.recorded_at) AS date,
         s.store_name,
         p.product_name,
         ph.price
    FROM price_history ph
    JOIN stores s ON ph.store_id = s.store_id
    JOIN products p ON ph.product_id = p.product_id
   WHERE ph.product_id IN (" . implode(',', array_fill(0, count($product_ids), '?')) . ")
     AND DATE(ph.recorded_at) BETWEEN ? AND ?
   ORDER BY DATE(ph.recorded_at), s.store_name, p.product_id
";
$stmt = $db->prepare($detail_sql);
$stmt->execute($params);
$rows_detailed = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 整形処理
// 日付の一覧を抽出（重複排除、昇順ソート）
$all_dates = array_unique(array_column($rows, 'date'));
sort($all_dates);

// 日付・店舗ごとに集計された価格を再構成
$data_map = []; // $data_map[store][date] = price;
foreach ($rows as $row) {
  $store = $row['store_name'];
  $date = $row['date'];
  $price = (int)$row['total_price'];
  $data_map[$store][$date] = $price;
}

// 各店舗の折れ線グラフ用データに変換（全日分）
$colors = ['#f44336', '#3f51b5', '#4caf50', '#ff9800', '#9c27b0', '#00bcd4'];
$chart_data = [];
$i = 0;

foreach ($data_map as $store => $price_by_date) {
  $data_points = [];

  foreach ($all_dates as $d) {
    $data_points[] = isset($price_by_date[$d]) ? $price_by_date[$d] : null;
  }

  $chart_data[] = [
    'label' => $store,
    'data' => $data_points,
    'borderColor' => $colors[$i++ % count($colors)],
    'fill' => false,
    'tension' => 0.3
  ];
}

// 最大値計算（Y軸のスケール調整用）
$max_values = [];
foreach ($data_map as $store => $price_by_date) {
  foreach ($price_by_date as $price) {
    $max_values[] = $price;
  }
}
$yAxisMax = ceil(max($max_values) * 1.05);

// 個別の商品価格を格納
$detailsData = [];
foreach ($rows_detailed as $row) {
  $store = $row['store_name'];
  $date = $row['date'];
  $product = $row['product_name'];
  $price = (int)$row['price'];
  $detailsData[$store][$date][] = [$product, $price];
}

// 最終更新日時
$latest_update = $latest_date;


// 最安値・最高値（合計価格から）
// 最安値・最高値（グラフに表示されている12日付に限定）
$minPrice = null;
$maxPrice = null;
$minInfo = $maxInfo = [];

foreach ($rows as $row) {
  $price = (int)$row['total_price'];
  if ($minPrice === null || $price < $minPrice) {
    $minPrice = $price;
    $minInfo = $row;
  }
  if ($maxPrice === null || $price > $maxPrice) {
    $maxPrice = $price;
    $maxInfo = $row;
  }
}


// URLパラメータ
$returnQuery = http_build_query(array_combine(
  array_map(fn($i) => "id" . ($i + 1), array_keys($product_ids)),
  $product_ids
));
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>価格推移</title>
  <link rel="stylesheet" href="trend.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="blue-bar"></div>
  <nav class="top-bar">
    <ul>
      <li><a href="select.html?<?= h($returnQuery) ?>">戻る</a></li>
      <li class="center-title"><strong>ネットスーパー価格</strong></li>
      <li class="right-align">最終更新：<?= htmlspecialchars($latest_update) ?></li>
    </ul>
  </nav>

  <h2 class="product-title"><?= $combined_product_name ?> の価格推移</h2>

  <div class="chart-container">
    <canvas id="priceChart"></canvas>
  </div>

  <div class="summary-container">
    <div class="summary-table">
      <div class="summary-row">
        <span class="label">最安値：</span>
        <span class="value"><?= h($minInfo['total_price']) ?>円（<?= h($minInfo['date']) ?> <?= h($minInfo['store_name']) ?>）</span>
      </div>
      <div class="summary-row">
        <span class="label">最高値：</span>
        <span class="value"><?= h($maxInfo['total_price']) ?>円（<?= h($maxInfo['date']) ?> <?= h($maxInfo['store_name']) ?>）</span>
      </div>
    </div>
  </div>

  <script>
    const detailsData = <?= json_encode($detailsData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>;
    const ctx = document.getElementById('priceChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?= json_encode($all_dates) ?>,
        datasets: <?= json_encode($chart_data) ?>,
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'bottom' },
          tooltip: {
            callbacks: {
              label: function(context) {
                const store = context.dataset.label;
                const date = context.label;
                const total = context.formattedValue;
                let lines = [`${store}: ${total}円`];
                const breakdown = detailsData[store]?.[date];
                if (breakdown) {
                  breakdown.forEach(([name, price]) => {
                    lines.push(`  ${name}: ${price}円`);
                  });
                }
                return lines;
              }
            }
          }
        },
        scales: {
          x: {
            type: 'category',
            offset: false, // 端にピッタリ揃える
            ticks: {
              autoSkip: true,
              maxTicksLimit: 12, // 最大12個だけ表示
              maxRotation: 0,     // 回転させない（任意）
              minRotation: 0,
              align: 'center'
            },
            title: {
              display: true,
              text: '日付'
            }
          },
          y: {
            beginAtZero: true,
            suggestedMax: <?= $yAxisMax ?>,
            title: {
              display: true,
              text: '価格（円）'
            }
          }
        }
      }
    });
  </script>
</body>
</html>
