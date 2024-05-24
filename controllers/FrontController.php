<?php

 require_once __DIR__ . '/../models/Post.php';

class FrontController {

    private $postModel;
    private $dateModel; 

    public function __construct()
    {
        $this->postModel = new Post();
        $this->dateModel = new Date(); 
    }

    public function getLastPosts() {
        return $this->postModel->readLast();
    }

    public function getAllPosts(){
        return $this->postModel->read();
    }
        
    public function showDates() {
        $dates = $this->dateModel->read();
        render('dates', ['dates' => $dates]);
    }
}
?>