<?php
session_start();

$text = $_POST['text'];


if (!empty($text)) {
    $message = $text;
    $_SESSION['info'] = $message;

    header('Location: /task_12.php');
    exit;
}

?>