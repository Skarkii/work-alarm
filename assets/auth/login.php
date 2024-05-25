<?php
    if(!defined('SAFE_MODE')){
        //die('Direct Access is not permitted!');
    }

    include 'authenticate.php';

    $name = "admin";
    $pass = "admin";

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE name = :name");
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();

    $stmt = $conn->query("SELECT * FROM users");
while ($row = $stmt->fetch()) {
    echo $row['name']."<br />\n";
}

    if($stmt->fetchColumn() <= 0) {
        echo "user does not exist";
    }

    echo $stmt->fetchColumn(0);

    if($res = password_verify($pass, $stmt->fetchColumn(1))){
        echo $res;
        echo "Correct";
    } else {
        echo $stmt->fetchColumn(1);
        echo "not correct";
    }

    $stmt = $conn->prepare("SELECT COUNT(*) FROM admins WHERE user = :user_id");

    $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

    $stmt->execute();

    $result = $stmt->fetchColumn();

    if ($result > 0) {
        $_SESSION['is_admin'] = 1;
    }
?>
