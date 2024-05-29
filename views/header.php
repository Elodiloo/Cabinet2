<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Accueil Cabinet dentaire</title>
    <link href="css/indexstyles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap"
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
                <li><a href="/booking">Prendre rendez-vous</a></li>
                <li><a href="/services">Offre de soins</a></li>
                <li><a href="/cabinet">Le cabinet</a></li>
                <li><a href="/actualites">Actualités santé</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/profile" class="nav-link">
                        <i class="fa fa-user"></i>
                        <?php echo htmlspecialchars($_SESSION['user_email']); ?>
                    </a></li>
                    <li><a href="/logout" class="nav-link">
                        <i class="fa fa-sign-out"></i>
                        Se déconnecter
                    </a></li>
                <?php else: ?>
                    <li><a href="/login" class="nav-link">
                        <i class="fa fa-user"></i>
                        Se connecter
                    </a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="burger">
            <img src="img/bars.svg" alt="menu burger" class="menu_burger">
        </div>
    </nav>
</header>
</body>
</html>
