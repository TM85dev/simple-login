<?php

    class DB {
        protected $PDO;
        private $host = 'localhost';
        private $db = 'sign';
        private $username = 'root';
        private $password = '';
        protected $error = null;
        protected $res = '';

        function __construct() {
            try {
                $this->PDO = new PDO("mysql:host=$this->host;dbname=$this->db", $this->username, $this->password);
                $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                $this->error = $e->getMessage();
            }
        }
        public function response() {
            return ($this->error === null) ? $this->res : false;
        }
        public function error() {
            return $this->error;
        }
        function __destruct() {
            $this->PDO = null;
        }
    }

?>