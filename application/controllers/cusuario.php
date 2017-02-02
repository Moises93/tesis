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
        $cont=0;
        $menu='menu';
        $contenido='vPrueba';
<<<<<<< HEAD
       // echo "ejejle".$this->model_usuario->existe($param);
        echo 'aqui encontre algo util ' .$this->session->userdata('Login');
        $id_usuario = $this->session->userdata('id');
        $menu = $
       /* $tipo_usuario = $this->model_usuario->existe($param);
        //intento validar que tipo de usuario es para cargar el menu
        if($tipo_usuario='administrador'){
            $menu='vmenu';
            $contenido='vPrueba';
            echo 'entre al if'.$menu;
        }*/



            $this->load->view('layout/header');
            $this->load->view('contenido/vmenu/');
            $this->load->view('contenido/'.$contenido);
=======
        $idUser=$this->session->userdata('id');
        $padres = $this->model_usuario->permisosUsuarioPadres($idUser);
        // echo '<pre>'; print_r($padres); echo '</pre>';
        foreach($padres as $result) {

            $menu =array(
                'id_menu'    => $result['id_menu'],
                'id_padre'   => $result['id_menu'],
                'nombre'     => $result['nombre'],
                'url'        => $result['url'],
                'clase'      => $result['clase'],
                'activo'     => $result['activo'],
                'hijos'      => null

             );
            $idMenu = $result['id_menu'];
            $hijos =  $this->model_usuario->permisosUsuarioHijos($idMenu,$idUser);
            //echo "hijos";
            //echo '<pre>'; print_r($hijos); echo '</pre>';
          // echo "cantidad de hijos" .count($hijos);
            if( count($hijos) > 0){
              $menu['hijos']=$hijos;
            }
            if($cont>0){
                array_push($menuUser, $menu);
            }else{
                $menuUser[$cont] =$menu;
            }
          //  echo "menu";
           echo '<pre>'; print_r($menuUser); echo '</pre>';
            $cont= $cont+1;
           // echo "-".$menu->id_menu;
            //echo "-".$menu->nombre;
        }


        $tipo_usuario= $this->model_usuario->existe($param);
        
        //intento validar que tipo de usuario es para cargar el menu
            $data['menu'] = $menuUser;
            $this->load->view('layout/header');
            $this->load->view('contenido/vmenu',$data);
            $this->load->view('contenido/vPrueba');
>>>>>>> 7bc1a20230feadb667ea43c6ce165a34cdc4d4fb
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
