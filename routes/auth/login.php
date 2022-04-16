<?php 
    
    include '../../includes/autoloader.php';
    
    use app\Models\Session;
    use app\Controllers\AuthController;
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        header('Content-Type: application/json');

        Session::start();
        Session::isAuth('index.php');
        $api = new AuthController;
    
        $request = (object) [
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];
        $api->login($request);
        
        $res = $api->error() ? $api->error() : $api->response();
        
        echo json_encode($res);
    }
?>