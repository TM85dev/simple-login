<?php

require_once '../../includes/autoloader.php';

use app\Models\Session;
use app\Models\Auth;

Session::start();
Session::isNotAuth('login');

header('Content-Type: application/json');

$auth = Auth::user();

echo json_encode($auth);

?>