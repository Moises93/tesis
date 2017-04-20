<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Empresa extends CI_controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('model_ubicacion');
    $this->load->model('model_habilidades');
    $this->load->model('model_empresa');
    $this->load->model('model_usuario');
    $this->load->model('model_pasante');
    $this->load->model('model_pasantia');
    $this->load->library('pagination');
  }

  public function index(){
  #  $this->load->helper('url');
    $this->load->view('login');
  }

  // Envia lista de paises y estados a la vista de Registro
  public function registroEmpresa(){
     $paises = $this->model_ubicacion->getTodosPaises();
     $estados = $this->model_ubicacion->getTodosEstados();
     $habilidades = $this->model_habilidades->getTodosHabilidadesComputacion();
     $foto = null;
     $data = array(
        'Paises' => $paises,
        'Estados' =>$estados,
        'Habilidades' =>$habilidades,
        'Foto' => $foto
      );
  	 $this->load->view('layout/registerheader');
     $this->load->view('registroempresa/index',$data);
  }

  // Devuelve Estados x Pais, en un JSON
  public function EstdadosxPais() {
    // Toma Variable por POST
    $idsuc = $this->input->post('pais'); 
  
    // Select
    $rs = $this->model_ubicacion->getEstadoxPais($idsuc);

    // Valida
    if ($rs){
      $estados = $rs->result();
    }else{
      $estados = array();
    }
    // Codifica
    $json = json_encode($estados);
    echo $json;
  }

     public function guardarEmpresa(){

         
            $data = array();
            foreach($_POST as $key => $value) {   
               $data[$key] = $value; 
            }

               $nueva_empresa['emp_rif'] = $data['numregistro'];
               $nueva_empresa['emp_nombre'] = $data['NombreEmpresa'];
               $nueva_empresa['emp_acceso'] = 1;
               $nueva_empresa['emp_foto'] = $data['empresa_foto'];
               $nueva_empresa['emp_correo'] = $data ['Email'];
               $id_empresa = $this->model_empresa->crearEmpresa($nueva_empresa);

               foreach ($data['habilidadId'] as $row) {
                 $datos['emp_id'] = $id_empresa;
                 $datos['id_habilidad'] = $row;
                 $this->model_habilidades->crearHabilidadEmpresa($datos);
               }
               $ubicacion['emp_id'] = $id_empresa;
               $ubicacion['ciudad'] = $data['Ciudad'];
               $ubicacion['sector'] = $data['Sector'];
               $ubicacion['direccion'] = $data['Direccion'];
               $ubicacion['pais_id'] = $data['paisId'];
               $ubicacion['estado_id'] = $data['estadoId'];
               $this->model_ubicacion->crearUbicacion($ubicacion);



             $data1 = array(
        'Paises' => $data
      );

        $this->load->view('layout/registerheader');
        $this->load->view('login',$data1);
      
    }

    public function registrarEmpresa(){

        $data = array();
        foreach($_POST as $key => $value) {
            $data[$key] = $value;
        }

        $nueva_empresa['emp_rif'] = $data['numregistro'];
        $nueva_empresa['emp_nombre'] = $data['NombreEmpresa'];
        $nueva_empresa['emp_acceso'] = 1;
        if (isset($data['empresa_foto'])) {
            $nueva_empresa['emp_foto'] = $data['empresa_foto'];
        }
        $nueva_empresa['emp_correo'] = $data ['Email'];
        $nueva_empresa['emp_telefono'] = $data['telefono'];
        $id_empresa = $this->model_empresa->crearEmpresa($nueva_empresa);

        foreach ($data['habilidadId'] as $row) {
            $datos['emp_id'] = $id_empresa;
            $datos['id_habilidad'] = $row;
            $this->model_habilidades->crearHabilidadEmpresa($datos);
        }

        foreach ($data['escuelaId'] as $row) {
            $escuela['emp_id'] = $id_empresa;
            $escuela['id_escuela'] = $row;
            $this->model_empresa->crearEscuelaEmpresa($escuela);
        }
        
        $ubicacion['emp_id'] = $id_empresa;
        $ubicacion['ciudad'] = $data['Ciudad'];
        $ubicacion['sector'] = $data['Sector'];
        $ubicacion['direccion'] = $data['Direccion'];
        $ubicacion['pais_id'] = $data['paisId'];
        $ubicacion['estado_id'] = $data['estadoId'];
        $this->model_ubicacion->crearUbicacion($ubicacion);
        header("Location: http://localhost/tesis/cadministrador/gestionEmpresa");

    }



    public function getEmpresa(){
        $dato = $this->model_empresa->getEmpresa();
        echo json_encode($dato);


    }


    public function getUsuarioEmpresa(){
        $dato = $this->model_empresa->getUsuarioEmpresa();
        echo json_encode($dato);


    }
    public function getUsuarioDeEmpresa(){
        $EmpId= $this->input->post('empId');
        $dato = $this->model_empresa->getUsuarioDeEmpresa($EmpId);
        echo json_encode($dato);


    }

 public function agregarUsuarioE(){
     $cedula= $this->input->post('cedula');
     $nombre= $this->input->post('nombre');
     $apellido= $this->input->post('apellido');
     $sexo= $this->input->post('sexo');
     $correo= $this->input->post('email');
     $empresa= $this->input->post('empresa');
     $telefono= $this->input->post('telefono');
     $tipoUe= $this->input->post('tipo');
     $login= $this->input->post('login');
     $clave= $this->input->post('clave');

     $tipo=5; //QUITAR HARCODEO Y CONSULTAR EL ID DEL PASANTE

     $this->model_usuario->insertar($login,$clave,$tipo,$correo);

     $data =$this->model_usuario->obtenerIdUsuarios($login);

     $id_usuario =$data->id_usuario;

     return $this->model_empresa->agregarUsuarioE($cedula,$nombre,$apellido,$sexo,$empresa,$id_usuario,$tipoUe,$telefono);
 }
    public function updUsuarioE(){

        $idusuario_empresa = $this->input->post('id');
        $uem_telefono = $this->input->post('telefono');
        $uem_cedula= $this->input->post('cedula');
        $uem_nombre = $this->input->post('nombre');
        $uem_apellido = $this->input->post('apellido');
        $idUser=$this->input->post('usuario');
        $correo =$this->input->post('correo');
        
        $usu=$this->model_usuario->actualizar_correo($idUser,$correo);
        $actualizar = $this->model_empresa->updUsuarioE($idusuario_empresa,$uem_nombre,$uem_cedula,$uem_apellido,$uem_telefono);

        if ($usu != FALSE && $actualizar != FALSE){
            echo('Actualización Exitosa!!');
        }else{
            echo('Ocurrio un error');
        }
    }

    public function actualizarEmpresa(){

        $id = $this->input->post('id');
        $telefono = $this->input->post('telefono');
        $rif= $this->input->post('rif');
        $nombre = $this->input->post('nombre');
        $correo =$this->input->post('correo');

        $actualizar = $this->model_empresa->actualizarEmpresa($id,$rif,$nombre,$correo,$telefono);

        if ($actualizar != FALSE){
            echo('Actualización Exitosa!!');
        }else{
            echo('Ocurrio un error');
        }
    }

    public function obtenerPasantes(){
        $resultado=array();
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        /*Si es tipo prfesor muestro solo sus pasantes y si es usauario admin traigo todos*/

            $rsu=$this->model_usuario->obtenerDataHeader($tipo,$idUser);
            $idUe= $rsu[0]->idusuario_empresa;

            $pas=$this->model_empresa->obtenerPasantias($idUe);


        foreach ($pas as $pas => $row){
            $idPa=$row['pas_id']; //obtener Id-pasante
            $idPas=$row['id_pasantia'];  //obtener Id_Pasantia
            $result=$this->model_pasantia->obtenerPasantiaActiva($idPas);
            $pasantia =array(
                'id_pasantia'    => $result['id_pasantia'],
                'modalidad'      => $result['modalidad'],
                'estatus'        => $result['estatus'],
                'fecha_inicio'   => $result['fecha_inicio'],
                'fecha_final'    => $result['fecha_final'],
                'cedula'         => $result['pas_cedula'],
                'pas_id'         => $result['pas_id'],
                'sexo'           => $result['pas_sexo'],
                'nombre'         => $result['pas_nombre'],
                'apellido'       => $result['pas_apellido'],
                'telefono'       => $result['pas_telefono'],
                'login'          => $result['usu_login'],
                'correo'         => $result['usu_correo'],
                'foto'           => $result['usu_foto'],
                'escuela'        => $result['esc_nombre'],
                'orgaca'         => $result['orgaca'],
                'universidad'    => 'Universidad de Carabobo',
                'empresa_id'     => $result['emp_id'],
                'empresa'        => $result['emp_nombre'],
                'id_escuela'     => $result['id_escuela'],
                'TutorEmp'       => 0,
                'integrantes'    => null,
                'requisitos'     => null

            );

            $requisitos=$this->model_pasantia->consultarRequisitos($idPa);
            $integrantes =  $this->model_pasantia->getIntegrantesPas($idPas);
            if(count($requisitos)>0) {
                $pasantia['requisitos']=$requisitos;
            }
   
            if( count($integrantes) > 0){
                $pasantia['integrantes']=$integrantes;
            }
            array_push($resultado, $pasantia);
        }
        echo json_encode($resultado);

    }

    //Ultima actualizacion el dia 15-03-2017//
    public function misPasantes(){
            $idUser=$this->session->userdata('id');
            $tipo =$this->session->userdata('tipo');
            $rsu=$this->model_usuario->obtenerDataHeader($tipo,$idUser);
            $userData = array(
               'user' => $rsu
            );
             $quiz['preguntas']=$this->model_pasantia->obtenerPreguntas();
             $quiz['respuestas']=$this->model_pasantia->obtenerRespuestas();
            $rsul = $this->model_pasante->getPasantesporEmpresa($rsu[0]->Id);
            $principal=1;
            $pasantes = array(
               'Pasantes' => $rsul,
                'preguntas' => $quiz['preguntas'],
                'respuestas' => $quiz['respuestas'],
                'principal' =>$principal
            );
             $data['menu'] =$this->model_usuario->menuPermisos($idUser);
             $data['user'] = $rsu;
            $this->load->view('layout/header',$userData);
            $this->load->view('layout/vmenu',$data);
            $this->load->view('empresa/misPasantes',$quiz);
            $this->load->view('empresa/footerEmpresa');
    }
    
    
    public function listaEmpresas(){
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $rsu=$this->model_usuario->obtenerDataHeader($tipo,$idUser);
        $userData = array(
            'user' => $rsu
        );

        $total = $this->model_empresa->getCountPostulados();
        $config = array();
        $config["base_url"] = base_url() . "empresa/listaEmpresas";
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
        $rsul =$this->model_empresa->getEmpresaPaginada($config["per_page"], $page);
        $str_links = $this->pagination->create_links();

        //Fin de Traer Postulados Paginados
        $principal=0;
        $empresas = array(
            'Empresa' => $rsul,
            'principal' =>$principal
        );
        $empresas['links'] = explode('&nbsp;',$str_links);
        $data['menu'] =$this->model_usuario->menuPermisos($idUser);
        $data['user'] = $rsu;
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$data);
        $this->load->view('empresa/listaEmpresas',$empresas);
        $this->load->view('empresa/footerEmpresa');
    }

    
    
    public function valorarEmpresa(){
        $idemp = $this->input->post('idemp');
        $valor = $this->input->post('valor');
        $comentario = $this->input->post('comentario');
        $idUser=$this->session->userdata('id');

        $existe=$this->model_empresa->consultarValoracion($idUser,$idemp);
        if(count($existe)>0){
            $this->model_empresa->actualizarValoracionEmpresa($idemp,$valor,$idUser,$comentario);
        }else{
            $this->model_empresa->guardarValoracionEmpresa($idemp,$valor,$idUser,$comentario);
        }
        $this->actualizarRating($idemp);
    }
    public function actualizarRating($idemp){

        $dato=$this->model_empresa->consultarRating($idemp);
        print_r($dato);
        $this->model_empresa->actualizarRating($dato,$idemp);
      
      /*  if(count($dato)>0){
        
        } else{
            $this->model_empresa->guardarValoracionEmpresa($idemp,$valor,$idUser,$comentario);
        }*/
    
        //  print_r($dato);
    }
    
    public function perfilEmpresa($id){
        /*cabecera y permisos de menu*/
        $data['tipo'] = $this->model_usuario->getTipo();
        /*Esto siempre lo hago para cargar el menu dinamico a la vista y el header*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        /*****************************************************************/
        $empresas= $this->model_empresa->getEmpresaPorId($id);
        $comentarios= $this->model_empresa->getComentariosEmpresa($id);
      // print_r($empresas);
       //print_r($comentarios);
        $perfil = array(
            'Empresa' => $empresas,
            'Comentarios' =>$comentarios
        );


      //  exit();
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('empresa/perfilEmpresa',$perfil);
        $this->load->view('contenido/footerAdmin');
    }

}
?>