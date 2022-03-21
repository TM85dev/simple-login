<?php
include_once 'includes/autoloader.php';

class UserController {
    public function login() {

    }
    public function logout() {
        session_start();
        session_destroy();
        header('Location: ./login.php');
    }
    public function register($request) {
        $user = new User;
        $user->validateRegister($request);
        if($user->error()) {
            return $user->error();
        } else {
            $user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'password2' => $request->password2
            ]);
            return $user->response();
        }
    }
    public function delete() {

    }
}

?>