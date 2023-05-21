<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoriamodel extends CI_Model {
    function __construct() {

    }

    public function inserir($data) {
        $this->db->insert('categoria', $data);
    }

    public function alterar($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('categoria', $data);
    }

    public function excluir($id) {
        $this->db->where('id', $id);
        $this->db->delete('categoria');
    }

    public function listar() {
        $this->db->from('categoria');
        $this->db->order_by('nome', 'asc');

        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }

    public function listarcategoria() {
        $this->db->select('id, nome');
        $this->db->from('categoria');
        $this->db->order_by('nome', 'asc');

        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }

    public function filtrar($array) {
        $this->db->from('categoria');

        foreach($array as $item => $value) {
            if ($item == 'nome') 
                $this->db->like($item, $value, 'both');
            else
                $this->db->where($item, $value);
        }

        $this->db->order_by('nome'); 
        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }
}