<?php
    $path = "Imagens_importação_condominio/renomeadas/";
    $diretorio = dir($path);
     
    echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";
    $contador = 0;
    while($arquivo = $diretorio -> read()){
        if((!preg_match("/.jpg/", $arquivo)) && (!preg_match("/.JPG/", $arquivo))){

            rename($path.$arquivo, $path.$arquivo . ".jpg");
            //echo "<a href='".$path.$arquivo."'>".$arquivo."</a><br />";
            echo "<br>";
            var_dump($arquivo);
            $contador++;
            var_dump($contador);
            echo "<br>";
        }
    }
    $diretorio -> close();
?>