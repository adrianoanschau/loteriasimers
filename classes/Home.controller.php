<?php
/**
 * User: adrianoanschau
 * Date: 25/11/17
 * Time: 12:58
 */

class Home extends Controller {

    public function index(){
        $inscritos = $this->json->get('inscritos');
        $sorteios = $this->json->get('sorteios');

        $view = $this->view->get('home');
        $view->set("ultimosorteio",current($sorteios));
        array_shift($sorteios);
        $view->set("sorteiosAnteriores",$sorteios);
        $view->set("inscritos",$inscritos);
        $view->set("falta",5-count($inscritos));

        return $view->output();
    }
}