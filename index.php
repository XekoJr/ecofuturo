<?php

session_start();

?>

<!DOCTYPE HTML>
<html lang="pt">

<head>
	<title>Spectral by HTML5 UP</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="stylesheet" href="./assets/css/main.css">
	<noscript>
		<link rel="stylesheet" href="./assets/css/noscript.css">
	</noscript>
</head>

<body class="landing is-preload">

	<!-- Page Wrapper -->
	<div id="page-wrapper">

		<!-- Header -->
		<?php include './layouts/header.php'; ?>

		<!-- Banner -->
		<section id="banner">
			<div class="inner">
				<h2>EcoFuturo</h2>
				<p>Educando um futuro mais verde</p>
				<ul class="actions special">
					<li><a href="#" class="button primary">Descubra Mais</a></li>
				</ul>
			</div>
			<a href="#one" class="more scrolly">Saiba Mais</a>
		</section>

		<!-- One -->
		<section id="one" class="wrapper style1 special">
			<div class="inner">
				<header class="major">
					<h2>Por que educar sobre sustentabilidade?</h2>
					<p>EcoFuturo é um portal interativo dedicado a crianças e adolescentes, com o objetivo de ensinar
						práticas ambientais de forma divertida e envolvente.</p>
				</header>
				<ul class="icons major">
					<li><span class="icon solid fa-leaf major style1"><span class="label">Sustentabilidade</span></span></li>
					<li><span class="icon solid fa-users major style2"><span class="label">Comunidade</span></span></li>
					<li><span class="icon solid fa-lightbulb major style3"><span class="label">Educação</span></span>
					</li>
				</ul>
			</div>
		</section>

		<!-- Two -->
		<section id="two" class="wrapper alt style2">
			<section class="spotlight">
				<div class="image"><img src="./assets/images/class.jpg" alt=""></div>
				<div class="content">
					<h2>Conteúdo educativo</h2>
					<p>Explore artigos, vídeos e quizzes que ensinam práticas sustentáveis, como reciclagem e economia
						de recursos, de forma lúdica e acessível.</p>
				</div>
			</section>
			<section class="spotlight">
				<div class="image"><img src="./assets/images/pic02.jpg" alt="imagem dos jogos"></div>
				<div class="content">
					<h2>Jogos Divertidos</h2>
					<p>Ganha pontos, desbloqueia medalhas e compete em rankings enquanto aprende sobre sustentabilidade
						e o impacto de suas ações no meio ambiente.</p>
				</div>
			</section>
			<section class="spotlight">
				<div class="image"><img src="./assets/images/kids.jpg" alt="crianças na floresta"></div>
				<div class="content">
					<h2>Eventos e Workshops</h2>
					<p>Participe de desafios ambientais, eventos e workshops que incentivam ações coletivas para
						proteger o planeta.</p>
				</div>
			</section>
		</section>

		<!-- Three -->
		<section id="three" class="wrapper style3 special">
			<div class="inner">
				<header class="major">
					<h2>Funcionalidades</h2>
					<p>Desenvolvemos ferramentas para inspirar jovens e ajudá-los a entender o impacto de suas ações no
						meio ambiente.</p>
				</header>
				<ul class="features">
					<li class="icon solid fa-book">
						<h3>Educação Interativa</h3>
						<p>Conteúdo educativo que combina com temas ambientais.</p>
					</li>
					<li class="icon solid fa-seedling">
						<h3>Ações Práticas</h3>
						<p>Dicas e desafios práticos para aplicar no dia a dia.</p>
					</li>
					<li class="icon solid fa-chart-bar">
						<h3>Monitoramento</h3>
						<p>Acompanhe o seu progresso e conquistas enquanto aprende.</p>
					</li>
					<li class="icon solid fa-heart">
						<h3>Impacto Social</h3>
						<p>Conecte-se com comunidades que compartilham os mesmos valores.</p>
					</li>
				</ul>
			</div>
		</section>

		<!-- CTA -->
		<section id="cta" class="wrapper style4">
			<div class="inner">
				<header>
					<h2>Junte-se à nossa comunidade!</h2>
					<p>Registe-se gratuitamente para acessar conteúdos exclusivos, aprender sobre sustentabilidade de
						forma divertida e acompanhar o seu progresso.</p>
				</header>
				<ul class="actions stacked">
					<li><a href="#" class="button fit primary">Registar</a></li>
					<li><a href="#" class="button fit">Saiba Mais</a></li>
				</ul>
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