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

   public function crearProfesor(){
       /* $nombre = $this->input->post('nombre');
        $id_padre= $this->input->post('padre');
        $url= $this->input->post('url');
        $clase = $this->input->post('clase');
        $actualizar = $this->model_admin->crearMenu($nombre,$id_padre,$url,$clase);
        echo $actualizar;
        if($actualizar)
        {
            //$this->session->set_flashdata('actualizado', 'El mensaje se actualizó correctamente');
            return 1;
        }*/
   }
}

?>