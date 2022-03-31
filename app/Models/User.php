<?php
    include_once 'db.php';

    class User {
        protected $user;
        private $password = '';
        protected $error = null;
        protected $res = null;
        protected $request;

        public function get(object $request) {
            $db = new DB();
            $this->user = $db->from('users')->where('email', $request->email)->get();
            $this->password = md5($request->password);
            return $this->user;
        }
        public function create(array $array) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                unset($array['password2']);
                $db = new DB;
                $db->from('users')->insert($array)->set();
                if(!$db->error()) {
                    $this->res = "User was created";
                }
            } else {
                $this->error = 'Invalid request method';
            }

        }
        public function edit($request) {
            $db = new DB;
            $db->from('users')->update($request);
        }
        public function delete($request) {
            $db = new DB;
            $db->from('users')->delete(['email' => $request->email])->set();
            if(!$db->error()) {
                $this->res = "User was deleted";
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
        public function validateRegister(array $array) {
            if(isset($array['password']) && isset($array['password2'])) {
                if(strlen($array['password']) < 7) $this->error = 'Password is too short'; 
                if($array['password'] !== $array['password2']) $this->error = 'Passwords are not the same';
                if(!preg_match("#[0-9]+#", $array['password'])) $this->error = 'Password must have at least 1 number';
                if(!preg_match("#[a-zA-Z]+#", $array['password'])) $this->error = 'Password must have at least 1 letter';
            } else $this->error = 'Passwords required';
            if(isset($array['email'])) {
                $user = new DB();
                $user = $user->from('users')->where('email', $array['email'])->get();
                if($user) $this->error = 'Email has been taken';
                if(strlen($array['email']) < 3) $this->error = 'Email too short';
                if(!filter_var($array['email'], FILTER_VALIDATE_EMAIL)) $this->error = 'Invalid email';
            } else $this->error = 'Email required';
            if(isset($array['name'])) {
                if(strlen($array['name']) < 3) $this->error = 'Name too short';
            } else $this->error = 'Name is required';
        }
        public function error() {
            return $this->error ? $this->error : false;
        }
        public function response() {
            return $this->res ? $this->res : false;
        }
    }

?>