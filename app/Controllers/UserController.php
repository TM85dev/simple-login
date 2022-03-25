<?php
include_once 'app/Models/User.php';

class UserController {

    public function register(array $request) {
        $user = new User;
        $user->validateRegister($request);
        if($user->error()) {
            return ['error' => $user->error()];
        } else {
            $user->create($request);
            return ['success' => $user->response()];
        }
    }
    public function delete() {

    }
}

?>