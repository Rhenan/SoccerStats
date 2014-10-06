<?php
class language {

    public $lang;
    
    function __construct($language) {
        if (empty($language) OR isset($language)) $this->lang = 'pt-BR';
        else $this->lang = $language;
    }

    function t($string, $return = false) {
        include $this->lang.'/'.$this->lang.'.php';
        $s = strtolower($string);
        if (array_key_exists($s, $lang)) $s = $lang[$s];
        else $s = $string;
        
        if ($return == false) echo $s;
        else return $s;
    }



}
?>