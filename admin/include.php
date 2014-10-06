<?php
    include "model/class.model.admin.php";
    include "control/class.control.admin.php";
    
    global $modelAdmin;   
    $modelAdmin = new modelAdmin();
    $controlAdmin = new controlAdmin();
    
    //Language
    include "../system/language/language.php";
    $lang = new language($_SESSION['lang']);
?>