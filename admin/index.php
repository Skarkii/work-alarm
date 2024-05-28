<?php
    define('SAFE_MODE', true);

    $is_admin = require __DIR__ . '/../assets/auth/is_admin.php';
    if($is_admin == false){
        header('location:/');
    }

    require __DIR__ . '/../assets/components/header.php';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../assets/style/global.css">
</head>
<body>

<h1>Admin Page</h1>
<?php 
    if(isset($_GET['user'])) {
        require __DIR__ . '/../assets/components/user_table.php';
    } else {
        require __DIR__ . '/../assets/components/admin_table.php';
    }
?>

<?php  require __DIR__ . '/../assets/alarm/warning.php'; ?>
</body>
</html>

