<?php
session_start();
require_once 'utils/DBWrapper.php';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validações básicas
    if (empty($username) || empty($email)) {
        echo "Por favor, preencha todos os campos obrigatórios.";
        exit;
    }

    // Inicializar o DBWrapper e obter a conexão PDO
    $dbWrapper = new DBWrapper();
    $pdo = $dbWrapper->getDBHandler();

    try {
        // Atualizar o utilizador no banco de dados (sem troca de senha)
        $stmt = $pdo->prepare("UPDATE user SET U_USERNAME = ?, U_EMAIL = ? WHERE U_ID = ?");
        $stmt->execute([$username, $email, $user_id]);

        // Se a senha atual for fornecida, verificar e trocar a senha
        if (!empty($current_password) || !empty($new_password) || !empty($confirm_password)) {
            if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
                echo "Todos os campos de senha devem ser preenchidos.";
                exit;
            }

            // Verificar se a nova senha e a confirmação correspondem
            if ($new_password !== $confirm_password) {
                echo "A nova senha e a confirmação não coincidem.";
                exit;
            }

            // Verificar se a senha atual está correta
            $stmt = $pdo->prepare("SELECT U_PASSWORD FROM user WHERE U_ID = ?");
            $stmt->execute([$user_id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user || !password_verify($current_password, $user['U_PASSWORD'])) {
                echo "A senha atual está incorreta.";
                exit;
            }

            // Atualizar a senha no banco de dados
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("UPDATE user SET U_PASSWORD = ? WHERE U_ID = ?");
            $stmt->execute([$hashed_password, $user_id]);

            echo "Senha atualizada com sucesso!";
        } else {
            echo "Perfil atualizado com sucesso!";
        }
    } catch (PDOException $e) {
        echo "Erro ao atualizar perfil: " . $e->getMessage();
    }
} else {
    header("Location: ./profile.php");
    exit;
}
?>
