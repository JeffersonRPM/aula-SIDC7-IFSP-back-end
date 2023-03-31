<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoriamodel extends CI_Model {

    public function inserir($data) {
        $this->db->insert('categoria', $data);
    }

    public function alterar($id, $data) {
        $this->db->update('categoria', $data);
        $this->db->where('id', $id);
    }

}