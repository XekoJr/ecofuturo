<?php
require_once './utils/DBWrapper.php';
require_once './repositories/Workshop.php';
require_once './repositories/UserWorkshop.php';
require_once './repositories/ManageUsers.php';

// Initialize variables
$workshopId = isset($_GET['id']) ? intval($_GET['id']) : null;
$workshopDetails = null;

// Create an instance of Workshop
$workshop = new Workshop();
$userWorkshop = new UserWorkshop();
$manageUsers = new ManageUsers();

// Fetch workshop details if ID is provided
if ($workshopId) {
    $workshopDetails = $workshop->getWorkshopById($workshopId);
}

if (!$workshopDetails) {
    header('Location: 404.php');
    exit;
}

$registeredUsers = $userWorkshop->getUserWorkshopsByWorkshopId($workshopId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attendance = $_POST['attendance'] ?? [];
    $userWorkshop->updateUserWorkshopShowed($attendance, $workshopId);
    $manageUsers->addPointsToUsers($attendance);
    $workshop->deactivateWorkshop($workshopId);
    header('Location: ./workshops.php');
    exit;
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
                    <h2><?php echo htmlspecialchars($workshopDetails['W_TITLE']) ?></h2>
                    <p><?php echo date('d-m-Y', strtotime($workshopDetails['W_DATE'])); ?></p>
                </header>
                <form method="post" enctype="multipart/form-data">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 10%;"></th>
                                <th style="width: 80%;">Inscritos</th>
                                <th style="width: 10%;">Presença</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($registeredUsers as $index => $user): ?>
                                <?php $userDetails = $manageUsers->getUserById($user['U_ID']); ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($userDetails['U_USERNAME']); ?></td>
                                    <td>
                                        <input type="checkbox" id="user_<?php echo $user['U_ID']; ?>" name="attendance[]" value="<?php echo htmlspecialchars($user['U_ID']); ?>">
                                        <label for="user_<?php echo $user['U_ID']; ?>"></label>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <input type="submit" value="Save Attendance" class="button primary">
                </form>
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