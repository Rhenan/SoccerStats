<?php
class modelCore {

    public $db;
    function __construct() {
        global $database;
        $this->db = $database;
    }

    //Retorna todas informa›es do time
    function getTime ($id) {
        $time = $this->db->getRow("SELECT * FROM tb_times WHERE id = ?", array($id));
        return $time;
    }
    
    //Retorna apenas o campo especifico do time
    function getTimeInfo($id, $field) {
        $time = $this->getTime($id);
        return $time[$field];
    }

    //Retorna apenas os times de determinado campeonato
    function getTimeCampeonato($campeonato) {
        $times = $this->db->getRows("SELECT * FROM tb_times WHERE campeonato = ?", array($campeonato));
        return $times;
    }
   
   //Retorna todos campeonatos cadastrados
    function getTodosCampeonatos () {
        $campeonatos = $this->db->getRows("SELECT * FROM tb_campeonato");
        return $campeonatos;
    }
    
   //Retorna todos campeonatos cadastrados
    function getJogosCampeonatos ($campeonato) {
        $jogos = $this->db->getRows("SELECT * FROM tb_jogos WHERE campeonato = ?",array($campeonato));
        return $jogos;
    }
    
    //Retorna apenas o campo especifico do Campeonato
    function getCampeonatoInfo ($id, $field) {
        $campeonato = $this->db->getRow("SELECT {$field} FROM tb_campeonato WHERE id = ?", array($id));
        return $campeonato[$field];
    }
    
    //Resultado do Jogo [Time da casa = 1 / Time Visitante = 2]
    function getQtdeGols ($id, $time) {
        $gols = $this->db->getRows("SELECT id FROM tb_gols WHERE id_jogo = ? AND time = ?", array($id, $time));
        return count($gols);
    }
    
    //Retorna todos os gols do jogo
    function getTodosGols ($id) {
        $gols = $this->db->getRows("SELECT * FROM tb_gols WHERE id_jogo = ? ORDER BY tempo ASC, minuto ASC", array($id));
        return $gols;
    }        
}
?>