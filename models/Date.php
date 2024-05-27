<?php
require_once __DIR__ . '/../config/Database.php';
class Date
{
    private $conn;
    private $table = 'open';
    public $id;
    public $jour;
    public $horaire;
        public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    // Créer un post de date
    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (jour, horaire) VALUES (:jour, :horaire, NOW())";
        $stmt = $this->conn->prepare($query);
        $this->jour = htmlspecialchars(strip_tags($this->jour));
        $this->horaire = htmlspecialchars(strip_tags($this->horaire));
        $stmt->bindParam(':jour', $this->jour);
        $stmt->bindParam(':horaire', $this->horaire);
               if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // Lire tout
    public function read()
    {
        $query = "SELECT id, jour, horaire FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
       
        return $stmt;
    }

    // Lire un seul post
    public function readOne()
    {
        $query = "SELECT id, jour, horaire FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->jour = $row['jour'];
        $this->horaire = $row['horaire'];
    }

    // Mettre à jour 
    public function update()
    {
        $query = "UPDATE " . $this->table . " SET jour = :jour, horaire = :horaire WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->jour = htmlspecialchars(strip_tags($this->jour));
        $this->horaire = htmlspecialchars(strip_tags($this->horaire));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':jour', $this->jour);
        $stmt->bindParam(':horaire', $this->horaire);
        $stmt->bindParam(':id', $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Supprimer un post
    public function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}