<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require 'config.php';

$stmt = $pdo->prepare('SELECT * FROM tasks WHERE user_id = ?');
$stmt->execute([$_SESSION['user_id']]);
$tasks = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>To-Do List with Calendar</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fullcalendar.io/releases/core/4.3.1/main.min.css' rel='stylesheet' />
    <link href='https://fullcalendar.io/releases/daygrid/4.3.0/main.min.css' rel='stylesheet' />
    <script src='https://fullcalendar.io/releases/core/4.3.1/main.min.js'></script>
    <script src='https://fullcalendar.io/releases/daygrid/4.3.0/main.min.js'></script>
</head>
<body>
    <div class="container">
        <h1>Your Tasks</h1>
        <ul class="task-list">
            <?php foreach ($tasks as $task): ?>
                <li><?php echo htmlspecialchars($task['task']); ?> (Due: <?php echo htmlspecialchars($task['due_date']); ?>)</li>
            <?php endforeach; ?>
        </ul>
        <a href="add_task.php" class="button">Add Task</a>
        <div id='calendar'></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'dayGrid' ],
                events: [
                    <?php foreach ($tasks as $task): ?>
                    {
                        title: '<?php echo htmlspecialchars($task['task']); ?>',
                        start: '<?php echo htmlspecialchars($task['due_date']); ?>'
                    },
                    <?php endforeach; ?>
                ]
            });
            calendar.render();
        });
    </script>
</body>
</html>
