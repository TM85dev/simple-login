<?php

namespace app\Controllers;

use app\Traits\TraitRes;
use app\Models\User;
use app\Models\Auth;
use app\Models\Validator;


class AuthController {
    use TraitRes;
    
    public function login(object $request) {
        $validator = new Validator((object) [
            'email' => 'required|email',
            'password' => 'required|password'
        ]);
        $data = (object) [
            'email' => $request->email,
            'password' => $request->password
        ];
        $validator->validate($data);
        if($validator->error()) {
            $this->error = ['error' => $validator->error()];
        } else {
            $auth = Auth::login($data);
            if(!$auth) {
                $this->error = ['error' => 'Invalid data'];
            } else {
                $this->res = ['msg' => 'Successfylly login'];
            }
        }
    }
    public function logout() {
        Auth::logout();
        $_SESSION['action_info'] = 'Successfully logout';
        header('Location: ./login.php');
    }
}