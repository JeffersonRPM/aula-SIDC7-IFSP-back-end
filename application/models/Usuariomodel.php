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
        $this->db->update('usuario', $data);
        $this->db->where('id', $id);
    }

}