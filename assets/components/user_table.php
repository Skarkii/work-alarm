<?php
    require __DIR__ . '/../auth/safe_mode.php';
    $is_admin = require __DIR__ . '/../auth/is_admin.php';

    if(!$is_admin)
        header('location: /');

    require __DIR__ . '/../auth/authenticate.php';

    $id = $_GET['user'];

    echo '
    <form action="/admin">
        <input type="submit" value="<- Go Back" />
    </form>
    ';

    $stmt = $conn->prepare("SELECT id, name, password from users where id =:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT count(*) from admins where user=:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC)['count(*)'];
    $is_admin = False;
    if($result > 0)
        $is_admin = True;

    $stmt = $conn->prepare("SELECT count(*) from managers where user=:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC)['count(*)'];
    $is_manager = False;
    if($result > 0)
        $is_manager = True;

    $stmt = $conn->prepare("SELECT manager from works_for where user=:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $manager = -1;
    if($result){
        $manager = $result['manager'];
    }
    echo '
    <form action="/assets/auth/update_specific.php" method="post">
        <div>
            <label for="id">ID</label>
            <input type="text" id="id" name="id" value="' . $user['id'] . '" required>
        </div>
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="'. $user['name'] . '"required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="text" id="password" name="password" value="'. $user['password'] .'"required>
        </div>
        <div>
            <label for="manager">Manager</label>
            <input type="text" id="manager" name="manager" value="'. $manager .'"required>
        </div>
        <div>
            <label for="is_admin">
                <input type="checkbox" id="is_admin"';
        if($is_admin) { echo 'checked';};
        echo '
         name="is_admin">
                Is Admin
            </label>
        </div>
        <div>
            <label for="is_manager">
                <input type="checkbox" id="is_manager"';
        if($is_manager) { echo 'checked';};
        echo '
                name="is_manager">
                Is Manager
            </label>
        </div>
        <button type="submit">Update</button>
    </form>
';
?>
