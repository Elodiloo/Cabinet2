<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Prendre rendez-vous - Cabinet dentaire</title>
    <link href="css/indexstyles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales/fr.js"></script>
    <script src="https://kit.fontawesome.com/50a626f102.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&display=swap" rel="stylesheet">
</head>

<body>
    <?php require_once(__DIR__ . '/header.php'); ?>

    <main>
        <h1 id="titre" class="text-center">Prendre rendez-vous</h1>

        <h3 class="text-center">1 - Choisissez un motif de consultation :</h3>
        <select id="motif" name="service_id">
            <?php foreach ($services as $service): ?>
                <option value="<?php echo htmlspecialchars($service['id']); ?>">
                    <?php echo htmlspecialchars($service['title']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <h3 class="text-center">2 - Choisissez un rendez-vous :</h3>
        <div id="calendar"></div>
        <form id="appointment-form" method="post" action="/booking" class="center-form">
            <input type="hidden" name="booked_at" id="booked_at">
            <input type="hidden" name="service_id" id="service_id">
            <button type="submit" class="submit-btn">J'enregistre mon rdv</button>
        </form>
        <div id="available-slots"></div>
    </main>

    <?php require_once(__DIR__ . '/footer.php'); ?>
    
    <script src="js/rdv.js"></script>
</body>
</html>
