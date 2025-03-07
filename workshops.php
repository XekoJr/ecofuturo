<?php

require_once './repositories/Workshop.php';
require_once './repositories/UserWorkshop.php';
require_once './repositories/ManageUsers.php';

session_start();
// Check if the user is logged in
if (isset($_COOKIE['user'])) {
    $currentUser = json_decode($_COOKIE['user'], true);
} else {
    // Redirect to login page if not logged in
    header("Location: ./views/login.php");
    exit();
}

$workshop = new Workshop();
$userWorkshop = new UserWorkshop();
$manageUsers = new ManageUsers();

$workshops = $workshop->getWorkshops();

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

<body class="is-preload" id="workshop-page">

    <!-- Page Wrapper -->
    <div id="page-wrapper">

        <!-- Header -->
        <?php include './layouts/header.php'; ?>

        <!-- Main -->
        <article id="main">
            <h2 class="col-12">Eventos</h2>
            <?php if ($currentUser['U_TYPE'] == 'Admin') : ?>
                <div id="admin-actions" class="col-12" style="text-align: center;">
                    <a href="edit-workshop.php" class="button primary"><i class="fas fa-plus"></i></a>
                </div>
            <?php endif; ?>
            <section>
                <div class="row" id="workshop-list">
                    <?php echo $workshop->generateWorkshopsHTML($currentUser, $userWorkshop); ?>
                </div>
            </section>
        </article>

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