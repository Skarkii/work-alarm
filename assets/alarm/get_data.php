<?php
if(!isset($_SERVER['HTTP_X_API_KEY'])) {
    echo "Invalid API Key (not set)"; 
    return;
}

if($_SERVER['HTTP_X_API_KEY'] != "im_safe_i_promise") {
    echo "Invalid API Key"; 
    return;
}
$data = array(
    'alarm' => 3,
);

echo json_encode($data);
return;

?>
