<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>A propos Cabinet dentaire</title>
    <link href="../public/css/indexstyles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/50a626f102.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php require_once (__DIR__ .'/header.php') ;?>

    <main>
        <h1 id="titre" class="text-center">Santé buccale : les dernières actus !</h1>
        <?php
            require_once __DIR__ . '/../config/Database.php';
            require_once __DIR__ . '/../models/Post.php';

            $post = new Post();
            $stmt = $post->read();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Créer dynamiquement une variable pour l'ID de l'article de blog
                $id = "actu" . $row['id'];
                // Créer dynamiquement le code HTML pour chaque article de blog
                echo "<div id='{$id}' class='icon-container border-sh row'>";
                echo "<div class='col-25'>";
                echo "<img src='../public/img/{$row['image']}' alt='{$row['title']}' class='image-radius border-sh'>";
                echo "</div>";
                echo "<div class='col-75'>";
                echo "<h2 class='text-center'>{$row['title']}</h2>";
                echo "<h3 class='txt-j'>{$row['content']}</h3>";
                echo "</div>";
                echo "</div>";
            }
        ?>
        <?php require_once (__DIR__ .'/footer.php') ; ?>
    </main>
    <script src="js/index.js"></script>
</body>

</html>



