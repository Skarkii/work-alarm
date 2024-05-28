<?php
define('SAFE_MODE', true);
require __DIR__ . '/../auth/session.php';
$is_admin = require __DIR__ . '/../auth/is_admin.php';

if(!$is_admin)
    header('location: /');

if(!isset($_POST['time'])){
    echo 'Invalid Post';
    return;
}

require __DIR__ . '/../auth/authenticate.php';

$active = 0;
if(isset($_POST['activated']))
    $active = 1;

$stmt = $conn->prepare('update alarm_config set value=:status where config="activated"');
$stmt->bindParam(":status", $active);
$stmt->execute();

$stmt = $conn->prepare('update alarm_config set value=:val where config="time_upon_empty"');
$stmt->bindParam(":val", $_POST['time']);
$stmt->execute();

header('location: /alarm');
?>
