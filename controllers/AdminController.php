<?php
require_once __DIR__ . '/../models/Date.php';
require_once __DIR__ . '/../models/Service.php';
require_once __DIR__ . '/../models/Post.php';

class AdminController
{
     public function showDashboard()
    {
        $date = new Date();
        $service = new Service();
        $post = new Post();
        
        $horaires = $date->read()->fetchAll(PDO::FETCH_ASSOC);
        $services = $service->read()->fetchAll(PDO::FETCH_ASSOC);
        $posts = $post->read()->fetchAll(PDO::FETCH_ASSOC);
        
        require __DIR__ . '/../views/admin.php';
    }

    public function updateSchedule()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date = new Date();
            $date->id = $_POST['id'];
            $date->jour = $_POST['jour'];
            $date->horaire = $_POST['horaire'];

            if ($date->update()) {
                header('Location: /admin/date');
                exit;
            } else {
                $error = "Erreur lors de la mise à jour.";
                $this->showAdminDate($error);
            }
        }
    }

    public function updateService()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $service = new Service();
            $service->id = $_POST['id'];
            $service->title = $_POST['title'];
            $service->description = $_POST['description'];

            if ($service->update()) {
                header('Location: /admin/service');
                exit;
            } else {
                $error = "Erreur lors de la mise à jour.";
                $this->showAdminService($error);
            }
        }
    }

    public function deleteService()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $service = new Service();
            $service->id = $_POST['id'];

            if ($service->delete()) {
                header('Location: /admin/service');
                exit;
            } else {
                $error = "Erreur lors de la suppression.";
                $this->showAdminService($error);
            }
        }
    }

    public function addService()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $service = new Service();
            $service->title = $_POST['title'];
            $service->description = $_POST['description'];

            if ($service->create()) {
                header('Location: /admin/service');
                exit;
            } else {
                $error = "Erreur lors de l'ajout.";
                $this->showAdminService($error);
            }
        }
    }

    private function uploadImage() {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../public/uploads/';
            $fileName = basename($_FILES['image']['name']);
            $uploadFile = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                return $fileName;
            }
        }
        return null;
    }
 
    public function createPost()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        error_log('Données POST reçues : ' . print_r($_POST, true));
        if (!isset($_POST['user_id']) || empty($_POST['user_id'])) {
            $error = "User ID manquant.";
            $this->showAdminPost($error);
            return;
        }
        
        $post = new Post();
        $post->user_id = $_POST['user_id'];
        $post->title = $_POST['title'];
        $post->content = $_POST['content'];
        $post->image = $this->uploadImage();

        if ($post->create()) {
            error_log('Post créé avec succès.');
            header('Location: /admin/blog');
            exit;
        } else {
            error_log('Erreur lors de la création du post.');
            $error = "Erreur lors de l'ajout.";
            $this->showAdminPost($error);
        }
    }
}

    public function updatePost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['user_id']) || empty($_POST['user_id'])) {
                $error = "User ID manquant.";
                $this->showAdminPost($error);
                return;
            }
    
            $post = new Post();
            $post->id = $_POST['id'];
            $post->user_id = $_POST['user_id'];
            $post->title = $_POST['title'];
            $post->content = $_POST['content'];
    
            if (!empty($_FILES['image']['name'])) {
                $post->image = $this->uploadImage();
            }
    
            if ($post->update()) {
                header('Location: /admin/blog');
                exit;
            } else {
                $error = "Erreur lors de la mise à jour.";
                $this->showAdminPost($error);
            }
        }
    }
    

    public function deletePost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = new Post();
            $post->id = $_POST['id'];

            if ($post->delete()) {
                header('Location: /admin/blog');
                exit;
            } else {
                $error = "Erreur lors de la suppression.";
                $this->showAdminPost($error);
            }
        }
    }

    private function showAdminDate($error = null)
    {
        $date = new Date();
        $horaires = $date->read()->fetchAll(PDO::FETCH_ASSOC);
        render('admindate', ['horaires' => $horaires, 'error' => $error]);
    }

    private function showAdminService($error = null)
    {
        $service = new Service();
        $services = $service->read()->fetchAll(PDO::FETCH_ASSOC);
        render('adminservice', ['services' => $services, 'error' => $error]);
    }

    private function showAdminPost($error = null)
    {
        $post = new Post();
        $posts = $post->read()->fetchAll(PDO::FETCH_ASSOC);
        render('adminblog', ['posts' => $posts, 'error' => $error]);
    }

}
?>
