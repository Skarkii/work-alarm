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
    case 'alarm_data':
        $stmt = $conn->prepare("select count(*) from users_in");
        $stmt->execute();
        $users_in = $stmt->fetch();

        $data = array(
            "users_in" => $users_in['count(*)'],
        );

        $stmt = $conn->prepare("select config, value from alarm_config");
        $stmt->execute();
        $cfgs= $stmt->fetchAll();
        foreach($cfgs as $cfg) {
            $data = array_merge($data, array($cfg['config'] => $cfg['value']));
        }
        //  $data = array_merge($data, array("test"=>"test"));
        echo json_encode($data);
        return 200;
        break;
    case 'get_client_time':
        $stmt = $conn->prepare("select time from is_alive where device=1");
        $stmt->execute();
        $result = $stmt->fetch();
        echo $result['time'];
        break;
    default:
        echo "Invalid request";
        return 403;
        break;
}
?>
