<?php

namespace app\Models;

class Request {
    private $res;
    private $method;

    public function __construct() {
        $this->res = json_decode(file_get_contents('php://input'));
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
    public function GET() {
        return $this->method == 'GET' ? $this->res : null;
    }
    public function POST() {
        return $this->method == 'POST' ? $this->res : null;
    }
    public function PUT() {
        return $this->method == 'PUT' ? $this->res : null;
    }
    public function PATCH($data_type = null) {
        if(strtolower($data_type) === 'json') $this->json();
        return $this->method == 'PATCH' ? $this->res : null;
    }
    public function DELETE() {
        return $this->method == 'DELETE' ? $this->res : null;
    }
    private function json() {
        $this->res = json_encode($this->res);
    }
}