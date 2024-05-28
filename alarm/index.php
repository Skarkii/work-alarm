<?php
define('SAFE_MODE', true);
$is_logged_in = require __DIR__ . '/../assets/auth/is_logged_in.php';

if(!$is_logged_in) {
    header('location: /');
}

require __DIR__ . '/../assets/auth/authenticate.php';
require __DIR__ . '/../assets/components/header.php';


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
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../assets/style/global.css">
<script src="../assets/alarm/ajax.js"></script>
</head>
<body>

<h1>Alarm Page</h1>
<form action="/assets/alarm/configure.php" method="POST">
<a>Activated: </a>
<input type="checkbox" name="activated" 
<?php 
if($data['activated'])
    echo ' checked ';
?>
id="activated">
</div>

<div>
<a>Time Until Alarm Activates after everyone left!</a>
<br>
<input type="range" min="1" name="time" id="time" max="100" value="<?php echo $data['time_upon_empty']; ?>" class="slider">
<span id="sliderValue">50</span>
</div>
<div>
<button type="submit" >Update!</button>
</div>
</form>
<script defer>
var slider = document.getElementById("time");

var sliderValueText = document.getElementById("sliderValue");

sliderValueText.textContent = slider.value;
slider.addEventListener("input", function() {
    sliderValueText.textContent = this.value;
});
</script>
<?php require __DIR__ . '/../assets/alarm/warning.php'; ?>
</body>
</html>
