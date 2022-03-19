<?php 
    include 'includes/user.php';
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
        $user = new User();
        $user->register([
            'name' => 'Tom',
            'email' => 'drakk-kun@o2.pl',
            'password' => '1z2x3c4v'
        ]);
        echo $user->error();
    ?>
</body>
</html>