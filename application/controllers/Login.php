<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header('Access-Control-Allow-Methods: POST, OPTIONS');
	header('Access-Control-Allow-Headers: *');
	exit;
}

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model("Usuariomodel");
	}

	public function index() {
		if ($this->input->post('usuario') && 
				$this->input->post('senha')) {
					$usuario = $this->Usuariomodel->validar(
						$this->input->post('usuario'),
						$this->input->post('senha')
					);

					if (count($usuario) > 0){
						$usuario = $usuario[0];

						$sessao = array(
							'id_usuario' => $usuario->id,
							'nome' => $usuario->nome
						);

						$rps = array(
							'status' => true,
							'usuario' => $sessao
						);
					} else {
						$rps = array(
							'status' => false,
							'erro' => "Login não autorizado"
						);
					}
					echo json_encode($rps);
				}
	}
}