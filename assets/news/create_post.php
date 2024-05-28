<?php
define('SAFE_MODE', true);
require __DIR__ . '/../auth/session.php';
$is_admin = require __DIR__ . '/../auth/is_admin.php';
$is_manager = require __DIR__ . '/../auth/is_manager.php';

if(!$is_admin and !$is_manager){
    echo 'You are not permitted to post news!';
    return;
}

if(!isset($_POST['title'])){
    echo 'Title not set';
    return;
}

if(!isset($_POST['text'])){
    echo 'No contents is set';
    return;
}

require __DIR__ . '/../auth/authenticate.php';

$stmt = $conn->prepare("INSERT INTO posts (title, author, contents) VALUES (:title, :author, :contents)");

$stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
$stmt->bindParam(':author', $_SESSION['id'], PDO::PARAM_STR);
$stmt->bindParam(':contents', $_POST['text'], PDO::PARAM_STR);
$stmt->execute();

header('location: /');
?>
