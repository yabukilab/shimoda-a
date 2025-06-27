<?php
require_once 'db.php'; // DB接続とエスケープ関数h()を利用

header("Content-Type: application/json; charset=UTF-8");

try {
  $keyword = $_GET['keyword'] ?? '';

  $sql = "SELECT product_id, product_name FROM products WHERE product_name LIKE :keyword";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $products = array_map(function($row) {
    return ['id' => $row['product_id'], 'name' => $row['product_name']];
  }, $results);

  $latestStmt = $db->query("SELECT MAX(updated_at) AS latest FROM prices");
  $latestRow = $latestStmt->fetch(PDO::FETCH_ASSOC);
  $latestDate = $latestRow ? $latestRow['latest'] : null;

  echo json_encode([
    'products' => $products,
    'latest_updated_at' => $latestDate
  ]);
} catch (PDOException $e) {
  echo json_encode(['error' => '接続エラー: ' . h($e->getMessage())]);
}
