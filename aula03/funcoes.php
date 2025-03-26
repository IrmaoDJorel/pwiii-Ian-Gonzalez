<?php
function criarTabelaVeiculos($pdo) {
    $sql = "CREATE TABLE IF NOT EXISTS veiculos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        marca VARCHAR(50) NOT NULL,
        modelo VARCHAR(50) NOT NULL,
        ano INT NOT NULL,
        placa VARCHAR(10) NOT NULL UNIQUE
    )";
    
    try {
        $pdo->exec($sql);
    } catch (PDOException $e) {
        die("Erro ao criar tabela: " . $e->getMessage());
    }
}

function cadastrarVeiculo($pdo, $dados) {
    $sql = "INSERT INTO veiculos (marca, modelo, ano, placa) VALUES (:marca, :modelo, :ano, :placa)";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([
            ':marca' => $dados['marca'],
            ':modelo' => $dados['modelo'],
            ':ano' => $dados['ano'],
            ':placa' => $dados['placa']
        ]);
        header("Location: index.php");
    } catch (PDOException $e) {
        die("Erro ao cadastrar veículo: " . $e->getMessage());
    }
}

function listarVeiculos($pdo) {
    $sql = "SELECT * FROM veiculos ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obterVeiculo($pdo, $id) {
    $sql = "SELECT * FROM veiculos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editarVeiculo($pdo, $dados) {
    $sql = "UPDATE veiculos SET marca = :marca, modelo = :modelo, ano = :ano, placa = :placa WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([
            ':id' => $dados['id'],
            ':marca' => $dados['marca'],
            ':modelo' => $dados['modelo'],
            ':ano' => $dados['ano'],
            ':placa' => $dados['placa']
        ]);
        header("Location: index.php");
    } catch (PDOException $e) {
        die("Erro ao atualizar veículo: " . $e->getMessage());
    }
}

function excluirVeiculo($pdo, $id) {
    $sql = "DELETE FROM veiculos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([':id' => $id]);
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Erro ao excluir veículo: " . $e->getMessage());
    }
}