<?php
include_once 'includes/autoloader.php';

class UserController {
    use Responses;

    public function register(object $request) {
        $user = new User;
        $user->validateRegister($request);
        if(!$user->error()) {
            $user->create($request);
            $this->res = $user->response();
        } else $this->error = $user->error();
        return $this;
    }
    public function delete() {

    }

}

?>