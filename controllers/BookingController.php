<?php

 require_once __DIR__ . '/../models/Booking.php';
 require_once __DIR__ . '/../models/Patient.php';
 require_once __DIR__ . '/../models/Service.php';

class BookingController {

    private $bookingModel;
    private $patientModel;
    private $serviceModel;
    
    
    public function __construct()
    {
        $this->bookingModel = new Booking();
        $this->patientModel = new Patient();
        $this->serviceModel = new Service();
    }

    public function showBookingPage()
    {
        $services = $this->serviceModel->getAllServices();
        $this->render('booking', ['services' => $services]);
    }

    public function bookAppointment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                echo 'Utilisateur non connecté.';
                exit;
            }

            $user_id = $_SESSION['user_id'];
            
            $patientModel = new Patient();
            $patient = $patientModel->getPatientByUserId($user_id);
            if (!$patient) {
                echo 'Patient non trouvé.';
                exit;
            }

            $patient_id = $patient['id'];
            $service_id = $_POST['service_id'];
            $booked_at = $_POST['booked_at'];
           
         

            if ($this->bookingModel->createBooking($patient_id, $booked_at, $service_id)) {
                header('Location: /myprofile'); 
                exit;
            } else {
                echo 'Erreur lors de l\'enregistrement du rendez-vous';
            }
        }
    }

    public function getAllBookings()
    {
        $bookings = $this->bookingModel->getAllBookings();
        echo $this->render('admincalendrier', ['bookings' => $bookings]);
    }

    private function render($view, $data = [])
    {
        extract($data);
        include __DIR__ . "/../views/{$view}.php";
    }

    public function manageBooking()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $bookingId = $_POST['id'];
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            switch ($action) {
                case 'confirm':
                    $this->confirmBooking($bookingId);
                    break;
                case 'modify':
                    $this->showModifyBookingForm($bookingId);
                    break;
                case 'cancel':
                    $this->cancelBooking($bookingId);
                    break;
                case 'update':
                    $this->updateBooking();
                    break;
            }
        } else {
            echo "Action non définie.";
        }
    }
}

     private function showModifyBookingForm($bookingId)
    {
        $booking = $this->bookingModel->getBookingById($bookingId);
        $services = $this->serviceModel->getAllServices();
        $this->render('modifbooking', ['booking' => $booking, 'services' => $services]);
    }


    private function cancelBooking($bookingId)
    {
       $this->bookingModel->cancelBooking($bookingId);
        header('Location: /admin/calendrier');
    }

    public function updateBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookingId = $_POST['id'];
            $bookedAt = $_POST['booked_at'];
            $serviceId = $_POST['service_id'];

            $this->bookingModel->updateBooking($bookingId, $bookedAt, $serviceId);
            header('Location: /admin/calendrier');
        }
    }
}
