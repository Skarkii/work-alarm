<?php
$is_admin = require __DIR__ . '/../auth/is_admin.php';
$is_logged_in = require __DIR__ . '/../auth/is_logged_in.php';
$is_manager = require __DIR__ . '/../auth/is_manager.php';
?>

 <link rel="stylesheet" href="../assets/style/header.css">
 <ul>
  <li><a href="/">Home</a></li>
    <?php
        if($is_logged_in) {
            echo '<li><a href="/profile">Profile</a></li>';
            if($is_admin) {
                echo '<li><a href="/admin">Admin Page</a></li>';
                echo '<li><a href="/alarm">Configure Alarm</a></li>';
            }
            if($is_manager) {
                echo '<li><a href="/manager">Manager Page</a></li>';
            }
            echo '<li><a href="/assets/auth/logout.php">Logout</a></li>';
        } else {
            echo '<li><a href="/login"asp>Login!</a></li>';
        }
    ?>
</ul>
