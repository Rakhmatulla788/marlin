<?php
$pdo = new PDO("mysql:host=localhost;dbname=marlin;", "root", "");

$file = $_FILES['img'];

if (isset($file) && !empty($file)) {
    $format = explode('.', $file['name']);
    $filename = 'photo_' . strtotime(date("Y-m-d H:i:s")) . '.' . $format[1];

    $sql = "INSERT INTO images (image) VALUES (:image)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['image' => $filename]);

    $result = move_uploaded_file($file['tmp_name'], __DIR__ . '/img/uploads/' . $filename);

    if ($result) {
        header('Location: /task_15.php');
    }
}

