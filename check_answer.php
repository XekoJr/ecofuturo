<?php
require_once 'games/Quizz.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$questionId = $data['questionId'];
$selectedOption = $data['selected'];

$quiz = new Quiz();

try {
    $isCorrect = $quiz->checkAnswer($questionId, $selectedOption);
    
    if ($isCorrect) {
        // Atualizar a pontuação: 5 pontos por resposta correta
        $score = $quiz->updateScore(5);
    } else {
        $score = $_SESSION['score']; // Pontuação permanece a mesma
    }

    echo json_encode(['correct' => $isCorrect, 'score' => $score]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
