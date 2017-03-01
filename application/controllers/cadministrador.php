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
        $this->load->model('model_ubicacion');
        $this->load->model('model_habilidades');
    }


    public function mantenimiento_usuarios()
    {
        $data['tipo'] = $this->model_usuario->getTipo();
        /*Esto siempre lo hago para cargar el menu dinamico a la vista y el header*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        /*****************************************************************/
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('usuario/vmantenimiento_usuarios');
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

    public function obtenerPadres(){
        $dato= $this->model_admin->obtenerPadres();
        echo json_encode($dato);
    }

    public function obtenerHijosDePadre(){
        $id_menu=$this->input->post('id');
        $dato= $this->model_admin->obtenerHijosDePadre($id_menu);
        echo json_encode($dato);
    }

    public function eliminarMenu(){
    
        $id_menu=$this->input->post('idMenu');
       return  $this->model_admin->eliminarMenu($id_menu);
    }

    public function menuEnUso(){

        $id_menu=$this->input->post('idMenu');
       $dato= $this->model_admin->menuEnUso($id_menu);
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


    public function crear_usuario()
    {
        $data['tipo'] = $this->model_usuario->getTipo();
        /*Esto siempre lo hago para cargar el menu dinamico a la vista y el header*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        /*****************************************************************/
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('usuario/vcrear_usuario',$data);
        $this->load->view('contenido/footerAdmin');

    }



    public function crearPasante()
    {
        /*Esto siempre lo hago para cargar el menu dinamico a la vista*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        /*****************************************************************/
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );



        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('pasante/vcrearPasante');
        $this->load->view('pasante/footerPasante');

    }

    public function permisos()
    {

        $data['tipo'] = $this->model_usuario->getTipo();
        /*Esto siempre lo hago para cargar el menu dinamico a la vista y el header*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        /*****************************************************************/
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('menu/vpermisos');
        $this->load->view('contenido/footerAdmin');

    }

    public function mtoMenu()
    {

        $data['tipo'] = $this->model_usuario->getTipo();
        /*Esto siempre lo hago para cargar el menu dinamico a la vista y el header*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        /*****************************************************************/
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('menu/vmtoMenu');
        $this->load->view('contenido/footerAdmin');

    }
    
    
    public function insertarU()
    {
        $login= $this->input->post('login');
        $clave= $this->input->post('clave');
        $tipo= $this->input->post('tipo');
        $correo= $this->input->post('email');


        $this->model_usuario->insertar($login,$clave,$tipo,$correo);

        $data['tipo'] = $this->model_usuario->getTipo();
        /*Esto siempre lo hago para cargar el menu dinamico a la vista y el header*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        /*****************************************************************/
        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('usuario/vcrear_usuario');
        $this->load->view('contenido/footerAdmin');
    }


    public function updMenu(){
        $id_menu = $this->input->post('idMenu');
        $nombre = $this->input->post('mtxtNombre');
        $id_padre= $this->input->post('mtxtPadre');
        $url= $this->input->post('mtxtUrl');
        $clase = $this->input->post('mtxtClase');
        $actualizar = $this->model_admin->actualizar_menu($id_menu,$nombre,$id_padre,$url,$clase);
       // echo $actualizar;
        if($actualizar)
        {
            //$this->session->set_flashdata('actualizado', 'El mensaje se actualizó correctamente');
            return 1;
        }
    }


    public function guardarPermisos(){
        $id_user = $this->input->post('id');
        $data = $this->input->post('menu');
        $menu=json_decode($data);
       //echo("user gc".$id_user);
        //echo($id_user);
        //print_r($menu);
        $menus = count($menu);
     //   echo($menus);
        $permisos = $this->model_usuario->permisosUsuario($id_user);
        $resultado = count($permisos);

       // print_r($menu);
        $menus = count($menu);
      //  echo($menus);
        print_r($permisos);
        echo($resultado);
      

      if($menus>0){
            if($resultado >0 ){
                $this->model_admin->eliminarPermisos($id_user);
            }
            foreach($menu as $d){
                echo $d;
                $this->model_admin->guardarPermisos($id_user,$d);
            }
      }else{
          if($resultado >0 ){
              $this->model_admin->eliminarPerminos($id_user);
          }
      }


    }

    public function crearMenu(){
       
        
        $nombre = $this->input->post('nombre');
        $id_padre= $this->input->post('padre');
        $url= $this->input->post('url');
        $clase = $this->input->post('clase');
        $actualizar = $this->model_admin->crearMenu($nombre,$id_padre,$url,$clase);
        echo $actualizar;
        if($actualizar)
        {
            //$this->session->set_flashdata('actualizado', 'El mensaje se actualizó correctamente');
            return 1;
        }
    }

    public function agregarPasante()
    {
        $cedula= $this->input->post('cedula');
        $nombre= $this->input->post('nombre');
        $apellido= $this->input->post('apellido');
        $sexo= $this->input->post('sexo');
        $correo= $this->input->post('email');
        $escuela= $this->input->post('escuela');
        $login= $this->input->post('login');
        $clave= $this->input->post('clave');

        $tipo=4; //QUITAR HARCODEO Y CONSULTAR EL ID DEL PASANTE

        $this->model_usuario->insertar($login,$clave,$tipo,$correo);

        $data =$this->model_usuario->obtenerIdUsuarios($login);

        $id_usuario =$data->id_usuario;

        return $this->model_usuario->agregarPasante($cedula,$nombre,$apellido,$sexo,$escuela,$id_usuario);
    }


    public function crearEmpresa()
    {
        /*Esto siempre lo hago para cargar el menu dinamico a la vista*/
        $idUser=$this->session->userdata('id');
        $tipo =$this->session->userdata('tipo');
        $datas['menu'] =$this->model_usuario->menuPermisos($idUser);
        /*****************************************************************/
        $userData = array(
            'user' => $this->model_usuario->obtenerDataHeader($tipo,$idUser)
        );
        /*esto solo para empresa para cargar los data combos de paises, estados y habiliades */
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
        /*hasta aqui , mando la data a la vista para procesarla*/


        $this->load->view('layout/header',$userData);
        $this->load->view('layout/vmenu',$datas);
        $this->load->view('empresa/vcrearEmpresa',$data);
        $this->load->view('empresa/footerEmpresa');

    }




}