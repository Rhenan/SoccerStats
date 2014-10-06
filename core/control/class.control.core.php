<?php
class controlCore {

    public $mCore;
    function __construct() {
        global $modelCore;
        $this->mCore = $modelCore;
    }
    
    //Altera data de yyyy-mm-dd para dd/mm/yyyy
    function acertaData ($data) {
        $novaData = explode("-",$data);
        $novaData = $novaData[2]."/".$novaData[1]."/".$novaData[0];
        return $novaData;
    }
    
    //Função para organizar Array por nome
    function organiza($info, $id = 'id', $nome = 'nome', $order = SORT_ASC) {
    
        $temp = array();
        
        foreach ($info as $i) {
            $temp[$i[$id]] = $i[$nome];
        }
        
        array_multisort($temp, $order, $info);
        
        return $info;
    }
    
    //Cria um select com os campeonatos cadastrados
    function select($info, $select, $nome, $class = '') {
    
        $info = $this->organiza($info);

        $output = "<select id='{$nome}' name='{$nome}' class='{$class}'>".PHP_EOL;
        $output .= "<option value='0'>---</option>".PHP_EOL;
        foreach ($info as $i) {
            //echo '['.$i['id'].'|'.$select.']';
            $selected = ($i['id'] == $select)?'selected':'';
            $output .= "<option value='{$i['id']}' {$selected}>".htmlentities($i['nome'])."</option>".PHP_EOL;
        }
        $output .= "</select>";
        
        return $output;
    }
    
    //Debug
    //Função para mostrar o valor destacado
    function show($value, $desc = '') {
        $desc .= ($desc)?': ':'';
        $txt = "<p class='bg-danger'>[{$desc}{$value}]</p>";

        echo $txt;
    }
}
?>