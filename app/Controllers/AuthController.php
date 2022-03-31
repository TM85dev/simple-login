<?php

include_once 'app/Models/User.php';

class AuthController extends User {
    
    public function login(object $request) {
        $auth = $this->get($request);
        $this->validateLogin();
        if(!$this->error()) {
            session_start();
            $_SESSION['u_id'] = $auth->id.'|'.uniqid();
            $_SESSION['auth'] = $auth;
            header('Location: ./index.php');
        }
        return $this;
    }

}