<?php
    define('SAFE_MODE', true);
    require __DIR__ .  '/assets/components/header.php';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/style/global.css">
</head>
<body>

<div class="news-flex-box">
<?php require __DIR__ . '/assets/components/news.php'; ?>
</div>
</body>
</html>
