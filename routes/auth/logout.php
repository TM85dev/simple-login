<?php
    include '../../includes/autoloader.php';

    use app\Controllers\AuthController;
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        header('Content-Type: application/json');
        
        $api = new AuthController();
        $api->logout();

        $res = $api->error() ? $api->error() : $api->response();

        echo json_encode($res);
    }
?>