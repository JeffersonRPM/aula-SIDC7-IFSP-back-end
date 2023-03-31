<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	public function adicionar() 
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
		
		$p = (object) $this->input->post();

		if ($this->form_validation->run() == FALSE) {
			$rps = array(
				'status' => false,
				'erros' => validation_erros()
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
	}
}