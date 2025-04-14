<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include 'conexao.php';

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $login = $email;
    $senha = $_POST['senha'];
    $nivel = intval($_POST['nivel']);

    // Verifica senha segura
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $senha)) {
        $erro = "Senha fraca. Use 8+ caracteres com maiúscula, minúscula, número e símbolo.";
    } else {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $data = date('Y-m-d');

        try {
            $stmt = $conn->prepare("INSERT INTO usuarios (nome, login, senha, email, data_cad, ativo, nivel) VALUES (?, ?, ?, ?, ?, 1, ?)");
            $stmt->bind_param("sssssi", $nome, $login, $senhaHash, $email, $data, $nivel);

            if ($stmt->execute()) {
                $sucesso = "Usuário cadastrado com sucesso! <a href='login.php'>Fazer login</a>";
            }
        } catch (mysqli_sql_exception $e) {
            $erro = ($e->getCode() == 1062) 
                  ? "Erro: Este e-mail já está cadastrado." 
                  : "Erro ao cadastrar: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 400px; 
            margin: 0 auto; 
            padding: 20px;
            background-color: #f5f5f5;
        }
        form { 
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex; 
            flex-direction: column; 
            gap: 15px; 
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            color: #555;
        }
        input { 
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        button { 
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        .error { 
            color: #d32f2f;
            background-color: #ffebee;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .links {
            text-align: center;
            margin-top: 20px;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Cadastro de Novo Usuário</h2>
    
    <?php if (!empty($erro)): ?>
        <p class="error"><?php echo $erro; ?></p>
    <?php endif; ?>
    
    <?php if (!empty($sucesso)): ?>
        <p class="success"><?php echo $sucesso; ?></p>
    <?php endif; ?>
    
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <small>Deve conter 8+ caracteres, maiúsculas, minúsculas, números e símbolos</small>
        
        <label for="nivel">Nível:</label>
        <select id="nivel" name="nivel">
            <option value="0">0 - Admin</option>
            <option value="1">1 - Moderador</option>
            <option value="2">2 - Usuário Avançado</option>
            <option value="3" selected>3 - Comum</option>
        </select>
        
        <button type="submit">Cadastrar</button>
    </form>
    
    <div style="margin-top: 20px;">
        <a href="login.php">Voltar para login</a>
    </div>
</body>
</html>