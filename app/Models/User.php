<?php
    include_once 'db.php';

    class User extends DB {

        public function login($request) {
            $request = (object) $request;
            $sql = "SELECT * FROM users WHERE email=:email";
            $prepare = $this->PDO->prepare($sql);
            $email = htmlspecialchars($request->email);
            $prepare->bindParam(':email', $email);
            $prepare->execute();
            $user = $prepare->fetch(PDO::FETCH_OBJ);
            if($user) {
                if($user->password == md5($request->password)) {
                    $uid = uniqid();
                    unset($user->password);
                    $_SESSION['u_id'] = "$user->id|$uid";
                    $_SESSION['auth'] = $user;
                    $this->res = 'login success';
                    header('Location: ./index.php');
                } else {
                    $this->error = 'Invalid password';
                }
            } else {
                $this->error = 'Can\'t find user';
            }
        }
        public function create(array $array) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $sql = "INSERT INTO users(".implode(',', array_keys($array)).") VALUES (:".implode(",:", array_keys($array)).");";
                $prepare = $this->PDO->prepare($sql);
                foreach ($array as $key => &$value) {
                    $value = ($key === 'password') ? md5($value) : $value;
                    $value = htmlspecialchars($value);
                    $key = ":$key";
                    $prepare->bindParam($key, $value);
                }
                $prepare->execute();
                $this->res = "User was created";
            } else {
                $this->error = 'Invalid request method';
            }

        }
        public function edit() {
            
        }
        public function delete() {

        }
        public function validateRegister(array $array) {
            if(isset($array['password']) && isset($array['password2'])) {
                if(strlen($array['password']) < 7) $this->error = 'Password is too short'; 
                if($array['password'] !== $array['password2']) $this->error = 'Passwords are not the same';
                if(!preg_match("#[0-9]+#", $array['password'])) $this->error = 'Password must have at least 1 number';
                if(!preg_match("#[a-zA-Z]+#", $array['password'])) $this->error = 'Password must have at least 1 letter';
            } else $this->error = 'Passwords required';
            if(isset($array['email'])) {
                if(strlen($array['email']) < 3) $this->error = 'Email too short';
                if(!filter_var($array['email'], FILTER_VALIDATE_EMAIL)) $this->error = 'Invalid email';
            } else $this->error = 'Email required';
            if(isset($array['name'])) {
                if(strlen($array['name']) < 3) $this->error = 'Name too short';
            } else $this->error = 'Name is required';
        }
    }

?>