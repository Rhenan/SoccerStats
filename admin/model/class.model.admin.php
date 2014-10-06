<?php
class modelAdmin {

    public $db;
    function __construct() {
        global $database;
        $this->db = $database;
    }
    
    function inserir($query, $args) {
        $inserir = $this->db->insertRow($query, $args);
        return $inserir;
    }

    function update($query, $args) {
        $update = $this->db->updateRow($query, $args);
        return $update;
    }
    
    function delete($query, $args) {
        $deletar = $this->db->deleteRow($query, $args);
        return $deletar;
    }   

    function ultimoID() {
        return $this->db->lastInsertId(); 
    }
}
?>