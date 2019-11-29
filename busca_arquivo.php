<?php
/////////////////////////////////////// ****************************** ///////////////////////////////////////////////
// este script deve ser rodado apos a rotina de importação de imaens para conferir se todas as imagens foram baixadas
// Setar os paramentros relevantes
/////////////////////////////////////// ****************************** ///////////////////////////////////////////////
$path = "Imagens_importação_condominio/Renomeadas/";
$diretorio = dir($path);

$string = file_get_contents('NovoEnderecoImagens.txt'); // pega o conteudo do arquivo 
$arrayItem = array_filter(explode("\n", $string)); //  lista de endereços como array baseado na quebra de linha do arquivo txt

$arrayitemBaseName = [];

foreach ($arrayItem as $nomeBaseName) {
    
    $nomeBaseNameAux = explode(".", trim(strtolower(basename($nomeBaseName))));

    //array_push($arrayitemBaseName, preg_replace("/\r|\n/", "", trim(strtolower(basename($nomeBaseNameAux[0])))));
    array_push($arrayitemBaseName, $nomeBaseNameAux[0]);
}

$arrayNomeArquivosNaPasta = []; //lista de endereços na pasta

while ($arquivo = strtolower($diretorio->read())) {
    if(is_file($arquivo)){
    $arquivo2 = explode(".", $arquivo);
    array_push($arrayNomeArquivosNaPasta, $arquivo2[0]);
    }
}

$result = array_diff($arrayNomeArquivosNaPasta, $arrayitemBaseName); //  comparação entre os 2 arrays
echo "Result: ";
print("<pre>");
print_r($result); // o resultado são os itens que não aparecem em ambos os arrays
print("</pre>");

$diretorio->close();