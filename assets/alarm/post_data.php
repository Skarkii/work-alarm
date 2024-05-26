<?php
if(!isset($_SERVER['HTTP_X_API_KEY'])) {
    echo "Invalid API Key (not set)"; 
    return 403;
}

if($_SERVER['HTTP_X_API_KEY'] != "im_safe_i_promise") {
    echo "Invalid API Key"; 
    return 403;
}

if(!isset($_SERVER['HTTP_REQUEST'])) {
    echo "No request provied";
    return 403;
}


define('SAFE_MODE', true);
require __DIR__ . '/../auth/authenticate.php';

switch($_SERVER['HTTP_REQUEST']){
    case 'is_alive':
        # update is_alive set time=now() where device=1;
        $stmt = $conn->prepare("update is_alive set time=now() where device = 1");
        $stmt->execute();
        return 200;
        break;
}
?>
