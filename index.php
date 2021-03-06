<?php 
    include_once 'includes/autoloader.php';

    use app\Models\Session;
    
    Session::start();
    Session::isNotAuth('login');
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign</title>
    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body>
    <div class="welcome-header">
        <div class="username"></div>
        <div class="left-menu-actions">
            <button id="toggleDelete" class="delete-btn">Delete</button>
            <form class="toggle-delete" action="routes/users/delete" method="POST">
                <div class="close">x</div>
                <input type="hidden" name="_method" value="DELETE">
                <div class="password-row">
                    <input type="text" name="confirm_password" placeholder="confirm password" autocomplete="off">
                    <button class="delete-btn" type="submit">Delete</button>
                </div>
            </form>
            <form class="logout-form">
                <button class="logout-btn" type="submit">Logout</button>
            </form>
        </div>
    </div>
    <div class="edit-form">
        <form>
            <div class="title">Edit profile</div>
            <input type="hidden" name="_method" value="PUT">
            <input type="text" name="name" placeholder="name"><br/>
            <input type="email" name="email" placeholder="email"><br/>
            <input class="password-input" type="text" name="old_password" placeholder="old password" autocomplete="off"><br/>
            <input class="password-input" type="text" name="new_password" placeholder="new password" autocomplete="off">
            <button class="edit-btn">Edit</button>
        </form>
    </div>
    <script type="module" src="public/js/script.js"></script>
</body>
</html>