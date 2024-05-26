<?php
require __DIR__ . '/../auth/safe_mode.php';
$logged_in = require __DIR__ . '/../auth/is_logged_in.php';

if($logged_in){
    echo '<script src="/assets/alarm/warning.js" ></script>';
    echo '<script>get_last_ping()</script>';
    echo '<script>setInterval(get_last_ping, 5000)</script>';
    echo '<div class="popup" id="popup">';
    echo 'WARNING: The Raspberry Pi Client Is Not Connected!';
    echo '</div>';
}
?>
