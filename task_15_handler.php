<?php
$pdo = new PDO("mysql:host=localhost;dbname=marlin;", "root", "");

$file = $_FILES['img'];
$files = $_FILES['files'];

function incoming_files()
{
    $files = $_FILES;
    $files2 = [];
    foreach ($files as $input => $infoArr) {
        $filesByInput = [];
        foreach ($infoArr as $key => $valueArr) {
            if (is_array($valueArr)) { // file input "multiple"
                foreach ($valueArr as $i => $value) {
                    $filesByInput[$i][$key] = $value;
                }
            } else { // -> string, normal file input
                $filesByInput[] = $infoArr;
                break;
            }
        }
        $files2 = array_merge($files2, $filesByInput);
    }
    $files3 = [];
    foreach ($files2 as $file) { // let's filter empty & errors
        if (!$file['error']) $files3[] = $file;
    }
    return $files3;
}

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
} else if (isset($files) && !empty($files)) {
    $array = incoming_files($files);

    $count = count($array);
    for ($i = 0; $i < $count; $i++) {
        $format = explode('.', $array[$i]['name']);
        $filename = 'photo_' . strtotime(date("Y-m-d H:i:s")) .$i. '.' . $format[1];

        $sql = "INSERT INTO images (image) VALUES (:image)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['image' => $filename]);

        $result = move_uploaded_file($array[$i]['tmp_name'], __DIR__ . '/img/uploads/' . $filename);
    }

    header('Location: /task_15.php');


}

