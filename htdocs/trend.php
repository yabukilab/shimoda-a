<?php
// データベースなどから取得したデータをここに仮置きしています
$productName = "りんご";
$lastUpdate = "2025/06/20 14:30";
$maxPriceDate = "2025/06/05";
$maxPriceStore = "スーパーA";
$minPriceDate = "2025/06/12";
$minPriceStore = "スーパーB";
$graphImagePath = "graph-placeholder.png"; // 実際には動的に生成・取得
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>商品価格推移閲覧</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <div style="position: relative;">
    <a href="#" class="back-button" style="position: absolute; top: 10px; left: 20px; color: white; text-decoration: none;">←戻る</a>
    <h1 class="page-title" style="margin: 0;">商品価格推移閲覧</h1>
    <div class="update-time">最終更新日時：<?php echo $lastUpdate; ?></div>
  </div>
</header>

<div class="graph-area">
  <div class="product-name" id="product-name"><?php echo htmlspecialchars($productName); ?></div>
  <div class="graph-container">
    <img src="<?php echo $graphImagePath; ?>" alt="価格推移グラフ" class="graph-image">
    <div class="price-info">
      <p>過去最高額：<?php echo $maxPriceDate . "、" . $maxPriceStore; ?></p>
      <p>過去最安値：<?php echo $minPriceDate . "、" . $minPriceStore; ?></p>
    </div>
  </div>
</div>

</body>
</html>