<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Profesor extends CI_controller
{

  function __construct()
  {
      parent::__construct();
      $this->load->model('model_ubicacion');
      $this->load->model('model_habilidades');
      $this->load->model('model_empresa');
      $this->load->model('model_usuario');
      $this->load->model('model_tipoprofesor');
      $this->load->model('model_profesor');
  }

   public function gestionProfesor() {
      /*Esto siempre lo hago para cargar el menu dinamico a la vista*/
      $idUser=$this->session->userdata('id');
      $tipo =$this->session->userdata('tipo');
      $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
      $userData = array(
       'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
      );
    /*****************************************************************/
   
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('profesor/index');
        $this->load->view('profesor/footerProfesor');
  }
   /*Actualizada el 18-02-2017*/
  public function get_profesores(){
         $dato = $this->model_usuario->obtener_Profesores();
         echo json_encode($dato);
  }

  public function get_tipoProfesor(){
        $dato = $this->model_tipoprofesor->obtenerTiposProfesor();
         echo json_encode($dato); 
  }

    public function get_ProfesoresTipo(){
        $idEscuela = $this->input->post('idEscuela');
        $idTipo = $this->input->post('idTipo');
        $dato = $this->model_profesor->get_ProfesoresTipo($idEscuela,$idTipo);
        echo json_encode($dato);
    }

   public function crearProfesor(){
      $cedula = $this->input->post('cedula');
      $nombre = $this->input->post('nombre');
      $apellido = $this->input->post('apellido');
      $sexo = $this->input->post('sexo');
      $escuela = $this->input->post('escuela');
      $tipo = $this->input->post('tipo');
      $email = $this->input->post('email');
      $login = $this->input->post('login');
      $password = $this->input->post('password');
      $idUser = $this->model_usuario->insertar2($login,$password,3,$email);
      $data = array(
        'pro_cedula' => $cedula,
        'pro_nombre' => $nombre,
        'pro_apellido' => $apellido,
        'pro_sexo' =>$sexo,
        'id_usuario' =>$idUser,
        'id_escuela' =>$escuela,
        'id_tipo'=>$tipo
        );
        $actualizar = $this->model_profesor->crearProfesor($data);
        if($actualizar)
        {
            return 1;
        }
   }
}

?>