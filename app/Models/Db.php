<?php

    class DB {
        protected $conn;
        protected $error = null;
        protected $res = '';
        protected $row = '';
        protected $name = '';
        protected $table = '';

        private function conn() {
            $host = 'localhost';
            $db = 'sign';
            $username = 'root';
            $password = '';
            try {
                $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->res = 'connected';
                $this->conn = $conn;
            } catch(PDOException $e) {
                $this->error = $e->getMessage();
            }
        }
        public function select($table) {
            $this->conn();
            $this->table = $table;
            return $this;
        }
        public function where($row, $name) {
            $this->row = $row;
            $this->name = $name;
            $sql = "SELECT * FROM $this->table WHERE $row=:$row";
            $this->conn = $this->conn->prepare($sql);
            return $this;
        }
        public function get() {
            $name = htmlspecialchars($this->name);
            $prepare = $this->conn;
            $prepare->bindParam(":$this->row", $this->name);
            $prepare->execute();
            return $prepare->fetch(PDO::FETCH_OBJ);
        }
        public function response() {
            return ($this->error === null) ? $this->res : false;
        }
        public function error() {
            return $this->error;
        }
        // function __destruct() {
        //     $this->conn = null;
        // }
    }

?>