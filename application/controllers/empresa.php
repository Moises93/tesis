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
           /* $hola1 = count($data);
            $array = array_keys($data); 
            $hola = count($array); 
            $casa = $array[9];
            $perro = $data[$casa];*/

             $data1 = array(
        'Paises' => $data
      );
      
       $this->load->view('layout/registerheader');
        $this->load->view('registroempresa/prueba',$data1);
      
    }
}




 ?>