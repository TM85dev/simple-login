<?php 
    include 'includes/autoloader.php';

    use app\Models\Session;
    use app\Controllers\AuthController;

    Session::start();
    Session::isAuth('index.php');
    $api = new AuthController;
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $request = (object) [
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];
        $api->login($request);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login</title>
</head>
<body class="login">
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <h2 class="title">Login</h2>
        <input type="email" name="email" placeholder="email"><br>
        <input type="password" name="password" placeholder="password"><br>
        <button type="submit">Login</button>
        <a href="./register.php" class="register-link">Register</a>

            <?php if( $api->error() ): ?>
                <div class="error">
                    <p><?=$api->error(); ?></p>
                </div>
            <?php elseif( $api->response() ): ?>
                <div class="success">
                    <p><?=$api->response(); unset($_SESSION['action_info']); ?></p>
                </div>
            <?php endif; ?>

    </form>
</body>
</html>