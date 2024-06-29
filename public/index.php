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
            if (isset($_POST['update_post'])) {
                $adminController->updatePost();
            } elseif (isset($_POST['delete_post'])) {
                $adminController->deletePost();
            } elseif (isset($_POST['create_post'])) {
                $adminController->createPost();
            }
        } else {
            render('adminblog');
        }
        break;

        case '/admin/patients':
            $patientController->getAllPatients();
            break;
        
        case '/edit_patient':
                if (isset($_GET['patient_id'])) {
                    $patientController->showEditPatientForm($_GET['patient_id']);
                } else {
                    echo "Patient ID not provided.";
                }
                break;
            
        case '/admin/deletepatient':
            $patientController->deletePatient();
            break;    
        
        case '/admin/addpatient':
            $patientController->addPatient();
            break;
        
        case '/admin/updatepatient':
            $patientController->updatePatient();
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
