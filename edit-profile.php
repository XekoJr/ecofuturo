<?php
require_once './repositories/ManageUsers.php';

session_start();
// Check if the user is logged in
if (isset($_COOKIE['user'])) {
    $currentUser = json_decode($_COOKIE['user'], true);
    $user_id = $currentUser['U_ID'];
} else {
    // Redirect to login page if not logged in
    header("Location: ./views/login.php");
    exit();
}
$dbWrapper = new DBWrapper();
$pdo = $dbWrapper->getDBHandler();
$stmt = $pdo->prepare("SELECT U_USERNAME, U_EMAIL FROM user WHERE U_ID = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Utilizador não encontrado.";
    exit;
}

$sql = "
    SELECT g.G_NAME, MAX(ug.UG_POINTS) AS best_score
    FROM usergame ug
    INNER JOIN game g ON ug.G_ID = g.G_ID
    WHERE ug.U_ID = ?
    GROUP BY g.G_ID, g.G_NAME
";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$game_scores = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="./assets/css/profile.css">
    <title>Perfil</title>
</head>

<body class="is-preload">

    <!-- Page Wrapper -->
    <div class="container" id="profile-page">

        <?php include './layouts/header.php'; ?>

        <form action="./update_profile.php" method="post" class="form-container">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">
            <label for="username">Nome:</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['U_USERNAME']) ?>" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['U_EMAIL']) ?>" required>
            <br>
            <label for="current_password">Senha Atual:</label>
            <input type="password" id="current_password" name="current_password">
            <br>
            <label for="new_password">Nova Senha:</label>
            <input type="password" id="new_password" name="new_password">
            <br>
            <label for="confirm_password">Confirme a Nova Senha:</label>
            <input type="password" id="confirm_password" name="confirm_password">
            <br>
            <button type="submit" class="button primary fit">Atualizar</button>
        </form>

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