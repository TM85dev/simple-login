<?php 
    session_start();
    if(isset($_SESSION['u_id'])) header('Location: ./index.php');
    include 'includes/autoloader.php';
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
        email: <input type="email" name="email"><br>
        password: <input type="password" name="password"><br>
        <button type="submit">Login</button>
        <?php if(isset($response['error'])): ?>
            <div class="error">
                <p><?=$response['error']?></p>
            </div>
            <?php elseif(isset($response['success'])): ?>
            <div class="success">
                <p><?=$response['success']?></p>
            </div>
        <?php endif; ?>
    </form>
    <?php if($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
    <div>
        <?php
            $user = new User();
            $user->login([
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ]);
        ?>

    </div>
    <?php endif; ?>
</body>
</html>