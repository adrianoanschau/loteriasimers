<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title><?=$title?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="/assets/font-awesome/css/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="/assets/styles/base.css"/>
    </head>
    <body class="home">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1>Loteria Simers</h1>
                <h4>Formulário de Inscrição</h4>
            </div>
            <div class="panel-body">
                <form method="post">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label>Nome</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="nome" class="form-control" value="<?=@$_POST['nome']?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label>Idade</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" name="idade" min="0" max="120" class="form-control" value="<?=(isset($_POST['idade'])?$_POST['idade']:18)?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info">Selecione as suas dezenas</li>
                            <li class='list-group-item'>
                                <p style="max-width:240px;margin:auto">
                                    <?php foreach($dezenas as $numero){
                                        $active = false;
                                        if(isset($_POST['dezenas'])&&$_POST['dezenas']!=""){
                                            $postDezenas = explode(",",$_POST['dezenas']);
                                            $active = in_array($numero,$postDezenas);
                                        }
                                        ?>
                                        <button type="button" class='numero<?=(($active)?' active':'')?>'><?=format($numero)?></button>
                                    <?php } ?>
                                </p>
                            </li>
                            <?php if(isset($mensagem)){ ?>
                            <li class="list-group-item list-group-item-<?=$mensagem['type']?>"><?=$mensagem['text']?></li>
                            <?php } ?>
                        </ul>
                        <input type="hidden" name="dezenas" value="<?=@$_POST['dezenas']?>">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <a href="/" class="form-control btn btn-default">Voltar</a>
                        </div>
                        <div class="col-md-6">
                            <input type="submit" class="form-control btn-primary" value="Confirmar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="/assets/scripts/jquery.js"></script>
        <script>
            $(document).ready(function(){
                var dezenasSelecionadas = [];
                <?php if(isset($_POST['dezenas'])) { ?>
                    var dezenas = "<?=$_POST['dezenas']?>";
                    if(dezenas!='') dezenasSelecionadas = dezenas.split(",");
                <?php } ?>
                $("button.numero").click(function(){
                    $(this).toggleClass("active");
                    var dezena = $(this).text();
                    if($(this).hasClass("active")){
                        dezenasSelecionadas.push(dezena);
                    } else {
                        dezenasSelecionadas.splice(dezenasSelecionadas.indexOf(dezena),1);
                    }
                    $('input[name=dezenas').val(dezenasSelecionadas.join(','));
                });
            })
        </script>
    </body>
</html>