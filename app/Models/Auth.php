<?php
    include_once 'includes/autoloader.php';

    class Auth {

        public function __construct() {
            Session::start();
        }
        public static function user() {
            if(isset($_SESSION['u_id']) && isset($_SESSION['auth'])) {
                $user_id = strval(explode('|', $_SESSION['u_id'])[0]);
                $auth_id = strval($_SESSION['auth']->id);
                if($user_id === $auth_id) {
                    unset($_SESSION['auth']->password);
                    return $_SESSION['auth'];
                } else {
                    return [];
                }
            }
        }
        public static function login(object $auth) {
            $_SESSION['u_id'] = $auth->id.'|'.uniqid();
            $_SESSION['auth'] = $auth;
        }
        public static function logout() {
            Session::remove([
                'u_id', 'auth'
            ]);
        }
    }

?>