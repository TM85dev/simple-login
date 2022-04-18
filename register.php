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
    <link rel="stylesheet" href="public/css/style.css">
    <title>Register</title>
</head>
<body class="register">
    <form>
        <h2 class="title">Register</h2>
        <input type="text" name="name" autocomplete="off" placeholder="name"><br/>
        <input type="email" name="email" placeholder="email"><br/>
        <input type="password" name="password" placeholder="password"><br/>
        <input type="password" name="confirm_password" placeholder="confirm password">
        <button type="submit">Register</button>
        <a href="./login.php" class="login-link">Login</a>
    </form>
    <script src="public/js/register.js"></script>
</body>
</html>