<?php

session_start();

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogos</title>
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
    <link rel="stylesheet" href="./assets/css/games.css">
</head>

<body id="games-page" class="is-preload">

    <div id="page-wrapper" class="container">

        <!-- Header -->
        <?php include './layouts/header.php'; ?>

        <!-- First Game -->
        <div class="panel">
            <div class="panel-image">
                <img src="./assets/images/quizz-panel.png" alt="Quizz">
            </div>
            <div class="panel-text">
                <h3>Testa o teu Conhecimento! <a style="border-bottom: none;" href="./leaderboard.php?id=1"><i class="fas fa-trophy" style="color: #FFD700;"></i></a> </h3>
                <p class="description">Descobre como podes ajudar o meio ambiente de forma divertida.
                    Este quizz é perfeito para aprenderes sustentabilidade
                    e práticas ecológicas.</p>
                <a class="button" href="./quizz-game.php">Jogar</a>
            </div>
        </div>
        <!-- Second Game -->
        <div class="panel">
            <div class="panel-image">
                <img src="./assets/images/recycling-panel.png" alt="Jogo de reciclagem">
            </div>
            <div class="panel-text">
                <h3><a style="border-bottom: none;" href="./leaderboard.php?id=1"><i class="fas fa-trophy" style="color: #FFD700;"></i></a> Sabes Reciclar?</h3>
                <p class="description">Aprende a separar o lixo corretamente e ajuda a salvar o planeta!
                    Este jogo vai ensinar-te a importância da reciclagem e como podes
                    contribuir para um ambiente mais limpo e sustentável.</p>
                <a class="button" href="./recycling-game.php">Jogar</a>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <?php include './layouts/footer.php'; ?>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrollex.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>