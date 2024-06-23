<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = $_POST['task_id'];
    $task = $_POST['task'];
    $due_date = $_POST['due_date'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare('UPDATE tasks SET task = ?, due_date = ? WHERE id = ? AND user_id = ?');
    $stmt->execute([$task, $due_date, $task_id, $user_id]);

    header('Location: index.php');
} else {
    $task_id = $_GET['id'];
    $stmt = $pdo->prepare('SELECT * FROM tasks WHERE id = ? AND user_id = ?');
    $stmt->execute([$task_id, $_SESSION['user_id']]);
    $task = $stmt->fetch();
    if (!$task) {
        header('Location: index.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <h1>Edit Task</h1>
        <form method="post" action="edit_task.php">
            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
            <input type="text" name="task" required value="<?php echo htmlspecialchars($task['task']); ?>">
            <input type="date" name="due_date" required value="<?php echo htmlspecialchars($task['due_date']); ?>">
            <button type="submit">Save Changes</button>
        </form>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
