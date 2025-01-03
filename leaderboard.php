<?php
require_once './utils/DBWrapper.php';
require_once './games/UserGame.php';
require_once './repositories/ManageUsers.php';
require_once './games/Game.php';

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
$gameId = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($gameId) {
    // Create an instance of Workshop
    $userGames = new UserGame();
    $manageUsers = new ManageUsers();
    $game = new Game();

    // Fetch workshop details if ID is provided
    $leaderboard = $userGames->getUserGamesByGameIdOrderedByPoints($gameId);
} else {
    // Redirect to games page if no ID is provided
    header("Location: ./games.php");
    exit();
}

?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Elements - Spectral by HTML5 UP</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
</head>

<body id="validate-page" class="is-preload">

    <!-- Page Wrapper -->
    <div id="page-wrapper">

        <!-- Header -->
        <?php include './layouts/header.php'; ?>

        <!-- Main -->
        <section class="wrapper style5">
            <div class="inner">
                <header>
                    <h2><?php echo htmlspecialchars($game->getGameNameById($gameId)); ?></h2>
                </header>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 20%;">Rank</th>
                            <th style="width: 60%;">Username</th>
                            <th style="width: 20%;">Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($leaderboard as $index => $userGame): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $manageUsers->getUsernameById($userGame['U_ID']) ?></td>
                                <td><?php echo htmlspecialchars($userGame['UG_POINTS']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Footer -->
        <?php include './layouts/footer.php'; ?>

    </div>

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