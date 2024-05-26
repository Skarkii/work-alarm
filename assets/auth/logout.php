<?php
    define('SAFE_MODE', true);
    require __DIR__ . '/session.php';
    require __DIR__ . '/authenticate.php';

    if(isset($_SESSION['id'])) {
        $stmt = $conn->prepare("insert into logs (user, entered) values (:id, 0)");
        // 1 indicates entered as in mysql true == 1 but in php true == 0
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->execute();
    }


    session_unset();
    session_destroy();

    header('location:/');
?>
