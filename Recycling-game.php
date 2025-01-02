<?php
require_once './games/Recycling.php';

// Check if the user is logged in
/*
if (isset($_COOKIE['user'])) {
    $currentUser = json_decode($_COOKIE['user'], true);
} else {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}
*/

if (isset($_GET['score'])) {
    $score = intval($_GET['score']);
    /*
    $userGame = new UserGame();
    $userGame->insertUserGame($currentUser['U_ID'], 2, $score);
    */

}

$recycling = new Recycling();
$objectsHTML = $recycling->generateObjectsHTML();
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycling Game</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body class="is-preload">

    <!-- Page Wrapper -->
    <div id="page-wrapper">

        <!-- Return Button -->
        <a href="index.php" id="return-button"><img src="./assets/images/icons8-arrow-64.png" alt=""></a>

        <!-- Points Display -->
        <div id="points-display"><h3>0</h3><img src="./assets/images/icons8-points-50.png" alt="Pontos"></div>

        <!-- Main -->
        <div>
            <h1 id="answer"></h1>
            <div class="game-container">

                <!-- Objects -->
                <?php echo $objectsHTML; ?>

                <div class="containers">
                    <div class="container" data-type="glass"><img src="./assets/images/green.png" alt="Green Bin"></div>
                    <div class="container" data-type="paper"><img src="./assets/images/paper.png" alt="Blue Bin"></div>
                    <div class="container" data-type="plastic"><img src="./assets/images/yellow.png" alt="Yellow Bin"></div>
                    <div class="container" data-type="batteries"><img src="./assets/images/battery.png" alt="Orange Bin"></div>
                    <div class="container" data-type="others"><img src="./assets/images/other.png" alt="Black Bin"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrollex.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>

</body>
</html>