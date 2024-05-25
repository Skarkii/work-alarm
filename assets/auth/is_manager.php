<?php
require __DIR__ . '/safe_mode.php';
require __DIR__ . '/session.php';

if(isset($_SESSION['manager'])){
    return true;
}
return false;
?>
