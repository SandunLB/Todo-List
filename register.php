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
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form method="post" action="register.php">
            <input type="text" name="username" required placeholder="Username">
            <input type="password" name="password" required placeholder="Password">
            <input type="email" name="email" required placeholder="Email">
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
