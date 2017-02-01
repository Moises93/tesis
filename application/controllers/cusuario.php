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
      $this->form_validation->set_message('login','Combinación de <strong>Nr de Identificacion</strong> y <strong>Contraseña</strong> inválida');
			return FALSE;
    }else{
        $menu='menu';
        $contenido='vPrueba';
       // echo "ejejle".$this->model_usuario->existe($param);
         $idUser=$this->session->userdata('id');
        // echo $idUser;
         $permiso = $this->model_usuario->permisosUsuario($idUser);
       // echo '<pre>'; print_r($permiso); echo '</pre>';
        foreach($permiso as $result) {
           // echo $result['id_menu'], '<br>';
            $idMenu = $result['id_menu'];
            $menu =  $this->model_usuario->MenuPorId($idMenu);
            echo "-".$menu->id_menu;
            echo "-".$menu->nombre;
            //print_r($menu);
            //$submenu = $this->model_usuario->subMenus($idMenu);
          //  echo '<pre>'; print_r($menu); echo '</pre>';
           // $mode = current($menu); //obtengo la primera posicion de un array
            //echo $mode['url'];
            /*$menuUser = array(
              'nombre' => $menu

            );*/

            /*$menuUser = array(
                'nombre' => $tipo,
                'url' => $login,
                'usu_clave' => $clave,
                'usu_estatus' => 1,
                'usu_correo' => $correo,

            );*/
        }


        $tipo_usuario= $this->model_usuario->existe($param);
        
        //intento validar que tipo de usuario es para cargar el menu
        if($tipo_usuario='administrador'){
            $menu='vmenu';
            $contenido='vPrueba';

        }
            $this->load->view('layout/header');
            $this->load->view('contenido/'.$menu);
            $this->load->view('contenido/'.$contenido);
            $this->load->view('layout/footer');

    }

	}

    public function consultar_usuarios()
    {
        $consulta= $this->model_usuario->consultar_usuarios();

        return $consulta;
    }


  
  public function index(){
    $this->load->view('vPrueba');
  }


}



 ?>
