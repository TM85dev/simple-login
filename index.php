<?php 
    session_start();
    if(!isset($_SESSION['u_id'])) header('Location: ./login.php');
    include 'includes/autoloader.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST') $_method = $_POST['_method'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <?php 
        $auth = Auth::user();
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($_method == 'PATCH') {
    
            }
            if($_method == 'DELETE') {
                $user = new User;
                $user->delete($auth);
                Auth::logout();
            }
        }
        ?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <label>
            Name: <input type="text" value="<?=$auth->name?>">
        </label>
        <label>
            Email: <input type="email" value="<?=$auth->email?>">
        </label>
        <label>
            Password: <input type="text">
        </label>
        <button type="submit">Edit</button>
    </form>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit">Delete</button>
    </form>
    <form action="./logout.php">
        <button type="submit">Logout</button>
    </form>
</body>
</html>