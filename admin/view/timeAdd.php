<div class="container">
    <?php
        if (isset($_POST['type'])) {
            if ($_POST['type'] == 'add') {
                $inserir = $controlAdmin->incluirTime($_POST);
                if ($id = $inserir) echo "<div class='alert alert-success' role='alert'>".$lang->t('Time Inclu’do com Sucesso!',true)."</div>";
            } else {
                $update = $controlAdmin->editarTime($_POST);
                if ($id = $update) echo "<div class='alert alert-success' role='alert'>".$lang->t('Time Editado com Sucesso!',true)."</div>";
            }
        }
    ?>
    <?php
        $id = (isset($id))?$id:0;
        $id = ($_GET['id'])?$_GET['id']:$id;
        if ($id > 0) {
            $action = '&id='.$id;
            $time = $database->getRows("SELECT * FROM tb_times WHERE id = ?",array($id));
            $nome = ($_POST['nome'] > 0)?$_POST['nome']:$time[0]['nome'];
            $img = ($_POST['img'] > 0)?$_POST['img']:$time[0]['img'];
            $select_campeonato = ($_POST['select_campeonato'] > 0)?$_POST['select_campeonato']:$time[0]['campeonato'];
            $type = "<input type='hidden' name='type' value='{$id}'>";
        } else {
            $nome = ($_POST['nome'] > 0)?$_POST['nome']:'';        
            $img = ($_POST['img'] > 0)?$_POST['img']:'';
            $select_campeonato = ($_POST['select_campeonato'] > 0)?$_POST['select_campeonato']:0;
            $type = "<input type='hidden' name='type' value='add'>";
        }
    ?>    
    <form action="?page=timeAdd<?php echo $action; ?>" method="POST">
    
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group adjust-top">
                    <span class="input-group-addon"><?php $lang->t('Nome'); ?></span>
                    <input type="text" name="nome" value="<?php echo $nome; ?>" class="form-control" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-group adjust-top">
                    <span class="input-group-addon"><?php $lang->t('Imagem'); ?></span>
                    <input type="text" name="img" value="<?php echo $img; ?>" class="form-control" >
                </div>
            </div>    
            <div class="col-sm-6">
                <div class="input-group adjust-top">
                    <span class="input-group-addon"><?php $lang->t('Campeonato'); ?></span>
                    <?php echo $controlCore->select($modelCore->getTodosCampeonatos(),$select_campeonato,'select_campeonato','form-control'); ?>
                </div>  
            </div>
        </div>
        <?php echo $type; ?>
        <input type="submit" value="<?php $lang->t('Salvar Time'); ?>" class="btn btn-success pull-right adjust-top">       
    </form>
</div>
<h1></h1>