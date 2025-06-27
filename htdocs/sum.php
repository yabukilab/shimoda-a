<?php
require_once 'db.php'; // DB接続とエスケープ関数h()を利用

try {
  $productIds = [];
  foreach ($_GET as $key => $value) {
    if (preg_match('/^id\d+$/', $key)) {
      $productIds[] = (int)$value;
    }
  }

  if (empty($productIds)) {
    echo "商品が選択されていません。";
    exit;
  }

  // 商品名取得
  $placeholders = implode(',', array_fill(0, count($productIds), '?'));
  $stmt = $db->prepare("SELECT product_id, product_name FROM products WHERE product_id IN ($placeholders)");
  $stmt->execute($productIds);
  $productNames = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $productNames[$row['product_id']] = $row['product_name'];
  }

  // 並び順
  $order = strtolower($_GET['order'] ?? 'asc');
  $orderSql = ($order === 'desc') ? 'DESC' : 'ASC';
  $nextOrder = ($order === 'desc') ? 'asc' : 'desc';

  // 合計価格取得
  $stmt = $db->prepare("
    SELECT s.store_name, SUM(pz.price) AS total_price
    FROM stores s
    JOIN prices pz ON s.store_id = pz.store_id
    WHERE pz.product_id IN ($placeholders)
    GROUP BY s.store_id
    ORDER BY total_price $orderSql
  ");
  $stmt->execute($productIds);
  $storePrices = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // 送料計算
  foreach ($storePrices as &$row) {
    $total = $row['total_price'];
    $row['shipping_fee'] = ($total < 300) ? 500 : (($total < 500) ? 250 : 0);
  }
  unset($row);

  // 最終更新日時取得
  $stmt = $db->query("SELECT MAX(updated_at) AS last_updated FROM prices");
  $lastUpdated = $stmt->fetchColumn();

  // 戻る用URL
  $backUrl = 'select.html?' . http_build_query(array_filter($_GET, fn($k) => preg_match('/^id\d+$/', $k), ARRAY_FILTER_USE_KEY));

} catch (PDOException $e) {
  die('DB接続エラー: ' . h($e->getMessage()));
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>価格比較</title>
  <link rel="stylesheet" href="sum.css">
  <style>
    body { font-family: sans-serif; padding: 20px; position: relative; }
    table { border-collapse: collapse; width: 100%; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    .last-updated { position: absolute; top: 20px; right: 20px; font-size: 0.9em; color: #555; }
    a.sort-link { text-decoration: none; color: inherit; }
  </style>
</head>
<body>

  <div class="last-updated">
    最終更新: <?= h($lastUpdated) ?>
  </div>

  <a href="<?= h($backUrl) ?>">← 戻る</a>

  <h2>合計金額（店舗別）</h2>
  <h2>選択した商品</h2>
  <p><?= h(implode(' + ', array_values($productNames))) ?></p>

  <table>
    <tr>
      <th>店舗名</th>
      <th>
        <a class="sort-link" href="?<?= h(http_build_query(array_merge($_GET, ['order' => $nextOrder]))) ?>">
          合計金額 <?= $order === 'asc' ? '▽' : '△' ?>
        </a>
      </th>
      <th>送料・手数料</th>
    </tr>
    <?php foreach ($storePrices as $row): ?>
      <tr>
        <td><?= h($row['store_name']) ?></td>
        <td>¥<?= number_format($row['total_price']) ?></td>
        <td><?= $row['shipping_fee'] === 0 ? '無料' : '¥' . number_format($row['shipping_fee']) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>

</body>
</html>
