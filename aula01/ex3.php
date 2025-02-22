<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 3</title>
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
        $porcentagem = 5;
        $porcentagem2 = 50;
        $resultado1 = $valor * ($porcentagem / 100);
        $resultado2 = $valor * ($porcentagem2 / 100);

        echo "<p>O primeiro resultado é $resultado1 <br> O segundo resultado é $resultado2</p>";
    }
    ?>

</body>
</html>