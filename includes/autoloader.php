<?php

    spl_autoload_register('autoload');

    function autoload($class) {
        $pathModels = $class.".php";
        // $pathControllers = $class.".php";
        // $pathTraits = $class.".php";
        if(file_exists($pathModels)) include_once $pathModels;
        // elseif(file_exists($pathControllers)) include_once $pathControllers;
        // elseif(file_exists($pathTraits)) include_once $pathTraits;
        
    }

?>