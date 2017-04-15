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
        $this->load->model('model_profesor');
        $this->load->model('model_admin');
        $this->load->model('model_habilidades');
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
         if($tipo == 4){
          $id_pasante = $this->model_pasante->getIdPasante($idUser);
          $userData['Habilidades'] = $this->model_habilidades->getTodosHabilidadesNoPasante($id_pasante[0]->pas_id);
         }
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
          if($data1['usuario_foto']!=null or $data1['usuario_foto'] != ''){
            $usuario_foto = array (
              'usu_foto' =>$data1['usuario_foto']
              );
          $rsu2 = $this->model_usuario->actualizar_usuario2($data1['idUsuario'],$usuario_foto );
        }
        if($data1['emailUsuario']!=null or $data1['emailUsuario'] != ''){
            $usuario_foto = array (
              'usu_correo' =>$data1['emailUsuario']
              );
          $rsu2 = $this->model_usuario->actualizar_usuario2($data1['idUsuario'],$usuario_foto );
        }
          if($data1['idTipo'] == 6){
            //Se desconocen los procedimientos
          }elseif($data1['idTipo'] == 5){
            $usuario_empresa = array(
              'uem_nombre' => $data1['nombreUsuario'],
              'uem_apellido' => $data1['apellidoUsuario'],
              'uem_telefono' => $data1['telefonoUsuario']
            );
            $this->model_empresa->actualizar_usuario_empresa($data1['idUsuario'],$usuario_empresa);
          }elseif($data1['idTipo'] == 4){
            $pasante = array(
              'pas_nombre' => $data1['nombreUsuario'],
              'pas_apellido' => $data1['apellidoUsuario'],
              'pas_telefono' => $data1['telefonoUsuario']
            );
            $this->model_pasante->actualizar_pasante($data1['idUsuario'],$pasante);
          }elseif($data1['idTipo'] == 3){
            $profesor = array(
              'pro_nombre' => $data1['nombreUsuario'],
              'pro_apellido' => $data1['apellidoUsuario'],
              'pro_telefono' => $data1['telefonoUsuario']
            );
            $this->model_profesor->actualizar_profesor($data1['idUsuario'],$profesor);
          }elseif($data1['idTipo'] == 2){
             $cordinador = array(
              'ucor_nombre' => $data1['nombreUsuario'],
              'ucor_apellido' => $data1['apellidoUsuario'],
              'ucor_telefono' => $data1['telefonoUsuario']
            );
             $this->model_usuario->actualizar_usuario_coordinador($data1['idUsuario'],$cordinador);
          }elseif($data1['idTipo'] == 1){
             $administrador = array(
              'uadm_nombre' => $data1['nombreUsuario'],
              'uadm_apellido' => $data1['apellidoUsuario'],
              'uadm_telefono' => $data1['telefonoUsuario']
            );
             $this->model_admin->actualizar_usuario_admin($data1['idUsuario'],$administrador);
          }
          $this->load->view('layout/header',$userData);
          $this->load->view('layout/vmenu',$data);
          $this->load->view('contenido/perfil',$userData);
          $this->load->view('layout/footer');    
     }


     public function guardarHabilidades(){
         $idUser=$this->session->userdata('id');
         $tipo =$this->session->userdata('tipo');
         $rsu=$this->model_usuario->obtenerDataHeader($tipo,$idUser);
         $foto = null;
         $userData = array(
               'user' => $rsu,
               'Foto' =>$foto
          );  
          $data_us['menu'] =$this->model_usuario->menuPermisos($idUser);
          $data_us['user'] = $rsu;
        $data = array();
        foreach($_POST as $key => $value) {   
               $data[$key] = $value; 
        }
        $id_pasante = $this->model_pasante->getIdPasante($data['idUsuario']);
        foreach ($data['habilidadId'] as $row) {
            $datos['id_habilidad'] = $row;
            $datos['pas_id'] = $id_pasante[0]->pas_id;
            $this->model_habilidades->crearHabilidadPasante($datos);
        }
        $this->load->view('layout/header',$userData);
          $this->load->view('layout/vmenu',$data_us);
          $this->load->view('contenido/perfil',$userData);
          $this->load->view('layout/footer'); 
     }
    
}



 ?>
