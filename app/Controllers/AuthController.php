<?php

namespace app\Controllers;

use app\Traits\TraitRes as TraitRes;
use app\Models\User as User;
use app\Models\Auth as Auth;

// include_once 'includes/autoloader.php';

class AuthController {
    use TraitRes;
    
    public function login(object $request) {
        $user = new User;
        $auth = $user->get($request);
        $user->validateLogin();
        if($user->error()) {
            $this->error = $user->error();
        } else {
            Auth::login($auth);
            $_SESSION['action_info'] = 'Successfully login';
            header('Location: ./index.php');
            exit;
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