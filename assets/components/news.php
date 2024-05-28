<?php
require __DIR__ . '/../auth/safe_mode.php';
$logged_in = require __DIR__ . '/../auth/is_logged_in.php';

$is_manager = require __DIR__ . '/../auth/is_manager.php';
$is_admin = require __DIR__ . '/../auth/is_admin.php';

if(!$logged_in)
    return;

if($is_manager or $is_admin){
    echo '<div class="news-card">';
    echo '<h1>' . "Create new post!". '</h1>';
    echo '
    <form action="/assets/news/create_post.php" method="post">
        <div class="form-group">
            <label for="title">Title:</label>
            <br>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="text">Text:</label>
            <br>
            <textarea id="text" name="text" required></textarea>
        </div>
        <br>
        <button type="submit">Create Post</button>
    </form>
    ';
    echo '</div>';
}

require __DIR__ . '/../auth/authenticate.php';

$stmt = $conn->prepare("SELECT id, author, date, contents, title FROM posts  ORDER by date DESC");
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
    if($is_manager or $is_admin){
        echo '
        <form action="/assets/news/delete_post.php" method="post">
            <input type="hidden" name="id" value="' . $post['id'] . '">
            <button type="submit">Delete</button>
        </form>
        ';
    }
    echo '</div>';
}
?>
