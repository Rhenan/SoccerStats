<?php
class controlAdmin {

    public $mAdmin;
    function __construct() {
        global $modelAdmin;
        $this->mAdmin = $modelAdmin;
    }
    
    function checkInfo($info) {
        $erro = 0;
        if (is_numeric($info['select_campeonato']) AND ($info['select_campeonato'] <= 0)) $erro++;
        if (is_numeric($info['select_Casa']) AND ($info['select_Casa'] <= 0)) $erro++;
        if (is_numeric($info['select_Visitante']) AND ($info['select_Visitante'] <= 0)) $erro++;        
        if (is_numeric($info['rodada']) AND ($info['rodada'] <= 0)) $erro++;
        $date = explode('-',$info['data']);
        if (!checkdate((int)$date[1], (int)$date[2], (int)$date[0])) $erro++;
        return $erro;
    }
    
    function incluirGols($info, $id_jogos) {
        $count = count($info['gol']['time']);
        for ($i = 0; $i < $count; $i++) {
            $inserirGol = $this->mAdmin->inserir("INSERT INTO tb_gols (id_jogo, time, minuto, tempo) VALUES (?, ?, ?, ?)", array($id_jogos, $info['gol']['time'][$i], $info['gol']['minuto'][$i], $info['gol']['tempo'][$i]));
        }    
    }
    
    function incluirJogo($info) {
        $erro = $this->checkInfo($info);
        
        if (!$erro) {
            $inserirJogo = $this->mAdmin->inserir("INSERT INTO tb_jogos (casa, visitante, campeonato, data, rodada) VALUES (?, ?, ?, ?, ?)", array($info['select_Casa'],$info['select_Visitante'], $info['select_campeonato'], $info['data'], $info['rodada']));
            
            $this->incluirGols($info, $inserirJogo);

            return $inserirJogo;
        } else {
            return false;
        }  
    }
    
    function editarJogo($info) {
        $erro = $this->checkInfo($info);
        
        if (!$erro) {
            $updateJogo = $this->mAdmin->update("UPDATE tb_jogos SET casa = ?, visitante = ?, campeonato = ?, data = ?, rodada=? WHERE id = ?", array($info['select_Casa'],$info['select_Visitante'], $info['select_campeonato'], $info['data'], $info['rodada'], $info['type']));
            
            $deleteGols = $this->mAdmin->delete("DELETE FROM tb_gols WHERE id_jogo = ?", array($info['type']));
            $this->incluirGols($info, $info['type']);
        }
        
        return $info['type'];
    }

    function incluirCampeonato($info) {
        if (!$erro) {
            $inserirCamp = $this->mAdmin->inserir("INSERT INTO tb_campeonato (nome, rodada, pais) VALUES (?, ?, ?)", array($info['nome'],$info['rodada'], $info['pais']));
            return $inserirCamp;
        } else {
            return false;
        }  
    }
    
    function editarCampeonato($info) {
        if (!$erro) {
            $updateCamp = $this->mAdmin->update("UPDATE tb_campeonato SET nome = ?, rodada = ?, pais = ? WHERE id = ?", array($info['nome'],$info['rodada'], $info['pais'], $info['type']));
        }
        
        return $info['type'];
    }

    function incluirTime($info) {
        if (!$erro) {
            $inserirTime = $this->mAdmin->inserir("INSERT INTO tb_times (nome, img, campeonato) VALUES (?, ?, ?)", array($info['nome'],$info['img'], $info['select_campeonato']));
            return $inserirTime;
        } else {
            return false;
        }  
    }
    
    function editarTime($info) {
        if (!$erro) {
            $updateTime = $this->mAdmin->update("UPDATE tb_times SET nome = ?, img = ?, campeonato = ? WHERE id = ?", array($info['nome'],$info['img'], $info['select_campeonato'], $info['type']));
        }
        
        return $info['type'];
    }
}
?>