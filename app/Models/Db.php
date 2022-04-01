<?php

    class DB {
        protected $conn;
        protected $error = null;
        protected $res = '';
        protected $row = '';
        protected $name = '';
        protected $table = '';
        protected $data;

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
                return $this->conn;
            } catch(PDOException $e) {
                $this->error = $e->getMessage();
            }
        }
        public function from(string $table) {
            $this->conn();
            $this->table = $table;
            return $this;
        }
        public function where(string $row, string $name) {
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
        public function insert(object $request) {
            $this->data = $request;
            $sql = "INSERT INTO ".$this->table."(".implode(',', array_keys((array) $request)).") VALUES (:".implode(",:", array_keys((array) $request)).");";
            $this->conn = $this->conn->prepare($sql);
            return $this;
        }
        public function set() {
            $prepare = $this->conn;
            foreach ($this->data as $key => &$value) {
                $value = ($key === 'password') ? md5($value) : $value;
                $value = htmlspecialchars($value);
                $key = ":$key";
                $prepare->bindParam($key, $value);
            }
            $prepare->execute();
        }
        public function update($request) {
            $old_email = $request['old_email'];
            unset($request['id'], $request['old_email']);
            $this->data = $request;
            $sets = '';
            $i = 0;
            foreach ($request as $key => $value) {
                $sets .= (count($request)==$i || $i==0) ? "$key=:$key" : " , $key=:$key ";
                $i++;
            }
            $sql = "UPDATE $this->table SET $sets WHERE email='$old_email'";
            $this->conn = $this->conn->prepare($sql);
            $this->set();
        }
        public function delete($request) {
            $this->data = $request;
            $condition = '';
            $i = 0;
            foreach ($request as $key => $value) {
                $condition .= (count($request)==$i || $i==0) ? "$key=:$key" : " AND $key=:$key ";
                $i++;
            }
            $sql = "DELETE FROM $this->table WHERE $condition";
            $this->conn = $this->conn->prepare($sql);
            return $this;

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