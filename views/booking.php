<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>A propos Cabinet dentaire</title>
    <link href="css/indexstyles.css" rel="stylesheet">
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

        <h1 id="titre" class="text-center">Prendre rendez-vous</h1>

        <h3 class="text-center">1 - Choisissez un motif de consultation :</h3>
        <select id="motif">
            <option value="option1">Soins dentaires courants</option>
            <option value="option2">Consultation d'orthodontie</option>
            <option value="option3">Consultation d'implantologie</option>
        </select>

        <h3 class="text-center">2 - Choisissez un rendez-vous :</h3>
        <div id="calendar"></div>
        <div id="appointment-form">
            <input type="date" id="datecalendar">
            <div id="available-slots"></div>
        </div>

        

                    <button type="submit" class="submit-btn">J'enregistre mon rdv </button>

               

            </div>
          
                </form>

            </div>
        </div>

        <?php require_once (__DIR__ .'/footer.php') ; ?>

    </main>
    <script src="js/rdv.js"></script>
</body>

</html>