<?php

require_once '../utils/DBWrapper.php';

class User {
    public $db;

    public function __construct() {
        $this->db = new DBWrapper(); // Classe Database deve retornar instância PDO
    }

    // Verificar se o email já existe
    public function emailExists($email) {
        $sql = "SELECT * FROM User WHERE U_EMAIL = ?";
        $stmt = $this->db->query($sql, [$email]);
        return $stmt->rowCount() > 0;
    }

    // Registrar novo usuário
    public function register($username, $email, $senha) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Formato de email inválido.");
        }

        if (strlen($senha) < 6) {
            throw new Exception("A senha deve ter pelo menos 6 caracteres.");
        }

        if ($this->emailExists($email)) {
            throw new Exception("Email já registado!");
        }

        $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO User (U_USERNAME, U_EMAIL, U_PASSWORD) VALUES (?, ?, ?)";
            $this->db->query($sql, [$username, $email, $hashedPassword]);
            return "Usuário registrado com sucesso!";
        } catch (Exception $e) {
            throw new Exception("Erro ao registrar utilizador: " . $e->getMessage());
        }
    }

    // Verificar credenciais de login
    public function login($email, $senha) {
        $sql = "SELECT * FROM User WHERE U_EMAIL = ?";
        $stmt = $this->db->query($sql, [$email]);
        $user = $stmt->fetch();
    
        if ($user && password_verify($senha, $user['U_PASSWORD'])) {
            // Iniciando a sessão
            session_start();
    
            return $user; // Login bem-sucedido
        }
    
        return false; // Email ou senha incorretos
    }
    

    // Pegar usuário por ID
    public function getUserById($id) {
        $sql = "SELECT * FROM User WHERE U_ID = ?";
        $stmt = $this->db->query($sql, [$id]);
        return $stmt->fetch();
    }
}
?>
