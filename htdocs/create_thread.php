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

    // スレッド作成後にリダイレクト
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
        <h1>新しい科目を作成</h1>
    </header>
    <div class="container">
        <form action="create_thread.php" method="post">
            <input type="hidden" name="board_id" value="<?= htmlspecialchars($board_id) ?>">
            <div>
                <label for="title">科目名:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="content">教授名:</label>
                <input type="text" id="content" name="content" required>
            </div>
            <div>
                <button type="submit">作成</button>
            </div>
        </form>
        <div class="rules-box">
            <p>科目を追加する際のルール:</p>
            <ul class="rules">
                <li>教授名には旧字体ではなく新字体を使用してください</li>
                <li>既に科目が登録されていないことを確認してください</li>
                <li>実在する科目を登録してください</li>
            </ul>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 下田A班</p>
    </footer>
</body>
</html>
