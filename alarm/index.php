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
<script src="../assets/alarm/ajax.js"></script>
<script>get_data_loop()</script>
</head>
<body>

<h1>Alarm Page</h1>

<div>
  <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
</div>

<?php  require __DIR__ . '/../assets/alarm/warning.php'; ?>
</body>
</html>
