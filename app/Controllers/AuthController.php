<?php

include_once 'app/Models/User.php';

class AuthController {
    
    public function login(array $request) {
        $user = new User();
        $auth = $user->get($request);
        $user->validateLogin($request);
        if($user->error()) {
            return ['error' => $user->error()];
        } else {
            session_start();
            $_SESSION['u_id'] = $auth->id.'|'.uniqid();
            $_SESSION['auth'] = $auth;
            header('Location: ./index.php');
            return ['success' => $user->res()];
        }
    }

}