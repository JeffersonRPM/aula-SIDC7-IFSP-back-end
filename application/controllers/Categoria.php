<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header('Access-Control-Allow-Methods: POST, OPTIONS');
	header('Access-Control-Allow-Headers: *');
	exit;
}

class Categoria extends CI_Controller {

	public function __construct() {
		parent::__construct();
	
		$this->load->model("categoriamodel");
	}
	

	public function adicionar() 
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		
		$p = (object) $this->input->post();

		if ($this->form_validation->run() == FALSE) {
			$rps = array(
				'status' => false,
				'erros' => validation_errors()
			);
		} else {
			$e = (object)[];
			$e->nome = $p->nome;
			$e->status = $p->status;
			
			if (!isset($p->id)) {
				$e->data_cad = date("Y-m-d H:i:s");

				$this->categoriamodel->inserir($e);

				$rps = array(
					'status' => true,
					'mensagem' => 'Cadastro realizado com sucesso!'
				);
			} else {
				$e->data_alt = date("Y-m-d H:i:s");
				$id = $p->id;

				$this->categoriamodel->alterar($id, $e);

				$rps = array(
					'status' => true,
					'mensagem' => 'Alteração realizada com sucesso!'
				);
			}
		}
		echo json_encode($rps);
	}

	public function listar() {
		
	}
}