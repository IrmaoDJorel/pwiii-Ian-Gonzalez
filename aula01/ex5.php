<?php
    $altura = 1.90;
    $peso = 85;

    $imc = $peso / ($altura ** 2);
    echo "O valor do IMC é $imc</p>";

    switch ($imc) {
        case $imc < 18.5:
            echo "Abaixo do peso";
            break;
        case $imc >= 18.5 && $imc <= 24.9:
            echo "Peso normal";
            break;
        case $imc >= 25.0 && $imc <= 29.9;
            echo "Sobrepeso";
            break;
        case $imc >= 30.0 && $imc <= 34.9;
            echo "Obesidade grau I";
            break;
        case $imc >= 35.0 && $imc <= 39.9;
            echo "Obesidade grau II";
            break;
        case $imc >= 40.0;
            echo "Obesidade grau III";
            break;
        
    }