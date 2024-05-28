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
        $services = $frontController ->showServices();    
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
                render('login');
                break;
            
            case '/enregistrer-user':
                // Récupération des données du formulaire
                $firstname = $_POST['first-name'] ?? '';
                $lastname = $_POST['last-name'] ?? '';
                $birthdate = $_POST['birthday'] ?? '';
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
            
                // Vérification que toutes les données ont été fournies
                if ($firstname && $lastname && $birthday && $email && $password) {
                    // Création d'un nouvel utilisateur
                    $user = new User();
                    $user->setFirstname($firstname);
                    $user->setLastname($lastname);
                    $user->setBirthday($birthday);
                    $user->setEmail($email);
                    $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            
                    // Enregistrement de l'utilisateur dans la base de données
                    $userDao = new UserDao();
                    $userId = $userDao->create($user);
            
                    // Redirection vers la page de rdv si l'utilisateur est un patient, vers une page admin si c'est un admin
                    if ($user->isPatient()) {
                        header('Location: /booking');
                    } else {
                        header('Location: /admin');
                    }
                    exit;
                } else {
                    // Affichage de la vue d'inscription avec un message d'erreur
                    render('enregistrer-user', ['error' => 'Veuillez remplir tous les champs']);
                }
                break;
            
    case '/user':
        $userController->user();
        break;
            
    default:
        http_response_code(404);
        render('404');
}

?>


