<?php

require_once '../../includes/autoloader.php';

use app\Controllers\UserController;
use app\Models\Auth;

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['_method'] == 'PUT') {
    $auth = Auth::user();
    $api = new UserController;
    $request = (object) [
        'old_email' => $auth->email,
        'old_password' => $_POST['old_password'],
        'new_name' => $_POST['name'],
        'new_email' => $_POST['email'],
        'new_password' => $_POST['new_password'],
    ];
    $api->edit($request);   
}