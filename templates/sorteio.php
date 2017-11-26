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
                <h4>Sorteio Ao Vivo</h4>
            </div>
            <div class="panel-body sorteio">
                <p class="iniciar-sorteio">
                    <button class="btn btn-primary">Iniciar o Sorteio</button>
                </p>
                <p class="sorteio-em-progresso">
                    <span class="fa fa-spinner fa-spin fa-fw"></span>
                    <span>Sorteando próxima dezena</span>
                </p>
                <p class="dezena-sorteada">
                    <span>Dezena sorteada:</span>
                    <span class="numero">12</span>
                </p>
                <p class="vencedor">
                    E o vencedor é <b><span class="nome"></span></b> com <b><span class="acertos"></span></b> acertos.
                    <a href="/">Voltar</a>
                </p>
            </div>
            <ul class="list-group">
                <li class="list-group-item list-group-item-info">
                    Dezenas Sorteadas
                </li>
                <li class='list-group-item'>
                    <p style="max-width:240px;margin:auto">
                        <?php foreach($dezenas as $numero){ ?>
                            <button type="button" class='numero' data-numero="<?=$numero?>"><?=format($numero)?></button>
                        <?php } ?>
                    </p>
                </li>
            </ul>
        </div>
        <script src="/assets/scripts/jquery.js"></script>
        <script>
            $(document).ready(function(){

                var sorteio = {
                    proximo: 0,
                    ultimo: 0,
                    dezenas: <?=json_encode($sorteio)?>,
                    vencedor: <?=json_encode($vencedor)?>,
                    iniciar: function(){
                        sorteio.ultimo = sorteio.dezenas.length - 1;
                        sorteio.proximaDezena();
                    },
                    proximaDezena: function(){
                        $(".sorteio .sorteio-em-progresso").show();
                        $(".sorteio .dezena-sorteada").hide();
                        if(sorteio.proximo<=sorteio.ultimo) {
                            setTimeout(function () {
                                sorteio.mostrarDezena(sorteio.dezenas[sorteio.proximo]);
                                sorteio.proximo++;
                            }, 1000);
                        } else {
                            sorteio.finalizarSorteio();
                        }
                    },
                    mostrarDezena: function(dezena){
                        $(".sorteio .sorteio-em-progresso").hide();
                        $(".sorteio .dezena-sorteada").show().find(".numero").text((""+dezena).padStart(2,'0'));
                        setTimeout(function(){
                            $("button[data-numero="+dezena+"]").addClass("active");
                            sorteio.proximaDezena();
                        },2000);
                    },
                    finalizarSorteio: function(){
                        $(".sorteio .sorteio-em-progresso").hide();
                        $(".sorteio .vencedor").find("span.nome").text(sorteio.vencedor.nome);
                        $(".sorteio .vencedor").find("span.acertos").text(sorteio.vencedor.acertos);
                        $(".sorteio .vencedor").show();
                    }
                };

                $(".sorteio p").hide();
                $(".sorteio .iniciar-sorteio").click(function(){
                    $(this).hide();
                    sorteio.iniciar();
                }).show();

            });
        </script>
    </body>
</html>