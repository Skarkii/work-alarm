<?php
$hash = password_hash("admin", PASSWORD_DEFAULT);
echo $hash; 
echo "\n";
echo password_verify("admin", $hash); 
?>
