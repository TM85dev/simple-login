<?php 
    include 'includes/autoloader.php';

    use app\Models\Session;
    use app\Controllers\UserController;

    Session::start();
    Session::isAuth('index.php');

    $api = new UserController();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $request = (object) [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'password2' => $_POST['password2']
        ];

        $api->register($request);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Register</title>
</head>
<body class="register">
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <h2 class="title">Register</h2>
        <input type="text" name="name" autocomplete="off" placeholder="name"><br/>
        <input type="email" name="email" placeholder="email"><br/>
        <input type="password" name="password" placeholder="password"><br/>
        <input type="password" name="password2" placeholder="confirm password">
        <button type="submit">Register</button>
        <a href="./login.php" class="login-link">Login</a>
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
</body>
</html>