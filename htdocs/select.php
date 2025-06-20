<?php
header('Content-Type: application/json');

$pdo = new PDO('mysql:host=localhost;dbname=supermarket', 'user', 'pass');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$keyword_raw = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$keyword = mb_convert_kana($keyword_raw, 'C', 'UTF-8');

if (trim($keyword) === '') {
    $stmt = $pdo->query("SELECT id, name, image_url FROM products");
} else {
    $like = '%' . $keyword . '%';
    $stmt = $pdo->prepare("SELECT id, name, image_url FROM products WHERE
        CONVERT(name USING utf8mb4) LIKE ? OR
        CONVERT(mb_convert_kana(name, 'C')) LIKE ?");
    $stmt->execute([$like, $like]);
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($results, JSON_UNESCAPED_UNICODE);
