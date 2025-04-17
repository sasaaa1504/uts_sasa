<?php
class Kategori_model extends CI_Model {
    public function getAll() {
        return $this->db->get('kategori')->result();
    }

    public function insert($data) {
        return $this->db->insert('kategori', $data);
    }

    public function getById($id) {
        return $this->db->get_where('kategori', ['id' => $id])->row();
    }

    public function update($id, $data) {
        return $this->db->update('kategori', $data, ['id' => $id]);
    }

    public function delete($id) {
        return $this->db->delete('kategori', ['id' => $id]);
    }
}
