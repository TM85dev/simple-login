<?php

namespace app\Controllers;

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
        $user->validateLogin();
        if($user->error()) {
            $this->error = $user->error();
        } else {
            $this->res = $user->response();
        }
        Auth::logout($user);
    }

}

?>