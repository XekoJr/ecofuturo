<?php

require_once './repositories/ManageUsers.php';
require_once './games/Game.php';
require_once './games/UserGame.php';
require_once './repositories/UserWorkshop.php';
require_once './repositories/Workshop.php';

session_start();
// Check if the user is logged in
if (isset($_COOKIE['user'])) {
    $currentUser = json_decode($_COOKIE['user'], true);
} else {
    // Redirect to login page if not logged in
    header("Location: ./views/login.php");
    exit();
}

// Initialize variables
$manageUsers = new ManageUsers();
$game = new Game();
$userGame = new UserGame();
$workshop = new Workshop();
$userWorkshop = new UserWorkshop();

// Get the maximum points by user ID
$maxPoints = $userGame->getMaxPointsByUserId($currentUser['U_ID']);

// Workshops the user has showed up
$workshopsAttended = $userWorkshop->getUserWorkshopsByShowed($currentUser['U_ID'], 1);

// Workshops sign in by user that are still open
$workshopsSignedIn = $userWorkshop->getUserWorkshopsByShowed($currentUser['U_ID'], 0);

// Initialize the best positions array
$bestPositions = [];

// Get the best position of the user in every game
$games = $game->getAllGames(); // Assuming this method exists to get all games

foreach ($games as $gameEntry) {
    $gameId = $gameEntry['G_ID'];
    $userGames = $userGame->getUserGamesByGameIdOrderedByPoints($gameId);
    foreach ($userGames as $index => $userGameEntry) {
        if ($userGameEntry['U_ID'] == $currentUser['U_ID']) {
            $bestPositions[$gameId] = $index + 1; // Position is index + 1
            break;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
    <title>Perfil</title>
</head>

<body class="is-preload">

    <!-- Page Wrapper -->
    <div class="container" id="profile-page">

        <?php include './layouts/header.php'; ?>

        <!-- Main -->
        <article id="main">
            <header>
                <div id="first-section" class="col-12">
                    <h2 class="col-12"><?php echo htmlspecialchars($currentUser['U_USERNAME']); ?></h2>
                    <div id="profile-points">
                        <h2><?php echo htmlspecialchars($currentUser['U_POINTS']); ?></h2>
                        <img src="./assets/images/icons8-points-50.png" alt="">
                    </div>
                </div>
                <div id="second-section" class="col-12">
                    <h4 class="col-12"><?php echo htmlspecialchars($currentUser['U_EMAIL']); ?></h4>
                </div>
                <a href="./edit-profile.php" style="border-bottom: none;"><i class="fas fa-pencil-alt" style="color: #ffffff;"></i></a>
            </header>
            <section>
                <div id="badge-section">
                    <?php
                    foreach ($maxPoints as $points) {
                        if ($points['G_ID'] == 1 && $points['max_points'] == 65) {
                            echo '<div class="badge">';
                            echo '<i class="fas fa-medal fa-3x" style="color: #FFD700"></i>';
                            echo '<span>Acertou TODAS</span>';
                            echo '</div>';
                        }
                    }
                    ?>
                    <?php if (count($workshopsAttended) >= 10): ?>
                        <div class="badge">
                            <i class="fas fa-medal fa-3x" style="color: #FFD700"></i>
                            <span>Participou em 10 Eventos</span>
                        </div>
                    <?php endif; ?>
                    <?php
                    foreach ($maxPoints as $points) {
                        if ($points['G_ID'] == 2 && $points['max_points'] > 1200) {
                            echo '<div class="badge">';
                            echo '<i class="fas fa-medal fa-3x" style="color: #FFD700"></i>';
                            echo '<span>Reciclador Profissional</span>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>

                <div id="main-box" class="profile-details col-12">
                    <div class="box">
                        <div class="mini-box">
                            <h3>Melhores resultados</h3>
                            <div>
                                <?php foreach ($maxPoints as $points): ?>
                                    <div><?php echo htmlspecialchars($game->getGameNameById($points['G_ID'])); ?>: <?php echo htmlspecialchars($points['max_points']); ?> pontos</div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="mini-box">
                            <h3>Melhores Ranks</h3>
                            <div>
                                <?php foreach ($bestPositions as $gameId => $position): ?>
                                    <div><?php echo htmlspecialchars($game->getGameNameById($gameId)); ?>: Rank <?php echo htmlspecialchars($position); ?></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="box col-12">
                        <div class="mini-box box-auto">
                            <h3>Eventos que participou</h3>
                            <div class="workshops-attended">
                                <?php foreach ($workshopsAttended as $workshopAttended) : ?>
                                    <div>
                                        <?php
                                        $workshopDetails = $workshop->getWorkshopById($workshopAttended['W_ID']);
                                        echo htmlspecialchars($workshopDetails['W_TITLE']);
                                        ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="mini-box box-auto">
                            <h3>Eventos Inscritos</h3>
                            <div>
                                <?php foreach ($workshopsSignedIn as $workshopSignedIn): ?>
                                    <div><?php echo htmlspecialchars($workshop->getWorkshopTitleById($workshopSignedIn['W_ID'])); ?></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </article>

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