<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Patient.php';
require_once __DIR__ . '/../models/Booking.php';

class UserController {

    private $userModel;
    private $patientModel;
    private $bookingModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->patientModel = new Patient();
        $this->bookingModel = new Booking();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
            $password = htmlspecialchars(strip_tags(trim($_POST['password'])));

            if ($this->userModel->checkCredentials($email, $password)) {
                session_start();
                $user = $this->userModel->getUserByEmail($email);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role'];

                if ($user['role'] == 1) {
                    header('Location: /admin');
                } else {
                    header('Location: /myprofile');
                }
                exit;
            } else {
                echo $this->render('login.php', ['error' => 'Email ou mot de passe incorrect']);
            }
        } else {
            echo $this->render('login.php');
        }
    }

    public function register()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstname = htmlspecialchars(strip_tags(trim($_POST['firstname'])));
        $lastname = htmlspecialchars(strip_tags(trim($_POST['lastname'])));
        $birthday = htmlspecialchars(strip_tags(trim($_POST['birthday'])));
        $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
        $role = htmlspecialchars(strip_tags(trim($_POST['role'])));
        
        
        if (isset($_POST['source']) && $_POST['source'] === 'adminpatients') {
            $password = bin2hex(random_bytes(4)); 
            
        } else {
           $password = htmlspecialchars(strip_tags(trim($_POST['password'])));
        }

       
        if ($this->userModel->createUser($firstname, $lastname, $birthday, $email, $password, $role)) {
            
            $user = $this->userModel->getUserByEmail($email);
            $user_id = $user['id'];

            if ($role == 0) {
                if ($this->patientModel->createPatient($user_id, $firstname, $lastname)) {
                    header('Location: /login');
                    exit;
                } else {
                    echo 'Erreur lors de la création du patient.';
                }
            } else {
                header('Location: /login');
                exit;
            }
        } else {
            echo 'Erreur lors de la création de l\'utilisateur.';
        }
    } else {
        echo $this->render('register.php');
    }
}



    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /');
        exit;
    }

    public function getUserProfile()
    {
         if (isset($_SESSION['user_id'])) {
            $user = $this->userModel->find($_SESSION['user_id']);
            $patient = $this->patientModel->getPatientByUserId($_SESSION['user_id']);
            $bookings = $this->bookingModel->getBookingsByPatientId($patient['id']);
            echo $this->render('myprofile.php', ['user' => $user, 'bookings' => $bookings]);
        } else {
            header('Location: /login');
            exit;
        }
    }

    public function getAllPatients()
    {
        $patients = $this->patientModel->getAllPatients();
        echo $this->render('adminpatients.php', ['patients' => $patients]);
    }

    private function render($view, $data = [])
    {
        extract($data);
        include __DIR__ . "/../views/{$view}";
    }
}
?>
