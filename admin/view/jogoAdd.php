<div class="container">
    <?php
        if (isset($_POST['type'])) {
            if ($_POST['type'] == 'add') {
                $inserir = $controlAdmin->incluirJogo($_POST);
                if ($id = $inserir) echo "<div class='alert alert-success' role='alert'>".$lang->t('Jogo Inclu’do com Sucesso!',true)."</div>";
            } else {
                $update = $controlAdmin->editarJogo($_POST);
                if ($id = $update) echo "<div class='alert alert-success' role='alert'>".$lang->t('Jogo Editado com Sucesso!',true)."</div>";
            }
        }
    ?>
    <?php
        $id = (isset($id))?$id:0;
        $id = ($_GET['id'])?$_GET['id']:$id;
        if ($id > 0) {
            $action = '&id='.$id;
            $jogo = $database->getRows("SELECT * FROM tb_jogos WHERE id = ?",array($id));
            $select_campeonato = ($_POST['select_campeonato'] > 0)?$_POST['select_campeonato']:$jogo[0]['campeonato'];
            $select_casa = ($_POST['select_Casa'] > 0)?$_POST['select_Casa']:$jogo[0]['casa'];
            $select_visitante = ($_POST['select_Visitante'] > 0)?$_POST['select_Visitante']:$jogo[0]['visitante'];
            $data = ($_POST['data'] > 0)?$_POST['data']:$jogo[0]['data'];
            $rodada = ($_POST['rodada'] > 0)?$_POST['rodada']:$jogo[0]['rodada'];
            $type = "<input type='hidden' name='type' value='{$id}'>";
        } else {
            $select_campeonato = ($_POST['select_campeonato'] > 0)?$_POST['select_campeonato']:0;        
            $select_casa = ($_POST['select_Casa'] > 0)?$_POST['select_Casa']:0;
            $select_visitante = ($_POST['select_Visitante'] > 0)?$_POST['select_Visitante']:0;
            $data = ($_POST['data'] > 0)?$_POST['data']:0;
            $rodada = ($_POST['rodada'] > 0)?$_POST['rodada']:0;
            $type = "<input type='hidden' name='type' value='add'>";
        }
    ?>    
    <form action="?page=jogoAdd<?php echo $action; ?>" method="POST">
        <div class="input-group adjust-top">
            <span class="input-group-addon"><?php $lang->t('Campeonato'); ?></span>
            <?php echo $controlCore->select($modelCore->getTodosCampeonatos(),$select_campeonato,'select_campeonato','form-control'); ?>
        </div>    
        <div id="divTimes"></div>
        
        <div class="row">
            <div class="col-sm-6">
                <div class="input-group adjust-top">
                    <span class="input-group-addon"><?php $lang->t('Data'); ?></span>
                    <input type="date" name="data" value="<?php echo $data; ?>" class="form-control" >
                </div>
            </div>    
            <div class="col-sm-6">
                <div class="input-group adjust-top">
                    <span class="input-group-addon"><?php $lang->t('Rodada'); ?></span>
                    <input type="number" name="rodada" value="<?php echo $rodada; ?>" class="form-control">
                </div>
            </div>
        </div>
        <div id="gols">
            <h3><?php $lang->t('Gols'); ?></h3>
            <table class="table table-striped" id="tableGol">
                <tr class="info">
                    <td><?php $lang->t('Time'); ?></td>
                    <td><?php $lang->t('Minuto'); ?></td>
                    <td><?php $lang->t('Tempo'); ?></td>
                    <td><?php $lang->t('Excluir'); ?></td>
                </tr>
<?php
            $countPost = count($_POST['gol']['time']);
            $count = $countPost;
            if (($id > 0) && ($countPost <= 0)) {
                $gol = $database->getRows("SELECT * FROM tb_gols WHERE id_jogo = ? ORDER BY tempo,minuto ASC",array($id));
                $count = count($gol);
            }
            for ($i=0; $i < $count; $i++) {
                if (($id > 0) && ($countPost <= 0)) {
                    if ($gol[$i]['time'] == 1) {
                        $time = 'Casa';
                        $timeNome = $modelCore->getTimeInfo($select_casa,'nome');
                    } else {
                        $time = 'Visitante';
                        $timeNome = $modelCore->getTimeInfo($select_visitante,'nome');
                    }
                    $timeValue = $gol[$i]['time'];
                    
                    $minuto = $gol[$i]['minuto'];
                    
                    $tempo = ($gol[$i]['tempo'] == 1)?$lang->t('Primeiro Tempo',true):$lang->t('Segundo Tempo',true);
                    $tempoValue = $gol[$i]['tempo'];
                   
                } else {
                    $time = ($_POST['gol']['time'][$i] == 1)?'Casa':'Visitante';
                    $timeNome = $modelCore->getTimeInfo($_POST['select_'.$time],'nome');
                    $timeValue = $_POST['gol']['time'][$i];
                    $minuto = $_POST['gol']['minuto'][$i];
                    $tempo = ($_POST['gol']['tempo'][$i]== 1)?$lang->t('Primeiro Tempo',true):$lang->t('Segundo Tempo',true);
                    $tempoValue = $_POST['gol']['tempo'][$i];
                }            
?>
                <tr>
                    <td>
                        <span class="time<?php echo $time; ?>">
                            <?php echo $timeNome; ?>
                            <input type="hidden" name="gol[time][]" value="<?php echo $timeValue; ?>">
                        </span>
                    </td>
                    <td><?php echo $minuto; ?><input type="hidden" name="gol[minuto][]" value="<?php echo $minuto; ?>"></td>
                    <td><?php echo $tempo; ?><input type="hidden" name="gol[tempo][]" value="<?php echo $tempoValue; ?>"></td>
                    <td><button type="button" class="btn btn-danger excluirGol" onclick="$(this).parent().parent().remove();">Excluir</button></td>
                </tr> 
<?php
            }
?>
            </table>
        </div>
        <?php echo $type; ?>
        <input type="submit" value="<?php $lang->t('Salvar Jogo'); ?>" class="btn btn-success pull-right">       
    </form>
    <div class="row jogosLinha">
        <div class="col-sm-12">
            <strong><?php $lang->t('Adicionar Gols'); ?>:</strong>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group">
                    <span class="input-group-addon"><?php $lang->t('Time'); ?></span>
                    <div class="btn-group" data-toggle="buttons">
                        <label></label>
                        <label class="btn btn-default active">
                            <input type="radio" name="time" value="1" checked><span class="timeCasa"><?php $lang->t('Casa'); ?></span>
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="time" value="2" ><span class="timeVisitante"><?php $lang->t('Visitante'); ?></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 adjust-top">
                <div class="input-group">
                    <span class="input-group-addon"><?php $lang->t('Minuto'); ?></span>
                    <input type="number" name="minuto" min="0" max="60" class="form-control">
                </div>
            </div>
            <div class="col-sm-7 adjust-top">
                <div class="input-group">
                    <span class="input-group-addon"><?php $lang->t('Tempo'); ?></span>
                    <div class="btn-group" data-toggle="buttons">
                        <label></label>
                        <label class="btn btn-default active">
                            <input type="radio" name="tempo" value="1" checked> <?php $lang->t('Primeiro Tempo'); ?>
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="tempo" value="2" > <?php $lang->t('Segundo Tempo'); ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-1 adjust-top">
                <button type="button" class="btn btn-success pull-right" id="addGol"><i class="glyphicon glyphicon-plus"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {

    //adiciona Gol
    $("#addGol").click(function () {
        var time = ($("input[name='time']:checked").val());
        var minuto = ($("input[name='minuto']").val());
        var tempo = ($("input[name='tempo']:checked").val());
        
        tableGol(time, minuto,tempo);
    });
    
    //inclui gol na tabela
    function tableGol(time, minuto, tempo) {
    
        var timeTxt = '';
        var timeHtml = '';
        timeTxt = (time == 1)?'Casa':'Visitante';
        timeHtml = '<span class="time'+timeTxt+'">'+$("#select_"+timeTxt).children("option").filter(":selected").html()+'</span>';
        timeHtml += '<input type="hidden" name="gol[time][]" value="'+time+'">';
        
        var minutoHtml = '';
        minuto = (minuto == '')?'0':minuto;
        minutoHtml = minuto+'<input type="hidden" name="gol[minuto][]" value="'+minuto+'">';   
        
        var tempoTxt = '';
        var tempoHtml = '';
        tempoTxt = (tempo == 1)?'<?php $lang->t('Primeiro Tempo'); ?>':'<?php $lang->t('Segundo Tempo'); ?>';
        tempoHtml = tempoTxt+'<input type="hidden" name="gol[tempo][]" value="'+tempo+'">';
        
        var excluirHtml = '';
        excluirHtml = '<button type="button" class="btn btn-danger excluirGol" onclick="$(this).parent().parent().remove();">Excluir</button>';
    
        var inclui = ['<tr>',
                        '<td>',timeHtml,'</td>',
                        '<td>',minutoHtml,'</td>',
                        '<td>',tempoHtml,'</td>',
                        '<td>',excluirHtml,'</td>',
                    '</tr>'].join('');
        $('#tableGol tr:last').after(inclui);
    }
    //Fim inserir gol na table

    //Verifica qual o campeonato selecionado e busca os times correspondentes
    if ($("#select_campeonato").children("option").filter(":selected").val() != 0) {
        callTimes();
    }
    
    $("#select_campeonato").change(function () {
        callTimes();
    });
    
    function callTimes() {
    	$.ajax({
			type:"POST",
			url: 'view/ajax/addTimes.php',
			data: {
                campeonato: $("#select_campeonato").children("option").filter(":selected").val(),
				casa: <?php echo $select_casa; ?>,
				visitante: <?php echo $select_visitante; ?>
			}
		}).done(function(msg) {
			$('#divTimes').html(msg);
		});	  
    }
    //Fim busca campeonato/mostra times
});
</script>
<h1></h1>