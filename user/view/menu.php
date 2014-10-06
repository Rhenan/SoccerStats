<?php $controlUser->callHeader(); ?>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-menu">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php?page=tabela"><?php $lang->t('User'); ?></a>
        </div>
        <div class="collapse navbar-collapse" id="collapse-menu">
            <ul class="nav navbar-nav">
                <li class="<?php echo ((strtoupper($_GET['page']) == strtoupper('tabela')) OR (!isset($_GET['page'])))?'active':''; ?>"><a href="index.php?page=tabela"><?php $lang->t('Tabela'); ?></a></li>
            <!--
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php $lang->t('Estat’sticas'); ?><span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#"><?php $lang->t('Gols por Per’odo'); ?></a></li>
                    <li class="divider"></li>
                    <li><a href="#"><?php $lang->t('Gols Geral'); ?></a></li>
                </ul>
            </li>
            -->
            </ul>
        </div>
    </div>
</nav>