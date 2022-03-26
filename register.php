<?php 
    session_start();
    if(isset($_SESSION['u_id'])) header('Location: ./index.php');
    include 'includes/autoloader.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        $request = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'password2' => $_POST['password2']
        ];
    
        $controller = new UserController();
        $response = $controller->register($request);
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
        <label>Name</label>
        <input type="text" name="name" autocomplete="off">
        <label>Email</label>
        <input type="email" name="email">
        <label>Password</label>
        <input type="password" name="password">
        <label>Confirm</label>
        <input type="password" name="password2">
        <button type="submit">Register</button>
        <a href="./login.php" class="login-link">Login</a>
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
<?php 

?>
</body>
</html>