<?php

require_once '../../includes/autoloader.php';

use app\Models\Session;
use app\Models\Auth;
use app\Models\Request;
use app\Controllers\UserController;

Session::start();
Session::isNotAuth('login.php');
if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $api = new UserController;
    
    $req = new Request;
    $request = $req->method('DELETE')->format();
    
    $auth = Auth::user();
    $data = (object) [
        'email' => $auth->email,
        'confirm_password' => $request->confirm_password
    ];
    
    $api->delete($data);

    $res = $api->error() ? $api->error() : $api->response();

    echo json_encode($res);
}
