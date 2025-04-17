<?php
class Kategori extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Kategori_model');
    }

    public function index() {
        $data['kategori'] = $this->Kategori_model->getAll();
        $this->load->view('kategori/index', $data);
    }

    public function tambah() {
        if ($this->input->post()) {
            $data = ['nama_kategori' => $this->input->post('nama_kategori')];
            $this->Kategori_model->insert($data);
            redirect('kategori');
        }
        $this->load->view('kategori/form');
    }

    public function edit($id) {
        $data['kategori'] = $this->Kategori_model->getById($id);
        if ($this->input->post()) {
            $dataUpdate = ['nama_kategori' => $this->input->post('nama_kategori')];
            $this->Kategori_model->update($id, $dataUpdate);
            redirect('kategori');
        }
        $this->load->view('kategori/form', $data);
    }

    public function hapus($id) {
        $this->Kategori_model->delete($id);
        redirect('kategori');
    }
}
