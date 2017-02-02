<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @property  form_validation
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
        $menu='menu';
        $contenido='vPrueba';
       // echo "ejejle".$this->model_usuario->existe($param);
        echo 'aqui encontre algo util ' .$this->session->userdata('Login');
        $id_usuario = $this->session->userdata('id');
        $menu = $
       /* $tipo_usuario = $this->model_usuario->existe($param);
        //intento validar que tipo de usuario es para cargar el menu
        if($tipo_usuario='administrador'){
            $menu='vmenu';
            $contenido='vPrueba';
            echo 'entre al if'.$menu;
        }*/



            $this->load->view('layout/header');
            $this->load->view('contenido/vmenu/');
            $this->load->view('contenido/'.$contenido);
            $this->load->view('layout/footer');

    }

	}

    public function consultar_usuarios()
    {
        $consulta= $this->model_usuario->consultar_usuarios();

        return $consulta;
    }


  
  public function index(){
    $this->load->view('vPrueba');
  }


}



 ?>
