<?php
    //Info B‡sica
    define("URL","http://127.0.0.1/statistics/");
    define("IMAGE_PATH",URL."system/img/");
        
    //Conex‹o com Banco de Dados
    include "core/db/class.db.php";
    
    define("BD_USER","root");
    define("BD_PASS","");
    define("BD_HOST","localhost");
    define("BD_NAME","tb_estatistica");

    global $database;
    $database = new db(BD_USER, BD_PASS, BD_HOST, BD_NAME);
    
    //Classe base
    include "core/model/class.model.core.php";
    include "core/control/class.control.core.php";
   
    global $modelCore;   
    global $controlCore;   
    $modelCore = new modelCore();
    $controlCore = new controlCore();   
?>