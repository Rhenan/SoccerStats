<?php
    include 'includeAjax.php';
    $controlUser->callHeader();
    
    $id = $_POST['id'];
    $campeonato = $_POST['campeonato'];
?>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default margin10">
                <div class="panel-body">
                    <?php $lang->t('Campeonato');?>: <?php echo $controlUser->showCampeonatoNome($campeonato); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="panel panel-default margin10">
                <div class="panel-heading ">
                    <h3 class="panel-title"><?php $lang->t('Jogos');?></h3>
                </div>
                <div class="panel-body">
                <?php $jogos = $controlUser->jogosTime ($id, $campeonato); ?>
        
<?php
                foreach ($jogos as $jogo) {
                    $resultadoCasa = ($jogo['casa'] == $id)?1:0;
                    $resultadoVisitante = ($jogo['visitante'] == $id)?1:0;
                    
                    $golCasa = $controlUser->showNumGols($jogo['id'],1);
                    $golVisitante = $controlUser->showNumGols($jogo['id'],2);
                    
                    if ($resultadoCasa) {
                        $bgResultado = ($golCasa > $golVisitante)?'green':'yellow';
                        $bgResultado = ($golCasa < $golVisitante)?'red':$bgResultado;
                        $resultadoCasa = '<div class="resultadoCirculo pull-left" style="background-color:'.$bgResultado.'"></div>';
                        $resultadoVisitante = '';
                    } else if ($resultadoVisitante) {
                        $bgResultado = ($golCasa < $golVisitante)?'green':'yellow';
                        $bgResultado = ($golCasa > $golVisitante)?'red':$bgResultado;                    
                        $resultadoVisitante = '<div class="resultadoCirculo pull-right" style="background-color:'.$bgResultado.'"></div>';
                        $resultadoCasa = '';
                    }
                    
?>
                    <div class="col-xs-12 maisInfoJogo">
                        <div class="col-xs-1"><?php $lang->t('R');?>: <?php echo $jogo['rodada']; ?></div>
                        <div class="col-xs-3"><?php $lang->t('Data');?>: <?php echo $controlUser->acertaData($jogo['data']); ?></div>
                        <div class="col-xs-3 text-right"><?php echo $resultadoCasa.' '.$controlUser->showTimeNome($jogo['casa']); ?>  <img src="<?php echo $controlUser->showTimeImg($jogo['casa']); ?>" class="maisInfoImg"></div>
                        <div class="col-xs-1"><?php echo $golCasa;  ?> x <?php echo $golVisitante; ?></div>
                        <div class="col-xs-3 text-left"><img src="<?php echo $controlUser->showTimeImg($jogo['visitante']); ?>" class="maisInfoImg">  <?php echo $controlUser->showTimeNome($jogo['visitante']).' '.$resultadoVisitante;?></div>
                    </div>
<?php
                }
?>
            </div>
        </div>
    </div>
