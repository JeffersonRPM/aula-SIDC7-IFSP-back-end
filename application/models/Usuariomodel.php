<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuariomodel extends CI_Model {
    function __construct() {

    }

    public function validar($login, $senha) {
        $this->db->from('usuario');
        $this->db->where('email', $login);
        $this->db->where('senha', $senha);
        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }

    public function inserir($data) {
        $this->db->insert('usuario', $data);
    }

    public function alterar($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('usuario', $data);
    }

    public function excluir($id) {
        $this->db->where('id', $id);
        $this->db->delete('usuario');
    }

    public function listar() {
        $this->db->from('usuario');
        $this->db->order_by('nome', 'asc');

        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }

    public function filtrar($array) {
        
        $this->db->from('usuario');      

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