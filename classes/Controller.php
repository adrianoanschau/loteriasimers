<?php
/**
 * User: adrianoanschau
 * Date: 25/11/17
 * Time: 12:58
 */

abstract class Controller {

    protected $view;
    protected $json;

    public function __construct()
    {
        $this->view = new View();
        $this->json = new Json();
    }

    public function __call($name, $arguments)
    {
        if(!method_exists($this,$name)){
            echo "Método {$name} não existe!";
        }
    }

    abstract function index();

}