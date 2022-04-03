<?php
    include 'includes/autoloader.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $controller = new AuthController();
        $controller->logout();
    }
?>