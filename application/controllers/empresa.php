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
    # code...paren
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
echo 'aqui ';
         exit();
            $data = array();
            foreach($_POST as $key => $value) {   
               $data[$key] = $value; 
            }

               $nueva_empresa['emp_rif'] = $data['numregistro'];
               $nueva_empresa['emp_nombre'] = $data['NombreEmpresa'];
               $nueva_empresa['emp_acceso'] = 1;
               $nueva_empresa['emp_foto'] = $data['empresa_foto'];
               $nueva_empresa['emp_email_contacto'] = $data ['Email'];
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
        echo 'alla ';
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
        $nueva_empresa['emp_email_contacto'] = $data ['Email'];
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


}
?>