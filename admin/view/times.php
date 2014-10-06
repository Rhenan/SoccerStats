<div class="container">
    <div class="col-sm-12">
        <div class="col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title"><?php $lang->t('Filtrar');?></h3></div>
                <div class="panel-body">
                    <?php $lang->t('Sem Filtros Disponíveis');?>
                </div>
            </div>
        </div>    
        <div class="col-sm-3">
            <div class="panel panel-success">
                <div class="panel-heading"><h3 class="panel-title"><?php $lang->t('Inserir');?></h3></div>
                <div class="panel-body">
                    <a href="?page=timeAdd"><button type="button" class="btn btn-success center-block"><?php $lang->t('Inserir Novo Time');?></button></a>
                </div>
            </div>
        </div>            
    </div>
    <div class="col-xs-12">
        <div id="timeTop" class="row top" style="width:100%;">
            <div class="col-xs-1"><?php $lang->t('Id');?></div>
            <div class="col-xs-4"><?php $lang->t('Nome');?></div>
            <div class="col-xs-2"><?php $lang->t('Imagem');?></div>
            <div class="col-xs-2"><?php $lang->t('Campeonato');?></div>
            <div class="col-xs-3"><?php $lang->t('Ação');?></div>
        </div>
<?php
    $times = $database->getRows("SELECT * FROM tb_times ORDER BY campeonato DESC,nome ASC");
    $i = 0;
    foreach ($times as $time) {
        $class = (($i%2)==0)?'dark':'light';
        $i++;
?>
        <div id="time<?php echo $time['id']; ?>" class="row <?php echo $class; ?>" style="width:100%; line-height: 40px;">
            <div class="col-xs-12">
                <div class="divDeletar" style="display:none;" id="deletar<?php echo $time['id']; ?>">
                    <?php $lang->t('Deletar Time');?> [id:<?php echo $time['id']; ?>] <strong><?php echo $modelCore->getTimeInfo($time['id'],'nome');?></strong>?
                    <button id="<?php echo $time['id']; ?>" type="button" class="btn btn-danger confirmar"><?php $lang->t('Deletar');?></button>
                    <button id="<?php echo $time['id']; ?>" type="button" class="btn btn-default pull-right deletarFechar"><?php $lang->t('Fechar');?></button>
                </div>
            </div>                
            <div class="col-xs-1"><?php echo $time['id']; ?></div>
            <div class="col-xs-4"><?php echo $time['nome']; ?></div>
            <div class="col-xs-2"><img src="<?php echo IMAGE_PATH.$time['img']; ?>" class="maisInfoImg"> <?php echo $time['img']; ?></div>
            <div class="col-xs-2"><?php echo $modelCore->getCampeonatoInfo($time['campeonato'],'nome'); ?></div>
            <div class="col-xs-3">
                <div class="col-xs-6">
                    <a href="?page=timeAdd&id=<?php echo $time['id']; ?>"><button type="button" class="btn btn-info"><?php $lang->t('Editar');?></button></a>
                </div>
                <div class="col-xs-6" >
                    <button type="button" class="btn btn-danger deletar" id="<?php echo $time['id']; ?>"><?php $lang->t('Deletar');?></button>
                </div>
            </div>
        </div>
<?php
    }
?>
    </div>
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
			url: 'view/ajax/deletaTime.php',
			data: {
                delete: id
			}
		}).done(function(msg) {
			$('#deletar'+id).html(msg);
		});
    });
});
</script>    