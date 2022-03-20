<?php
    include 'connection.php';

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
        public static function logout() {
            session_start();
            session_destroy();
            header('Location: ./login.php');
        }
        public function register($array) {
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

    }

?>