<header>
    <h1>To-Do App</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
        <nav>
            <a href="index.php">Home</a>
            <a href="add_task.php">Add Task</a>
            <a href="logout.php">Logout</a>
        </nav>
    <?php endif; ?>
</header>
