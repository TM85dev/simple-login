<?php

namespace app\Models;

use app\Models\User;
use app\Models\Session;

class Auth {

    public static function user() {
        Session::start();
        if(isset($_SESSION['u_id']) && isset($_SESSION['auth'])) {
            $user_id = strval(explode('|', $_SESSION['u_id'])[0]);
            $auth_id = strval($_SESSION['auth']->id);
            if($user_id === $auth_id) {
                unset($_SESSION['auth']->password);
                return $_SESSION['auth'];
            } else {
                return (object) [];
            }
        }
    }
    public static function login(object $auth) {
        Session::start();
        $user = new User;
        $user = $user->get($auth);
        if($user->password === md5($auth->password)) {
            unset($user->password);
            $_SESSION['u_id'] = $user->id.'|'.uniqid();
            $_SESSION['auth'] = $user;
            return true;
        } else {
            return false;
        }
    }
    public static function logout() {
        Session::start();
        if(isset($_SESSION['u_id']) && isset($_SESSION['auth'])) {
            Session::stop();
            return true;
        } else {
            return false;
        }
    }
}

?>