<?php
$host = "localhost";
$dbname = "sistema_login";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$table_check = $conn->query("SHOW TABLES LIKE 'usuarios'");
if ($table_check->num_rows == 0) {
    $create_table = $conn->query("
        CREATE TABLE `usuarios` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `nome` VARCHAR(40) NOT NULL,
            `login` VARCHAR(40) NOT NULL UNIQUE,
            `senha` VARCHAR(255) NOT NULL,
            `email` VARCHAR(40) NOT NULL UNIQUE,
            `data_cad` DATE NOT NULL,
            `ativo` BOOLEAN DEFAULT TRUE,
            `nivel` INT NOT NULL CHECK (`nivel` BETWEEN 0 AND 3)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");
    
    if (!$create_table) {
        die("Erro ao criar tabela: " . $conn->error);
    }
    
    // Inserção correta do usuário admin
    $senhaHash = password_hash('admin123', PASSWORD_DEFAULT);
    $conn->query("INSERT INTO usuarios 
                 (nome, login, senha, email, data_cad, ativo, nivel) 
                 VALUES 
                 ('Administrador', 'admin', '$senhaHash', 'admin@example.com', CURDATE(), 1, 0)");
}
?>