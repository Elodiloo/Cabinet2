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
    <?php require_once(__DIR__ . '/header.php'); ?>

    <main>
        <div id="fotocabinet" class="container">
            <div class="slider-container">
                <div class="menu">
                    <label for="slide1" class="arrow arrow-prev">
                        <i class="fa-solid fa-chevron-left"></i>
                    </label>
                    <label for="slide2" class="arrow arrow-next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </label>
                    <label for="slide3" class="arrow arrow-next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </label>

                </div>

                <input class="slide-input" id="slide1" type="radio" name="slides" checked>
                <img class="slide-img" src="../public/img/image3.jpg" alt="cabinetexterieur">

                <input class="slide-input" id="slide2" type="radio" name="slides">
                <img class="slide-img" src="../public/img/image2.jpg" alt="cabinetinterieur">

                <input class="slide-input" id="slide3" type="radio" name="slides">
                <img class="slide-img" src="../puclic/img/image1.png" alt="cabinetinterieur2">
            </div>
        </div>

        <div id="section1">
            <h2 class="text-center ml-50 mr-50">Le cabinet dentaire White Smile offre une large gamme de services et
                soins pour répondre aux besoins de tous les patients.</h2>

            <button type="submit" class="rdv-btn">PRENDRE RENDEZ-VOUS</button>

            <h3 class="text-center">
                L'équipe du Docteur Jean DUPONT vous accueille :
            </h3>
        </div>

        <div id="section2" class="row text-center">
            <div class="col-50 col-sm-100">
                <div class="bg-light ml-100 mr-100 p-10 b-radius-50">
                <img class="img-service" src="../public/img/clock.svg" alt="création">
                <?php foreach ($dates as $date): ?>
                <li><?php echo htmlspecialchars($date['jour']) . ' - ' . htmlspecialchars($date['horaire']); ?></li>
            <?php endforeach; ?>
               
                </div>
            </div>
            <div class="col-50 col-sm-100 mt-30">
                <div class="bg-light ml-100 mr-100 p-10 b-radius-50">
                    <img class="img-service" src="../public/img/map.svg" alt="audit" width="24" height="24">
                    <h3>22 rue du Dortier</h3>
                    <h3> 86520 Saint-Rémy-sur-Creuse</h3>
                </div>
            </div>
        </div>

        <?php require_once(__DIR__ . '/footer.php'); ?>

    </main>
    <script src="js/index.js"></script>
</body>

</html>
