<?php 
    include_once 'includes/autoloader.php';

    use app\Models\Session;
    use app\Models\Auth;
    use app\Controllers\AuthController;
    use app\Controllers\UserController;
    
    Session::start();
    Session::isNotAuth('login.php');

    $auth = Auth::user();
    $api = new AuthController;
    $api_user = new UserController;
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="welcome-header">
        <div>
            Welcome <b><?=$auth->name; ?></b>
        </div>
        <?php if( $api->response() ): ?>
            <div class="success-login"><?=$api->response(); ?></div>
        <?php endif; ?>
        <div class="left-menu-actions">
            <button id="toggleDelete" class="delete-btn">Delete</button>
            <form class="toggle-delete" action="routes/users/delete.php" method="POST">
                <div class="close">x</div>
                <input type="hidden" name="_method" value="DELETE">
                <div class="password-row">
                    <input type="text" name="confirm_password" placeholder="confirm password" autocomplete="off">
                    <button class="delete-btn" type="submit">Delete</button>
                </div>
                <?php if( $api_user->error() ): ?>
                    <div class="error">
                        <p><?=$api_user->error(); ?></p>
                    </div>
                <?php endif; ?>
            </form>
            <form action="./logout.php" method="POST">
                <button class="logout-btn" type="submit">Logout</button>
            </form>
        </div>
    </div>
    <div class="edit-form">
        <form action="routes/users/edit.php" method="POST">
            <div class="title">Edit profile</div>
            <input type="hidden" name="_method" value="PUT">
            <input type="text" name="name" value="<?=$auth->name?>" placeholder="name"><br/>
            <input type="email" name="email" value="<?=$auth->email?>" placeholder="email"><br/>
            <input type="text" name="old_password" placeholder="old password"><br/>
            <input type="text" name="new_password" placeholder="new password">
            <button type="submit">Edit</button>
            <?php if( $api->error() ): ?>
                <div class="error">
                    <p><?=$api->error(); ?></p>
                </div>
            <?php elseif( $api->response() ): ?>
                <div class="success">
                    <p><?=$api->response(); ?></p>
                </div>
            <?php endif; ?>
        </form>
    </div>
    <?php Session::remove(['action_info', 'action_error']); ?>
    <script src="assets/js/script.js"></script>
</body>
</html>