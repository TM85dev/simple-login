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
            $user = new User;
            if($_method == 'PATCH') {
                $user->edit([
                    'id' => $auth->id,
                    'old_email' => $auth->email,
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password']
                ]);    
            }
            if($_method == 'DELETE') {
                $user->delete($auth);
                Auth::logout();
            }
        }
        ?>
    <div class="welcome-header">
        Welcome <b><?=$auth->name ?></b>
    </div>
    <div class="edit-form">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <div class="title">Edit profile</div>
            <input type="hidden" name="_method" value="PATCH">
            <input type="text" name="name" value="<?=$auth->name?>" placeholder="name"><br/>
            <input type="email" name="email" value="<?=$auth->email?>" placeholder="email"><br/>
            <input type="text" name="old_password" placeholder="old password"><br/>
            <input type="text" name="new_password" placeholder="new password">
            <button type="submit">Edit</button>
        </form>
    </div>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit">Delete</button>
    </form>
    <form action="./logout.php">
        <button type="submit">Logout</button>
    </form>
</body>
</html>