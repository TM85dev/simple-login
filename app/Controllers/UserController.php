<?php

namespace app\Controllers;

use app\Models\User;
use app\Models\Auth;
use app\Models\Validator;
use app\Traits\TraitRes;

// include_once 'includes/autoloader.php';

class UserController {
    use TraitRes;

    public function register(object $request) {
        $validator = new Validator((object) [
            'name' => 'required|min:3',
            'email' => 'required|email|unique_users',
            'password' => 'required|password|min:6',
            'confirm_password' => 'required|confirm_password'
        ]);
        $data = (object) [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'confirm_password' => $request->confirm_password
        ];
        $validator->validate($data);
        if($validator->error()) {
            $this->error = ['error' => $validator->error()];
        } else {
            $user = new User;
            unset($data->confirm_password);
            $user->create($data);
            if($user->error()) {
                $this->error = ['error' => $$user->error()];
            } else {
                $this->res = ['msg' => $user->response()];
            }
        }
    }
    public function delete(object $request) {
        $auth = Auth::user();
        $user = new User;
        $password = $user->get($auth)->password;
        $validator = new Validator((object) [
            'password' => 'required|password',
            'confirm_password' => 'required|confirm_password'
        ]);
        $data = (object) [
            'password' => $password,
            'confirm_password' => md5($request->confirm_password)
        ];
        $validator->validate($data);
        if($validator->error()) {
            $_SESSION['delete_error'] = $validator->error();
        } 
        else {
            Auth::logout($user);
            $user->remove($request->email);
            $_SESSION['action_info'] = "User was removed";
        }
        header('Location: /sign/');
        
    }
    public function edit(object $request) {
        $user = new User;
        $data = (object) [
            'email' => $request->old_email,
        ];
        $password = $user->get($data)->password;
        $validator = new Validator((object) [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|password|is_hashed',
            'confirm_password' => 'required|confirm_password|password',
            'new_password' => 'required|password'
        ]);
        $data = (object) [
            'name' => $request->new_name,
            'email' => $request->new_email,
            'password' => $password,
            'confirm_password' => md5($request->old_password),
            'new_password' => $request->new_password
        ];
        $validator->validate($data);
        if($validator->error()) {
            $this->error = ['error' => $validator->error()];
        } else {
            $data = (object) [
                'old_email' => $request->old_email,
                'new_name' => $request->new_name,
                'new_email' => $request->new_email,
                'new_password' => $request->new_password
            ];
            $user->edit($data);
            $_SESSION['auth']->name = $request->new_name;
            $_SESSION['auth']->email = $request->new_email;
            $this->res = ['msg' => 'User data updated'];
        }
        // $user = new User;
        // $data = (object) ['email' => $request->old_email];
        // $user->get($data);
        // $user->validateEdit();
        // if($user->error()) {
        //     $this->error = $user->error();
        //     $_SESSION['action_error'] = $user->error();
        // } else {
        //     $this->res = $user->response();
        //     $_SESSION['action_info'] = $user->response();
        //     $user->edit($request);
        // }
        // exit;
    }

}

?>