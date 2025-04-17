<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Peminjaman_model');
        $this->load->model('Barang_model');
    }

    // Halaman utama: daftar peminjaman
    public function index() {
        $data['peminjaman'] = $this->Peminjaman_model->getAll();
        $this->load->view('peminjaman/index', $data);
    }

    // Tambah peminjaman
    public function tambah() {
        if ($this->input->post()) {
            $data = [
                'nama_peminjam'   => $this->input->post('nama_peminjam'),
                'barang_id'       => $this->input->post('barang_id'),
                'jumlah'          => $this->input->post('jumlah'),
                'tanggal_pinjam'  => $this->input->post('tanggal_pinjam'),
                'tanggal_kembali' => $this->input->post('tanggal_kembali'),
                'status'          => 'dipinjam'
            ];

            // Simpan data peminjaman
            $this->Peminjaman_model->insert($data);

            // Kurangi stok barang
            $this->db->set('stok', 'stok - ' . $data['jumlah'], false);
            $this->db->where('id', $data['barang_id']);
            $this->db->update('barang');

            redirect('peminjaman');
        }

        $data['barang'] = $this->Barang_model->getAll();
        $this->load->view('peminjaman/tambah', $data);
    }

    // Proses pengembalian barang
    public function pengembalian() {
        if ($this->input->post('peminjaman_id')) {
            $id = $this->input->post('peminjaman_id');
            $this->Peminjaman_model->kembalikan($id);
            redirect('peminjaman/pengembalian');
        }

        $data['peminjaman'] = $this->Peminjaman_model->getBelumKembali();
        $this->load->view('peminjaman/pengembalian', $data);
    }
}
