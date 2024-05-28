<?php
define('SAFE_MODE', true);
require __DIR__ . '/../auth/session.php';
$is_admin = require __DIR__ . '/../auth/is_admin.php';

if(!$is_admin){
    echo 'You are not permitted to create user!';
    return;
}

if(!isset($_POST['name'])){
    echo 'Name not set';
    return;
}

if(!isset($_POST['password'])){
    echo 'Pass not set';
    return;
}

$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

require __DIR__ . '/../auth/authenticate.php';

$stmt = $conn->prepare("INSERT INTO users (name, password) VALUES (:name, :pass)");

$stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
$stmt->bindParam(':pass', $pass , PDO::PARAM_STR);
$stmt->execute();

header('location: /admin');
?>
