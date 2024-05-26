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

switch($_SERVER['HTTP_REQUEST']){
    case 'GET_DATA':
        $data = array(
        'alarm' => 3,
        );
        echo json_encode($data);
        return 200;
        break;
    default:
        echo "Invalid request";
        return 403;
        break;
}
?>
