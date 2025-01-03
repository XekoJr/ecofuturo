<?php

require_once './utils/DBWrapper.php';

class Quiz
{
    private $db;

    public function __construct()
    {
        $this->db = new DBWrapper(); // Conexão com a base de dados
    }

    // Método para carregar todas as perguntas do banco de dados
    public function getQuestions()
    {
        try {
            $sql = "SELECT Q_ID, Q_QUESTION, Q_OP_A, Q_OP_B, Q_OP_C, Q_OP_D, Q_CORRECT FROM question";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todas as perguntas como array
        } catch (Exception $e) {
            throw new Exception("Erro ao carregar perguntas: " . $e->getMessage());
        }
    }

    // Método para verificar a resposta correta
    public function checkAnswer($questionId, $selectedOption)
    {
        try {
            $sql = "SELECT Q_CORRECT FROM question WHERE Q_ID = ?";
            $stmt = $this->db->query($sql, [$questionId]);
            $question = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$question) {
                throw new Exception("Pergunta não encontrada.");
            }

            return $question['Q_CORRECT'] === $selectedOption; // Retorna true se correto
        } catch (Exception $e) {
            throw new Exception("Erro ao verificar a resposta: " . $e->getMessage());
        }
    }

    public function updateScore($points)
    {
        // Adiciona os pontos à sessão
        if (!isset($_SESSION['score'])) {
            $_SESSION['score'] = 0;
        }
        $_SESSION['score'] += $points;
        return $_SESSION['score'];
    }

    public function saveScore($userId, $gameId, $points)
    {
        try {
            // Inserir nova pontuação
            $sql = "INSERT INTO usergame (U_ID, G_ID, UG_POINTS) VALUES (?, ?, ?)";
            $this->db->query($sql, [$userId, $gameId, $points]);
        } catch (Exception $e) {
            throw new Exception("Erro ao salvar pontuação: " . $e->getMessage());
        }
    }
}
