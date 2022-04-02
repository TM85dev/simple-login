<?php
    include_once 'includes/autoloader.php';

    class Auth {

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
        public static function logout() {
            session_start();
            unset($_SESSION['u_id'], $_SESSION['auth']);
        }
    }

?>