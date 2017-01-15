<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Cusuario extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
 		$this->load->model('model_usuario');
  }

  public function login()
	{
		$param['nombre'] = $this->input->post('usuario');
    $param['clave'] = $this->input->post('password');
    // $param['clave'] = $this->encrypt->sha1($this->input->post('password'));

    if(!$this->model_usuario->existe($param)){
      $this->form_validation->set_message('login','Combinación de <strong>Nr de Identificacion</strong> y <strong>Contraseña</strong> inválida');
			return FALSE;
    }else{
          $this->load->view('layout/header');
            $this->load->view('layout/menu');
            $this->load->view('vPrueba');
              $this->load->view('layout/footer');
    }

	}

  public function index(){
    $this->load->view('vPrueba');
  }


}



 ?>
