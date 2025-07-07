<?php
require_once 'db.php';

$latestDate = '取得失敗';

try {
    $stmt = $db->query("SELECT MAX(updated_at) AS latest_date FROM prices");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $latestDate = $row && $row['latest_date'] ? date('Y/m/d H:i', strtotime($row['latest_date'])) : 'データなし';
} catch (PDOException $e) {
    $latestDate = '取得失敗: ' . h($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ネットスーパー商品価格比較アプリ</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header></header>

  <div class="title-bar">
    <div class="app-title">ネットスーパー価格比較</div>
    <div class="update-time">最終更新日時：<?= h($latestDate) ?></div>
  </div>

  <div class="container">
    <h1>Welcome！</h1>
    <div class="subtitle">ネットスーパー商品価格比較アプリ</div>

    <div class="button-area">
      <a class="compare-button" href="select.html">
        <img src="img/yajirusi.jpeg" alt="商品選択・比較">
        <div class="compare-button-text">商品選択・比較</div>
      </a>
    </div>
  </div>

</body>
</html>
