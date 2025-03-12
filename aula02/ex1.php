<?php

function calcularVolume($comprimento, $largura, $altura) {
    $volume = $comprimento * $largura * $altura;
    echo "O volume da caixa é: $volume cm³\n";
}
calcularVolume(10, 5, 2);

?>