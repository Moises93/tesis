<?php
/**
 * Created by PhpStorm.
 * User: eheredia
 * Date: 18/01/2017
 * Time: 1:06 PM
 */

class cadministrador extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        # code...paren

        $this->load->model('model_usuario');
        $this->load->model('model_admin');
    }


    public function mantenimiento_usuarios()
    {
        $this->load->library('table');
        $this->load->library('pagination');

        $idUser=$this->session->userdata('id');

        $data['menu'] =$this->model_usuario->menuPermisos($idUser);
        $this->load->view('layout/header');
        $this->load->view('layout/vmenu',$data);
        $this->load->view('contenido/vmantenimiento_usuarios');
        $this->load->view('contenido/footerAdmin');
        
    }
    /**/
    public function get_usuario(){
         $dato = $this->model_usuario->consultar_usuarios();
         echo json_encode($dato);
    }

    public function obtenerUsuariosTipos(){
        $idTipo = $this->input->post('tipo');
        $dato = $this->model_usuario->obtenerUsuariosTipos($idTipo);
        echo json_encode($dato);


    }

    public function get_tipo(){
        $dato = $this->model_usuario->getTipo();;
        echo json_encode($dato);


    }
/* lo uso para llenar la tabla del mantenimiento de menus*/
    public function getMenu(){
        $cont=0;
        $idUser = $this->input->post('user');
        $dato = $this->model_admin->getMenu();
        //traerme los permisos del usuario
        $permisos = $this->model_usuario->permisosUsuario($idUser);

        foreach($dato as $result) {
            $menu = array(
                'id_menu' => $result['id_menu'],
                'id_padre' => $result['id_padre'],
                'nombre' => $result['nombre'],
                'url' => $result['url'],
                'clase' => $result['clase'],
                'activo' => $result['activo'],
                'permisos' => $permisos

            );
            if($cont>0){
                array_push($menuUser, $menu);
            }else{
                $menuUser[$cont] =$menu;
            }
            $cont= $cont+1;
        }
        //$dato = $this->model_admin->getMenu();
       //return $dato->fetchAll();
      //  array_push($dato, $idUsere);
          echo json_encode($menuUser);
    }
    /**/

    public function nombrePadre(){
        $idPadre = $this->input->post('idPadre');

        $dato= $this->model_admin->nombrePadre($idPadre);

        echo json_encode($dato);


    }

   
    public function cambiaEstatus(){
        $idUsuario = $this->input->post('idUsuario');
        $estatus=$this->input->post('estatus');
        $dato= $this->model_usuario->cambiaEstatus($idUsuario,$estatus);
        echo json_encode($dato);


    }

    public function val_login(){
        $usu_login = $this->input->post('login');
        
       $dato= $this->model_usuario->valLogin($usu_login);
        echo json_encode($dato);

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

    public function crear_usuario()
    {
        $data['tipo'] = $this->model_usuario->getTipo();

        $idUser=$this->session->userdata('id');

        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $this->load->view('layout/header');
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('contenido/vcrear_usuario',$data);
        $this->load->view('contenido/footerAdmin');

    }


    public function permisos()
    {

        $idUser=$this->session->userdata('id');

        $data['menu'] =$this->model_usuario->menuPermisos($idUser);
        $this->load->view('layout/header');
        $this->load->view('layout/vmenu',$data);
        $this->load->view('contenido/vpermisos');
        $this->load->view('contenido/footerAdmin');

    }
    
    
    public function insertarU()
    {
        $login= $this->input->post('login');
        $clave= $this->input->post('clave');
        $tipo= $this->input->post('tipo');
        $correo= $this->input->post('email');


        $this->model_usuario->insertar($login,$clave,$tipo,$correo);

        $idUser=$this->session->userdata('id');

        $data['menu'] =$this->model_usuario->menuPermisos($idUser);
        $this->load->view('layout/header');
        $this->load->view('layout/vmenu',$data);
        $this->load->view('contenido/vcrear_usuario');
        $this->load->view('contenido/footerAdmin');
    }



}