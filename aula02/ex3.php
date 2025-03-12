<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcelamento</title>
</head>
<body>

    <form method="POST">
        <label>Valor do produto:</label>
        <input type="number" step="0.01" name="valor" required>

        <br><br>

        <input type="submit" value="Calcular Parcelamento">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valor = floatval($_POST["valor"]);
        $acrescimo = $valor * 0.16;
        $valorTotal = $valor + $acrescimo;
        $parcela = $valorTotal / 10;

        echo "<p>Acréscimo de 16%: R$ " . number_format($acrescimo, 2, ',', '.') . "</p>";
        echo "<p>Valor total: R$ " . number_format($valorTotal, 2, ',', '.') . "</p>";  
        echo "<p>Valor da parcela (10x): R$ " . number_format($parcela, 2, ',', '.') . "</p>";
    }
    ?>

</body>
</html>
