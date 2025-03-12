<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumo de Combustível</title>
</head>
<body>

    <form method="POST">
        <label>Distância percorrida (km):</label>
        <input type="number" step="0.01" name="km" required>

        <br><br>

        <label>Combustível consumido (litros):</label>
        <input type="number" step="0.01" name="litros" required>

        <br><br>

        <input type="submit" value="Calcular Consumo">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $km = floatval($_POST["km"]);
        $litros = floatval($_POST["litros"]);

        if ($litros > 0) {
            $consumo = $km / $litros;
            echo "<p>O consumo médio do veículo é: $consumo km/l</p>";
        } else {
            echo "<p>Erro: O valor de litros deve ser maior que zero.</p>";
        }
    }
    ?>

</body>
</html>
