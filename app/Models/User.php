<?php

namespace app\Models;

use app\Models\DB;
use app\Traits\TraitRes;

// include_once 'db.php';

class User {
    use TraitRes;

    protected $user;
    private $password = '';
    // protected $error = null;
    // protected $res = null;
    protected $request;

    public function get(object $request) {
        $db = new DB;
        $email = isset($request->email) ? $request->email : '';
        $this->user = $db->from('users')->where('email', $email)->get();
        $this->password = isset($request->password) ? md5($request->password) : $this->password;
        return $this->user;
    }
    public function create(object $request) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            unset($request->password2);
            $db = new DB;
            $db->from('users')->insert($request)->set();
            if(!$db->error()) {
                $this->res = "User was created";
            }
        } else {
            $this->error = 'Invalid request method';
        }

    }
    public function edit(object $request) {
        $db = new DB;
        $db->from('users')->update($request);
    }
    public function remove(object $request) {
        $db = new DB;
        $db->from('users')->delete(['email' => $request->email])->set();
    }
    public function validateEdit() {
        $user = $this->user;
        if(!$user) {
            $this->error = 'Can\'t find user';
        } else {
            $this->error = 'User found';
        }
    }
    public function validateLogin() {
        $user = $this->user;
        if(!$user) {
            $this->error = "Can't find user";
        } else {
            if($user->password === $this->password) {
                $this->res = "You are successfully login";
            } else {
                $this->error = 'Incorrect password';
            }
        }
    }
    public function validateRemove() {
        $user = $this->user;
        if(!isset($user->email)) {
            $this->error = 'User not found';
        } else {
            if(!isset($user->password)) {
                $this->error = 'Password required';
            } else {
                $db = new DB;
                $password = $db->from('users')->where('email', $user->email)->get()->password;
                if($this->password !== $password) {
                    $this->error = 'Incorrect password';
                } else {
                    $this->res = 'Successfully removed from database';
                }
            }
        }
    }
    public function validateRegister(object $request) {
        if(isset($request->password) && isset($request->password2)) {
            if(strlen($request->password) < 7) $this->error = 'Password is too short'; 
            if($request->password !== $request->password2) $this->error = 'Passwords are not the same';
            if(!preg_match("#[0-9]+#", $request->password)) $this->error = 'Password must have at least 1 number';
            if(!preg_match("#[a-zA-Z]+#", $request->password)) $this->error = 'Password must have at least 1 letter';
        } else $this->error = 'Passwords required';
        if(isset($request->email)) {
            $user = new DB;
            $user = $user->from('users')->where('email', $request->email)->get();
            if($user) $this->error = 'Email has been taken';
            if(strlen($request->email) < 3) $this->error = 'Email too short';
            if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)) $this->error = 'Invalid email';
        } else $this->error = 'Email required';
        if(isset($request->name)) {
            if(strlen($request->name) < 3) $this->error = 'Name too short';
        } else $this->error = 'Name is required';
    }
    // public function error() {
    //     return $this->error ? $this->error : false;
    // }
    // public function response() {
    //     return $this->res ? $this->res : false;
    // }
}

?>