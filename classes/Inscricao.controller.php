<?php
/**
 * User: adrianoanschau
 * Date: 25/11/17
 * Time: 12:58
 */

class Inscricao extends Controller {

    private $permissoes = array(
        18 => 6,
        30 => 8,
        50 => 10,
        70 => 11,
        120 => 12
    );

    private $mensagem = null;

    public function index(){
        if($this->validar()){
            $inscritos = $this->json->get('inscritos');
            $inscricao = array(
                'id' => count($inscritos),
                'nome' => $_POST['nome'],
                'idade' => $_POST['idade'],
                'dezenas' => explode(",",$_POST['dezenas'])
            );
            array_push($inscritos,$inscricao);
            $this->json->save('inscritos',$inscritos);
            $view = $this->view->get('inscricao-confirmar');
        }
        else {
            $dezenas = $this->json->get('dezenas');
            $view = $this->view->get('inscricao');
            $view->set("dezenas", $dezenas);
        }
        return $view->output($this->mensagem);
    }

    private function validar(){
        if(isset($_POST['nome'])){
            if($_POST['nome']==''){
                $this->mensagem = array(
                    'type' => 'warning',
                    'text' => "Você esqueceu de preencher o nome."
                );
                return false;
            } else {
                $idade = $_POST['idade'];
                $dezenas = explode(",",$_POST['dezenas']);
                foreach($this->permissoes as $maxidade=>$maxdezenas){
                    if($idade<=$maxidade) {
                        if(count($dezenas)!=$maxdezenas) {
                            $this->mensagem = array(
                                'type' => 'warning',
                                'text' => "Com {$idade} anos você tem direito de apostar em {$maxdezenas} dezenas.<br>Marque as {$maxdezenas} dezenas e confirme em seguida."
                            );
                            return false;
                        }
                        return true;
                    }
                }
            }
        }
        return false;
    }

}