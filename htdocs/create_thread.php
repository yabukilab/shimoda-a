<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $board_id = $_POST['board_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // スレッドをデータベースに挿入するクエリ
    $query = "INSERT INTO threads (board_id, title, content) VALUES (:board_id, :title, :content)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':board_id', $board_id, PDO::PARAM_INT);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt->execute();

    // スレッド作成後、リダイレクトする
    header('Location: board.php?board_id=' . $board_id);
    exit();
}

$board_id = $_GET['board_id'] ?? 1;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Create Thread</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>新しいスレッドを作成</h1>
    </header>
    <div class="container">
        <form action="create_thread.php" method="post">
            <input type="hidden" name="board_id" value="<?= htmlspecialchars($board_id) ?>">
            <div>
                <label for="title">タイトル:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="content">内容:</label>
                <tinput type="text" id="content" name="content" required>
            </div>
            <div>
                <button type="submit">作成</button>
            </div>
        </form>
    </div>
    <footer>
        <p>&copy; 2024 Bulletin Board</p>
    </footer>
</body>
</html>
