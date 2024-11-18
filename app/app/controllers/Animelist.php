<?php

class Animelist extends Controller{
    private $mdl = 'Anime_model';

    //controller default page user
    public function index(){
        $data['judul'] = 'Daftar Anime';
        $data['Animelist'] = $this->model($this->mdl)->getAnime();
        $this->view('templates/header', $data);
        $this->view('animelist/index', $data);
        $this->view('templates/footer');
    }

    //contoller page user/detail
    public function detail($id){
        $data['judul'] = 'Detail Anime';
        $data['Animelist'] = $this->model($this->mdl)->getAnimeById($id);
        $this->view('templates/header', $data);
        $this->view('animelist/detail', $data);
        $this->view('templates/footer');
    }
    
    //Controller data user
    public function add(){
        if( $this->model($this->mdl)->addDataAnime($_POST) > 0) {
            Flasher::setFlash('successfully', 'added', 'success');
            header('Location: ' . BASEURL . '/Animelist' );
            exit;
        } else {
            Flasher::setFlash('failed', 'added', 'danger');
            header('Location: ' . BASEURL . '/Animelist' );
            exit;
        }
    }
    
    public function delete($id){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$id; 
            $result = $this->model($this->mdl)->deleteDataAnime($id);
            if ($result) {
                http_response_code(200); // Success
                echo json_encode(['status' => 'success', 'message' => 'User deleted.']);
            } else {
                http_response_code(500); // Server error
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete user.']);
            }
        } else {
            http_response_code(405); // Method not allowed
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
        }
    }

    public function getUpdate(){
       echo json_encode($this->model($this->mdl)->getAnimeById($_POST['id']));
    }

    public function update(){
        if( $this->model($this->mdl)->updateDataAnime($_POST) > 0) {
            Flasher::setFlash('successfully', 'Updated', 'success');
            header('Location: ' . BASEURL . '/Animelist' );
            exit;
        } else {
            Flasher::setFlash('failed', 'Updates', 'danger');
            header('Location: ' . BASEURL . '/Animelist' );
            exit;
        }
    }

    
}