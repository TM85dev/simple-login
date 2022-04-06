<?php

require_once '../../includes/autoloader.php';

use app\Models\Session;

Session::start();
Session::isNotAuth('login.php');
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['_method'] == 'DELETE') {
    $api = new UserController;
    $auth = Auth::user();
    $api->delete($auth);
}
