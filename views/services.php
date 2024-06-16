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

    <h1 id="titre" class="text-center">Nos services et soins</h1>

<div id="soin1" class="row">
    <div class="col-25 mt-50">
        <img src="img/detartage.png" alt="detartrage" class="image-carre">
    </div>
    <div class="col-50 mt-50">
        <?php foreach ($services as $service): ?>
            <h2><?php echo htmlspecialchars($service['title']); ?></h2>
            <h3><?php echo htmlspecialchars($service['description']); ?></h3>
        <?php endforeach; ?>
    </div>
    <div class="col-25 mb-30">
        <img src="img/kkdgj.png" alt="implant" class="image-carre">
    </div>
</div>



        <?php require_once (__DIR__ .'/footer.php') ; ?>
        </div>

    </main>
    <script src="js/index.js"></script>
</body>

</html>