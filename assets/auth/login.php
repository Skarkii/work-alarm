<?php
    require __DIR__ . '/safe_mode.php';

function login($name, $pass){
    require __DIR__ . '/session.php';
    require __DIR__ . '/authenticate.php';

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE name = :name");

    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row == false or !password_verify($pass, $row['password'])){
        return false;
    }
    $id = $row['id'];
    $stmt = $conn->prepare("SELECT user FROM admins WHERE user= :id");
    $stmt->bindParam(':id', $id , PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row) {
        $_SESSION['admin'] = 1;
    }

    $stmt = $conn->prepare("SELECT user FROM managers WHERE user= :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row) {
        $_SESSION['manager'] = 1;
    }

    $_SESSION['username'] = $name;
    $_SESSION['id'] = $id;
    return true;
}
?>
