<?php
    global $modelCore;
    
    $campeonato = 1;
    
    $info = $modelCore->getTimeCampeonato($campeonato);
    $tabela = $controlUser->criarTabela($info, $campeonato);
?>
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12">
            <div class="row top">
                <div class="col-xs-3"><?php $lang->t('Time'); ?></div>
                <div class="col-xs-1"><?php $lang->t('P'); ?></div>
                <div class="col-xs-1"><?php $lang->t('J'); ?></div>
                <div class="col-xs-1"><?php $lang->t('V'); ?></div>
                <div class="col-xs-1"><?php $lang->t('E'); ?></div>
                <div class="col-xs-1"><?php $lang->t('D'); ?></div>
                <div class="col-xs-1"><?php $lang->t('GP'); ?></div>
                <div class="col-xs-1"><?php $lang->t('GC'); ?></div>
                <div class="col-xs-1"><?php $lang->t('SG'); ?></div>
                <div class="col-xs-1"><?php $lang->t('%'); ?></div>
            </div>
<?php
    $i = 0;
    foreach ($tabela as $t) {
        $class = (($i%2)==0)?'dark':'light';
        $i++;
?>
            <div class="row <?php echo $class; ?>">
                <div class="col-xs-3"><a href="#" id="<?php echo $t['id']; ?>" class="maisInfo"><i id="iconMaisInfo<?php echo $t['id']; ?>" class="glyphicon glyphicon-plus"></i></a> <a href="index.php?page=time&id=<?php echo $t['id']; ?>&camp=<?php echo $campeonato; ?>"><img src="<?php echo $controlUser->showTimeImg($t['id'])?>" class="rodadaTableLine"> <?php echo $t['nome']; ?></a></div>
                <div class="col-xs-1"><?php echo $t['P']; ?></div>
                <div class="col-xs-1"><?php echo $t['J']; ?></div>
                <div class="col-xs-1"><?php echo $t['V']; ?></div>
                <div class="col-xs-1"><?php echo $t['E']; ?></div>
                <div class="col-xs-1"><?php echo $t['D']; ?></div>
                <div class="col-xs-1"><?php echo $t['GP']; ?></div>
                <div class="col-xs-1"><?php echo $t['GC']; ?></div>
                <div class="col-xs-1"><?php echo $t['S']; ?></div>
                <div class="col-xs-1"><?php echo $t['A']; ?></div>
            </div>
            <div class="row <?php echo $class; ?> maisInfoTabela" id="maisInfoTab<?php echo $t['id']; ?>">
                <?php $lang->t('Mais Info'); ?>
            </div>            
<?php
    }
?>
        </div>
        <div class="col-md-3 col-sm-12">
            <?php $rodadas = $controlUser->numeroRodadas($campeonato); ?>
            <div id="carousel-jogos" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <!-- Wrapper for slides -->
              <div class="carousel-inner">
<?php
            $totalRodadas = count($rodadas);
            foreach ($rodadas as $rodada) {
                $jogos = $controlUser->jogosRodada($rodada, $campeonato);
?>
                <div class="item <?php echo ($rodada == $rodadas[$totalRodadas-1])?'active':'';?>">
                    <div class="tabelaRodada">Rodada <?php echo $rodada; ?></div>
<?php
                    foreach ($jogos as $jogo) {
?>
                    <div class="row margin0">
                        <div class="col-xs-4 text-center"><img src="<?php echo $controlUser->showTimeImg($jogo['casa'])?>" class="rodadaTable"></div>
                        <div class="col-xs-4 text-center rodadaResult"><?php echo $controlUser->showNumGols($jogo['id'],1)?> x <?php echo $controlUser->showNumGols($jogo['id'],2)?></div>
                        <div class="col-xs-4 text-center"><img src="<?php echo $controlUser->showTimeImg($jogo['visitante'])?>" class="rodadaTable"></div>
                    </div>
                    <div class="row margin0 text-center">
                        <a href="#" tabindex="0" data-toggle="popover" data-trigger="focus" data-html="true" title="<div class='titlePopover'><?php echo $controlUser->showTimeNome($jogo['casa'])?> x <?php echo $controlUser->showTimeNome($jogo['visitante'])?></div>" data-content="<?php echo $controlUser->showTempoGols($jogo['id'],$lang->t('Jogo sem Gols',true)); ?>" data-placement="bottom" data-container="body"><?php $lang->t('Mais Info'); ?></a>   
                    </div>
<?php
                    }
?>
                </div>
<?php
            }
?>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-jogos" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-jogos" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
            </div>        
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.carousel').carousel({
        interval: 360000
    });
    $(function () {
        $("[data-toggle='popover']").popover();
    });
    $(function () {
        $("[data-toggle='tooltip']").tooltip();
    });
    var ultimoToggle;    
    $(".maisInfo").click(function () {
        var id = $(this).attr('id');
        var muda;
        
        if (ultimoToggle != id) {
            $(".maisInfoTabela").hide("fast");
            $('.glyphicon-minus').removeClass('glyphicon-minus').addClass('glyphicon-plus');
        }
        ultimoToggle = id;
        
        $('#maisInfoTab'+id).toggle("fast",function () {
            if ($('#iconMaisInfo'+id).hasClass('glyphicon-plus')) {
                $('#iconMaisInfo'+id).removeClass('glyphicon-plus').addClass('glyphicon-minus');
            } else {
                $('#iconMaisInfo'+id).removeClass('glyphicon-minus').addClass('glyphicon-plus');
            }        
        });
        
        $.ajax({
			type:"POST",
			url: 'view/ajax/moreInfo.php',
			data: {
                campeonato: <?php echo $campeonato; ?>,
                id: id
			}
		}).done(function(msg) {
			$('#maisInfoTab'+id).html(msg);
		});
    });
    
    
    
    
    
</script>
