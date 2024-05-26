<?php
require __DIR__ . '/../auth/safe_mode.php';
require __DIR__ . '/../auth/session.php';


function worked_hours_total(){
    require __DIR__ . '/../auth/authenticate.php';
    $stmt = $conn->prepare("SELECT time, entered FROM logs order by time");
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
    return floor($totalTimeInSeconds / 3600);
}

function worked_hours_month(){
    return 5;
}
?>
