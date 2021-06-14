<?php
    spl_autoload_register(function($class){
        //echo LIBS.'Core/'.$class.".php";
        if(file_exists(LIBS.'Core/'.$class.".php")){
            require_once(LIBS.'Core/'.$class.".php");
        }
    });

?>