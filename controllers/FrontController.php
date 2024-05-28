<?php

 require_once __DIR__ . '/../models/Post.php';
 require_once __DIR__ . '/../models/Date.php';
 require_once __DIR__ . '/../models/Service.php';


class FrontController {

    private $postModel;
    private $dateModel; 
    private $serviceModel;
    
    public function __construct()
    {
        $this->postModel = new Post();
        $this->dateModel = new Date(); 
        $this->serviceModel = new Service();
    }

    public function getLastPosts() {
        return $this->postModel->readLast();
    }

    public function getAllPosts(){
        return $this->postModel->read();
    }
        
    public function showDates() {
        $stmt = $this->dateModel->read();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showServices() {
        $stmt = $this->serviceModel->read();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
?>