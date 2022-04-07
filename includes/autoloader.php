<?php

    spl_autoload_register('autoload');

    function autoload($class) {
        $path = $class.".php";
        if(file_exists($path)) include_once $path;
        elseif(file_exists('../../'.$path)) include_once '../../'.$path;

    }

?>