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

        <h1 id="titre" class="text-center">A propos du cabinet White Smile</h1>
        <div id="presentationdoctor" class="icon-container border-sh row">
            <div class="col-25 col-sm-100 text-center">
                <img src="img/image4.jpg" alt="dupont" class="image-arrondie border-sh">
                <h4>1978</h4>
                <h4> Diplômé d'État de docteur en chirurgie dentaire</h4>
                <h4>Faculté de chirurgie dentaire - Paris 7</h4>
            </div>
            <div class="col-75 col-sm-100 mr-50">
                <h2 class="text-center">Le cabinet White Smile est dirigé par le Docteur Jean DUPONT,
                    chirurgien-dentiste.</h2>
                <h3 class="txt-j">Le chirurgien-dentiste, aussi appelé dentiste, prend en charge les problèmes bucco-dentaires. Ce
                    spécialiste de la dentition s'occupe aussi bien
                    des dents, des gencives et des nerfs que des maxillaires. Les patients peuvent notamment le
                    consulter pour un détartrage, le soin d'une carie, le soulagement de gencives irritées ou encore
                    pour la réparation d'une dent abîmée.</h3>
            </div>
        </div>

        <div id="équipedocteur" class="container">
            <h2 class="text-center">Deux dentistes qualifiés et expérimentés travaillent avec le Dr DUPONT</h2>

            <div class="row text-center col-sm-100">
                <div class="col-50 col-sm-100">
                    <img src="img/image5.jpg" alt="hélène" class="image-arrondie">
                    <h3>Hélène DAMIN</h3>
                    <p>Orthodontiste</p>
                </div>
                <div class="col-50 col-sm-100">
                    <img src="img/image6.jpg" alt="oscar" class="image-arrondie">
                    <h3>Oscar LAVAPIES</h3>
                    <p>Chirurgien-dentiste</p>
                </div>

            </div>
        </div>

        <?php require_once (__DIR__ .'/footer.php') ; ?>

    </main>
    <script src="js/index.js"></script>
</body>

</html>