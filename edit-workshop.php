<?php
require_once './utils/DBWrapper.php';
require_once './repositories/Workshop.php';

// Initialize variables
$workshopId = isset($_GET['workshopid']) ? intval($_GET['workshopid']) : null;
$title = '';
$date = '';
$smallDescription = '';
$description = '';
$imgsrc = '';

// Create an instance of Workshop
$workshop = new Workshop();

if ($workshopId) {
    $existingWorkshop = $workshop->getWorkshopById($workshopId);
    if ($existingWorkshop) {
        $title = $existingWorkshop['W_TITLE'];
        $date = $existingWorkshop['W_DATE'];
        $smallDescription = $existingWorkshop['W_SMALL_DESCRIPTION'];
        $description = $existingWorkshop['W_DESCRIPTION'];
        $imgsrc = $existingWorkshop['W_IMG'];
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $date = trim($_POST['date']);
    $smallDescription = trim($_POST['small-description']);
    $description = trim($_POST['description']);

    // Validate form data
    $errors = [];
    // Handle image upload
    if (!empty($_FILES['workshop_image']['name'])) {
        $targetDir = "./assets/images/uploads/";
        $timestamp = time();
        $imageFileType = strtolower(pathinfo($_FILES["workshop_image"]["name"], PATHINFO_EXTENSION));
        $targetFile = $targetDir . $timestamp . '.' . $imageFileType;
        if (move_uploaded_file($_FILES["workshop_image"]["tmp_name"], $targetFile)) {
            $imgsrc = $targetFile;
        } else {
            $errors[] = 'Erro ao fazer upload da imagem.';
        }
    } else {
        if (!$workshopId) {
            // Set default image if creating a new workshop and no image is uploaded
            $imgsrc = "./assets/images/pic01.jpg";
        } else {
            // Keep the existing image if editing and no new image is uploaded
            $imgsrc = $existingWorkshop['W_IMG'];
        }
    }

    if (empty($title)) {
        $errors[] = 'O título é obrigatório.';
    }
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        $errors[] = 'A data deve estar no formato aaaa-mm-dd.';
    }
    if (strlen($smallDescription) < 150 || strlen($smallDescription) > 200) {
        $errors[] = 'A pequena descrição deve ter entre 150 e 200 caracteres.';
    }
    if (strlen($description) < 200) {
        $errors[] = 'A descrição completa deve ter no mínimo 200 caracteres.';
    }

    // If no errors, update the workshop
    if (empty($errors)) {
        if ($workshopId) {
            // Update existing workshop
            $workshop->updateWorkshop($workshopId, $title, $imgsrc, $smallDescription, $description, $date);
        } else {
            // Create new workshop
            $workshop->createWorkshop($title, $imgsrc, $smallDescription, $description, $date);
        }
        header('Location: workshops.php');
        exit;
    }
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

<body class="is-preload">

    <!-- Page Wrapper -->
    <div id="page-wrapper">

        <!-- Header -->
        <?php include './layouts/header.php'; ?>

        <!-- Main -->
        <section class="wrapper style5">
            <div class="inner">
                <h4>Evento</h4>
                <?php if (!empty($errors)): ?>
                    <div class="errors">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="row gtr-uniform">
                        <div class="col-12">
                            <div id="edit-workshop-image" onclick="document.getElementById('workshop_image').click();">
                                <button type="button" class="button small change-button icon solid fa-upload">Imagem do workshop</button>
                                <input type="file" name="workshop_image" id="workshop_image" accept=".png, .jpg, .jpeg" style="display: none;" />
                            </div>
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <input type="text" name="title" id="workshop-title" value="<?php echo htmlspecialchars($title); ?>" placeholder="Título" required />
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <input type="text" name="date" id="workshop-date" value="<?php echo htmlspecialchars($date); ?>" placeholder="aaaa-mm-dd" required />
                        </div>
                        <div class="col-12">
                            <textarea name="small-description" id="workshop-small-description" placeholder="Pequena descrição do evento.." rows="6" required minlength="150" maxlength="200"><?php echo htmlspecialchars($smallDescription); ?></textarea>
                        </div>
                        <div class="col-12">
                            <textarea name="description" id="workshop-description" placeholder="Descrição completa do evento.." rows="6" required><?php echo htmlspecialchars($description); ?></textarea>
                        </div>
                        <div class="col-12">
                            <ul class="actions">
                                <li><input type="submit" value="Salvar Evento" class="primary" /></li>
                                <li><input type="reset" value="Reset" /></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <!-- Footer -->
        <?php include './layouts/footer.php'; ?>

    </div>

    <!-- Scripts -->
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/jquery.scrollex.min.js"></script>
    <script src="./assets/js/jquery.scrolly.min.js"></script>
    <script src="./assets/js/browser.min.js"></script>
    <script src="./assets/js/breakpoints.min.js"></script>
    <script src="./assets/js/util.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/create-workshop.js"></script>

</body>

</html>