<?php
include 'db.php';

// スレッドIDを取得
$thread_id = $_GET['thread_id'] ?? 0;

// コメントの評価処理
if (isset($_POST['helpful_comment_id'])) {
    $comment_id = $_POST['helpful_comment_id'];

    // コメントの評価を更新
    $stmt = $db->prepare("UPDATE comments SET helpful_count = helpful_count + 1 WHERE id = ?");
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // 評価追加後に同じスレッドページにリダイレクト
        header("Location: thread.php?thread_id=$thread_id");
        exit();
    } else {
        echo "コメントの評価に失敗しました。";
    }
    $stmt->close();
}

// コメント投稿フォームの処理
if (isset($_POST['submit_comment'])) {
    $name = trim($_POST['name']) !== '' ? $_POST['name'] : '名無しの千葉工大生';
    $content = $_POST['comment_content'];

    // コメントをデータベースに挿入
    $stmt = $db->prepare("INSERT INTO comments (thread_id, name, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $thread_id, $name, $content);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // コメント追加後に同じスレッドページにリダイレクト
        header("Location: thread.php?thread_id=$thread_id");
        exit();
    } else {
        echo "コメントの追加に失敗しました。";
    }
    $stmt->close();
}

// スレッド情報を取得
$stmt = $db->prepare("SELECT title, content FROM threads WHERE thread_id = ?");
$stmt->bind_param("i", $thread_id);
$stmt->execute();
$thread = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$thread) {
    echo "指定されたスレッドは存在しません。";
    exit;
}

// ソート順を取得（デフォルトは古い順）
$sort_order = $_GET['sort_order'] ?? 'oldest';

// ソート順に基づいてSQLクエリを構築
switch ($sort_order) {
    case 'newest':
        $order_by = "created_at DESC";
        break;
    case 'helpful':
        $order_by = "helpful_count DESC";
        break;
    case 'oldest':
    default:
        $order_by = "created_at ASC";
        break;
}

// コメントをデータベースから取得
$comment_stmt = $db->prepare("SELECT id, name, content, created_at, helpful_count FROM comments WHERE thread_id = ? ORDER BY $order_by");
$comment_stmt->bind_param("i", $thread_id);
$comment_stmt->execute();
$comment_result = $comment_stmt->get_result();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($thread['title']) ?></title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($thread['title']) ?></h1>
    </header>
    <div class="container">
        <p><?= nl2br(htmlspecialchars($thread['content'])) ?></p>

        <!-- ソート順選択フォーム -->
        <form action="thread.php" method="get">
            <input type="hidden" name="thread_id" value="<?= htmlspecialchars($thread_id); ?>">
            <label for="sort_order">ソート順:</label>
            <select name="sort_order" id="sort_order" onchange="this.form.submit()">
                <option value="oldest" <?= $sort_order == 'oldest' ? 'selected' : '' ?>>古い順</option>
                <option value="newest" <?= $sort_order == 'newest' ? 'selected' : '' ?>>新しい順</option>
                <option value="helpful" <?= $sort_order == 'helpful' ? 'selected' : '' ?>>役に立った順</option>
            </select>
        </form>

        <!-- コメントがある場合、それを表示 -->
        <?php if ($comment_result->num_rows > 0): ?>
            <h3>コメント:</h3>
            <ul>
                <?php while ($comment = $comment_result->fetch_assoc()): ?>
                    <li>
                        <strong><?= htmlspecialchars($comment['name']) ?></strong> (<?= htmlspecialchars($comment['created_at']) ?>):<br>
                        <?= nl2br(htmlspecialchars($comment['content'])) ?><br>
                        <form action="thread.php?thread_id=<?= htmlspecialchars($thread_id) ?>" method="post" style="display:inline;">
                            <input type="hidden" name="helpful_comment_id" value="<?= htmlspecialchars($comment['id']) ?>">
                            <input type="submit" value="役に立った (<?= htmlspecialchars($comment['helpful_count']) ?>)">
                        </form>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>コメントはまだありません。</p>
        <?php endif; ?>
        <?php $comment_stmt->close(); ?>

        <!-- コメント投稿フォーム -->
        <form action="thread.php?thread_id=<?= htmlspecialchars($thread_id) ?>" method="post">
            <input type="hidden" name="thread_id" value="<?= htmlspecialchars($thread_id); ?>">
            <input type="text" name="name" placeholder="お名前"><br>
            <textarea name="comment_content" required placeholder="コメントを入力してください"></textarea><br>
            <input type="submit" name="submit_comment" value="コメントを追加">
        </form>
    </div>
    <footer>
        <p>&copy; 2024 下田A班</p>
    </footer>
</body>
</html>
