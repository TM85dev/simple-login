<?php

require_once '../../includes/autoloader.php';

use app\Models\Session;
use app\Models\Auth;
use app\Controllers\UserController;

Session::start();
Session::isNotAuth('login.php');
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['_method'] == 'DELETE') {
    $api = new UserController;
    $auth = Auth::user();
    $data = (object) [
        'email' => $auth->email,
        'password' => $_POST['confirm_password']
    ];
    $api->delete($data);
}
