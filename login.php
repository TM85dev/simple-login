<?php 
    session_start();
    if(isset($_SESSION['u_id'])) header('Location: ./index.php');
    include 'includes/autoloader.php';

    $response = new AuthController();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $request = (object) [
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];
        $response->login($request);
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
        <?php if($response->error()): ?>
            <div class="error">
                <p><?=$response->error(); ?></p>
            </div>
        <?php elseif($response->response()): ?>
            <div class="success">
                <p><?=$response->response(); ?></p>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>