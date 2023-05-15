<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtomodel extends CI_Model {
    function __construct() {

    }

    public function inserir($data) {
        $this->db->insert('produto', $data);
    }

    public function alterar($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('produto', $data);
    }

    public function excluir($id) {
        $this->db->where('id', $id);
        $this->db->delete('produto');
    }

    public function listar() {
        $this->db->from('produto');
        $this->db->order_by('nome', 'asc');

        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }

}