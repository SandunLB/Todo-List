<?php
session_start();
require 'config.php';

if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare('SELECT username, email FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>To-Do App</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <div class="header-container">
        <div class="logo">
            <a href="index.php">To-Do App</a>
        </div>
        <div class="user-info">
            <?php if (isset($user)): ?>
                <span>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</span>
                <a href="profile.php">Profile</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </div>
</header>
