<?php

include_once 'includes/autoloader.php';

class AuthController {
    use TraitRes;
    
    public function login(object $request) {
        $user = new User;
        $auth = $user->get($request);
        $user->validateLogin();
        if($user->error()) {
            $this->error = $user->error();
        } else {
            $this->res = $user->response();
            session_start();
            $_SESSION['u_id'] = $auth->id.'|'.uniqid();
            $_SESSION['auth'] = $auth;
            header('Location: ./index.php');
        }
        return $this;
    }

}