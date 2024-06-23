<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'config.php';
    
    $task = $_POST['task'];
    $due_date = $_POST['due_date'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare('INSERT INTO tasks (user_id, task, due_date) VALUES (?, ?, ?)');
    $stmt->execute([$user_id, $task, $due_date]);

    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Task</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Add Task</h1>
        <form method="post" action="add_task.php">
            <input type="text" name="task" required placeholder="Task">
            <input type="date" name="due_date" required>
            <button type="submit">Add Task</button>
        </form>
    </div>
</body>
</html>
