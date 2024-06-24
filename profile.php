<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require 'config/config.php';

$user_id = $_SESSION['user_id'];

// Fetch user details
$stmt = $pdo->prepare('SELECT username, email FROM users WHERE id = ?');
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if (!empty($password) && $password === $confirm_password) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare('UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?');
        $stmt->execute([$username, $email, $password_hash, $user_id]);
    } else {
        $stmt = $pdo->prepare('UPDATE users SET username = ?, email = ? WHERE id = ?');
        $stmt->execute([$username, $email, $user_id]);
    }

    header('Location: profile.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="css/includes.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <h1>Profile</h1>
        <form method="post" action="profile.php">
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="password">New Password (leave blank to keep current):</label>
            <input type="password" name="password">

            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" name="confirm_password">

            <button type="submit" class="button">Update Profile</button>
        </form>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
