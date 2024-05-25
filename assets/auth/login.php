<?php
    require __DIR__ . '/safe_mode.php';
    require __DIR__ . '/session.php';

    include __DIR__ . 'authenticate.php';

    $name = "admin";
    $pass = "admin";

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE name = :name");
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row == false) {
        echo "Invalid username";
        return;
    }
    if(!password_verify($pass, $row['password'])){
        echo "Wrong password";
        return;
    }
    $id = $row['id'];
    $stmt = $conn->prepare("SELECT user FROM admins WHERE user= :id");
    $stmt->bindParam(':id', $row['id'], PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row) {
        echo "Is Admin";
        $_SESSION['admin'] = 1;
    }
    $_SESSION['username'] = $name;
    $_SESSION['id'] = $id;

?>
