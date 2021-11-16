<?php

class DataPegawai extends CI_Controller {
    public function index() {
        $this->load->library('session');
        $data['title'] = 'Data Pegawai';
        $data['pegawai'] = $this->PenggajianModel->get_data('data_pegawai')->result();
        $this->load->view('template_admin/header',$data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/dataPegawai',$data);
        $this->load->view('template_admin/footer');
    }

    public function tambah_data() {
        $data['title'] = 'Tambah Data Pegawai';
        $data['jabatan'] = $this->PenggajianModel->get_data('data_jabatan')->result();
        $this->load->view('template_admin/header',$data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/formTambahPegawai',$data);
        $this->load->view('template_admin/footer');
    }

    public function update_data($id){
        $where = array('id_pegawai' => $id);
        $data['title']= "Update Data Pegawai";
        $data['jabatan'] = $this->PenggajianModel->get_data("data_jabatan");
        $data['pegawai'] = $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai='$id'")->result();
        $this->load->view('template_admin/header',$data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/formUpdatePegawai',$data);
        $this->load->view('template_admin/footer');
    }

    public function update_data_aksi() {
        $this->_rules();

        if($this->form_validation->run() == FALSE) {
            $this->update_data();
        }else{
            $id_pegawai          =$this->input->post('id_pegawai');
            $nik                 =$this->input->post('nik');
            $nama_pegawai        =$this->input->post('nama_pegawai');
            $jenis_kelamin       =$this->input->post('jenis_kelamin');
            $tanggal_masuk       =$this->input->post('tanggal_masuk');
            $jabatan             =$this->input->post('jabatan');
            $status              =$this->input->post('status');
            $photo               =$_FILES['photo']['name'];
            if ($photo==''){

            } else {
                $config ['upload_path'] = './assets/img';
                $config ['allowed_types'] = 'jpg|jpeg|png|tiff';
                $this->load->library('upload' , $config);
                if ($this->upload->do_upload('photo')) {
                    $photo = $this->upload->data('file_name');
                    $this->db->set('photo', $photo);
                } else {
                    $photo = $this->upload->display_errors();
                };
            }

            $data   =array(
                'nik' => $nik,
                'nama_pegawai' => $nama_pegawai,
                'jenis_kelamin' => $jenis_kelamin,
                'jabatan' => $jabatan,
                'tanggal_masuk' => $tanggal_masuk,
                'status' => $status,
            );
            
            $where = array('id_pegawai' => $id_pegawai);

            $this->PenggajianModel->update_data('data_pegawai', $data, $where);
            $this->load->library('session');
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil diupdate!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            </div>');
            redirect('admin/DataPegawai');

        }
    }

    public function tambah_data_aksi() {
        $this->_rules();
        
        if($this->form_validation->run() == FALSE) {
            $this->tambah_data();
        }else{
            $nik                 =$this->input->post('nik');
            $nama_pegawai        =$this->input->post('nama_pegawai');
            $jenis_kelamin       =$this->input->post('jenis_kelamin');
            $tanggal_masuk       =$this->input->post('tanggal_masuk');
            $jabatan             =$this->input->post('jabatan');
            $status              =$this->input->post('status');
            $photo               =$_FILES['photo']['name'];
            if ($photo=''){

            } else {
                $config ['upload_path'] = './assets/img';
                $config ['allowed_types'] = 'jpg|jpeg|png|tiff';
                $this->load->library('upload' , $config);
                if (!$this->upload->do_upload('photo')) {
                    echo 'Photo Gagal diUpload!';
                } else {
                    $photo = $this->upload->data('file_name');
                };
            }

            $data   = array(
                'nik' => $nik,
                'nama_pegawai' => $nama_pegawai,
                'jenis_kelamin' => $jenis_kelamin,
                'jabatan' => $jabatan,
                'tanggal_masuk' => $tanggal_masuk,
                'status' => $status,
                'photo' => $photo,
            );
            
            $this->PenggajianModel->insert_data($data,'data_pegawai');
            $this->load->library('session');
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil ditambahkan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            </div>');
            redirect('admin/DataPegawai');

        }
    }

    public function delete_data($id){
        $where = array('id_pegawai' => $id);
        $this->PenggajianModel->delete_data($where, 'data_pegawai');
        $this->load->library('session');
        $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data Berhasil dihapus!!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        </div>');
        redirect('admin/dataPegawai');
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nik','nik','required');
        $this->form_validation->set_rules('nama_pegawai','nama pegawai','required');
        $this->form_validation->set_rules('jenis_kelamin','jenis kelamin','required');
        $this->form_validation->set_rules('jabatan','jabatan','required');
        $this->form_validation->set_rules('tanggal_masuk','tanggal masuk','required');
        $this->form_validation->set_rules('status','status','required');
    }
}

?>