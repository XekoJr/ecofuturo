<?php
require_once './utils/DBWrapper.php';
require_once './repositories/Article.php';

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
$articleId = isset($_GET['id']) ? intval($_GET['id']) : null;
$articleDetails = null;

// Create an instance of article
$article = new Article();

// Fetch article details if ID is provided
if ($articleId) {
	$articleDetails = $article->getArticleById($articleId);
}

if (!$articleDetails) {
	header('Location: 404.php');
	exit;
}
?>

<!DOCTYPE HTML>
<html lang="pt">

<head>
	<title>Generic - Spectral by HTML5 UP</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="stylesheet" href="./assets/css/main.css">
	<noscript>
		<link rel="stylesheet" href="./assets/css/noscript.css">
	</noscript>
</head>

<body id="article-details" class="is-preload">

	<!-- Page Wrapper -->
	<div id="page-wrapper">

		<!-- Header -->
		<?php include './layouts/header.php'; ?>

		<!-- Main -->
		<section class="wrapper style5">
			<div class="inner">
				<header>
					<?php if (isset($currentUser) && $currentUser['U_TYPE'] === 'Admin'): ?>
						<div id="admin-actions" class="col-12">
							<a href="edit-article.php?id=<?php echo $articleId; ?>" class="button primary">Editar</a>
						</div>
					<?php endif; ?>
					<h2><?php echo htmlspecialchars($articleDetails['A_TITLE']); ?></h2>
					<p><?php echo date('d-m-Y H:i', strtotime($articleDetails['A_DATE'])); ?></p>
				</header>
				<p><?php echo htmlspecialchars($articleDetails['A_SMALL_DESCRIPTION']); ?></p>
				<img class="article-img" src="<?php echo htmlspecialchars($articleDetails['A_COVER_IMG']); ?>" alt="cover image">
				<?php if (!empty($articleDetails['A_OPINION_NAME']) && !empty($articleDetails['A_OPINION_TEXT'])): ?>
					<section>
						<h5><?php echo htmlspecialchars($articleDetails['A_OPINION_NAME']); ?></h5>
						<blockquote><?php echo htmlspecialchars($articleDetails['A_OPINION_TEXT']); ?></blockquote>
					</section>
				<?php endif; ?>
				<p><?php echo htmlspecialchars($articleDetails['A_DESCRIPTION_1']); ?></p>
				<?php if (!empty($articleDetails['A_IMG_1'])): ?>
					<img class="article-img" src="<?php echo htmlspecialchars($articleDetails['A_IMG_1']); ?>" alt="">
				<?php endif; ?>
				<?php if (!empty($articleDetails['A_DESCRIPTION_2']) && (empty($articleDetails['A_IMG_1']))): ?>
					<hr>
				<?php endif; ?>
				<p><?php echo htmlspecialchars($articleDetails['A_DESCRIPTION_2']); ?></p>
				<?php if (!empty($articleDetails['A_IMG_2'])): ?>
					<img class="article-img" src="<?php echo htmlspecialchars($articleDetails['A_IMG_2']); ?>" alt="">
				<?php endif; ?>
				<?php if (!empty($articleDetails['A_DESCRIPTION_3']) && (empty($articleDetails['A_IMG_2']))): ?>
					<hr>
				<?php endif; ?>
				<p><?php echo htmlspecialchars($articleDetails['A_DESCRIPTION_3']); ?></p>
				<?php if (!empty($articleDetails['A_IMG_3'])): ?>
					<img class="article-img" src="<?php echo htmlspecialchars($articleDetails['A_IMG_3']); ?>" alt="">
				<?php endif; ?>
				<?php if (!empty($articleDetails['A_DESCRIPTION_4']) && (empty($articleDetails['A_IMG_3']))): ?>
					<hr>
				<?php endif; ?>
				<p><?php echo htmlspecialchars($articleDetails['A_DESCRIPTION_4']); ?></p>
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

</body>

</html>