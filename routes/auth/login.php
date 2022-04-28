<?php 
    
    include '../../includes/autoloader.php';
    
    use app\Models\Session;
    use app\Controllers\AuthController;
    use app\Models\Request;
    
    Session::start();
    Session::isAuth('index.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        header('Content-Type: application/json');

        $api = new AuthController;
    
        $req = new Request;
        $request = $req->method('POST')->format();
        
        $api->login($request);
        
        $res = $api->error() ? $api->error() : $api->response();
        
        echo json_encode($res);
    }
?>