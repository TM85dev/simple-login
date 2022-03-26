<?php
    include_once 'db.php';

    class User {
        protected $user;
        protected $password = '';
        protected $error = null;
        protected $res = '';
        protected $request;

        public function get($request) {
            $request = (object) $request;
            $db = new DB();
            $this->user = $db->select('users')->where('email', $request->email)->get();
            return $this->user;
        }
        public function create(array $array) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                unset($array['password2']);
                // $sql = "INSERT INTO users(".implode(',', array_keys($array)).") VALUES (:".implode(",:", array_keys($array)).");";
                // $prepare = $this->PDO->prepare($sql);
                // foreach ($array as $key => &$value) {
                //     $value = ($key === 'password') ? md5($value) : $value;
                //     $value = htmlspecialchars($value);
                //     $key = ":$key";
                //     $prepare->bindParam($key, $value);
                // }
                // $prepare->execute();
                $db = new DB;
                $db->insertInto('users')->values($array)->set();
                if(!$db->error()) {
                    $this->res = "User was created";
                }
            } else {
                $this->error = 'Invalid request method';
            }

        }
        public function edit() {
            
        }
        public function delete() {

        }
        public function validateLogin($request) {
            $request = (object) $request;
            $user = $this->user;
            if(!$user) {
                $this->error = "Can't find user";
            } else {
                if($user->password === md5($request->password)) {
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
                $user = $user->select('users')->where('email', $array['email'])->get();
                if($user) $this->error = 'Email has been taken';
                if(strlen($array['email']) < 3) $this->error = 'Email too short';
                if(!filter_var($array['email'], FILTER_VALIDATE_EMAIL)) $this->error = 'Invalid email';
            } else $this->error = 'Email required';
            if(isset($array['name'])) {
                if(strlen($array['name']) < 3) $this->error = 'Name too short';
            } else $this->error = 'Name is required';
        }
        public function error() {
            return $this->error;
        }
        public function response() {
            return $this->res;
        }
    }

?>