<?php
session_start();
include 'conexao.php';

$erro = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $erro = "Por favor, informe seu e-mail cadastrado.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Formato de e-mail inválido.";
    } else {
        try {
            $stmt = $conn->prepare("SELECT senha FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($usuario = $result->fetch_assoc()) {
                echo "<script>alert('Sua senha é: " . htmlspecialchars($usuario['senha'], ENT_QUOTES) . "');</script>";
            } else {
                $erro = "E-mail não encontrado em nosso sistema.";
            }
        } catch (Exception $e) {
            $erro = "Ocorreu um erro ao processar sua solicitação.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha</title>
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
    <h2>Recuperar Senha</h2>
    
    <?php if (!empty($erro)): ?>
        <div class="error"><?php echo htmlspecialchars($erro); ?></div>
    <?php endif; ?>
    
    <form method="post">
        <label for="email">Digite seu e-mail cadastrado:</label>
        <input type="email" id="email" name="email" required>
        
        <button type="submit">Recuperar Senha</button>
    </form>
    
    <div class="links">
        <a href="login.php">Voltar para o login</a>
    </div>
</body>
</html>