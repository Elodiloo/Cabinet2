<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Accueil Cabinet dentaire</title>
    <link href="css/indexstyles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap"
          rel="stylesheet">
    <script src="https://kit.fontawesome.com/50a626f102.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <nav class="navbar">
        <div class="logo">White Smile</div>
        <div class="nav-links">
            <ul>
                <li><a href="/">Accueil</a></li>
                <?php if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1): ?>
                    <li><a href="/booking">Prendre rendez-vous</a></li>
                <?php endif; ?>
                <li><a href="/services">Offre de soins</a></li>
                <li><a href="/cabinet">Le cabinet</a></li>
                <li><a href="/actualites">Actualités santé</a></li>
                <?php if (isset($_SESSION['user_role'])): ?>
                    <?php if ($_SESSION['user_role'] == 1): ?>
                        <li><a href="/admin">Mon tableau de bord</a></li>
                        <li><i class="fas fa-user-shield"></i></li>
                    <?php endif; ?>
                   <li><a href="/logout">Se déconnecter</a></li>
                <?php else: ?>
                    <li><a href="/login">Se connecter</a></li>
                    <li><a href="/register">S'inscrire</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="burger">
            <img src="img/bars.svg" alt="menu burger" class="menu_burger">
        </div>
    </nav>
</header>
<script type="application/javascript" src="js/header.js"></script>
</body>
</html>
