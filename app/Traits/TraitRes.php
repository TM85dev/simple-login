<?php

namespace app\Traits;

trait TraitRes {
    private $error = false;
    private $res = false;

    public function response() {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        if(isset($_SESSION['action_info'])) {
            unset($_SESSION['action_error']);
            $this->res = $_SESSION['action_info'];
        }
        return $this->res;
    }
    public function error() {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        if(isset($_SESSION['action_error'])) {
            unset($_SESSION['action_info']);
            $this->error = $_SESSION['action_error'];
        }
        return $this->error;
    }
}