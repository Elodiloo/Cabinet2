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
        <div class="col-25 col-sm-100 text-center">
            <img src="uploads/<?= htmlspecialchars($post['image']); ?>" alt="<?= htmlspecialchars($post['title']); ?>" class="image-radius border-sh">
        </div>
        <div class="col-75 col-sm-100 text-center">
            <h2 class="text-center"><?= htmlspecialchars($post['title']); ?></h2>
            <h3 class="txt-j"><?= nl2br(htmlspecialchars($post['content'])); ?></h3>
        </div>
        <div class="col-100 col-sm-100 text-center comments">
            <h3 class="text-center">Commentaires</h3>
            <?php foreach ($data['frontController']->showComments($post['id']) as $comment): ?>
                <div class="comment">
                  
                    <p class="comment-content"><?= nl2br(htmlspecialchars($comment['content'])); ?></p>
                    <p class="comment-date"><?= htmlspecialchars($comment['created_at']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-100 col-sm-100 text-center comment-form">
            <h3 class="text-center">Laisser un commentaire</h3>
            <form action="/comment" method="post">
                <input type="hidden" name="blog_id" value="<?= $post['id']; ?>">
                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">
                <textarea name="content" rows="4" cols="50" required></textarea><br>
                <button type="submit" class="submit-btn">Commenter</button>
            </form>
        </div>
    </div>
<?php endforeach; ?>

    </main>
    
        <?php require_once (__DIR__ .'/footer.php'); ?>
    
    <script src="js/index.js"></script>
</body>
</html>
