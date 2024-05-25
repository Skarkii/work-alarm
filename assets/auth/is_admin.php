<?php
    if(!defined('SAFE_MODE')){
        die('Direct Access is not permitted!');
    }
    session_start();

    if(isset($_SESSION['is_admin'])){
        return true;
    }
    return false;
?>
