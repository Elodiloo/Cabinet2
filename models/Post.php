<?php
require_once __DIR__ . '/../config/Database.php';
class Post
{
    private $conn;
    private $table = 'blog';
    public $id;
    public $user_id;
    public $title;
    public $content;
    public $image;
    public $updated_at;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (user_id, title, content, image, updated_at) VALUES (:user_id, :title, :content, :image, NOW())";
        $stmt = $this->conn->prepare($query);
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':image', $this->image);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read()
    {
        $query = "SELECT id, user_id, title, content, image, updated_at FROM " . $this->table . " ORDER BY updated_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readLast()
    {
        $query = "SELECT id, user_id, title, content, image, updated_at FROM " . $this->table . " ORDER BY updated_at DESC LIMIT 3";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne()
    {
        $query = "SELECT id, user_id, title, content, image, updated_at FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->user_id = $row['user_id'];
        $this->title = $row['title'];
        $this->content = $row['content'];
        $this->image = $row['image'];
        $this->updated_at = $row['updated_at'];
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " SET user_id = :user_id, title = :title, content = :content, image = :image WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':id', $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

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
?>
