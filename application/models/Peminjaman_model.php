<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_model extends CI_Model {

    // Ambil semua data peminjaman (termasuk nama barang)
    public function getAll() {
        $this->db->select('peminjaman.*, barang.nama_barang');
        $this->db->from('peminjaman');
        $this->db->join('barang', 'barang.id = peminjaman.barang_id');
        return $this->db->get()->result();
    }

    // Ambil data peminjaman yang belum dikembalikan
    public function getBelumKembali() {
        $this->db->select('peminjaman.*, barang.nama_barang');
        $this->db->from('peminjaman');
        $this->db->join('barang', 'barang.id = peminjaman.barang_id');
        $this->db->where('peminjaman.status', 'dipinjam');
        return $this->db->get()->result();
    }

    // Proses pengembalian barang
    public function kembalikan($id) {
        // Ambil data peminjaman berdasarkan ID
        $pinjam = $this->db->get_where('peminjaman', ['id' => $id])->row();

        if ($pinjam) {
            // Update status peminjaman
            $this->db->update('peminjaman', ['status' => 'dikembalikan'], ['id' => $id]);

            // Tambahkan kembali stok barang
            $this->db->set('stok', 'stok + ' . $pinjam->jumlah, false);
            $this->db->where('id', $pinjam->barang_id);
            $this->db->update('barang');
        }
    }

    // Tambah data peminjaman
    public function insert($data) {
        return $this->db->insert('peminjaman', $data);
    }
}
