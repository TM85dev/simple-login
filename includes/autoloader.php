<?php

    spl_autoload_register('autoload');

    function autoload($class) {
        $path = "classes/".$class.".php";

        include_once $path;
    }

?>