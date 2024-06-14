<?php
include 'db.php';
$board_id = $_GET['board_id'] ?? 1; // デフォルト値を設定
$search_keyword = $_GET['search'] ?? ''; // 検索キーワードを取得

$query = "SELECT thread_id, title, post_date FROM threads WHERE board_id = ? AND title LIKE ? ORDER BY post_date DESC";
$stmt = $conn->prepare($query);
$search_param = '%' . $search_keyword . '%';
$stmt->bind_param("is", $board_id, $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>板ページ</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>スレッド一覧</h1>
    </header>
    <div class="container">
        <!-- 検索フォームの追加 -->
        <form method="get" action="">
            <input type="hidden" name="board_id" value="<?= htmlspecialchars($board_id) ?>">
            <input type="text" name="search" placeholder="スレッドタイトル検索" value="<?= htmlspecialchars($search_keyword) ?>">
            <button type="submit">検索</button>
        </form>
        <a href="create_thread.php?board_id=<?= htmlspecialchars($board_id) ?>">スレッド作成</a> <!-- スレッド作成リンクを追加 -->
        <?php if ($result->num_rows > 0): ?>
            <?php while ($thread = $result->fetch_assoc()): ?>
                <div>
                    <a href="thread.php?thread_id=<?= htmlspecialchars($thread['thread_id']) ?>"><?= htmlspecialchars($thread['title']) ?></a>
                    <span><?= htmlspecialchars($thread['post_date']) ?></span>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>スレッドが見つかりませんでした。</p>
        <?php endif; ?>
    </div>
    <footer>
        <p>&copy; 2024 Bulletin Board</p>
    </footer>
</body>
</html>
