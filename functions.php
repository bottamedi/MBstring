<?php 

// Funcoes para trabalhar com 'Multibyte String' sem o mbstring instalado no PHP

function MBstrlen($str = "") {
    /*
     * Nome: Deinar Bottamedi
     * Data: 09/08/2017
     * Faz mesmo que mb_strlen() 
     * Usar quando o mbstring nao estiver disponivel no PHP
     */

    $caracteres = [];
    preg_match_all("/./u", $str, $caracteres);

    $retorno = sizeof($caracteres[0]);

    return $retorno; 
}

function MBsubstr($str = "", $limite_str = 0, $length = NULL) {
    /*
     * Nome: Deinar Bottamedi
     * Data: 09/08/2017
     * Faz mesmo que mb_substr() 
     * Usar quando o mbstring nao estiver disponivel no PHP
     */

    if (!is_numeric($limite_str)) {
        $limite_str = 0;
    }
    if (!is_numeric($length) && $length != NULL) {
        $length = 0;
    }

    $caracteres = [];
    $retorno = "";
    preg_match_all("/./u", $str, $caracteres);

    if ($length == NULL) {
        $length = sizeof($caracteres[0]);
    } else {
        if ($length < 0) {
            $length = sizeof($caracteres[0]) + $length;
        } else {
            $length = $limite_str + $length;
        }
    }

    for ($i = $limite_str; $i < $length; $i++) {
        $retorno .= $caracteres[0][$i];
    }
    return $retorno;
}

// EXEMPLOS DE USO
$frase = "News collects all the stories you want to read - so you no longer need to move from app to app to stay informed.";

echo "<h1>Exemplos:</h1>";
echo "<br/>";
echo "String = ".$frase;
echo "<br/>";
echo "Length = ".MBstrlen($frase);
echo "<br/>";
echo "String(20)  = ".MBsubstr($frase,20); // imprimir a partir da posicao 20
echo "<br/>";
echo "String(0,5)  = ".MBsubstr($frase,0,5); // imprimir os 5 primeiros caracteres
echo "<br/>";
echo "String(0,-7)  = ".MBsubstr($frase,0,-7); // remove os 7 ultimos caracteres
echo "<br/>";
echo "String(14,50)  = ".MBsubstr($frase,14,50); // imprimir 50 caracteres a partir da posicao 10
echo "<br/>";
