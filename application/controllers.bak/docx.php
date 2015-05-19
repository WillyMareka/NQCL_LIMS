<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Docx extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->library('phpdocx');
    }
    function generate(){
        $docx= new CreateDocx();
        $text=array();
        $text[]=array('text'=>'I am going to write');
        $text[]=array('text'=>'Hellow World','b'=>'on');
        $text[]=array('text'=>'using bold characters');
        $docx->addText($text);
        $docx->createDocx('Test');
        echo 'Document Created';
    }
}
?>
