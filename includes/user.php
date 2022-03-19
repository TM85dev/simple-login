<?php
    include 'connection.php';

    class User extends DB {

        public function login($login, $password) {

        }
        public function logout() {

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