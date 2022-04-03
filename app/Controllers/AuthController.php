<?php

include_once 'includes/autoloader.php';

class AuthController {
    use TraitRes;

    public function __construct() {
        Session::start();
    }
    
    public function login(object $request) {
        $user = new User;
        $auth = $user->get($request);
        $user->validateLogin();
        if($user->error()) {
            $this->error = $user->error();
        } else {
            $_SESSION['u_id'] = $auth->id.'|'.uniqid();
            $_SESSION['auth'] = $auth;
            $_SESSION['action_info'] = 'Successfully login';
            header('Location: ./index.php');
        }
        return $this;
    }
    public function edit() {

    }
    public function logout() {
        Auth::logout();
        $_SESSION['action_info'] = 'Successfully logout';
        header('Location: ./login.php');
    }
}