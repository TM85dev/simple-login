<?php 
    include_once 'includes/autoloader.php';
    Session::start();
    Session::isNotAuth('login.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST') $_method = $_POST['_method'];
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
    <?php 
        $auth = Auth::user();
        $api = new AuthController;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User;
            if($_method == 'PUT') {
                $user->edit([
                    'id' => $auth->id,
                    'old_email' => $auth->email,
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password']
                ]);    
            }
            if($_method == 'DELETE') {
                
            }
        }
        ?>
    <div class="welcome-header">
        <div>
            Welcome <b><?=$auth->name ?></b>
        </div>
        <?php if( $api->response() ): ?>
            <div class="success-login"><?=$api->response(); Session::remove('action_info'); ?></div>
        <?php endif; ?>
        <div>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <button class="delete-btn" type="submit">Delete</button>
            </form>
            <form action="./logout.php" method="POST">
                <button class="logout-btn" type="submit">Logout</button>
            </form>
        </div>
    </div>
    <div class="edit-form">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <div class="title">Edit profile</div>
            <input type="hidden" name="_method" value="PUT">
            <input type="text" name="name" value="<?=$auth->name?>" placeholder="name"><br/>
            <input type="email" name="email" value="<?=$auth->email?>" placeholder="email"><br/>
            <input type="text" name="old_password" placeholder="old password"><br/>
            <input type="text" name="new_password" placeholder="new password">
            <button type="submit">Edit</button>
        </form>
    </div>
</body>
</html>