<?php

trait TraitRes {
    private $error = false;
    private $res = false;

    public function __construct() {
        if(session_status() == PHP_SESSION_NONE) session_start();
        if(isset($_SESSION['login_info'])) $this->res = 'Successfully login';
        if(isset($_SESSION['logout_info'])) $this->res = 'Successfully logout';
    }

    public function response() {
        return $this->res;
    }
    public function error() {
        return $this->error;
    }
}