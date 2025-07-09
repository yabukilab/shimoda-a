<?php
require_once 'db.php';

// 商品IDの取得
$product_ids = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($product_ids === 0) {
    die("無効な商品IDです");
}

if (empty($product_ids)) {
    echo "商品が指定されていません。";
    exit;
}

// 商品名の取得
$sql = "SELECT product_name FROM products WHERE product_id = :id LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $product_ids]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$product) {
    die("商品情報が見つかりませんでした");
}
$product_name = $product['product_name'];
$combined_product_name = htmlspecialchars($product['product_name']);

// 最新日付取得
$sql_latest_date = "SELECT MAX(DATE(recorded_at)) as latest_date FROM price_history WHERE product_id = :id";
$stmt = $db->prepare($sql_latest_date);
$stmt->execute(['id' => $product_ids]);
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
           SUM(ph.price) as total_price,
           SUM(ph.quantity) as total_quantity
      FROM price_history ph
      JOIN stores s ON ph.store_id = s.store_id
     WHERE ph.product_id = :id
       AND DATE(ph.recorded_at) BETWEEN :start_date AND :latest_date
     GROUP BY s.store_id, DATE(ph.recorded_at)
     ORDER BY DATE(ph.recorded_at), s.store_name
";
$params = [
    'id' => $product_ids,
    'start_date' => $start_date,
    'latest_date' => $latest_date
];
$stmt = $db->prepare($sql);
$stmt->execute($params);
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
     WHERE ph.product_id = :id
       AND DATE(ph.recorded_at) BETWEEN :start_date AND :latest_date
     ORDER BY DATE(ph.recorded_at), s.store_name, p.product_id
";
$stmt = $db->prepare($detail_sql);
$stmt->execute($params);
$rows_detailed = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 最新価格取得
$sql_prices = "
    SELECT s.store_name, pr.price, pr.quantity
      FROM prices pr
      JOIN stores s ON pr.store_id = s.store_id
     WHERE pr.product_id = :id
";
$stmt = $db->prepare($sql_prices);
$stmt->execute(['id' => $product_ids]);
$prices = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 商品画像取得
$sql_image = "SELECT image_path FROM prices WHERE product_id = :id ORDER BY store_id";
$stmt = $db->prepare($sql_image);
$stmt->execute(['id' => $product_ids]);
$image_paths_from_db = $stmt->fetchAll(PDO::FETCH_COLUMN);
$image_paths = [];
foreach ($image_paths_from_db as $path) {
    $fullPath = __DIR__ . '/img/' . $path;
    if (!empty($path) && file_exists($fullPath)) {
        $image_paths[] = $path;
    } else {
        $image_paths[] = 'no_image.png';
    }
}
if (count($image_paths) === 0) {
    $image_paths[] = 'no_image.png';
}

// 12ヶ月分日付生成
$latestDateObj = new DateTime($latest_date);
$referenceDates = [];
for ($i = 11; $i >= 0; $i--) {
    $d = (clone $latestDateObj)->modify("-{$i} months");
    $referenceDates[] = $d->format('Y-m-d');
}

// データマップ整形
$data_map = [];
foreach ($rows as $row) {
    $store = $row['store_name'];
    $date = $row['date'];
    $data_map[$store][$date] = [
        'total_price' => (int)$row['total_price'],
        'total_quantity' => (int)$row['total_quantity']
    ];
}

// 単価表示判定
$show_unit_price = false;
foreach ($prices as $p) {
    if (isset($p['quantity']) && $p['quantity'] > 0) {
        $show_unit_price = true;
        break;
    }
}

// グラフ用データ
$colors = ['#f44336', '#3f51b5', '#4caf50', '#ff9800'];
$chart_data = [];
$i = 0;
foreach ($data_map as $store => $daily) {
    $points = [];
    foreach ($referenceDates as $d) {
        if (isset($daily[$d])) {
            $p = $daily[$d]['total_price'];
            $q = $daily[$d]['total_quantity'];
            $v = ($show_unit_price && $q > 0) ? round($p / $q * 100, 2) : $p;
            $points[] = $v;
        } else {
            $points[] = null;
        }
    }
    $chart_data[] = [
        'label' => $store,
        'data' => $points,
        'borderColor' => $colors[$i++ % count($colors)],
        'fill' => false,
        'tension' => 0
    ];
}

// 詳細データ
$detailsData = [];
foreach ($rows_detailed as $r) {
    $detailsData[$r['store_name']][$r['date']][] = [$r['product_name'], $r['price']];
}

// y軸最大値
$max_values = [];
foreach ($data_map as $d) {
    foreach ($referenceDates as $date) {
        if (isset($d[$date])) {
            $p = $d[$date]['total_price'];
            $q = $d[$date]['total_quantity'];
            $v = ($show_unit_price && $q > 0) ? round($p / $q * 100, 2) : $p;
            $max_values[] = $v;
        }
    }
}
$yAxisMax = ceil(max($max_values) * 1.05);

// 戻る用URL
$returnQuery = http_build_query(['id1' => $product_ids]);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php echo $combined_product_name; ?> - 商品価格</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" />
<link rel="stylesheet" href="details.css" />
</head>
<body>
<div class="blue-bar"></div>

<nav class="top-bar">
    <ul>
        <li><a href="select.html?<?php echo $returnQuery; ?>">戻る</a></li>
        <li class="center-title"><strong>ネットスーパー価格</strong></li>
        <li class="right-align">最終更新：<?php echo $latest_date; ?></li>
    </ul>
</nav>

<main class="container">
<hgroup>
    <h2><?php echo htmlspecialchars($product_name); ?></h2>
    <h3>価格一覧と推移</h3>
</hgroup>

<div class="flex-wrap">
    <!-- 商品画像スライダー -->
    <div class="image-slider" id="imageSlider">
        <div class="arrow-container left" onclick="prevImage()">〈</div>
        <div class="image-container" id="imageContainer">
            <img id="mainImage" src="img/<?php echo htmlspecialchars($image_paths[0]); ?>" alt="商品画像" style="width: 100%;" />
        </div>
        <div class="arrow-container right" onclick="nextImage()">〉</div>
        <div class="image-count" id="imageCounter">1 / <?php echo count($image_paths); ?></div>
    </div>

    <!-- 各店舗の価格表 -->
    <div class="price-table-wrapper">
        <h3>各店舗の価格</h3>
        <table class="price-table" id="priceTable">
            <thead>
                <tr>
                    <th>店舗</th>
                    <th>価格
                        <button onclick="sortTable(1, true)">▲</button>
                        <button onclick="sortTable(1, false)">▼</button>
                    </th>
                    <?php if ($show_unit_price): ?>
                    <th>グラム単価
                        <button onclick="sortTable(2, true)">▲</button>
                        <button onclick="sortTable(2, false)">▼</button>
                    </th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prices as $p):
                    $unit_price = ($show_unit_price && $p['quantity'] > 0)
                        ? round($p['price'] / $p['quantity'] * 100, 2)
                        : null;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($p['store_name']); ?></td>
                    <td><?php echo number_format($p['price']); ?> 円</td>
                    <?php if ($show_unit_price): ?>
                    <td><?php echo $unit_price !== null ? number_format($unit_price, 2) . ' 円/100g' : '-'; ?></td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- 折れ線グラフ -->
<h3>店舗別価格推移（折れ線グラフ）</h3>
<canvas id="priceChart"></canvas>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// 商品画像スライダー
const imagePaths = <?php echo json_encode($image_paths); ?>;
let currentIndex = 0;
function updateImage() {
    document.getElementById("mainImage").src = "img/" + imagePaths[currentIndex];
    document.getElementById("imageCounter").textContent = (currentIndex + 1) + " / " + imagePaths.length;
}
function prevImage() {
    currentIndex = (currentIndex - 1 + imagePaths.length) % imagePaths.length;
    updateImage();
}
function nextImage() {
    currentIndex = (currentIndex + 1) % imagePaths.length;
    updateImage();
}
window.onload = () => updateImage();

// テーブルソート
function sortTable(column, asc = true) {
    const table = document.getElementById("priceTable");
    const tbody = table.tBodies[0];
    const rows = Array.from(tbody.rows);
    rows.sort((a, b) => {
        const aVal = parseFloat(a.cells[column].innerText.replace(/[^\d.]/g, '')) || 0;
        const bVal = parseFloat(b.cells[column].innerText.replace(/[^\d.]/g, '')) || 0;
        return asc ? aVal - bVal : bVal - aVal;
    });
    rows.forEach(row => tbody.appendChild(row));
}

// 折れ線グラフ
const detailsData = <?php echo json_encode($detailsData, JSON_UNESCAPED_UNICODE); ?>;
const ctx = document.getElementById('priceChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($referenceDates); ?>,
        datasets: <?php echo json_encode($chart_data); ?>
    },
    options: {
        responsive: true,
        interaction: { mode: 'index', intersect: false },
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
            y: {
                beginAtZero: true,
                suggestedMax: <?php echo $yAxisMax; ?>,
                title: { display: true, text: '価格（円）' }
            },
            x: {
                title: { display: true, text: '日付' }
            }
        }
    }
});
</script>
</body>
</html>
