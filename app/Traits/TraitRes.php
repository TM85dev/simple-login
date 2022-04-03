<?php

trait TraitRes {
    private $error = false;
    private $res = false;

    public function __construct() {
        if(session_status() == PHP_SESSION_NONE) session_start();
        $this->res = isset($_SESSION['action_info']) ? $_SESSION['action_info'] : false;
    }

    public function response() {
        return $this->res;
    }
    public function error() {
        return $this->error;
    }
}