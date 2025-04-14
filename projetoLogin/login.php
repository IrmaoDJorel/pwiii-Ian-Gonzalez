<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include 'conexao.php';

    $login = trim($_POST['login']);
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE login = ? AND ativo = 1");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario'] = $usuario;
        
        echo '<script>alert("Login efetuado com sucesso!");</script>';
        
        echo '<script>
                setTimeout(function() {
                    window.location.href = "painel.php";
                }, 100);
              </script>';
        exit();
    } else {
        $erro = "Login ou senha inválidos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
    <h2>Login</h2>
    <form method="post">
        <label for="login">Usuário ou E-mail:</label>
        <input type="text" id="login" name="login" required>
        
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        
        <button type="submit">Entrar</button>
    </form>
    
    <?php if (!empty($erro)): ?>
        <p class="error"><?php echo htmlspecialchars($erro); ?></p>
    <?php endif; ?>
    
    <div style="margin-top: 20px;">
        <a href="cadastro.php">Novo Cadastro</a> | 
        <a href="recuperar.php">Esqueci minha senha</a>
    </div>
</body>
</html>