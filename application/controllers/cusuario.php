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

    if(!$this->model_usuario->existe($param)){
      $this->form_validation->set_message('login','Combinación de <strong>Nr de Identificacion</strong> y <strong>Contraseña</strong> inválida');
			return FALSE;
    }else{
       // echo "ejejle".$this->model_usuario->existe($param);
       // echo 'aqui encontre algo util ' .$this->session->userdata('Login');
            $idUser=$this->session->userdata('id');

            $data['menu'] =$this->model_usuario->menuPermisos($idUser);
            $this->load->view('layout/header');
            $this->load->view('layout/vmenu',$data);
            $this->load->view('contenido/vPrueba');

            $this->load->view('layout/footer');

    }

	}

    public function consultar_usuarios()
    {
        $consulta= $this->model_usuario->consultar_usuarios();

        return $consulta;
    }
/*sin uso po ahora , lo habia creado llenar el arbol de mantenimiento de permisos*/
    public function obtenerMenu()
    {
        $idUser=$this->session->userdata('id');
//&data['menu']
        $data =$this->model_usuario->menuPermisos($idUser);
        echo json_encode($data);
        //return $data;
    }

  
  public function index(){
    $this->load->view('vPrueba');
  }


}



 ?>
