<?php

include '../../includes/autoloader.php';
    
use app\Controllers\UserController;

$api = new UserController();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    $request = (object) [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'confirm_password' => $_POST['confirm_password']
    ];

    $api->register($request);

    $res = $api->error() ? $api->error() : $api->response();

    echo json_encode($res);
}