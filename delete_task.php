<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require 'config.php';

$task_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare('DELETE FROM tasks WHERE id = ? AND user_id = ?');
$stmt->execute([$task_id, $user_id]);

header('Location: index.php');
?>
