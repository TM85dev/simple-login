<?php

namespace app\Models;

class Request {
    private $res;
    private $method;

    public function __construct() {
        $this->res = json_decode(file_get_contents('php://input'));
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
    }
    public function method(string $method = 'get') {
        return $this->method === strtolower($method) ? $this : false;
    }
    public function format(string $format = 'raw') {
        return  strtolower($format) === 'json' ? json_encode($this->res) : $this->res;
    }
}