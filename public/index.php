<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../controllers/FrontController.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/AdminController.php';
require_once __DIR__ . '/../controllers/BookingController.php';
require_once __DIR__ . '/../controllers/PatientController.php';

session_start();

$uri = $_SERVER['REQUEST_URI'];
$uriParts = explode('?', $uri);
$route = $uriParts[0];
$queryString = $uriParts[1] ?? '';

function render($template, $data = []) {
    extract($data);
    include __DIR__ . "/../views/$template.php";
}

$frontController = new FrontController();
$userController = new UserController();
$adminController = new AdminController();
$bookingController = new BookingController();
$patientController = new PatientController();


switch ($route) {
    case '/':
        $dates = $frontController->showDates();    
        render('home', ['dates' => $dates]);
        break;

        case '/booking':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $bookingController->bookAppointment();
            } else {
                $bookingController->showBookingPage();
            }
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

    case '/myprofile':
        $userController->getUserProfile();
        break;
    
    case '/admin':
        render('admin');
        break;

    case '/admin/date':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_schedule'])) {
            $adminController->updateSchedule();
        } else {
            render('admindate');
        }
        break;

    case '/admin/service':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['update_service'])) {
                $adminController->updateService();
            } elseif (isset($_POST['delete_service'])) {
                $adminController->deleteService();
            } elseif (isset($_POST['add_service'])) {
                $adminController->addService();
            }
        } else {
            render('adminservice');
        }
        break;

    case '/admin/blog':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['update_post']) || isset($_POST['delete_post']) || isset($_POST['add_post'])) {
                $adminController->managePost();
            }
        } else {
            render('adminblog');
        }
        break;

    case '/admin/patients':
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['create_patient']) || isset($_POST['modify_patient']) || isset($_POST['delete_patient']) || isset($_POST['update_patient'])) {
                    $patientController->managePatient();
            }
        } else {
            $patientController->getAllPatients();
        }
        break;

    case '/admin/addpatient':
        $userController->register();
        break;

    case '/admin/calendrier':
        $bookingController->getAllBookings();
        $bookingController->manageBooking();
        break;

    
    case '/modifbooking':
            $bookingController->updateBooking();
            break;

        
    default:
        http_response_code(404);
        render('404');
        break;
}
?>
