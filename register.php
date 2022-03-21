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
    <title>Register</title>
</head>
<body>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <input type="text" name="name">
        <input type="email" name="email">
        <input type="password" name="password">
        <button type="submit">Register</button>
    </form>
    <?php if($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
    <div>
        <?php
            $user = new User();
            $user->register([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'password2' => $_POST['password2']
            ]);
        ?>
        <?php if($user->error()): ?>
            <span style="color: red"><?=$user->error(); ?></span>
        <?php else: ?>
            <span style="color: green"><?=$user->response(); ?></span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</body>
</html>