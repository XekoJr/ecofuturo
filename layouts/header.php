<?php

// Check if the user is logged in
if (isset($_COOKIE['user'])) {
    $currentUser = json_decode($_COOKIE['user'], true);
}

?>

<header id="header">
    <h1><a href="index.php">EcoFuturo</a></h1>
    <nav id="nav">
        <ul>
            <li class="special">
                <a href="#menu" class="menuToggle"><span>Menu</span></a>
                <div id="menu">
                    <ul>
                        <li><a href="./index.php">Página Inicial</a></li>
                        <li><a href="./articles.php">Artigos</a></li>
                        <li><a href="./games.php">Jogos</a></li>
                        <li><a href="./workshops.php">Eventos</a></li>
                        <?php if (isset($currentUser)): ?>
                            <li><a href="./profile.php">Perfil</a></li>
                            <li><a href="./logout.php">Log Out</a></li>
                        <?php else: ?>
                            <li><a href="./views/login.php">Log In</a></li>
                            <li><a href="./views/registo.php">Registar</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</header>