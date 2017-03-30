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
    $this->load->model('model_pasante');
    $this->load->model('model_pasantia');
    $this->load->model('model_empresa');
  }


  public function inicio(){
     $idUser=$this->session->userdata('id');
     $tipo =$this->session->userdata('tipo');
     $rsu=$this->model_usuario->obtenerDataHeader($tipo,$idUser);
      $userData = array(
               'user' => $rsu
      );
            
      $data['menu'] =$this->model_usuario->menuPermisos($idUser);
      $data['user'] = $rsu;
      //print_r($this->session->userdata());
      $this->load->view('layout/header',$userData);
      $this->load->view('layout/vmenu',$data);
      if($tipo==4){
          //deberias aqui llamar a un modelo que te traiga todas las empresasy mandar
          //esa informacion como un array a la vista    $this->load->view('pasante/vpasante',ARRAY); 
          $this->load->view('pasante/vpasante');
          $this->load->view('layout/footer');
      }elseif($tipo==5){
          $quiz['preguntas']=$this->model_pasantia->obtenerPreguntas();
          $quiz['respuestas']=$this->model_pasantia->obtenerRespuestas();
          $rsu=$this->model_pasante->getPostulados();
          $principal=0;

          $pasantes = array(
              'Pasantes' => $rsu,
              'preguntas' => $quiz['preguntas'],
              'respuestas' => $quiz['respuestas'],
              'principal' =>$principal
          );
          $this->load->view('empresa/dashboardEmpresa',$pasantes);
          $this->load->view('empresa/footerEmpresa');
          }elseif(true){ 
          $this->load->view('contenido/vPrueba');
          $this->load->view('layout/footer');
        }   
  }
    public function login()
  {
        $param['nombre'] = $this->input->post('usuario');
        $param['clave'] = $this->input->post('password');
        if(!$this->model_usuario->existe($param)){
          redirect('/cusuario/vlogin/error');//Llamo a la funcion vlogin con una variable de error
        }else{
            
             redirect('/cusuario/inicio');
            
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
    public function perfil(){

      //  $idUsuario =$this->uri->segment(3);
         $idUser=$this->session->userdata('id');
         $tipo =$this->session->userdata('tipo');
         $rsu=$this->model_usuario->obtenerDataHeader($tipo,$idUser);
         $foto = null;
         $userData = array(
               'user' => $rsu,
               'Foto' =>$foto
            );
            
            $data['menu'] =$this->model_usuario->menuPermisos($idUser);
            $data['user'] = $rsu;
         $this->load->view('layout/header',$userData);
         $this->load->view('layout/vmenu',$data);
         $this->load->view('contenido/perfil',$userData);
         $this->load->view('layout/footer');
    }
    public function logout(){
        $this->model_usuario->signOutUser();
        redirect('/cusuario/vlogin');
    }
    
    public function cambiarClave(){
        $idUsu=$this->input->post('id');
        $clave =$this->input->post('clave');
        $dato= $this->model_usuario->cambiarClave($idUsu,$clave);
        
        if ($dato != FALSE ){
            echo('Actualización Exitosa!!');
        }else{
            echo('Ocurrio un error');
        }
    }

      public function guardarUsuario(){
          $idUser=$this->session->userdata('id');
         $tipo =$this->session->userdata('tipo');
         $rsu=$this->model_usuario->obtenerDataHeader($tipo,$idUser);
         $foto = null;
         $userData = array(
               'user' => $rsu,
               'Foto' =>$foto
            );
            
            $data['menu'] =$this->model_usuario->menuPermisos($idUser);
            $data['user'] = $rsu;
        $data1 = array();
            foreach($_POST as $key => $value) {   
               $data1[$key] = $value; 
        }
        $rsu2 = $this->model_usuario->actualizar_usuario2($data1['idUsuario'],$data1['usuario_foto']);

         $this->load->view('layout/header',$userData);
         $this->load->view('layout/vmenu',$data);
         $this->load->view('contenido/perfil',$userData);
         $this->load->view('layout/footer');    
     }
    
}



 ?>
