<?php

    include "../config.php";
    include "include.php";
    include "../header.php";
    
    include "view/menu.php";

    $page = (isset($_GET['page']))?"view/".$_GET['page'].".php":"view/tabela.php";
    include $page;
    
    include "../footer.php";    
?>