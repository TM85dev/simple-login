<?php

namespace app\Controllers;

use app\Models\User;
use app\Models\Auth;
use app\Traits\TraitRes;

// include_once 'includes/autoloader.php';

class UserController {
    use TraitRes;

    public function register(object $request) {
        $user = new User;
        $user->validateRegister($request);
        if(!$user->error()) {
            $user->create($request);
            $this->res = $user->response();
        } else $this->error = $user->error();
        return $this;
    }
    public function delete(object $request) {
        $user = new User;
        $user->get($request);
        $user->validateRemove();
        $_SESSION['action_error'] = $user->error();
        // $_SESSION['action_info'] = $user->response();
        // if($user->error()) {
        //     $this->error = $user->error();
        //     $_SESSION['action_error'] = $user->error();
        // } else {
        //     $this->res = $user->response();
        //     $_SESSION['action_info'] = $user->response();
        //     Auth::logout($user);
        // }
        header('Location: /sign/');
        exit;
    }

}

?>