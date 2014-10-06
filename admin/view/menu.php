<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-menu">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php?page=jogos"><?php $lang->t('Admin');?></a>
        </div>
        <div class="collapse navbar-collapse" id="collapse-menu">
            <ul class="nav navbar-nav">
                <li class="<?php echo ((strtoupper($_GET['page']) == strtoupper('Jogos')) OR (!isset($_GET['page'])))?'active':''; ?>"><a href="index.php?page=jogos"><?php $lang->t('Jogos');?></a></li>
                <li class="<?php echo (strtoupper($_GET['page']) == strtoupper('campeonatos'))?'active':''; ?>"><a href="index.php?page=campeonatos"><?php $lang->t('Campeonato');?></a></li>
                <li class="<?php echo (strtoupper($_GET['page']) == strtoupper('times'))?'active':''; ?>"><a href="index.php?page=times"><?php $lang->t('Times');?></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php $lang->t('Inserir'); ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php?page=jogoAdd"><?php $lang->t('Inserir Novo Jogo'); ?></a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?page=campeonatoAdd"><?php $lang->t('Inserir Novo Campeonato'); ?></a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?page=timeAdd"><?php $lang->t('Inserir Novo Time'); ?></a></li>
                    </ul>
                </li>                      
            </ul>
        </div>
    </div>
</nav>