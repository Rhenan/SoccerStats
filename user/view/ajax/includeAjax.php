<?php
    //Config
    include '../../../config.php';
    
    include "../../model/class.model.user.php";
    include "../../control/class.control.user.php";
    
    global $modelUser;   
    $modelUser = new modelUser();
    $controlUser = new controlUser();
    
    //Language
    include "../../../system/language/language.php";
    $lang = new language($_SESSION['lang']);
?>