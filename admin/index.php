<?php
    define('SAFE_MODE', true);

    $is_admin = require '../assets/auth/is_admin.php';
    if($is_admin == false){
        header('location:/');
    }
?>
<h1>Admin Page</h1>

