<?php
require __DIR__ . '/../auth/safe_mode.php';
$is_admin = require __DIR__ . '/../auth/is_admin.php';

if(!$is_admin)
    header('location: /');

require __DIR__ . '/../auth/authenticate.php';

$stmt = $conn->prepare("SELECT id, name, password from users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '
    <form action="/assets/auth/create_user.php" method="post">
        <div class="form-group">
            <label for="name">name:</label>
            <input type="text" id="name" name="name" required>
            <br>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
        </div>
        <br>
        <button type="submit">Create User</button>
    </form>
';

echo '<h1>Users</h1>
        <table id="users_table">
            <thead>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>password</th>
                <th>manage</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
';


foreach($users as $user) {
    echo '
    <tr>
        <td id="mod">'. $user['id'].'</td> 
        <td id="mod">'. $user['name'].'</td>
        <td id="mod">'. $user['password'] . '</td>
        <td>
        <form action="/admin" method="get">
            <input type="hidden" name="user" value="' . $user['id'] . '">
            <button type="submit">Modify</button>
        </form>
        </td>
        <td>
        <form action="/assets/auth/delete_user.php" method="post">
            <input type="hidden" name="id" value="' . $user['id'] . '">
            <button type="submit">Delete</button>
        </form>
        </td>
    </tr>
    ';
}
echo '</tbody>
    </table>';
?>

<script>
document.querySelectorAll('#mod').forEach(cell => {
    cell.addEventListener('dblclick', function () {

    const original_text = this.textContent;
    const input = document.createElement('input');
    input.type = 'text';
    input.value = original_text;
    input.style.width = '100%';

    input.addEventListener('blur', () => {
        this.textContent = input.value;
    });

    input.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            this.textContent = input.value;
            const cells = this.parentElement.querySelectorAll('td');
            const data = Array.from(cells).map(cell => cell.textContent);
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../assets/auth/user_manage.php", true);
            xhttp.setRequestHeader('X-API-KEY', 'im_safe_i_promise');
            xhttp.setRequestHeader('REQUEST', 'UPDATE_USER');
            xhttp.setRequestHeader('ID', data[0]);
            xhttp.setRequestHeader('USERNAME', data[1]);
            xhttp.setRequestHeader('PASSWORD', data[2]);
            console.log(data);
            xhttp.send();
        } else if (event.key === 'Escape') {
            this.textContent = original_text;
        }
    });

    this.textContent = '';
    this.appendChild(input);
    input.focus();
    });
});
</script>
