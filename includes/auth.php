<?php
    include 'connection.php';

    class Auth extends DB {

        public static function user() {
            if(isset($_SESSION['u_id']) && isset($_SESSION['auth'])) {
                $user_id = strval(explode('|', $_SESSION['u_id'])[0]);
                $auth_id = strval($_SESSION['auth']->id);
                if($user_id === $auth_id) {
                    return $_SESSION['auth'];
                } else {
                    return [];
                }
            }
        }
    }

?>