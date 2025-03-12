<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desconto de 27%</title>
</head>
<body>

    <form method="POST">
        <label>Digite um número inteiro:</label>
        <input type="number" name="valor" required>

        <br><br>

        <input type="submit" value="Calcular Desconto">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valor = intval($_POST["valor"]);
        $desconto = intval($valor * 0.27);
        $valorFinal = $valor - $desconto;

        echo "<p>Desconto de 27%: $desconto</p>";
        echo "<p>Valor final: $valorFinal</p>";
    }
    ?>

</body>
</html>
