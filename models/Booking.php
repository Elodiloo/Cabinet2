<?php
require_once __DIR__ . '/../config/Database.php';

class Booking
{
    private $conn;
    private $table = 'booking';
    public $id;
    public $patient_id;
    public $booked_at;
    public $service_id;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createBooking($patient_id, $booked_at, $service_id): bool
    {
        $stmt = $this->conn->prepare('INSERT INTO booking (patient_id, booked_at, service_id) VALUES (?, ?, ?)');
        return $stmt->execute([$patient_id, $booked_at, $service_id]);
    }

    public function getBookingsByPatientId($patient_id)
    {
        $stmt = $this->conn->prepare('
            SELECT b.*, s.title AS service_title
            FROM ' . $this->table . ' b
            JOIN service s ON b.service_id = s.id
            WHERE b.patient_id = ?
            ORDER BY b.booked_at DESC
        ');
        $stmt->execute([$patient_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllBookings()
    {
        $stmt = $this->conn->prepare('
            SELECT b.*, p.firstname AS patient_firstname, p.lastname AS patient_lastname, s.title AS service_title
            FROM ' . $this->table . ' b
            JOIN patient p ON b.patient_id = p.id
            JOIN service s ON b.service_id = s.id
            ORDER BY b.booked_at ASC
        ');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookingById($bookingId)
    {
        $stmt = $this->conn->prepare('SELECT * FROM booking WHERE id = ?');
        $stmt->execute([$bookingId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cancelBooking($bookingId)
    {
        $stmt = $this->conn->prepare('DELETE FROM booking WHERE id = ?');
        return $stmt->execute([$bookingId]);
    }

    public function updateBooking($bookingId, $bookedAt, $serviceId)
    {
        $stmt = $this->conn->prepare('UPDATE booking SET booked_at = ?, service_id = ? WHERE id = ?');
        return $stmt->execute([$bookedAt, $serviceId, $bookingId]);
    }
}

?>

