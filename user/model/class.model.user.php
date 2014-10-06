<?php
class modelUser {

    public $db;
    function __construct() {
        global $database;
        $this->db = $database;
    }
    
    function getRodadas($campeonato) {
        $rodada = $this->db->getRows("SELECT rodada FROM tb_jogos WHERE campeonato = ?",array($campeonato));
        return $rodada;
    }
    
    function getJogosRodada($rodada, $campeonato) {
        $jogos = $this->db->getRows("SELECT * FROM tb_jogos WHERE campeonato = ? AND rodada = ? ORDER BY data ASC",array($campeonato,$rodada));
        return $jogos;
    }
    
    function getJogosTime($id, $campeonato) {
        $jogos = $this->db->getRows("SELECT * FROM tb_jogos WHERE campeonato = ? AND (casa = ? OR visitante = ?) ORDER BY rodada ASC",array($campeonato,$id, $id));
        return $jogos;
    }

    function getJogosTimeRodada($id, $campeonato, $rodada) {
        $jogos = $this->db->getRows("SELECT * FROM tb_jogos WHERE campeonato = ? AND rodada <= ? AND (casa = ? OR visitante = ?) ORDER BY rodada ASC",array($campeonato,$rodada, $id, $id));
        return $jogos;
    }
      
}
?>