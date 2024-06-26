<?php

// HTMLでのエスケープ処理をする関数
function h($var) {
  if (is_array($var)) {
    return array_map('h', $var);
  } else {
    return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
  }
}

// 環境変数からデータベース接続情報を取得
$dbServer = isset($_ENV['MYSQL_SERVER'])    ? $_ENV['MYSQL_SERVER']      : '127.0.0.1';
$dbUser = isset($_SERVER['MYSQL_USER'])     ? $_SERVER['MYSQL_USER']     : 'testuser';
$dbPass = isset($_SERVER['MYSQL_PASSWORD']) ? $_SERVER['MYSQL_PASSWORD'] : 'pass';
$dbName = isset($_SERVER['MYSQL_DB'])       ? $_SERVER['MYSQL_DB']       : 'mydb';

// DSNの作成
$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";

try {
  // データベース接続の確立
  $db = new PDO($dsn, $dbUser, $dbPass);
  // プリペアドステートメントのエミュレーションを無効にする
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  // エラーモードを例外に設定
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  // 接続エラー時のメッセージ表示
  echo "Can't connect to the database: " . h($e->getMessage());
}
?>
