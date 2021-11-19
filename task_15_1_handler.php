<?php
$pdo = new PDO("mysql:host=localhost;dbname=marlin;", "root", "");

$id = $_GET['id'];

$sql = "SELECT * FROM images WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

$filename = $task['image'];


$sql = "DELETE FROM images WHERE id = :id";
$stmt = $pdo->prepare($sql);
$res = $stmt->execute(['id' => $id]);

if($res){
    $path = 'img/uploads/'.$filename;
    unlink($path);
    header('Location: /task_15_1.php');
}
