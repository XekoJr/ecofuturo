<?php
include_once '../utils/DBWrapper.php';
include_once '../models/user.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $username = $_POST['username'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $user = new User();
    $user->register($username, $email, $senha);

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>EcoFuturo - Criar Conta</title>
    <link rel="stylesheet" href="../assets/css/registo.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="login-container">
    <div class="login-form">
        <h2>Criar Conta</h2>
        <form action="" method="POST" id="register-form">
            <div class="form-group">
                <label for="username">Nome de Utilizador</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <span id="email-status"></span>
            </div>
            <div class="form-group">
                <label for="senha">Password</label>
                <input type="password" id="senha" name="senha" required>
                <span id="senha-status"></span>
            </div>
            <button type="submit" id="submit-btn">Registo</button>
        </form>
        <div class="extra-links">
            <a href="login.php">Já tenho conta!</a>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $("#email").on("keyup", function () {
        let email = $(this).val();
        let emailStatus = $("#email-status");

        if (email.length > 0) {
            $.ajax({
                url: "verificar_email.php",
                type: "POST",
                data: { email: email },
                success: function (response) {
                    let data = JSON.parse(response);
                    if (data.exists) {
                        emailStatus.text("Email já está registado").css("color", "red");
                        $("#submit-btn").prop("disabled", true); // Desativa o botão de envio
                    } else {
                        emailStatus.text("Email disponível").css("color", "green");
                        $("#submit-btn").prop("disabled", false); // Ativa o botão de envio
                    }
                },
                error: function () {
                    emailStatus.text("Erro ao verificar email").css("color", "red");
                }
            });
        } else {
            emailStatus.text("");
        }
    });
    // Validação de senha em tempo real
    $("#senha").on("keyup", function () {
        let senha = $(this).val();
        let senhaStatus = $("#senha-status");

        if (senha.length < 6) {
            senhaStatus.text("A senha deve ter pelo menos 6 caracteres").css("color", "red");
            $("#submit-btn").prop("disabled", true);
        } else {
            senhaStatus.text("Senha válida").css("color", "green");
            $("#submit-btn").prop("disabled", false);
        }
    });
});
</script>


</body>
</html>
