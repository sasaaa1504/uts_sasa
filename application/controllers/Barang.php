<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(['Barang_model', 'Kategori_model']);
    }
    

    public function index() {
        $data['barang'] = $this->Barang_model->getAll();
        $this->load->view('barang/index', $data);
    }
    public function pengembalian() {
        // Ambil data peminjaman yang belum dikembalikan
        $this->load->model('Barang_model');
        $data['peminjaman'] = $this->Barang_model->get_peminjaman_belum_dikembalikan();
        
        // Tampilkan form pengembalian
        $this->load->view('barang/pengembalian', $data);
    }

    // Fungsi untuk memproses pengembalian
    public function proses_pengembalian() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $peminjaman_id = $this->input->post('peminjaman_id');
            $tanggal_kembali = $this->input->post('tanggal_kembali');
            $jumlah = $this->input->post('jumlah');

            // Update status peminjaman menjadi 'dikembalikan'
            $this->load->model('Barang_model');
            $this->Barang_model->update_status_peminjaman($peminjaman_id);

            // Update stok barang
            $this->Barang_model->update_stok_barang($peminjaman_id, $jumlah);

            // Simpan data pengembalian
            $this->Barang_model->simpan_pengembalian($peminjaman_id, $tanggal_kembali, $jumlah);

            // Redirect atau tampilkan pesan sukses
            $this->session->set_flashdata('message', 'Barang berhasil dikembalikan');
            redirect('barang/pengembalian');
        }
    }

    public function tambah() {
        $data['kategori'] = $this->Kategori_model->getAll();

        if ($this->input->post()) {
            $dataInput = [
                'nama_barang' => $this->input->post('nama_barang', true),
                'kategori_id' => $this->input->post('kategori_id', true),
                'stok' => $this->input->post('stok', true),
                'deskripsi' => $this->input->post('deskripsi', true),
            ];
            $this->Barang_model->insert($dataInput);
            redirect('barang');
        }

        $this->load->view('barang/form', $data);
    }

    public function edit($id) {
        $data['barang'] = $this->Barang_model->getById($id);
        $data['kategori'] = $this->Kategori_model->getAll();

        if ($this->input->post()) {
            $update = [
                'nama_barang' => $this->input->post('nama_barang', true),
                'kategori_id' => $this->input->post('kategori_id', true),
                'stok' => $this->input->post('stok', true),
                'deskripsi' => $this->input->post('deskripsi', true),
            ];
            $this->Barang_model->update($id, $update);
            redirect('barang');
        }

        $this->load->view('barang/form', $data);
    }

    public function hapus($id) {
        $this->Barang_model->delete($id);
        redirect('barang');
    }
}
