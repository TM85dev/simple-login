<?php
    include 'includes/autoloader.php';
    
    use app\Models\Session;
    use app\Models\DB;
    Session::start();
    Session::isAuth('index');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Login</title>
</head>
<body class="login">
    <form>
        <h2 class="title">Login</h2>
        <input type="email" name="email" placeholder="email"><br>
        <input type="password" name="password" placeholder="password"><br>
        <button type="submit">Login</button>
        <a href="./register" class="register-link">Register</a>
    </form>

    <script src="public/js/login.js"></script>
</body>
</html>