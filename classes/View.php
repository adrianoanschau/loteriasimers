<?php
/**
 * User: adrianoanschau
 * Date: 25/11/17
 * Time: 13:12
 */

class View {

    private $template;
    private $props;

    public function __construct(){
        $this->props = array();
        $this->props['title'] = TITLE;
    }

    public function get($template){
        $filename = TEMPLATES.$template.".php";
        if(file_exists($filename)) {
            $this->template = $filename;
        } else {
            $this->template = false;
        }
        return $this;
    }

    public function set($prop,$value){
        $this->props[$prop] = $value;
        return $this;
    }

    public function output($mensagem=null){
        if($this->template) {
            foreach($this->props as $prop=>$value) $$prop = $value;
            include_once $this->template;
        } else {
            echo "Template não existe";
        }
    }

}