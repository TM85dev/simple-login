<?php

trait Responses {
    private $error = false;
    private $res = false;

    public function response() {
        return $this->res;
    }
    public function error() {
        return $this->error;
    }
}