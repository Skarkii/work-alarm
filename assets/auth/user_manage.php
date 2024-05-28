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

$stmt = $conn->prepare("select id, name from users where id=:id");
$stmt->bindParam(':id', $_SERVER['HTTP_ID'] , PDO::PARAM_STR);
$stmt->execute();
$original = $stmt->fetch(PDO::FETCH_ASSOC);

switch($_SERVER['HTTP_REQUEST']){
    case 'UPDATE_USER':
        if(!isset($_SERVER['HTTP_ID'])
            or !isset($_SERVER['HTTP_USERNAME']) 
            or !isset($_SERVER['HTTP_PASSWORD'])){
                echo "Failed, missing data";
                return;
                break;
        }

        $stmt = $conn->prepare("update users set id=:id, name=:name where id=:orgid");
        $stmt->bindParam(':id', $_SERVER['HTTP_ID'] , PDO::PARAM_STR);
        $stmt->bindParam(':orgid', $original['id'], PDO::PARAM_STR);
        $stmt->bindParam(':name', $_SERVER['HTTP_USERNAME'] , PDO::PARAM_STR);
        $stmt->execute();

        if($original['name'] == $_SERVER['HTTP_USERNAME'] and $original['id'] == $_SERVER['HTTP_ID']){
            $stmt = $conn->prepare("update users set password=:password where id=:id");
            $stmt->bindParam(':password', password_hash($_SERVER['HTTP_PASSWORD'], PASSWORD_DEFAULT) , PDO::PARAM_STR);
            $stmt->bindParam(':id', $_SERVER['HTTP_ID'] , PDO::PARAM_STR);
            $stmt->execute();
        }
        break;
    default:
        echo "Invalid request";
        return 403;
        break;
}
?>
