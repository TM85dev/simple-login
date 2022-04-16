<?php
    include 'includes/autoloader.php';
    
    use app\Models\Session;
    Session::start();
    Session::isAuth('index.php');
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
    </form>

    <script type="module" src="assets/js/login.js"></script>
</body>
</html>