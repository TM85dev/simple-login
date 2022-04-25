<?php

require_once '../../includes/autoloader.php';

use app\Controllers\UserController;
use app\Models\Auth;
use app\Models\Request;

if($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    header('Content-Type: application/json');
    
    $auth = Auth::user();
    $api = new UserController;

    $req = new Request;
    $request = $req->method('patch')->format();
    $request->old_email = $auth->email;

    $api->edit($request);

    $res = $api->error() ? $api->error() : $api->response();

    echo json_encode($res);
}