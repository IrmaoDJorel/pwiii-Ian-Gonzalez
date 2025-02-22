<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 2</title>
</head>
<body>

    <form method="POST">
        <label>Valor:</label>
        <input type="number" name="valor" required>

        <br><br>

        <input type="submit" value="Calcular">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valor = $_POST["valor"];
        $porcentagem = 15;
        $resultado = $valor * ($porcentagem / 100);

        echo "<p>O resultado é $resultado</p>";
    }
    ?>

</body>
</html>
