<?php
require_once __DIR__ . '/../models/Patient.php';
require_once __DIR__ . '/../models/User.php';

class PatientController {
    private $patientModel;
    private $userModel;

    public function __construct()
    {
        $this->patientModel = new Patient();
        $this->userModel = new User();
    }

    public function createPatient()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_POST['user_id'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];

            if ($this->patientModel->createPatient($user_id, $firstname, $lastname)) {
                header('Location: /patients');
                exit;
            } else {
                echo 'Erreur lors de la création du patient.';
            }
    
            }
    }

    public function getAllPatients()
    {
        $patients = $this->patientModel->getAllPatients();
        echo $this->render('adminpatients.php', ['patients' => $patients]);
    }

    public function managePatients() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $patientId = $_POST['id'];
            if (isset($_POST['action'])) {
                $action = $_POST['action'];
    
                switch ($action) {
                    case 'create':
                        $this->createPatient();
                        break;
                    case 'modify':
                        $this->showEditPatientForm($patientId);
                        break;
                    case 'delete':
                        $this->deletePatient($patientId);
                        break;
                    case 'update':
                        $this->updatePatient();
                        break;
                }
            } else {
                echo "Action non définie.";
            }
        }
    }
    
    

    public function showEditPatientForm($patientId)
{
    $patient = $this->patientModel->getPatientById($patientId);
    if ($patient) {
        $this->render('editpatient.php', ['patient' => $patient]);
    } else {
        echo "Patient not found";
    }
}


    public function deletePatient($patientId) 
   {
     $this->patientModel->deletePatient($patientId);
       
   }


   public function updatePatient()
   {
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $patientId = htmlspecialchars(strip_tags(trim($_POST['id'])));
           $firstname = htmlspecialchars(strip_tags(trim($_POST['firstname'])));
           $lastname = htmlspecialchars(strip_tags(trim($_POST['lastname'])));
           $birthday = htmlspecialchars(strip_tags(trim($_POST['birthday'])));
           $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
   
           $userId = $this->patientModel->getUserIdByPatientId($patientId);
           $this->userModel->updateUser($userId, $firstname, $lastname, $birthday, $email);
   
           $this->patientModel->updatePatient($patientId, $firstname, $lastname);
   
           header('Location: /admin/patients');
           exit;
       }
   }
   

   

  
    public function addPatient()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstname = htmlspecialchars(strip_tags(trim($_POST['firstname'])));
            $lastname = htmlspecialchars(strip_tags(trim($_POST['lastname'])));
            $birthday = htmlspecialchars(strip_tags(trim($_POST['birthday'])));
            $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
            $password = bin2hex(random_bytes(4));
            $role = 0; 

            
            if ($this->userModel->createUser($firstname, $lastname, $birthday, $email, $password, $role)) {
                $user = $this->userModel->getUserByEmail($email);
                $user_id = $user['id'];

                if ($this->patientModel->createPatient($user_id, $firstname, $lastname)) {
                    header('Location: /admin/patients');
                    exit;
                } else {
                    echo 'Erreur lors de la création du patient.';
                }
            } else {
                echo 'Erreur lors de la création de l\'utilisateur.';
            }
        } else {
            echo $this->render('adminaddpatient.php');
        }
    }

    private function render($view, $data = [])
    {
        extract($data);
        include __DIR__ . "/../views/{$view}";
    }
}
