<?php
require_once 'db.php';

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($product_id === 0) {
  die("無効な商品IDです");
}

// 選択された商品IDを戻るリンクに引き継ぐためのクエリ文字列を作成
$selected_ids = [];
foreach ($_GET as $key => $value) {
    if (preg_match('/^id\d+$/', $key)) {
        $selected_ids[] = urlencode($key) . '=' . urlencode($value);
    }
}

// ★ id1=xx が存在しない場合に id=xx を id1=xx に補完して戻す
if (empty($selected_ids) && isset($_GET['id'])) {
    $selected_ids[] = 'id1=' . urlencode($_GET['id']);
}

$back_query = !empty($selected_ids) ? '?' . implode('&', $selected_ids) : '';


// 商品名取得
$sql = "SELECT product_name FROM products WHERE product_id = :id LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$product) {
  die("商品が見つかりません");
}

// 画像取得
$sql = "SELECT image_path FROM prices WHERE product_id = :id AND image_path IS NOT NULL";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $product_id]);
$image_paths = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'image_path');

// 各店舗の価格取得
$sql = "SELECT s.store_name, pr.price, pr.updated_at, pr.quantity
        FROM prices pr
        JOIN stores s ON pr.store_id = s.store_id
        WHERE pr.product_id = :id";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $product_id]);
$prices = $stmt->fetchAll(PDO::FETCH_ASSOC);

$all_prices = array_column($prices, 'price');
$min_price = min($all_prices);
$max_price = max($all_prices);

$show_unit_price = array_reduce($prices, fn($c, $p) => $c || (!empty($p['quantity']) && $p['quantity'] > 0), false);

$updated_at = htmlspecialchars($prices[0]['updated_at'] ?? '不明');

// グラフ用履歴データ取得
$sql = "SELECT DATE(ph.recorded_at) AS date, ph.price, s.store_name
        FROM price_history ph
        JOIN stores s ON ph.store_id = s.store_id
        WHERE ph.product_id = :id
        ORDER BY ph.recorded_at ASC";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $product_id]);
$history_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 整形
$history_grouped = [];
$dates = [];
foreach ($history_rows as $row) {
  $date = $row['date'];
  $store = $row['store_name'];
  $price = floatval($row['price']);
  if (!in_array($date, $dates)) $dates[] = $date;
  $history_grouped[$store][$date] = $price;
}

$chart_datasets = [];
$colors = ['red', 'blue', 'green', 'orange'];
$i = 0;
foreach ($history_grouped as $store => $data) {
  $data_filled = [];
  foreach ($dates as $d) {
    $data_filled[] = $data[$d] ?? null;
  }
  $chart_datasets[] = [
    'label' => $store,
    'data' => $data_filled,
    'borderColor' => $colors[$i % count($colors)],
    'backgroundColor' => 'rgba(0,0,0,0)',
    'fill' => false,
    'tension' => 0.3
  ];
  $i++;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo htmlspecialchars($product['product_name']); ?> - 商品価格</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" />
  <link rel="stylesheet" href="details.css" />
</head>
<body>
<div class="blue-bar"></div> <!-- 青帯（空バー） -->

<nav class="top-bar">
  <ul>
    <li><a href="select.html<?php echo $back_query; ?>">戻る</a></li>
    <li class="center-title"><strong>ネットスーパー価格</strong></li>
    <li class="right-align">最終更新：<?php echo $updated_at; ?></li>
  </ul>
</nav>

<main class="container">
  <hgroup>
    <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
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
            $class = ($p['price'] == $min_price) ? 'green' : (($p['price'] == $max_price) ? 'red' : '');
            $unit_price = ($show_unit_price && !empty($p['quantity']) && $p['quantity'] > 0)
                            ? round($p['price'] / $p['quantity'] * 100, 2)
                            : null;
          ?>
          <tr>
            <td><?php echo htmlspecialchars($p['store_name']); ?></td>
            <td class="<?php echo $class; ?>"><?php echo number_format($p['price']); ?> 円</td>
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
const imagePaths = <?php echo json_encode($image_paths); ?>;
let currentIndex = 0;

function preloadImages(callback) {
  let loaded = 0;
  imagePaths.forEach((path) => {
    const img = new Image();
    img.src = "img/" + path + "?v=" + Date.now();
    img.onload = function () {
      loaded++;
      if (loaded === imagePaths.length && callback) {
        callback();
      }
    };
  });
}

function updateImage() {
  const mainImage = document.getElementById("mainImage");
  const counter = document.getElementById("imageCounter");
  mainImage.src = "img/" + imagePaths[currentIndex];
  counter.textContent = (currentIndex + 1) + " / " + imagePaths.length;
}

function prevImage() {
  currentIndex = (currentIndex - 1 + imagePaths.length) % imagePaths.length;
  updateImage();
}

function nextImage() {
  currentIndex = (currentIndex + 1) % imagePaths.length;
  updateImage();
}

window.onload = () => {
  preloadImages(updateImage);
};

function sortTable(column, asc = true) {
  const table = document.getElementById("priceTable");
  const tbody = table.tBodies[0];
  const rows = Array.from(tbody.rows);

  rows.sort((a, b) => {
    const aText = a.cells[column].innerText.replace(/[^\d.]/g, '');
    const bText = b.cells[column].innerText.replace(/[^\d.]/g, '');
    const aVal = parseFloat(aText) || 0;
    const bVal = parseFloat(bText) || 0;
    return asc ? aVal - bVal : bVal - aVal;
  });

  rows.forEach(row => tbody.appendChild(row));
}

// 折れ線グラフ描画
const ctx = document.getElementById('priceChart').getContext('2d');
new Chart(ctx, {
  type: 'line',
  data: {
    labels: <?php echo json_encode($dates); ?>,
    datasets: <?php echo json_encode($chart_datasets); ?>
  },
  options: {
    responsive: true,
    interaction: { mode: 'index', intersect: false },
    stacked: false,
    scales: {
      y: { beginAtZero: false, title: { display: true, text: '価格（円）' } },
      x: { title: { display: true, text: '日付' } }
    }
  }
});
</script>
</body>
</html>
