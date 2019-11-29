<?php

ini_set('max_execution_time', -1);
/////////////////////////////////////////////////////////////
//produz o array com o nome dos arquivos a serem baixados
$string = file_get_contents('importaçãoTLX-B.txt');
$arrayItem = array_filter(explode("\n", $string));
/////////////////////////////////////////////////////////////


echo "INICIADO";
echo "<br>";

$contador = 0;
$contadorErro = 0;

foreach ($arrayItem as $item) {
    $url = "http://cdn.vistahost.com.br/tlxconsu18445/vista.imobi/fotos/" . trim($item);

    $nome = basename($url); // extrai o nome do arquivo

    $path_parts = pathinfo($url);

    $axlImovel = $path_parts['dirname'];

    $axlImovel = explode("/", $axlImovel);
    $axlImovel = array_reverse($axlImovel);

    $criarDiretorio = getcwd() . "/" . $axlImovel[0];

    //var_dump( getcwd()."/".$axlImovel[0]);
    echo "<br>";

    if (!is_dir($criarDiretorio)) {
        //echo "diretorio NÃO existe";
        mkdir($axlImovel[0], 0777, true);
        chdir($axlImovel[0]);
    } else {
        //echo "diretorio existe";
        chdir($axlImovel[0]);
    }

    $img = $axlImovel[0] . "-" . $nome;

    if (!file_put_contents($img, file_get_contents($url))) {
        echo "o Arquivo <b>$nome</b>, não pôde ser baixado<br>";
        echo "Quantidade de ERROS" . $contadorErro;
        echo "<br>";
        $contadorErro++;
        $contador--;
    }

    chdir("../");

    echo "Quantidade de fotos baixadas" . $contador;
    echo "<br>";
    $contador++;
}


echo "<br>";
echo "terminado";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <h1>Baixando arquivo</h1>
    <?php
    echo "Quantidade total de fotos baixadas" . $contador;
    echo "<br>";
    echo "Quantidade total de erros no download" . $contadorErro;
    echo "<br>";
    ?>
    </div>

</body>
<script>
</script>

</html>