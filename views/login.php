<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

include_once '../utils/DBWrapper.php';
include_once '../models/user.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($email === '' || $senha === '') {
        $erro = "Preenche o email e a password.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Formato de email inválido.";
    } else {
    // Cria um objeto User e verifica o login
    $user = new User();
    $loggedInUser = $user->login($email, $senha);

    if ($loggedInUser) {
        // Guarda o utilizador na sessão
        $_SESSION['user'] = $loggedInUser;

        // Set user cookie
        setcookie('user', json_encode($loggedInUser), time() + 3600, "/");

        // Redireciona para a página inicial
        header("Location: ../index.php");
        exit();
    } else {
        // Caso falhe o login
        $erro = "Email ou senha incorretos!";
    }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>EcoFuturo - Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Login</h2>
            <?php if (isset($erro)): ?>
                <p class="erro"><?= htmlspecialchars($erro) ?></p>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="senha">Password</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <button type="submit">Login</button>
            </form>
            <div class="extra-links">
                <a href="registo.php">Criar Conta</a>
            </div>
        </div>
    </div>
</body>
</html>
