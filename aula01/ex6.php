<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 6</title>
</head>
<body>

    <form method="POST">
        <label>Valor do produto:</label>
        <input type="number" name="valor" required>

        <br><br>

        <input type="submit" value="Calcular Desconto">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valor = $_POST["valor"];
        $desconto = $valor * (7 / 100);
        $valorFinal = $valor - $desconto;

        echo "<p>Desconto de 7%: R$ " . number_format($desconto, 2, ',', '.') . "</p>";
        echo "<p>Valor a pagar: R$ " . number_format($valorFinal, 2, ',', '.') . "</p>";
    }
    ?>

</body>
</html>
