<?php
$dsn = 'mysql:host=localhost;dbname=todo_app';
$username = 'root';
$password = '';
$options = [];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die('Could not connect to the database');
}
?>
