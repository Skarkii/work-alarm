<?php
define('SAFE_MODE', true);
require __DIR__ . '/../assets/components/header.php';
require __DIR__ . '/../assets/auth/session.php';
$logged_in = require __DIR__ . '/../assets/auth/is_logged_in.php';

if($logged_in) {
    header('location: /');
}

if(isset($_POST['name']) and isset($_POST['pass'])){
    require __DIR__ . "/../assets/auth/login.php";
    $logged_in = login($_POST['name'], $_POST['pass']);

    if($logged_in){
        header('location: /');
    }

    $failed_login = true;
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../assets/style/global.css">
</head>
<body>

<form action="" method="POST">
  <label for="name">Username:</label><br>
  <input type="text" id="name" name="name"><br>
  <label for="pass">Password::</label><br>
  <input type="password" id="pass" name="pass">
<input type="submit" value="Submit">

<?php
if(isset($failed_login)) {
    echo '<br><a class="warning-text">Failed to login!</a>';
}
?>
</form>

</body>
</html>
