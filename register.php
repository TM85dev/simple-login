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
    <title>Register</title>
</head>
<body>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <input type="text" name="name">
        <input type="email" name="email">
        <input type="password" name="password">
        <input type="password" name="password2">
        <button type="submit">Register</button>
    </form>
    <div>
        <?php if(isset($response['error'])): ?>
            <p style="color:red"><?=$response['error']?></p>
        <?php elseif(isset($response['success'])): ?>
            <p style="color:green"><?=$response['success']?></p>
        <?php endif; ?>
    </div>
<?php 

?>
</body>
</html>