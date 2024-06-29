<?php
include 'db.php';

// スレッドIDを取得
$thread_id = $_GET['thread_id'] ?? 0;

// コメントの評価処理
if (isset($_POST['helpful_comment_id'])) {
    $comment_id = $_POST['helpful_comment_id'];

    // コメントの評価を更新
    $stmt = $db->prepare("UPDATE comments SET helpful_count = helpful_count + 1 WHERE id = ?");
    $stmt->execute([$comment_id]);

    if ($stmt->rowCount() > 0) {
        // 評価追加後に同じスレッドページにリダイレクト
        header("Location: thread.php?thread_id=$thread_id");
        exit();
    } else {
        echo "コメントの評価に失敗しました。";
    }
}

// コメントの通報処理
if (isset($_POST['report_comment_id'])) {
    $comment_id = $_POST['report_comment_id'];

    // コメントの通報回数を更新
    $stmt = $db->prepare("UPDATE comments SET report_count = report_count + 1 WHERE id = ?");
    $stmt->execute([$comment_id]);

    if ($stmt->rowCount() > 0) {
        // 通報追加後に同じスレッドページにリダイレクト
        header("Location: thread.php?thread_id=$thread_id");
        exit();
    } else {
        echo "コメントの通報に失敗しました。";
    }
}

// コメント投稿フォームの処理
if (isset($_POST['submit_comment'])) {
    
    $name = trim($_POST['name']) !== '' ? $_POST['name'] : '名無しの千葉工大生';
    $content = $_POST['comment_content'];

    // コメントをデータベースに挿入
    $stmt = $db->prepare("INSERT INTO comments (thread_id, name, content) VALUES (?, ?, ?)");
    $stmt->execute([$thread_id, $name, $content]);

    if ($stmt->rowCount() > 0) {
        // コメント追加後に同じスレッドページにリダイレクト
        header("Location: thread.php?thread_id=$thread_id");
        exit();
    } else {
        echo "コメントの追加に失敗しました。";
    }
}

// スレッド情報を取得
$stmt = $db->prepare("SELECT title, content FROM threads WHERE thread_id = ?");
$stmt->execute([$thread_id]);
$thread = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$thread) {
    echo "指定されたスレッドは存在しません。";
    exit;
}

// ソート順を取得（デフォルトは古い順）
$sort_order = $_GET['sort_order'] ?? 'oldest';

// ソート順に基づいてSQLクエリを構築a
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
$comment_stmt = $db->prepare("SELECT id, name, content, created_at, helpful_count, report_count FROM comments WHERE thread_id = ? ORDER BY $order_by");
$comment_stmt->execute([$thread_id]);
$comments = $comment_stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($thread['title']) ?></title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        /* 追加されたCSSスタイル */
        .nav-container {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .nav-container a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            padding: 10px 20px;
            background-color: #555;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .nav-container a:hover {
            background-color: #777;
        }
    </style>
</head>
<body>
    <header>
    <h1><?= htmlspecialchars($thread['title'] . ' - ' . $thread['content'] . '先生') ?></h1><br>
        <div class="nav-container">
            <a href="link1.html">リンク1</a>
            <a href="link2.html">リンク2</a>
            <a href="link3.html">リンク3</a>
            <a href="link4.html">リンク4</a>
        </div>
    </header>
    <div class="container">
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
        <?php if (count($comments) > 0): ?>
            <ul>
                <?php foreach ($comments as $comment): ?>
                    <li>
                        <?php if ($comment['report_count'] >= 5): ?>
                            このコメントは削除されました。
                        <?php else: ?>
                            <?= htmlspecialchars($comment['name']) ?></strong> (<?= htmlspecialchars($comment['created_at']) ?>):<br>
                            <?= nl2br(htmlspecialchars($comment['content'])) ?><br>
                            <form action="thread.php?thread_id=<?= htmlspecialchars($thread_id) ?>" method="post" style="display:inline;">
                                <input type="hidden" name="helpful_comment_id" value="<?= htmlspecialchars($comment['id']) ?>">
                                <input type="submit" value="役に立った (<?= htmlspecialchars($comment['helpful_count']) ?>)">
                            </form>
                            <form action="thread.php?thread_id=<?= htmlspecialchars($thread_id) ?>" method="post" style="display:inline;">
                                <input type="hidden" name="report_comment_id" value="<?= htmlspecialchars($comment['id']) ?>">
                                <input type="submit" value="通報する ">
                            </form>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>コメントはまだありません。</p>
        <?php endif; ?>

        <!-- コメント投稿フォーム -->
        <form action="thread.php?thread_id=<?= htmlspecialchars($thread_id) ?>" method="post">
            <input type="hidden" name="thread_id" value="<?= htmlspecialchars($thread_id); ?>">
            <input type="text" name="name" placeholder="お名前"><br>
            <textarea id="large-textbox" name="comment_content" required placeholder="コメントを入力してください"></textarea><br>
            <input type="submit" name="submit_comment" value="コメントを追加">
        </form>
        <div class="rules-box">
            <p>コメントを追加する際のルール:</p>
            <ul class="rules">
                <li>他人を尊重し、攻撃的な言葉や不適切な内容を避けてください。</li>
                <li>スパムや宣伝行為を行わないでください。</li>
                <li>プライバシーを尊重し、個人情報を公開しないでください。</li>
            </ul>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 下田A班</p>
    </footer>
</body>
</html>
