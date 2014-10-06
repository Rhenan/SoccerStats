<?php
    $id = $_GET['id'];
    $camp = $_GET['camp'];
    
    $jogos = $controlUser->jogosTime($id, $camp);
    $golsMinuto = $controlUser->golsMinuto($id, $camp);
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php echo $controlUser->showTimeNome($id); ?>
            <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
            <div id="golsPrimeiroTempo" style="width: 100%; height: 300px;"></div>
            <div id="golsSegundoTempo" style="width: 100%; height: 300px;"></div>
            <script>
                google.setOnLoadCallback(drawChartGols1T);
                google.setOnLoadCallback(drawChartGols2T);
                function drawChartGols1T() {
                    var data = google.visualization.arrayToDataTable([
                                                                        ['Minuto', 'Gols Feitos', 'Gols Sofrido'],
                                                                        <?php
                                                                            for ($i = 0; $i <= 9; $i ++) {
                                                                                $feito = $golsMinuto[0][1][(5 * $i)] +
                                                                                        $golsMinuto[0][1][1 + (5 * $i)] +
                                                                                        $golsMinuto[0][1][2 + (5 * $i)] +
                                                                                        $golsMinuto[0][1][3 + (5 * $i)] +
                                                                                        $golsMinuto[0][1][4 + (5 * $i)];
                                                                                $feito = (empty($feito))?0:$feito;
                                                                                
                                                                                $sofrido = $golsMinuto[1][1][(5 * $i)] +
                                                                                        $golsMinuto[1][1][1 + (5 * $i)] +
                                                                                        $golsMinuto[1][1][2 + (5 * $i)] +
                                                                                        $golsMinuto[1][1][3 + (5 * $i)] +
                                                                                        $golsMinuto[1][1][4 + (5 * $i)];
                                                                                $sofrido = (empty($sofrido))?0:$sofrido;
                                                                                
                                                                                $minChart =  (5 * $i)." - ".(4+ (5 * $i));
                                                                                echo "['{$minChart}',".$feito.','.$sofrido."]";
                                                                                if ($i < 9) echo ','.PHP_EOL;
                                                                            }
                                                                        ?>
                                                                        
                                                                    ]);
                    
                    var options = {
                        title: 'Gols Primeiro Tempo',
                        hAxis: {title: 'Minuto', titleTextStyle: {color: 'red'}},
                        legend: { position: 'top'}
                    };
                    var chart = new google.visualization.ColumnChart(document.getElementById('golsPrimeiroTempo'));
                    chart.draw(data, options);
                }
                function drawChartGols2T() {
                    var data = google.visualization.arrayToDataTable([
                                                                        ['Minuto', 'Gols Feitos', 'Gols Sofrido'],
                                                                        <?php
                                                                            for ($i = 0; $i <= 9; $i ++) {
                                                                                $feito = $golsMinuto[0][2][(5 * $i)] +
                                                                                        $golsMinuto[0][2][1 + (5 * $i)] +
                                                                                        $golsMinuto[0][2][2 + (5 * $i)] +
                                                                                        $golsMinuto[0][2][3 + (5 * $i)] +
                                                                                        $golsMinuto[0][2][4 + (5 * $i)];
                                                                                $feito = (empty($feito))?0:$feito;
                                                                                
                                                                                $sofrido = $golsMinuto[2][1][(5 * $i)] +
                                                                                        $golsMinuto[1][2][1 + (5 * $i)] +
                                                                                        $golsMinuto[1][2][2 + (5 * $i)] +
                                                                                        $golsMinuto[1][2][3 + (5 * $i)] +
                                                                                        $golsMinuto[1][2][4 + (5 * $i)];
                                                                                $sofrido = (empty($sofrido))?0:$sofrido;
                                                                                
                                                                                $minChart =  (5 * $i)." - ".(4+ (5 * $i));
                                                                                echo "['{$minChart}',".$feito.','.$sofrido."]";
                                                                                if ($i < 9) echo ','.PHP_EOL;
                                                                            }
                                                                        ?>
                                                                        
                                                                    ]);
                    
                    var options = {
                        title: 'Gols Segundo Tempo',
                        hAxis: {title: 'Minuto', titleTextStyle: {color: 'red'}},
                        legend: { position: 'top'}
                    };
                    var chart = new google.visualization.ColumnChart(document.getElementById('golsSegundoTempo'));
                    chart.draw(data, options);
                }
            </script>
        </div>
    </div>
</div>