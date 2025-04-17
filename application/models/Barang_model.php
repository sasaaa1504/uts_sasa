<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

    // Ambil semua data barang beserta nama kategori
    public function getAll() {
        $this->db->select('barang.*, kategori.nama_kategori');
        $this->db->from('barang');
        $this->db->join('kategori', 'barang.kategori_id = kategori.id');
        return $this->db->get()->result();
    }

    // Tambahkan data barang baru
    public function insert($data) {
        return $this->db->insert('barang', $data);
    }

    // Ambil data barang berdasarkan ID
    public function getById($id) {
        return $this->db->get_where('barang', ['id' => $id])->row();
    }

    // Update data barang berdasarkan ID
    public function update($id, $data) {
        return $this->db->update('barang', $data, ['id' => $id]);
    }

    // Hapus data barang berdasarkan ID
    public function delete($id) {
        return $this->db->delete('barang', ['id' => $id]);
    }
}
