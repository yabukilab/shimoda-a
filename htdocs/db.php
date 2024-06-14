<?php
// データベース接続情報
$servername = "localhost";
$username = "testuser";
$password = "pass";
$database = "mydb";

// データベースへの接続
$conn = new mysqli($servername, $username, $password, $database);

// 接続エラーのチェック
if ($conn->connect_error) {
    die("データベース接続エラー: " . $conn->connect_error);
}

// 文字エンコーディング設定（オプション）
$conn->set_charset("utf8mb4");
?>

