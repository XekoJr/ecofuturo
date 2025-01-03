<?php
session_start();
require_once './utils/DBWrapper.php';
require_once './games/Quizz.php';
require_once './games/UserGame.php';

if (isset($_COOKIE['user'])) {
    $currentUser = json_decode($_COOKIE['user'], true);
}

$userId = $currentUser['U_ID'];
$gameId = 1; // Substituir pelo ID do jogo correspondente, se aplicável
$points = isset($_POST['points']) ? intval($_POST['points']) : 0;

try {
    $userGame = new UserGame();
    $userGame->insertUserGame($userId, $gameId, $points);
    echo json_encode(['success' => true, 'message' => 'Pontuação salva com sucesso']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
