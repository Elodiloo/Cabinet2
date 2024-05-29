<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../controllers/FrontController.php';
require_once __DIR__ . '/../controllers/UserController.php';

session_start();

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
$userController = new UserController();

switch ($route) {
    case '/':
        $dates = $frontController->showDates();    
        render('home', ['dates' => $dates]);
        break;

    case '/booking':
        render('booking');
        break;  

    case '/services':
        $services = $frontController->showServices();    
        render('services', ['services' => $services]);
        break;  

    case '/cabinet':
        render('cabinet');
        break;

    case '/actualites':
        $posts = $frontController->getAllPosts();
        render('blog', ['posts' => $posts]);
        break;

    case '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->login();
        } else {
            render('login');
        }
        break;

    case '/register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->register();
        } else {
            render('register');
        }
        break;

    case '/user':
        $userController->user();
        break;

    case '/logout':
        $userController->logout();
        break;

    default:
        http_response_code(404);
        render('404');
}
?>
