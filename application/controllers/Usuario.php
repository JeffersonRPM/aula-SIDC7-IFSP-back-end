<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function adicionar() 
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required');

		$p = (object) $this->input->post();

		if ($this->form_validation->run() == FALSE) {
			$rps = array(
				'status' => false,
				'erros' => validation_erros()
			);
		} else {
			$e = (object)[];
			$e->nome = $p->nome;
			$e->email = $p->email;
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
	}
}