<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './utils/DBWrapper.php';
require_once './repositories/Article.php';

// Initialize variables
$articleId = isset($_GET['id']) ? intval($_GET['id']) : null;
$title = '';
$smallDescription = '';
$opinionName = '';
$opinionText = '';
$description1 = '';
$img1 = '';
$description2 = '';
$img2 = '';
$description3 = '';
$img3 = '';
$description4 = '';
$coverImg = '';

// Create an instance of article
$article = new Article();

if ($articleId) {
    $existingArticle = $article->getArticleById($articleId);
    if ($existingArticle) {
        $title = $existingArticle['A_TITLE'];
        $smallDescription = $existingArticle['A_SMALL_DESCRIPTION'];
        $opinionName = $existingArticle['A_OPINION_NAME'];
        $opinionText = $existingArticle['A_OPINION_TEXT'];
        $description1 = $existingArticle['A_DESCRIPTION_1'];
        $img1 = $existingArticle['A_IMG_1'];
        $description2 = $existingArticle['A_DESCRIPTION_2'];
        $img2 = $existingArticle['A_IMG_2'];
        $description3 = $existingArticle['A_DESCRIPTION_3'];
        $img3 = $existingArticle['A_IMG_3'];
        $description4 = $existingArticle['A_DESCRIPTION_4'];
        $coverImg = $existingArticle['A_COVER_IMG'];
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $smallDescription = trim($_POST['small-description']);
    $opinionName = trim($_POST['opinion-name']);
    $opinionText = trim($_POST['opinion-text']);
    $description1 = trim($_POST['description1']);
    $description2 = trim($_POST['description2']);
    $description3 = trim($_POST['description3']);
    $description4 = trim($_POST['description4']);
    $date = date('Y-m-d H:i:s');

    // Handle image uploads
    $timestamp = time();
    $targetDir = "./assets/images/uploads/";

    // Validate form data
    $errors = [];

    // Ensure the target directory exists and is writable
    if (!is_dir($targetDir) && !mkdir($targetDir, 0777, true)) {
        $errors[] = 'Failed to create upload directory.';
    }

    if (!empty($_FILES['cover_image']['name'])) {
        $imageFileType = strtolower(pathinfo($_FILES["cover_image"]["name"], PATHINFO_EXTENSION));
        $coverImg = $targetDir . "0_" . $timestamp . "." . $imageFileType;
        if (!move_uploaded_file($_FILES["cover_image"]["tmp_name"], $coverImg)) {
            $errors[] = 'Failed to upload cover image.';
        }
    } else {
        $coverImg = $existingArticle['A_COVER_IMG'];
    }

    if (!empty($_FILES['img1']['name'])) {
        $imageFileType = strtolower(pathinfo($_FILES["img1"]["name"], PATHINFO_EXTENSION));
        $img1 = $targetDir . "1_" . $timestamp . "." . $imageFileType;
        if (!move_uploaded_file($_FILES["img1"]["tmp_name"], $img1)) {
            $errors[] = 'Failed to upload image 1.';
        }
    } else {
        $img1 = $existingArticle['A_IMG_1'];
    }

    if (!empty($_FILES['img2']['name'])) {
        $imageFileType = strtolower(pathinfo($_FILES["img2"]["name"], PATHINFO_EXTENSION));
        $img2 = $targetDir . "2_" . $timestamp . "." . $imageFileType;
        if (!move_uploaded_file($_FILES["img2"]["tmp_name"], $img2)) {
            $errors[] = 'Failed to upload image 2.';
        }
    } else {
        $img2 = $existingArticle['A_IMG_2'];
    }

    if (!empty($_FILES['img3']['name'])) {
        $imageFileType = strtolower(pathinfo($_FILES["img3"]["name"], PATHINFO_EXTENSION));
        $img3 = $targetDir . "3_" . $timestamp . "." . $imageFileType;
        if (!move_uploaded_file($_FILES["img3"]["tmp_name"], $img3)) {
            $errors[] = 'Failed to upload image 3.';
        }
    } else {
        $img3 = $existingArticle['A_IMG_3'];
    }

    if (empty($title)) {
        $errors[] = 'O título é obrigatório.';
    }
    if (empty($smallDescription)) {
        $errors[] = 'A descrição pequena é obrigatória.';
    }
    if (strlen($smallDescription) > 200) {
        $errors[] = 'A descrição pequena deve ter no máximo 200 caracteres.';
    }
    if (empty($description1)) {
        $errors[] = 'A descrição 1 é obrigatória.';
    }
    if (empty($coverImg)) {
        $errors[] = 'A imagem de capa é obrigatória.';
    }

    // If no errors, update the article
    if (empty($errors)) {
        if ($articleId) {
            // Update existing article
            $article->updateArticle($articleId, $title, $coverImg, $date, $smallDescription, $opinionName, $opinionText, $description1, $img1, $description2, $img2, $description3, $img3, $description4);
        } else {
            // Create new article
            $article->createArticle($title, $coverImg, $date, $smallDescription, $opinionName, $opinionText, $description1, $img1, $description2, $img2, $description3, $img3, $description4);
        }
        header('Location: articles.php');
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
                <h4>Artigo</h4>
                <?php if (!empty($errors)): ?>
                    <div class="errors">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form method="post" enctype="multipart/form-data">
                    <div class="row gtr-uniform">
                        <div class="col-12">
                            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($title); ?>" placeholder="Título" required />
                        </div>
                        <div class="col-12">
                            <textarea name="small-description" id="small-description" placeholder="Descrição breve" rows="2" max="200" required><?php echo htmlspecialchars($smallDescription); ?></textarea>
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <input type="text" name="opinion-name" id="opinion-name" placeholder="Nome de autor" rows="1" value="<?php echo htmlspecialchars($opinionName); ?>" />
                        </div>
                        <div class="col-12">
                            <textarea name="opinion-text" id="opinion-text" placeholder="Opinião do autor" rows="2"><?php echo htmlspecialchars($opinionText); ?></textarea>
                        </div>
                        <div class="col-12">
                            <div id="edit-cover-image" onclick="document.getElementById('cover_image').click();">
                                <button type="button" class="button small change-button icon solid fa-upload">Imagem de capa</button>
                                <input type="file" name="cover_image" id="cover_image" accept=".png, .jpg, .jpeg" style="display: none;" value=""/>
                            </div>
                        </div>
                        <div class="col-12">
                            <textarea name="description1" id="description1" placeholder="Descrição 1" rows="5" required><?php echo htmlspecialchars($description1); ?></textarea>
                        </div>
                        <div class="col-12">
                            <div id="edit-img1" onclick="document.getElementById('img1').click();">
                                <button type="button" class="button small change-button icon solid fa-upload">Imagem 1</button>
                                <input type="file" name="img1" id="img1" accept=".png, .jpg, .jpeg" style="display: none;" />
                            </div>
                        </div>
                        <div class="col-12">
                            <textarea name="description2" id="description2" placeholder="Descrição 2" rows="5"><?php echo htmlspecialchars($description2); ?></textarea>
                        </div>
                        <div class="col-12">
                            <div id="edit-img2" onclick="document.getElementById('img2').click();">
                                <button type="button" class="button small change-button icon solid fa-upload">Imagem 2</button>
                                <input type="file" name="img2" id="img2" accept=".png, .jpg, .jpeg" style="display: none;" />
                            </div>
                        </div>
                        <div class="col-12">
                            <textarea name="description3" id="description3" placeholder="Descrição 3" rows="5"><?php echo htmlspecialchars($description3); ?></textarea>
                        </div>
                        <div class="col-12">
                            <div id="edit-img3" onclick="document.getElementById('img3').click();">
                                <button type="button" class="button small change-button icon solid fa-upload">Imagem 3</button>
                                <input type="file" name="img3" id="img3" accept=".png, .jpg, .jpeg" style="display: none;" />
                            </div>
                        </div>
                        <div class="col-12">
                            <textarea name="description4" id="description4" placeholder="Descrição 4" rows="5"><?php echo htmlspecialchars($description4); ?></textarea>
                        </div>
                        <div class="col-12">
                            <ul class="actions">
                                <li><input type="submit" value="Save" class="primary" /></li>
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
    <script src="./assets/js/create-article.js"></script>

</body>

</html>