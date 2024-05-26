<?php
require __DIR__ . '/../auth/safe_mode.php';
$logged_in = require __DIR__ . '/../auth/is_logged_in.php';

if(!$logged_in)
    return;

require __DIR__ . '/../auth/authenticate.php';

$stmt = $conn->prepare("SELECT author, date, contents, title FROM posts  ORDER by date DESC");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<link rel="stylesheet" href="../assets/style/news.css">';

$max_posts = 10;
$i = 0;
foreach($posts as $post) {
    $i = $i + 1;
    if($i > $max_posts)
        break;
    $stmt = $conn->prepare("SELECT name FROM users where id = :id");
    $stmt->bindParam(":id", $post['author']);
    $stmt->execute();
    $author = $stmt->fetch(PDO::FETCH_ASSOC)['name'];

    echo '<div class="news-card">';
    echo '<h1>' . $post['title']. '</h1>';
    echo '<a>' . $post['contents'] . '</a>';
    echo '<h4>Posted: ' . $post['date'] . '</h4>';
    echo '</div>';
}
?>
