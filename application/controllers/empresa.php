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
    # code...paren
  }

  public function index(){
  #  $this->load->helper('url');
    $this->load->view('login');
  }


  public function registroEmpresa(){
     $paises = $this->model_ubicacion->getTodosPaises();
     $estados = $this->model_ubicacion->getTodosEstados();

     $data = array(
        'Paises' => $paises,
        'Estados' =>$estados
      );

  	 $this->load->view('layout/registerheader');
     $this->load->view('registroempresa/index',$data);
  }
}




 ?>