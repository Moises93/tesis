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
          redirect('/cusuario/vlogin/error');//Llamo a la funcion vlogin con una variable de error
        }else{
            
            $idUser=$this->session->userdata('id');
            $tipo =$this->session->userdata('tipo');
            $rsu=$this->model_usuario->obtenerDataHeader($tipo,$idUser);
            $userData = array(
               'user' => $rsu
            );
            
            $data['menu'] =$this->model_usuario->menuPermisos($idUser);
            //print_r($this->session->userdata());
            $this->load->view('layout/header',$userData);
            $this->load->view('layout/vmenu',$data);
            $this->load->view('contenido/vPrueba');
            $this->load->view('layout/footer');
        }
	}
    
    /*Funcion Vlogin que direcciona a la pagina de registro */
    public function vlogin(){
        $data["message"] = NULL;
        @$data["message"]=$this->uri->segment(3);//capturo variable de error por get
        $this->load->view('vlogin',$data);
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

    public function updUsuario(){
        $id_usuario = $this->input->post('mhdnIdUsuario');
        $id_tipo = $this->input->post('tipo');
        $usu_login = $this->input->post('mtxtLogin');
        $usu_clave = $this->input->post('mtxtClave');
        $usu_correo = $this->input->post('mtxtCorreo');
        $actualizar = $this->model_usuario->actualizar_usuario($id_usuario,$id_tipo,$usu_login,$usu_clave,$usu_correo);
        echo $actualizar;
        if($actualizar)
        {
            //$this->session->set_flashdata('actualizado', 'El mensaje se actualizó correctamente');
            return 1;
        }
    }

    public function logout(){
        $this->model_usuario->signOutUser();
        redirect('/cusuario/vlogin');
    }
}



 ?>
