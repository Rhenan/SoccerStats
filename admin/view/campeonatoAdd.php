<div class="container">
    <?php
        if (isset($_POST['type'])) {
            if ($_POST['type'] == 'add') {
                $inserir = $controlAdmin->incluirCampeonato($_POST);
                if ($id = $inserir) echo "<div class='alert alert-success' role='alert'>".$lang->t('Campeonato Inclu’do com Sucesso!',true)."</div>";
            } else {
                $update = $controlAdmin->editarCampeonato($_POST);
                if ($id = $update) echo "<div class='alert alert-success' role='alert'>".$lang->t('Campeonato Editado com Sucesso!',true)."</div>";
            }
        }
    ?>
    <?php
        $id = (isset($id))?$id:0;
        $id = ($_GET['id'])?$_GET['id']:$id;
        if ($id > 0) {
            $action = '&id='.$id;
            $camp = $database->getRows("SELECT * FROM tb_campeonato WHERE id = ?",array($id));
            $nome = ($_POST['nome'] > 0)?$_POST['nome']:$camp[0]['nome'];
            $pais = ($_POST['pais'] > 0)?$_POST['pais']:$camp[0]['pais'];
            $rodada = ($_POST['rodada'] > 0)?$_POST['rodada']:$camp[0]['rodada'];
            $type = "<input type='hidden' name='type' value='{$id}'>";
        } else {
            $nome = ($_POST['nome'] > 0)?$_POST['nome']:'';        
            $pais = ($_POST['pais'] > 0)?$_POST['pais']:'';
            $rodada = ($_POST['rodada'] > 0)?$_POST['rodada']:0;
            $type = "<input type='hidden' name='type' value='add'>";
        }
    ?>    
    <form action="?page=campeonatoAdd<?php echo $action; ?>" method="POST">
    
        <div class="row">
            <div class="col-sm-6">
                <div class="input-group adjust-top">
                    <span class="input-group-addon"><?php $lang->t('Nome'); ?></span>
                    <input type="text" name="nome" value="<?php echo $nome; ?>" class="form-control" >
                </div>
            </div>
            <div class="col-sm-3">
                <div class="input-group adjust-top">
                    <span class="input-group-addon"><?php $lang->t('Pa’s'); ?></span>
                    <input type="text" name="pais" value="<?php echo $pais; ?>" class="form-control" >
                </div>
            </div>    
            <div class="col-sm-3">
                <div class="input-group adjust-top">
                    <span class="input-group-addon"><?php $lang->t('Rodada Atual'); ?></span>
                    <input type="number" name="rodada" value="<?php echo $rodada; ?>" class="form-control">
                </div>
            </div>
        </div>
        <?php echo $type; ?>
        <input type="submit" value="<?php $lang->t('Salvar Campeonato'); ?>" class="btn btn-success pull-right adjust-top">       
    </form>
</div>
<h1></h1>