<?php
include 'includeAjax.php';

//Teste se campeonato Ž maior do que 0, caso n‹o seja, n‹o imprime times.
$testCampeonato = ($_POST['campeonato']<=0)?false:true;
if (!$testCampeonato) return;

$times = $modelCore->getTimeCampeonato($_POST['campeonato']);
?>
<div class="input-group adjust-top">
  <span class="input-group-addon"><?php $lang->t('Casa'); ?></span>
  <?php echo $controlCore->select($times,$_POST['casa'],'select_Casa','form-control'); ?>
</div>
<div class="input-group adjust-top">
  <span class="input-group-addon"><?php $lang->t('Visitante'); ?></span>
  <?php echo $controlCore->select($times,$_POST['visitante'],'select_Visitante','form-control'); ?>
</div>

<script>
    //Ajusta nome dos times
    $("#select_Casa").change(function () {
        $(".timeCasa").html($(this).children("option").filter(":selected").html());
    });
    $("#select_Visitante").change(function () {
        $(".timeVisitante").html($(this).children("option").filter(":selected").html());
    });
</script>