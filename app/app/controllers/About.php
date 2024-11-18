<?php

class About extends Controller {
    //Controller default page about
    public function index($nama = "FaizCan", $pekerjaan = "Mahasiswa"){
        $data['nama'] = $nama;
        $data['pekerjaan'] = $pekerjaan;
        $data['judul'] = 'About Me';
        $this->view('templates/header', $data);
        $this->view('about/index', $data);
        $this->view('templates/footer');
    }

    //Controller page about/page
    public function page(){
        $data['judul'] = 'About Me Pages';
        $this->view('templates/header', $data);
        $this->view('about/page');
        $this->view('templates/footer');
    }
}