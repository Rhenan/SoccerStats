<?php
class controlUser {
    
    public $mCore;
    public $cCore;
    public $mUser;
    function __construct() {
        global $modelCore;
        global $controlCore;
        global $modelUser;
        $this->mCore = $modelCore;
        $this->cCore = $controlCore;
        $this->mUser = $modelUser;
    }
    
    function callHeader() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
    }
    
    function criarTabela($info, $campeonato) {
    
        //Coloca os times do campeonato escolhido em um array
        $timesTemp = $this->mCore->getTimeCampeonato($campeonato);
        $times = array();
        foreach ($timesTemp as $temp) {
            $times[$temp['id']]['id'] = $temp['id'];
            $times[$temp['id']]['nome'] = $temp['nome'];
            $times[$temp['id']]['J'] = 0;
            $times[$temp['id']]['V'] = 0;
            $times[$temp['id']]['D'] = 0;
            $times[$temp['id']]['GP'] = 0;
            $times[$temp['id']]['GC'] = 0;
        }
        
        $jogos = $this->mCore->getJogosCampeonatos($campeonato);
        
        foreach ($jogos as $jogo) {
            $golsCasa = $this->mCore->getQtdeGols ($jogo['id'], 1);
            $golsVisitante = $this->mCore->getQtdeGols ($jogo['id'], 2);
            $times[$jogo['casa']]['J']++;
            $times[$jogo['visitante']]['J']++;
            $times[$jogo['casa']]['GP'] += $golsCasa;
            $times[$jogo['visitante']]['GP'] += $golsVisitante;
            $times[$jogo['casa']]['GC'] += $golsVisitante;
            $times[$jogo['visitante']]['GC'] += $golsCasa;
            if ($golsCasa > $golsVisitante) {
                $times[$jogo['casa']]['V'] += 1;
                $times[$jogo['visitante']]['D'] += 1;
            } else if ($golsCasa < $golsVisitante){
                $times[$jogo['casa']]['D'] += 1;
                $times[$jogo['visitante']]['V'] += 1;            
            }
        }
        
        foreach ($times as &$t) {
            $t['S'] = $t['GP']-$t['GC'];
            $t['E'] = $t['J']-$t['V']-$t['D'];
            $t['S'] = $t['GP']-$t['GC'];
            $t['P'] = $t['V']*3+$t['E'];
            $t['A'] = round(($t['P']/($t['J']*3)),4)*100;
        }        
        
        // Ordena times
        $sort = array();
        foreach($times as $k => $v) {
            $sort['P'][$k] = $v['P'];
            $sort['V'][$k] = $v['V'];
            $sort['S'][$k] = $v['S'];
        }
       
        array_multisort($sort['P'], SORT_DESC, $sort['V'], SORT_DESC, $sort['S'], SORT_DESC, $times);
        
        return $times;
    }
    
    function numeroRodadas($campeonato) {
        $rodadas = $this->mUser->getRodadas($campeonato);
        $temp = array();
        foreach ($rodadas as $k => $v) { //Ajusta array das rodadas para facilitar remo‹o de duplicados
            $temp[] = $v['rodada'];
        }
        
        $rodadas = array_unique($temp); //Remove valores duplicados
        $rodadas = array_values($rodadas); //Refaz key do array
        return $rodadas;
        
    }
    
    function jogosRodada($rodada, $campeonato) {
        return $this->mUser->getJogosRodada($rodada, $campeonato);
    }
    
    function showTimeNome($time) {
        return $this->mCore->getTimeInfo($time, 'nome');
    }
    
    function showTimeImg($time) {
        return IMAGE_PATH.$this->mCore->getTimeInfo($time, 'img');
    }    
    
    function showNumGols ($id, $time) {
        return $this->mCore->getQtdeGols($id, $time);
    }
    
    function showTempoGols ($id, $noGoal) {
        $gols = $this->mCore->getTodosGols($id);
        $golsCasa = 0;
        $golsVisitante = 0;
        $output = '';
        foreach ($gols as $gol) {
            $output .= "<div class='row'>";
            $placar = '';
            $casa = '';
            $visitante = '';
            if ($gol['time'] == 1) {
                $golsCasa++;
                $casa .= "{$gol["minuto"]}[{$gol["tempo"]}T]";
                $placar = "<span class='golPopover'>{$golsCasa}</span> x {$golsVisitante}";
            } else {
                $golsVisitante++;
                $visitante .= "{$gol["minuto"]}[{$gol["tempo"]}T]";
                $placar = "{$golsCasa} x <span class='golPopover'>{$golsVisitante}</span>";            
            }
            $output .= "<div class='col-xs-4'>{$casa}</div>";
            $output .= "<div class='col-xs-4'>{$placar}</div>";
            $output .= "<div class='col-xs-4'>{$visitante}</div>";        
            $output .= "</div>";
        }
        if (empty($output)) {$output = "<div class='row text-center'>".$noGoal."</div>";}
        return $output;
    }
    
    function showCampeonatoNome ($id) {
        return $this->mCore->getCampeonatoInfo ($id, 'nome'); 
    }
    
    function jogosTime ($id, $campeonato) {
        return $this->mUser->getJogosTime($id, $campeonato);
    }
    
    function acertaData($data) {
        return $this->cCore->acertaData($data);
    }
    
    function golsMinuto($time, $campeonato, $rodada = false) {
        $rodada = ($rodada)?$rodada:$this->mCore->getCampeonatoInfo($campeonato, 'rodada');
        $jogos = $this->mUser->getJogosTimeRodada($time, $campeonato, $rodada);
        $gArray = array();
      
        foreach ($jogos as $jogo) {
            $gols = $this->mCore->getTodosGols($jogo['id']);
            $mandante = ($jogo['casa']==$time)?1:0;
            foreach ($gols as $gol) {
                if ($mandante) {
                    if ($gol['time'] == 1)
                        $gArray[0][$gol['tempo']][$gol['minuto']] += 1;
                    else 
                        $gArray[1][$gol['tempo']][$gol['minuto']] += 1;
                } else {
                    if ($gol['time'] == 2)
                        $gArray[0][$gol['tempo']][$gol['minuto']] += 1;
                    else 
                        $gArray[1][$gol['tempo']][$gol['minuto']] += 1;
                }
                
            }
        }
    
        return $gArray;
    }
}
?>