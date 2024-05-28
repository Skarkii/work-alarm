<?php
define('SAFE_MODE', true);
$is_logged_in = require __DIR__ . '/../assets/auth/is_logged_in.php';
$is_manager = require __DIR__ . '/../assets/auth/is_manager.php';

if(!$is_logged_in or !$is_manager) {
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

<h1>Manager Page</h1>
<?php require __DIR__ . '/../assets/components/manager_table.php'; ?>

<?php  require __DIR__ . '/../assets/alarm/warning.php'; ?>
</body>
</html>
