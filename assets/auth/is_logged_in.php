<?php
    require __DIR__ . '/safe_mode.php';
    require __DIR__ . '/session.php';

    if(isset($_SESSION['username'])){
        return true;
    }
    return false;
?>
