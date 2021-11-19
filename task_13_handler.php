<?php
session_start();

$number = $_SESSION['info'];
$submit = $_POST['submit'];

if (isset($submit)) {
    if (!$number) {
        $number = 1;
        $_SESSION['info'] = $number;
    } else {
        $number = $number + 1;
        $_SESSION['info'] = $number;
    }
    header('Location: /task_13.php');
    exit;
}

?>