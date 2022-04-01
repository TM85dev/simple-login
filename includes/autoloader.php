<?php

    spl_autoload_register('autoload');

    function autoload($class) {
        $pathModels = "app/Models/".$class.".php";
        $pathControllers = "app/Controllers/".$class.".php";
        $pathTraits = "app/Traits/".$class.".php";
        if(file_exists($pathModels)) include_once $pathModels;
        if(file_exists($pathControllers)) include_once $pathControllers;
        if(file_exists($pathTraits)) include_once $pathTraits;
        
    }

?>