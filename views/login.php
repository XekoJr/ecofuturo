<?php
session_start(); // Inicia a sessão

include_once '../utils/DBWrapper.php';
include_once '../models/user.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Cria um objeto User e verifica o login
    $user = new User();
    $loggedInUser = $user->login($email, $senha);

    if ($loggedInUser) {
        // Armazena os dados do usuário na sessão
        $_SESSION['utilizador_id'] = $loggedInUser['U_ID'];
        $_SESSION['username'] = $loggedInUser['U_USERNAME'];

        // Redireciona para a página inicial
        header("Location: ../index.php");
        exit();
    } else {
        // Caso falhe o login
        $erro = "Email ou senha incorretos!";
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
            <?php if (isset($erro)) { echo "<p style='color: red;'>$erro</p>"; } ?>
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
