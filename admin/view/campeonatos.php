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
                    <a href="?page=campeonatoAdd"><button type="button" class="btn btn-success center-block"><?php $lang->t('Inserir Novo Campeonato');?></button></a>
                </div>
            </div>
        </div>            
    </div>
    <div class="col-xs-12">
        <div id="campTop" class="row top" style="width:100%;">
            <div class="col-xs-1"><?php $lang->t('Id');?></div>
            <div class="col-xs-4"><?php $lang->t('Nome');?></div>
            <div class="col-xs-2"><?php $lang->t('País');?></div>
            <div class="col-xs-2"><?php $lang->t('Rodada');?></div>
            <div class="col-xs-3"><?php $lang->t('Ação');?></div>
        </div>
<?php
    $campeonatos = $database->getRows("SELECT * FROM tb_campeonato ORDER BY pais DESC,nome DESC");
    $i = 0;
    foreach ($campeonatos as $camp) {
        $class = (($i%2)==0)?'dark':'light';
        $i++;
?>
        <div id="camp<?php echo $camp['id']; ?>" class="row <?php echo $class; ?>" style="width:100%; line-height: 40px;">
            <div class="col-xs-12">
                <div class="divDeletar" style="display:none;" id="deletar<?php echo $camp['id']; ?>">
                    <?php $lang->t('Deletar Campeonato');?> [id:<?php echo $camp['id']; ?>] <strong><?php echo $modelCore->getCampeonatoInfo($camp['id'],'nome');?></strong>?
                    <button id="<?php echo $camp['id']; ?>" type="button" class="btn btn-danger confirmar"><?php $lang->t('Deletar');?></button>
                    <button id="<?php echo $camp['id']; ?>" type="button" class="btn btn-default pull-right deletarFechar"><?php $lang->t('Fechar');?></button>
                </div>
            </div>                
            <div class="col-xs-1"><?php echo $camp['id']; ?></div>
            <div class="col-xs-4"><?php echo $camp['nome']; ?></div>
            <div class="col-xs-2"><?php echo $camp['pais']; ?></div>
            <div class="col-xs-2"><?php echo $camp['rodada']; ?></div>
            <div class="col-xs-3">
                <div class="col-xs-6">
                    <a href="?page=campeonatoAdd&id=<?php echo $camp['id']; ?>"><button type="button" class="btn btn-info"><?php $lang->t('Editar');?></button></a>
                </div>
                <div class="col-xs-6" >
                    <button type="button" class="btn btn-danger deletar" id="<?php echo $camp['id']; ?>"><?php $lang->t('Deletar');?></button>
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
			url: 'view/ajax/deletaCampeonato.php',
			data: {
                delete: id
			}
		}).done(function(msg) {
			$('#deletar'+id).html(msg);
		});
    });
});
</script>    