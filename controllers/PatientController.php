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

    public function managePatients() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $patientId = $_POST['patient_id'];
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
        echo $this->render('editpatient.php', ['patient' => $patient]);
    } else {
        echo 'Patient not found';
    }
}



public function updatePatient()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $patient_id = htmlspecialchars(strip_tags(trim($_POST['patient_id'])));
        $firstname = htmlspecialchars(strip_tags(trim($_POST['firstname'])));
        $lastname = htmlspecialchars(strip_tags(trim($_POST['lastname'])));
        $birthday = htmlspecialchars(strip_tags(trim($_POST['birthday'])));
        $email = htmlspecialchars(strip_tags(trim($_POST['email'])));

        $patient = $this->patientModel->getPatientById($patient_id);
        if ($patient) {
            $user_id = $patient['user_id'];
            if ($this->userModel->updateUser($user_id, $firstname, $lastname, $birthday, $email)) {
                header('Location: /admin/patients');
                exit;
            } else {
                echo 'Erreur lors de la mise à jour du patient.';
            }
        } else {
            echo 'Patient not found';
        }
    }
}

  
      public function deletePatient($patientId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->patientModel->deletePatient($patientId)) {
                header('Location: /admin/patients');
                exit;
            } else {
                echo "Erreur lors de la suppression du patient.";
            }
        }
    }

    
    public function addPatient()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstname = htmlspecialchars(strip_tags(trim($_POST['firstname'])));
            $lastname = htmlspecialchars(strip_tags(trim($_POST['lastname'])));
            $birthday = htmlspecialchars(strip_tags(trim($_POST['birthday'])));
            $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
            $password = bin2hex(random_bytes(4)); // Génère un mot de passe aléatoire de 8 caractères
            $role = 0; 

            
            if ($this->userModel->createUser($firstname, $lastname, $birthday, $email, $password, $role)) {
                $user = $this->userModel->getUserByEmail($email);
                $user_id = $user['id'];

                if ($this->patientModel->createPatient($user_id, $firstname, $lastname)) {
                    // Vous pouvez envoyer un email avec le mot de passe temporaire ici
                    // mail($email, "Votre compte a été créé", "Votre mot de passe temporaire est: $password");

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
