<?php

class DataPegawai extends CI_Controller {
    public function index() {
        $data = $this->db->query("SELECT * FROM dataPegawai")->result();
        echo var_dump($data);
    }
}

?>