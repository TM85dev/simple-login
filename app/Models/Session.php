<?php

class Session {

    public static function start() {
        if(session_status() == PHP_SESSION_NONE) session_start();
    }
    public static function isAuth(string $location) {
        if( isset($_SESSION['u_id']) ) {
            header("Location: $location");
        }
    }
    public static function isNotAuth(string $location) {
        if( !isset($_SESSION['u_id']) ) {
            header("Location: $location");
        }
    }
    public static function stop() {
        self::start();
        session_destroy();
    }
    public static function remove($request) {
        self::start();
        if(is_array($request)) {
            foreach ($request as $name) unset($_SESSION[$name]);
        } else if(is_string($request)) {
            unset($_SESSION[$request]);
        }
    }
}