<?php
define('SAFE_MODE', true);
$is_logged_in = require __DIR__ . '/../assets/auth/is_logged_in.php';

if(!$is_logged_in) {
    header('location: /');
}

require __DIR__ . '/../assets/components/header.php';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../assets/style/global.css">
</head>
<body>

<h1>Profile Page</h1>

</body>
</html>
