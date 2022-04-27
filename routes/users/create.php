<?php

include '../../includes/autoloader.php';
    
use app\Controllers\UserController;
use app\Models\Request;

$api = new UserController();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    $req = new Request;
    $request = $req->method('POST')->format();

    $api->register($request);

    $res = $api->error() ? $api->error() : $api->response();

    echo json_encode($res);
}