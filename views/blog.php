<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Actualités Santé</title>
    <link href="../public/css/indexstyles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/50a626f102.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php require_once (__DIR__ .'/header.php'); ?>

    <main>
        <h1 id="titre" class="text-center">Santé buccale : les dernières actus !</h1>
        
            <?php foreach ($posts as $post): ?>
                <div id="actu<?= $post['id']; ?>" class="icon-container border-sh row">
                    <div class="col-25">
                        <img src="uploads/<?= htmlspecialchars($post['image']); ?>" alt="<?= htmlspecialchars($post['title']); ?>" class="image-radius border-sh">
                    </div>
                    <div class="col-75">
                        <h2 class="text-center"><?= htmlspecialchars($post['title']); ?></h2>
                        <h3 class="txt-j"><?= nl2br(htmlspecialchars($post['content'])); ?></h3>
                    </div>
                </div>
            <?php endforeach; ?>
    </main>
    
        <?php require_once (__DIR__ .'/footer.php'); ?>
    
    <script src="js/index.js"></script>
</body>
</html>
