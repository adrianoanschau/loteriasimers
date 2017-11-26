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
                </div>
                <div class="panel-body">
                    <p>
                        A Loteria Simers lhe oferece a chance de ganhar 1 MILHÃO DE REAIS agora.
                    </p>
                    <p>
                        Participe! A cada 5 apostadores um sorteio será realizado.
                    </p>
                    <?php if($falta>0){ ?>
                        <p>
                            <a href="/inscricao" class="btn btn-primary">Clique aqui para se inscrever</a>
                        </p>
                        <p>
                            Falta(m) <b><?=$falta?></b> inscrição(ões) para o próximo sorteio ser realizado.
                        </p>
                    <?php } else { ?>
                        <p>
                            O próximo sorteio está prestes a começar.
                        </p>
                        <p>
                            <a href="/sorteio" class="btn btn-primary">Clique aqui para ver o sorteio ao vivo</a>
                        </p>
                    <?php } ?>
                </div>
                <?php if(count($inscritos)>0){?>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info">Inscritos para o próximo sorteio</li>
                    <?php foreach($inscritos as $inscrito){ ?>
                    <li class='list-group-item'><?=$inscrito['nome']?>, de <?=$inscrito['idade']?> anos.</li>
                    <?php } ?>
                </ul>
                <?php } ?>
                <?php if($ultimosorteio){ ?>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info">Último sorteio</li>
                        <li class='list-group-item'>
                        <?php foreach($ultimosorteio['dezenas'] as $numero){ ?>
                            <span class='numero'><?=format($numero)?></span>
                        <?php } ?>
                            <span>Vencedor: <?=$ultimosorteio['vencedor']['nome']?>, de <?=$ultimosorteio['vencedor']['idade']?> anos.</span>
                        </li>
                </ul>
                <?php } ?>
                <?php if($sorteiosAnteriores) { ?>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info">Sorteios Anteriores</li>
                    <?php foreach($sorteiosAnteriores as $sorteio){ ?>
                        <li class='list-group-item'>
                        <?php foreach($sorteio['dezenas'] as $numero){ ?>
                            <span class='numero'><?=format($numero)?></span>
                        <?php } ?>
                            <span>Vencedor: <?=$sorteio['vencedor']['nome']?>, de <?=$sorteio['vencedor']['idade']?> anos.</span>
                        </li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </div>
    </body>
</html>