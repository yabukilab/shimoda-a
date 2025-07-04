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

// データ取得（ネットスーパー別の日別合計価格）
$sql = "
  SELECT DATE(ph.recorded_at) as date,
         s.store_name,
         SUM(ph.price) as total_price
    FROM price_history ph
    JOIN stores s ON ph.store_id = s.store_id
   WHERE ph.product_id IN (" . implode(',', array_fill(0, count($product_ids), '?')) . ")
   GROUP BY s.store_id, DATE(ph.recorded_at)
   ORDER BY DATE(ph.recorded_at), s.store_name
";
$stmt = $db->prepare($sql);
$stmt->execute($product_ids);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 商品ごとの詳細価格を取得
$detail_sql = "
  SELECT DATE(ph.recorded_at) AS date,
         s.store_name,
         p.product_name,
         ph.price
    FROM price_history ph
    JOIN stores s ON ph.store_id = s.store_id
    JOIN products p ON ph.product_id = p.product_id
   WHERE ph.product_id IN (" . implode(',', array_fill(0, count($product_ids), '?')) . ")
   ORDER BY DATE(ph.recorded_at), s.store_name, p.product_id
";
$stmt = $db->prepare($detail_sql);
$stmt->execute($product_ids);
$rows_detailed = $stmt->fetchAll(PDO::FETCH_ASSOC);


// データ整形
$data = [];
$dates = [];

foreach ($rows as $row) {
  $date = $row['date'];
  $store = $row['store_name'];
  $price = (int)$row['total_price'];

  $dates[$date] = true;
  $data[$store][$date] = $price;
}

$all_dates = array_keys($dates);
sort($all_dates);

$chart_data = [];
foreach ($data as $store => $price_by_date) {
  $chart_data[] = [
    'label' => $store,
    'data' => array_map(fn($d) => $price_by_date[$d] ?? null, $all_dates),
    'borderColor' => '#' . substr(md5($store), 0, 6),
    'tension' => 0,
    'spanGaps' => true
  ];
}

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
$last_update_sql = "
  SELECT MAX(recorded_at) AS latest FROM price_history WHERE product_id IN (" . implode(',', array_fill(0, count($product_ids), '?')) . ")
";
$stmt = $db->prepare($last_update_sql);
$stmt->execute($product_ids);
$latest_update = $stmt->fetchColumn();

// 最安値
$min_sql = "
  SELECT DATE(ph.recorded_at) AS date,
         s.store_name,
         SUM(ph.price) AS total_price
    FROM price_history ph
    JOIN stores s ON ph.store_id = s.store_id
   WHERE ph.product_id IN (" . implode(',', array_fill(0, count($product_ids), '?')) . ")
   GROUP BY s.store_id, DATE(ph.recorded_at)
   ORDER BY total_price ASC
   LIMIT 1
";
$stmt = $db->prepare($min_sql);
$stmt->execute($product_ids);
$min = $stmt->fetch(PDO::FETCH_ASSOC);

// 最高値
$max_sql = str_replace('ASC', 'DESC', $min_sql);
$stmt = $db->prepare($max_sql);
$stmt->execute($product_ids);
$max = $stmt->fetch(PDO::FETCH_ASSOC);

// 最安値・最高値の取得（合計価格）
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
// 最高値（グラフの最大値設定用）
$yAxisMax = max(array_column($rows, 'total_price'));

// URLパラメータの再構築
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
      <li class="right-align">最終更新：<?php echo htmlspecialchars($latest_update); ?></li>
    </ul>
  </nav>

  <h2 class="product-title"><?php echo $combined_product_name; ?> の価格推移</h2>

  <div class="chart-container">
    <canvas id="priceChart"></canvas>
  </div>

  <div class="summary-container">
    <div class="summary-table">
      <div class="summary-row">
        <span class="label">最安値：</span>
        <span class="value"><?= h($min['total_price']) ?>円（<?= h($min['date']) ?> <?= h($min['store_name']) ?>）</span>
      </div>
      <div class="summary-row">
        <span class="label">最高値：</span>
        <span class="value"><?= h($max['total_price']) ?>円（<?= h($max['date']) ?> <?= h($max['store_name']) ?>）</span>
      </div>
    </div>
  </div>


  <script>
    const detailsData = <?= json_encode($detailsData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>;
    const ctx = document.getElementById('priceChart').getContext('2d');
    const chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?php echo json_encode($all_dates); ?>,
        datasets: <?php echo json_encode($chart_data); ?>
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'bottom' },
          title: { display: false },
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
          y: { beginAtZero: true,
               suggestedMax: <?php echo ceil($yAxisMax * 1.05);?>,
               title: { display: true, text: '価格（円）' } },
          x: { title: { display: true, text: '日付' } }
        }
      }
    });

    function goBack() {
      const params = new URLSearchParams(window.location.search);
      const selected = [];
      for (const [key, value] of params.entries()) {
        if (key.startsWith('id')) {
          selected.push(`id[]=${value}`);
        }
      }
      location.href = `select.html?${selected.join('&')}`;
    }
  </script>
</body>
</html>
