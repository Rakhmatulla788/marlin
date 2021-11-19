<?php

session_start();
$pdo = new PDO("mysql:host=localhost;dbname=marlin;", "root", "");

$email = $_POST['email'];
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$sql = "SELECT * FROM users2 WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!empty($task)) {
    $message = "Этот адресс уже иммется в базе";
    $_SESSION['danger'] = $message;

    header('Location: /task_11.php');
    exit;
}

$sql = "INSERT INTO users2 (email, password) VALUES (:email, :password)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email, 'password'=> $hashed_password]);

$message = "Запись создан!";
$_SESSION['success'] = $message;
header('Location: /task_11.php');

