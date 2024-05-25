<?php
$is_admin = require __DIR__ . '/../auth/is_admin.php';
$is_logged_in = require __DIR__ . '/../auth/is_logged_in.php';

?>

 <link rel="stylesheet" href="../assets/style/header.css">
 <ul>
  <li><a href="/">Home</a></li>
    <?php
        if($is_logged_in) {
            echo '<li><a href="' . __DIR__  . '/assets/auth/logout.php"' . '>Logout!</a></li>';
        } else {
            echo '<li><a href="/login"asp>Login!</a></li>';
        }
    ?>
</ul>
