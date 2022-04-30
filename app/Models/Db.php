<?php

namespace app\Models;

use PDO;
use app\Traits\TraitRes;

class DB {
    use TraitRes;

    private $conn;
    private $col = '';
    private $name = '';
    private $table = '';
    private $data;
    private $prepare; 

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
    public function where(string $col, string $name) {
        $this->col = $col;
        $this->name = $name;
        $sql = "SELECT * FROM $this->table WHERE $col=:$col";
        $this->conn = $this->conn->prepare($sql);
        return $this;
    }
    private function bindValues() {
        $name = htmlspecialchars($this->name);
        $this->prepare = $this->conn;
        $this->prepare->bindParam(":$this->col", $this->name);
        $this->prepare->execute();
    }
    public function get() {
        $this->bindValues();
        return $this->prepare->fetch(PDO::FETCH_OBJ);
    }
    public function getAll() {
        $this->bindValues();
        return $this->prepare->fetchAll(PDO::FETCH_OBJ);
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
    public function update(object $request) {
        $old_email = $request->old_email;
        unset($request->old_email);
        $this->data = $request;
        $sets = '';
        $i = 0;
        $request = (array) $request;
        foreach ($request as $key => $value) {
            $sets .= (count($request)==$i || $i==0) ? "$key=:$key" : " , $key=:$key ";
            $i++;
        }
        $sql = "UPDATE $this->table SET $sets WHERE email='$old_email'";
        $this->conn = $this->conn->prepare($sql);
        return $this;
    }
    public function delete(object $request) {
        $this->data = $request;
        $condition = '';
        $i = 0;
        $request = (array) $request;
        foreach ($request as $key => $value) {
            $condition .= (count($request)==$i || $i==0) ? "$key=:$key" : " AND $key=:$key ";
            $i++;
        }
        $sql = "DELETE FROM $this->table WHERE $condition";
        $this->conn = $this->conn->prepare($sql);
        return $this;

    }
}

?>