<?php
require __DIR__ . '/../auth/safe_mode.php';
$is_manager = require __DIR__ . '/../auth/is_manager.php';

if(!$is_manager)
    return;

require __DIR__ . '/../auth/authenticate.php';

$stmt = $conn->prepare("SELECT user from works_for where manager =:id");
$stmt->bindParam(":id", $_SESSION['id']);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($users as $user){
    $user_id = $user['user'];

    $stmt = $conn->prepare("SELECT name from users where id=:id");
    $stmt->bindParam(":id", $user_id);
    $stmt->execute();
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT time, entered FROM logs where user=:id order by time");
    $stmt->bindParam(":id", $user_id);
    $stmt->execute();
    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalTimeInSeconds = 0;
    $entryTime = null;

    foreach ($entries as $entry) {
        $currentTime = new DateTime($entry['time']);

        if ($entry['entered']) {
            $entryTime = $currentTime;
        } else {
            if ($entryTime !== null) {
                $interval = $entryTime->diff($currentTime);

                $seconds = ($interval->h * 3600) + ($interval->i * 60) + $interval->s;

                $totalTimeInSeconds += $seconds;

                $entryTime = null;
            }
        }
    }
    echo "Employee: ";
    echo $user_data['name'];
    echo " has worked a total of: ";
    echo floor($totalTimeInSeconds / 3600);
    echo " hours!";
    echo "<br>";

}
?>
