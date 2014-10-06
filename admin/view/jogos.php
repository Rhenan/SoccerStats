<div class="container">
    <div class="col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><?php $lang->t('Filtrar');?></h3></div>
            <div class="panel-body">
                <form action="?page=jogos" method="POST">
                    <?php $lang->t('Campeonato');?>: <?php echo $controlCore->select($modelCore->getTodosCampeonatos(),$_POST['select_campeonato'],'select_campeonato'); ?>
                    <input type="submit" value="Filtrar">
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-success">
            <div class="panel-heading"><h3 class="panel-title"><?php $lang->t('Inserir');?></h3></div>
            <div class="panel-body">
                <a href="?page=jogoAdd"><button type="button" class="btn btn-success center-block"><?php $lang->t('Inserir Novo Jogo');?></button></a>
            </div>
        </div>
    </div>    
<?php
    if (isset($_POST['select_campeonato'])) {
        $jogos = $database->getRows("SELECT * FROM tb_jogos WHERE campeonato = ? ORDER BY rodada DESC, data DESC, id ASC",array($_POST['select_campeonato']));
    } else {
        $jogos = $database->getRows("SELECT * FROM tb_jogos ORDER BY rodada DESC,data DESC, id ASC");
    }
    
    foreach ($jogos as $jogo) {
        $casa['gols'] = $modelCore->getQtdeGols($jogo['id'],1);
        $visitante['gols'] = $modelCore->getQtdeGols($jogo['id'],2);
        
        $casa['style'] = ($casa['gols']>$visitante['gols'])?'green':'red';
        $casa['style'] = ($casa['gols']==$visitante['gols'])?'yellow':$casa['style'];
        $visitante['style'] = ($casa['gols']<$visitante['gols'])?'green':'red';
        $visitante['style'] = ($casa['gols']==$visitante['gols'])?'yellow':$visitante['style'];
        
        $resultadoCasa = '<div class="resultadoCirculo pull-left" style="background-color:'.$casa['style'].'"></div>';      
        $resultadoVisitante = '<div class="resultadoCirculo pull-right" style="background-color:'.$visitante['style'].'"></div>';
 
?>
    <div id="jogo<?php echo $jogo['id']; ?>" class="row jogosLinha" style="width:100%;">
        <div class="col-x-12">
            <div class="divDeletar" style="display:none;" id="deletar<?php echo $jogo['id']; ?>">
                <?php $lang->t('Deletar Jogo');?> [id:<?php echo $jogo['id']; ?>] <strong><?php echo $modelCore->getTimeInfo($jogo['casa'],'nome'); ?> x <?php echo $modelCore->getTimeInfo($jogo['visitante'],'nome'); ?></strong>?
                <button id="<?php echo $jogo['id']; ?>" type="button" class="btn btn-danger confirmar"><?php $lang->t('Deletar');?></button>
                <button id="<?php echo $jogo['id']; ?>" type="button" class="btn btn-default pull-right deletarFechar"><?php $lang->t('Fechar');?></button>
            </div>        
            <div class="col-sm-10">
                <div class="col-xs-12" style="margin-bottom: 10px;">
                    <div class="col-sm-1 hidden-xs label label-default">
                        <span class="hidden-xs"><?php $lang->t('Id');?>:</span> <?php echo $jogo['id']; ?>
                    </div>
                    <div class="col-sm-5 col-xs-6"><span class="hidden-xs"><?php $lang->t('Campeonato');?>:</span> <?php echo $modelCore->getCampeonatoInfo($jogo['campeonato'],'nome'); ?></div>
                    <div class="col-sm-4 col-xs-4"><span class="hidden-xs"><?php $lang->t('Data');?>:</span> <?php echo $controlCore->acertaData($jogo['data']); ?></div>
                    <div class="col-sm-2 col-xs-2"><span class="hidden-xs"><?php $lang->t('Rodada');?>:</span> <?php echo $jogo['rodada']; ?></div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-5 text-right">
                        <?php echo $resultadoCasa.$modelCore->getTimeInfo($jogo['casa'],'nome'); ?> <img src="<?php echo IMAGE_PATH.$modelCore->getTimeInfo($jogo['casa'],'img')?>" class="maisInfoImg">
                    </div>
                    <div class="col-xs-1 text-center">
                        <?php echo $casa['gols']; ?> x <?php echo $visitante['gols']; ?>
                    </div>
                    <div class="col-xs-5 text-left">
                        <img src="<?php echo IMAGE_PATH.$modelCore->getTimeInfo($jogo['visitante'],'img')?>" class="maisInfoImg"> <?php echo $modelCore->getTimeInfo($jogo['visitante'],'nome').$resultadoVisitante; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div id="<?php echo $jogo['id']; ?>" class="col-xs-6 editar"><a href="?page=jogoAdd&id=<?php echo $jogo['id']; ?>"><button type="button" class="btn btn-info"><?php $lang->t('Editar');?></button></a></div>
                <div id="<?php echo $jogo['id']; ?>" class="col-xs-6 deletar"><button type="button" class="btn btn-danger"><?php $lang->t('Deletar');?></button></div>
            </div>
        </div>
    </div>
<?php
    }
?>
</div>
<script>
//Ações para edição e deleção
$(document).ready(function () {
    $(".deletar").click(function () {
        var id = $(this).attr('id');
        $('#deletar'+id).css('display','block');
    });
    $(".deletarFechar").click(function () {
        var id = $(this).attr('id');
        $('#deletar'+id).css('display','none');
    });
    $(".confirmar").click(function () {
        var id = $(this).attr('id');
        $.ajax({
			type:"POST",
			url: 'view/ajax/deletaJogo.php',
			data: {
                delete: id
			}
		}).done(function(msg) {
			$('#deletar'+id).html(msg);
		});
    });
});
</script>    