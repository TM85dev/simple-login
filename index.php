<?php 
    session_start();
    if(!isset($_SESSION['u_id'])) header('Location: ./login.php');
    include 'includes/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        print_r(Auth::user());
    ?>
    <form action="./logout.php">
        <button type="submit">Logout</button>
    </form>
</body>
</html>