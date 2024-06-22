<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'config.php';
    
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    $stmt = $pdo->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)');
    $stmt->execute([$username, $password, $email]);

    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <form method="post" action="register.php">
        <input type="text" name="username" required>
        <input type="password" name="password" required>
        <input type="email" name="email" required>
        <button type="submit">Register</button>
    </form>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
