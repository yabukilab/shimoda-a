<?php
include 'db.php'; // DB接続のためのファイル

// boardsテーブルから全レコードを取得するクエリ
$query = "SELECT * FROM boards";
$result = $db->query($query);

// 結果を配列に格納
$boards = $result->fetchAll(PDO::FETCH_ASSOC);

// 学部のカスタム順序を定義
$faculty_order = ['工学部', '創造工学部', '先進工学部','情報変革科学部','未来変革科学部','社会システム科学部'];

// カスタム順序に基づいてソート
usort($boards, function($a, $b) use ($faculty_order) {
    $pos_a = array_search($a['faculty'], $faculty_order);
    $pos_b = array_search($b['faculty'], $faculty_order);

    if ($pos_a === $pos_a) {
        return strcmp($a['name'], $b['name']); // 同じ学部内では名前でソート
    }
    return $pos_a - $pos_b;
});

$current_faculty = null;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>掲示板リスト</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>掲示板リスト</h1>
    </header>
    <div class="container">
        <?php foreach ($boards as $board): ?>
            <?php
            // 新しい学部のセクションを開始
            if ($current_faculty !== $board['faculty']) {
                if ($current_faculty !== null) {
                    // 前の学部のセクションを閉じる
                    echo "</ul>";
                }
                // 新しい学部名を表示
                echo "<h2>" . htmlspecialchars($board['faculty']) . "</h2>";
                echo "<ul>";
                $current_faculty = $board['faculty'];
            }
            ?>
            <li><a href="board.php?board_id=<?= htmlspecialchars($board['board_id']) ?>"><?= htmlspecialchars($board['name']) ?></a></li>
        <?php endforeach; ?>
        <?php
        // 最後の学部のリストを閉じる
        if ($current_faculty !== null) {
            echo "</ul>";
        }
        ?>
    </div>
    <footer>
        <p>&copy; 2024 Bulletin Board</p>
    </footer>
</body>
</html>
