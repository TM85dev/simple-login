<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['_method'] == 'PUT') {
    $user = new User;
    $user->edit([
        'id' => $auth->id,
        'old_email' => $auth->email,
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ]);    
}