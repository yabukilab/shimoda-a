<?php
include 'db.php';

// デフォルトのboard_idと検索キーワードを取得
$board_id = $_GET['board_id'] ?? 1;
$search_keyword = $_GET['search'] ?? '';

// board_idに基づいて学科名を取得するクエリ
$board_query = "SELECT name FROM boards WHERE board_id = :board_id";
$board_stmt = $db->prepare($board_query);
$board_stmt->bindParam(':board_id', $board_id, PDO::PARAM_INT);
$board_stmt->execute();
$board_name = $board_stmt->fetchColumn();

// threadsテーブルからデータを取得するクエリ
$query = "SELECT thread_id, title, post_date FROM threads WHERE board_id = :board_id AND title LIKE :search_keyword ORDER BY post_date DESC";
$stmt = $db->prepare($query);
$search_param = '%' . $search_keyword . '%';
$stmt->bindParam(':board_id', $board_id, PDO::PARAM_INT);
$stmt->bindParam(':search_keyword', $search_param, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($board_name) ?> - 科目一覧</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($board_name) ?> - 科目一覧</h1>
    </header>
    <div class="home">
            <a href="https://shimoda-a.pm-chiba.tech/">HOME</a>
            <a href="board.php?board_id=<?= htmlspecialchars($board['board_id']) ?>">科目一覧</a>
            <a href="link3.html">科目作成</a>
        </div>
    <div class="container">
        <!-- 検索フォームの追加 -->
        <form method="get" action="">
            <input type="hidden" name="board_id" value="<?= htmlspecialchars($board_id) ?>">
            <input type="text" name="search" placeholder="スレッドタイトル検索" value="<?= htmlspecialchars($search_keyword) ?>">
            <button type="submit">検索</button>
        </form>
        <a href="create_thread.php?board_id=<?= htmlspecialchars($board_id) ?>">科目作成</a> <!-- スレッド作成リンクを追加 -->
        <?php if (count($result) > 0): ?>
            <?php foreach ($result as $thread): ?>
                <div>
                    <a href="thread.php?thread_id=<?= htmlspecialchars($thread['thread_id']) ?>"><?= htmlspecialchars($thread['title']) ?></a>
                    <span><?= htmlspecialchars($thread['post_date']) ?></span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>スレッドが見つかりませんでした。</p>
        <?php endif; ?>
    </div>
    <footer>
        <p>&copy; 2024 下田A班</p>
    </footer>
</body>
</html>
