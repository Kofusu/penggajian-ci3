<?php

Class Dashboard extends CI_Controller {
    public function index(){
        $data['title'] = 'Dashboard';
        $pegawai = $this->db->query('SELECT * FROM dataPegawai');
        $admin = $this->db->query('SELECT * FROM dataPegawai where jabatan = "admin"');
        $jabatan = $this->db->query('SELECT * FROM dataJabatan');
        $kehadiran = $this->db->query('SELECT * FROM dataKehadiran');
        
        $data['pegawai'] = $pegawai->num_rows();
        $data['admin'] = $admin->num_rows();
        $data['jabatan'] = $jabatan->num_rows();
        $data['kehadiran'] = $kehadiran->num_rows();

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('template_admin/footer');
    }
}
