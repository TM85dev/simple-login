<?php

trait TraitRes {
    private $error = false;
    private $res = false;

    public function response() {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        $this->res = isset($_SESSION['action_info']) ? $_SESSION['action_info'] : false;
        return $this->res;
    }
    public function error() {
        return $this->error;
    }
}