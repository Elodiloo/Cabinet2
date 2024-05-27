<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../controllers/FrontController.php';
// Parsing de l'URL pour extraire l'identifiant du post si nécessaire
$uri = $_SERVER['REQUEST_URI'];
$uriParts = explode('?', $uri);
$route = $uriParts[0];
$queryString = $uriParts[1] ?? '';
// Fonction pour inclure un template avec des variables
function render($template, $data = []) {
    extract($data);
    include __DIR__ . "/../views/$template.php";
}

$frontController = new FrontController();

switch ($route) {
    case '/':
        $dates = $frontController->showDates();

      
        render('home', ['dates' => $dates]);
            break;
    case '/booking':
            render('booking');
            break;  
    case '/services':
            render('services');
            break;  
    case '/cabinet':
            render('cabinet');
            break;
    case '/actualites':
        $posts = $frontController->getAllPosts();
        render('blog', ['posts' => $posts]);
            break;
          
    default:
        http_response_code(404);
        render('404');
}

?>


