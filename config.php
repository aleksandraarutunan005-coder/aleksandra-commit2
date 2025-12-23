<?php
// config.php
$host = 'localhost';
$dbname = 'galactic_news';
$username = 'root';
$password = ''; // Если есть пароль - укажите его

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>