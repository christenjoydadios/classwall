<?php
session_start();
include 'db.php';


if (!isset($_SESSION['visits'])) {
    $_SESSION['visits'] = 0;
}
$_SESSION['visits']++;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    if ($author != '' && $body != '') {
        $stmt = $pdo->prepare("INSERT INTO messages (author, body) VALUES (?, ?)");
        $stmt->execute([$author, $body]);
    }

  
    if (isset($_POST['remember'])) {
        setcookie('author', $author, time() + 60 * 60 * 24 * 30);
    } else {
        setcookie('author', '', time() - 3600);
    }

    header('Location: index.php');
    exit;
}

$search = $_GET['search'] ?? '';
$stmt = $pdo->prepare(
    "SELECT * FROM messages WHERE body ILIKE ? ORDER BY created_at DESC, id DESC"
);
$stmt->execute(['%' . $search . '%']);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

$savedName = $_COOKIE['author'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Class Wall</title>
</head>
<body>
    <h1>Class Wall</h1>
    <p>You've visited <?= $_SESSION['visits'] ?> times.</p>

    <form method="POST" action="index.php">
        <p>Name: <input type="text" name="author" value="<?= htmlspecialchars($savedName) ?>"></p>
        <p>Message:<br><textarea name="body" rows="3" cols="40"></textarea></p>
        <p><label><input type="checkbox" name="remember" <?= $savedName != '' ? 'checked' : '' ?>> Remember my name</label></p>
        <button type="submit">Post</button>
    </form>

    <hr>

    <form method="GET" action="index.php">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search messages">
        <button type="submit">Search</button>
    </form>

    <hr>

    <?php foreach ($messages as $m): ?>
        <p>
            <strong><?= htmlspecialchars($m['author']) ?></strong>
            (<?= htmlspecialchars($m['created_at']) ?>)<br>
            <?= htmlspecialchars($m['body']) ?>
        </p>
    <?php endforeach; ?>

    <?php if (count($messages) == 0): ?>
        <p>No messages found.</p>
    <?php endif; ?>
</body>
</html>
