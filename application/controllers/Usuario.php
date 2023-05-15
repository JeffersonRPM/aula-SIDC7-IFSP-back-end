<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header('Access-Control-Allow-Methods: POST, OPTIONS');
	header('Access-Control-Allow-Headers: *');
	exit;
}

class Usuario extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model("usuariomodel");
	}

	public function adicionar() 
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required');
		$this->form_validation->set_rules('confsenha', 'Confirmação de Senha', 'trim|required');

		$p = (object) $this->input->post();
		$erros = '';
		if ($p->confsenha != $p->senha) {
			$erros .= "Senha e Confirmação de senha não correspondem";
		}

		if ($this->form_validation->run() == FALSE || $erros != '') {
			$rps = array(
				'status' => false,
				'erros' => validation_errors().$erros,
			);
		} else {
			$e = (object)[];
			$e->nome = $p->nome;
			$e->email = $p->email;
			$e->status = $p->status;
			$e->senha = $p->senha;

			if (!isset($p->id)) {
				$e->data_cad = date("Y-m-d H:i:s");

				$this->usuariomodel->inserir($e);

				$rps = array(
					'status' => true,
					'mensagem' => 'Cadastro realizado com sucesso!'
				);
			} else {
				$e->data_alt = date("Y-m-d H:i:s");
				$id = $p->id;

				$this->usuariomodel->alterar($id, $e);

				$rps = array(
					'status' => true,
					'mensagem' => 'Alteração realizada com sucesso!'
				);
			}
		}
		echo json_encode($rps);
	}

	public function listar() {
		
		$cat = $this->usuariomodel->listar();

		$data = array();

			foreach ($cat as $linha) {
				$linha->id = intval($linha->id);
				$linha->data_cad = date("d/m/Y H:i:s", strtotime($linha->data_cad));
				if ($linha->data_alt != null)
				$linha->data_alt = date("d/m/Y H:i:s", strtotime($linha->data_alt));

				$data[] = $linha;
			}

		$rps = array(
			'status' => true,
			'obj' => $data
		);

		echo json_encode($rps);
	}
}