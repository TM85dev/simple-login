<?php
    include 'db.php';

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
        public function register(array $array) {
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
            if(isset($array['name'])) $this->validateName($array['name']);
            else $this->error = '';
        }
        private function validateName($name) {
            if(strlen($name) < 3) $this->error = 'Name should be more than 3 characters';
        }
        private function validatePassword() {

        }
        private function validateEmail() {

        }
    }

?>