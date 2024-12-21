<?php
require_once './utils/DBWrapper.php';
require_once './repositories/Workshop.php';

// Initialize variables
$workshopId = isset($_GET['id']) ? intval($_GET['id']) : null;
$workshopDetails = null;

// Create an instance of Workshop
$workshop = new Workshop();

// Fetch workshop details if ID is provided
if ($workshopId) {
    $workshopDetails = $workshop->getWorkshopById($workshopId);
}

if (!$workshopDetails) {
    header('Location: 404.php');
    exit;
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <title><?php echo htmlspecialchars($workshopDetails['W_TITLE']); ?> - Spectral by HTML5 UP</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
</head>

<body class="is-preload">

    <!-- Page Wrapper -->
    <div id="page-wrapper">

        <!-- Header -->
        <?php include './layouts/header.php'; ?>

        <!-- Main -->
        <article id="main">
            <header>
                <h2><?php echo htmlspecialchars($workshopDetails['W_TITLE']); ?></h2>
            </header>
            <section class="wrapper style5">
                <div class="inner">
                    <div id="actions">
                        <div id="admin-actions" class="col-12">
                            <a href="edit-workshop.php?workshopid=<?php echo $workshopId; ?>" class="button primary">Editar</a>
                            <a href="validate-workshop.php?id=<?php echo $workshopId; ?>" class="button primary">Validar</a>
                        </div>
                        <div id="user-actions">
                            <a href="workshop-register.php?id=<?php echo $workshopId; ?>" class="button primary">Inscrever</a>
                        </div>
                    </div>
                    <h3><?php echo date('d-m-Y', strtotime($workshopDetails['W_DATE'])); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($workshopDetails['W_DESCRIPTION'])); ?></p>
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