<?php
session_start();

$text = $_POST['txt'];
$pdo = new PDO("mysql:host=localhost;dbname=marlin;", "root", "");

$sql = "SELECT * FROM txt WHERE text = :text";
$stmt = $pdo->prepare($sql);
$stmt->execute(['text' => $text]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!empty($task)) {
    $message = "Запись уже есть!";
    $_SESSION['danger'] = $message;

    header('Location: /task_10.php');
    exit;
}


$sql = "INSERT INTO txt (text) VALUES (:text)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['text' => $text]);

$message = "Запись создан!";
$_SESSION['success'] = $message;
header('Location: /task_10.php');

?>