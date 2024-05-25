<?php
    require __DIR__ . '/safe_mode.php';

    $servername = "localhost";
    $username = "srv";
    $password = "srvdbpass";
    $conn = null;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=work_alarm_db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Database Connection failed: " . $e->getMessage();
    }
?>
