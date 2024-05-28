<?php
define('SAFE_MODE', true);

require __DIR__ . '/session.php';
$is_admin = require __DIR__ . '/is_admin.php';

if(!$is_admin)
    header('location: /');

if(!isset($_POST['id']) or !isset($_POST['name']) or !isset($_POST['password']) or !isset($_POST['manager'])){
    echo "Invalid post";
    return;
}
$id = $_POST['id'];
$name = $_POST['name'];
$pass= $_POST['password'];
$manager = $_POST['manager'];
$user_admin = isset($_POST['is_admin']);
$user_manager = isset($_POST['is_manager']);

require __DIR__ . '/authenticate.php';

$stmt = $conn->prepare("select password from users where id=:id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$original = $stmt->fetch(PDO::FETCH_ASSOC);
if($pass != $original['password'])
    $pass = password_hash($pass, PASSWORD_DEFAULT);

$stmt = $conn->prepare("update users set id=:id, name=:name, password=:pass where id=:id");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':pass', $pass );
$stmt->bindParam(':id', $id );
$stmt->execute();

if($user_admin){
    $stmt = $conn->prepare("insert ignore into admins (user) values (:id)");
    $stmt->bindParam(':id', $id );
    $stmt->execute();
} else {
    $stmt = $conn->prepare("delete ignore from admins where user=:id");
    $stmt->bindParam('id',$id);
    $stmt->execute();
}

if($user_manager){
    $stmt = $conn->prepare("insert ignore into managers (user) values (:id)");
    $stmt->bindParam(':id', $id );
    $stmt->execute();
} else {
    $stmt = $conn->prepare("delete ignore from managers where user=:id");
    $stmt->bindParam('id',$id);
    $stmt->execute();
}

$stmt = $conn->prepare("delete ignore from works_for where user=:id");
$stmt->bindParam('id',$id);
$stmt->execute();

$stmt = $conn->prepare("insert into works_for (user, manager) values (:id, :manager)");
$stmt->bindParam('id',$id);
$stmt->bindParam('manager', $manager);
$stmt->execute();


header('location: /admin?user=' . $id);
?>
