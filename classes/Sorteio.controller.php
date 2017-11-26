<?php
/**
 * User: adrianoanschau
 * Date: 25/11/17
 * Time: 12:58
 */

class Sorteio extends Controller {

    public function index(){
        $inscritos = $this->json->get('inscritos');
        $dezenas = $this->json->get('dezenas');
        $sorteio = $this->random($dezenas,6);
        $vencedor = $this->determinarVencedores($inscritos,$sorteio);
        $view = $this->view->get('sorteio')
            ->set('vencedor',$vencedor)
            ->set('dezenas',$dezenas)
            ->set('sorteio',$sorteio);
        $salvarSorteio = array(
            "vencedor" => array(
                "nome" => $vencedor['nome'],
                "idade" => $vencedor['idade']
            ),
            "dezenas" => $sorteio
        );
        $this->json->save('inscritos',array());
        $sorteios = $this->json->get('sorteios');
        array_unshift($sorteios,$salvarSorteio);
        $this->json->save('sorteios',$sorteios);
        return $view->output();
    }

    private function random($dezenas,$total){
        $sorteio = array();
        while(count($sorteio)<$total){
            $rand = $dezenas[rand(0,count($dezenas)-1)];
            if(!in_array($rand,$sorteio)) $sorteio[] = $rand;
        }
        return $sorteio;
    }

    private function determinarVencedores($inscritos,$sorteio){
        foreach($inscritos as $i=>$inscrito){
            $acertos = 0;
            foreach($inscrito['dezenas'] as $dezena){
                if(in_array((int)$dezena,$sorteio)){
                    $acertos++;
                }
            }
            $inscritos[$i]['acertos'] = $acertos;
        }
        $acertos = array();
        $ordem = array();
        foreach($inscritos as $key=>$row){
            $acertos[$key] = $row['acertos'];
            $ordem[$key] = $row['id'];
        }
        array_multisort($acertos,SORT_DESC, $ordem, SORT_ASC, $inscritos);
        return $inscritos[0];
    }

}