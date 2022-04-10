<?php

namespace app\Models;

use app\Models\Auth;
use app\Traits\TraitRes;

class Validator {
    use TraitRes;

    private $data = [];
    private $password = null;
    private $comparing_passwords = false;

    public function __construct(object $obj) {
        $this->data = $obj;
        if(isset($obj->password) && isset($obj->confirm_password)) $this->comparing_passwords = true;
    }

    public function validate(object $obj) {
        foreach ($this->data as $name => $requirements) {
            $value = $obj->$name;
            if(!isset($obj->$name)) $this->error = "Required <b>$name</b> not send";
            $this->check($value, $name, $requirements);
        }
    }
    private function check(string $value, string $name, string $requirements) {
        $reqs = explode('|', $requirements);
        foreach ($reqs as $req) {
            if($req === 'required') {
                if(strlen($value) < 1) $this->error = "<b>$name</b> required";
            }
            if(strpos($req, 'min:') !== false) {
                $num = intval(explode(':', $req, 2)[1]);
                if(strlen($value) < $num) $this->error = "min <b>$name</b> length $num required";
            }
            if(strpos($req, 'max:') !== false) {
                $num = intval(explode(':', $req, 2)[1]);
                if(strlen($value) > $num) $this->error = "max <b>$name</b> length $num required";
            }
            if($req === 'email') {
                if(!filter_var($value, FILTER_VALIDATE_EMAIL)) $this->error = "<b>$name</b> is not valid";
            }
            if($req === 'password') {
                if(!$this->comparing_passwords) {
                    if(!preg_match("#[0-9]+#", $value)) $this->error = "<b>$name</b> required min 1 number";
                    if(!preg_match("#[A-Z]+#", $value)) $this->error = "<b>$name</b> required min 1 uppercase";
                    if(!preg_match("#[a-z]+#", $value)) $this->error = "<b>$name</b> required min 1 lowercase";
                    if(!preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $value)) $this->error = "<b>$name</b> required min 1 special";
                }
                $this->password = $value;
            }
            if($req === 'confirm_password') {
                if(!$this->password) $this->error = "<b>password</b> is required";
                if($this->password !== $value) $this->error = "<b>confirm password</b> and <b>password</b> are not the same"; 
            }
        }
        // if(in_array('required', $req)) {
        //     if(strlen($value) < 1) $this->error = "$name required";
        // }
        // if(strpos('min:')) {
        //     $this->error = "$name min required";
        // }
    }
}


?>