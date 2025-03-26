<?php
if (!file_exists('funcoes.php')) {
    die("Arquivo funcoes.php não encontrado!");
}

include("config.php");
include("funcoes.php");

// Verifica se as funções existem
if (!function_exists('criarTabelaVeiculos')) {
    die("Função criarTabelaVeiculos não encontrada!");
}


criarTabelaVeiculos($pdo);

// Processa o formulário se enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cadastrar'])) {
        cadastrarVeiculo($pdo, $_POST);
    } elseif (isset($_POST['editar'])) {
        editarVeiculo($pdo, $_POST);
    } elseif (isset($_GET['excluir'])) {
        excluirVeiculo($pdo, $_GET['excluir']);
    }
}

// Obtém a lista de veículos
$veiculos = listarVeiculos($pdo);

// Se estiver editando, obtém os dados do veículo
$veiculoEdicao = null;
if (isset($_GET['editar'])) {
    $veiculoEdicao = obterVeiculo($pdo, $_GET['editar']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Veículos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 20px; }
        .form-group { margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>Cadastro de Veículos</h1>
    
    <form method="POST">
        <?php if ($veiculoEdicao): ?>
            <input type="hidden" name="id" value="<?= $veiculoEdicao['id'] ?>">
        <?php endif; ?>
        
        <div class="form-group">
            <label>Marca:</label>
            <input type="text" name="marca" required 
                   value="<?= $veiculoEdicao ? $veiculoEdicao['marca'] : '' ?>">
        </div>
        
        <div class="form-group">
            <label>Modelo:</label>
            <input type="text" name="modelo" required 
                   value="<?= $veiculoEdicao ? $veiculoEdicao['modelo'] : '' ?>">
        </div>
        
        <div class="form-group">
            <label>Ano:</label>
            <input type="number" name="ano" required 
                   value="<?= $veiculoEdicao ? $veiculoEdicao['ano'] : '' ?>">
        </div>
        
        <div class="form-group">
            <label>Placa:</label>
            <input type="text" name="placa" required 
                   value="<?= $veiculoEdicao ? $veiculoEdicao['placa'] : '' ?>">
        </div>
        
        <div class="form-group">
            <?php if ($veiculoEdicao): ?>
                <button type="submit" name="editar">Atualizar Veículo</button>
                <a href="index.php">Cancelar</a>
            <?php else: ?>
                <button type="submit" name="cadastrar">Cadastrar Veículo</button>
            <?php endif; ?>
        </div>
    </form>
    
    <h2>Veículos Cadastrados</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Ano</th>
                <th>Placa</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($veiculos as $veiculo): ?>
                <tr>
                    <td><?= $veiculo['id'] ?></td>
                    <td><?= $veiculo['marca'] ?></td>
                    <td><?= $veiculo['modelo'] ?></td>
                    <td><?= $veiculo['ano'] ?></td>
                    <td><?= $veiculo['placa'] ?></td>
                    <td>
                        <a href="index.php?editar=<?= $veiculo['id'] ?>">Editar</a>
                        <a href="index.php?excluir=<?= $veiculo['id'] ?>" 
                            onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>