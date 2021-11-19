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
    $id = $task['id'];
    $pass = $task['password'];
    if (password_verify($password, $pass)) {
        $message = $task['email'];
        $_SESSION['user'] = $message;
        header('Location: /task_14_1.php');
        exit;
    } else {
        $message = 'Пароль неверный!';
        $_SESSION['danger'] = $message;
        header('Location: /task_14.php');
        exit;
    }

} else {
    $message = "Неверный логин или пароль.";
    $_SESSION['danger'] = $message;
    header('Location: /task_14.php');
    exit;
}


