<?php
define('SAFE_MODE', true);
require __DIR__ . '/../auth/session.php';
$is_admin = require __DIR__ . '/../auth/is_admin.php';

if(!$is_admin){
    echo 'You are not permitted to delete users!';
    return;
}

if(!isset($_POST['id'])){
    echo 'id is not set';
    return;
}

require __DIR__ . '/../auth/authenticate.php';

$stmt = $conn->prepare("delete from users where id = :id");
$stmt->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
$stmt->execute();

header('location: /admin');
?>
