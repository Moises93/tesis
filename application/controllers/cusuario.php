<?php 

/**
 *
 * @property  form_validation
 */
class Cusuario extends CI_Controller
{
    
  function __construct()
  {
        parent:: __construct();
        $this->load->library('form_validation');
        $this->load->model('model_usuario');
        $this->load->model('model_pasante');
        $this->load->model('model_pasantia');
        $this->load->model('model_empresa');
        $this->load->library('pagination');
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
        //Deberiamos separa estas secciones en funciones mas pequeñas.
        //Configuracion Paginacion
         $total = $this->model_pasante->getCountPostulados();
          $config = array();
          $config["base_url"] = base_url() . "cusuario/inicio";
          $config["total_rows"] = $total[0]->Total;
          $config["per_page"] = 9;
          $config['use_page_numbers'] = TRUE;
          $config['num_links'] = 4;
          $config['cur_tag_open'] = '&nbsp;<a class="active">';
          $config['cur_tag_close'] = '</a>';
          $config['next_link'] = '>';
          $config['prev_link'] = '<';
          $this->pagination->initialize($config);
            if($this->uri->segment(3)){
              $page = (int)($this->uri->segment(3))-1 ;
              $page *= $config["per_page"];
            }
            else{
              $page = 1;
            }
        //Fin Configuracion Paginacion
        //Traer Postulados Paginados
            $rsu =$this->model_pasante->getPostulados($config["per_page"], $page);
            $str_links = $this->pagination->create_links();
            
        //Fin de Traer Postulados Paginados
          $quiz['preguntas']=$this->model_pasantia->obtenerPreguntas();
          $quiz['respuestas']=$this->model_pasantia->obtenerRespuestas();
          $principal=0;
          $pasantes = array(
              'Pasantes' => $rsu,
              'preguntas' => $quiz['preguntas'],
              'respuestas' => $quiz['respuestas'],
              'principal' =>$principal
          );
              $pasantes['links'] = explode('&nbsp;',$str_links);
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
