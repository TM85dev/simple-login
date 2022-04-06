<?php
    include 'includes/autoloader.php';

    use app\Controllers\AuthController;

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $controller = new AuthController();
        $controller->logout();
    }
?>