<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_usuario extends CI_Model
{
	//constructor predeterminado del modelo
	function __construct()
	{
		parent::__construct();
	}

	public function existe($param)
	{
		$data = array
		(
			'usu_login' => $param['nombre'],
			'usu_clave' => $param['clave']
		);

		$query = $this->db->get_where('usuario', $data);

		if ($query->num_rows() == 1) {
			//SI EL USUARIO EXISTE CONSULTO QUE TIPO DE USUARIO ES
			$r = $query->row();

			$datos['id'] = $r->id_usuario;
			$datos['Login'] = $r->usu_login;
			$datos['Name'] = $r->id_tipo;

			$this->session->set_userdata($datos);

			$query2 = $this->db->get_where('tipos_usuarios', array('id_tipo' => $r->id_tipo));
			$r_tipos = $query2->row();
			return $r_tipos->tipo;
		} else {
			return 0;
		}
	}
	/* Desarrollada el 13-02-2017*/
	public function obtener_usuario($id){
               $this->db->select('*');
               $this->db->from('usuario u');
               $this->db->where('u.id_usuario',$id);
               return $this->db->get()->result();
	}
	
/*retorna todos los datos del usuario adicional su nombre de tipo*/
	public function consultar_usuarios()
	{
		$this->db->select('u.id_usuario,tu.tipo, u.usu_login, u.usu_clave, u.usu_estatus,u.usu_correo,u.id_tipo');
		$this->db->from('usuario u');
		$this->db->join('tipos_usuarios tu', 'u.id_tipo = tu.id_tipo');

		return $this->db->get()->result();
	}

	public function obtenerUsuariosTipos($idTipo)
	{
		$this->db->select('u.id_usuario,u.id_tipo, u.usu_login, u.usu_clave, u.usu_estatus,u.usu_correo');
		$this->db->from('usuario u');
		$this->db->where('u.id_tipo',$idTipo);

		return $this->db->get()->result();
	}

	function insertar($login,$clave,$tipo,$correo){
		$data = array(
			'id_tipo' => $tipo,
			'usu_login' => $login,
			'usu_clave' => $clave,
			'usu_estatus' => 1,
			'usu_correo' => $correo,

		);

		$this->db->insert('usuario',$data);
	}

	function getTipo() {
		$data = array();
		$query = $this->db->get('tipos_usuarios');
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data[] = $row;
			}
		}
			$query->free_result();
			return $data;
	}
   function permisosUsuario($idUser){
	   $data = array();
	   $query = $this->db->get_where('permiso_usuario', array('id_usuario' => $idUser));
	  
	   if ($query->num_rows() > 0) {
		   foreach ($query->result_array() as $row){
			   $data[] = $row['id_menu'];
		   }
	   }
	   $query->free_result();
	   return $data;
   }
function permisosUsuarioPadres ($idUser){
	$data = array();
//echo "permisos padres".$idUser;

	$this->db->select('*');
	$this->db->from('menu');
	$this->db->join('permiso_usuario', 'menu.id_menu = permiso_usuario.id_menu');
	$this->db->where('permiso_usuario.id_usuario', $idUser);
	$this->db->where('menu.id_padre',0);
	$query = $this->db->get();

	if ($query->num_rows() > 0) {
		foreach ($query->result_array() as $row){
			$data[] = $row;
		}
	}
	$query->free_result();
	return $data;
}

function permisosUsuarioHijos($idMenu,$idUser){
	$data = array();

	$this->db->select('*');
	$this->db->from('menu');
	$this->db->join('permiso_usuario', 'menu.id_menu = permiso_usuario.id_menu');
	$this->db->where('permiso_usuario.id_usuario', $idUser);
	$this->db->where('menu.id_padre',$idMenu);
	$query = $this->db->get();

	if ($query->num_rows() > 0) {
		foreach ($query->result_array() as $row){
			$data[] = $row;
		}
	}
	$query->free_result();
	return $data;
}

	//Preguntar a Sandra
    function MenuPorId($idMenu){
		$data = array();
		$query = $this->db->get_where('menu', array('id_menu' => $idMenu));
		return $query->row();
	/*	if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;*/
	}

	public function menuPermisos($idUser)
	{
		$menuUser=array();
		$cont=0;
		$padres = $this->permisosUsuarioPadres($idUser);
		//echo '<pre>'; print_r($padres); echo '</pre>';
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
			//echo '<pre>'; print_r($menuUser); echo '</pre>';

			$cont= $cont+1;
			// echo "-".$menu->id_menu;
			//echo "-".$menu->nombre;
		}
		return $menuUser;
	}

	function cambiaEstatus($idUsuario,$estatus){
		$data = array(
			'usu_estatus' => $estatus
		);
		$this->db->where('id_usuario', $idUsuario);
		return $this->db->update('usuario', $data);
	}


	function actualizar_usuario($id_usuario,$id_tipo,$usu_login,$usu_clave,$usu_correo){
		$data = array(
			'id_tipo' => $id_tipo,
			'usu_login' => $usu_login,
			'usu_clave' => $usu_clave,
			'usu_correo' => $usu_correo
		);
			$this->db->where('id_usuario', $id_usuario);
			return $this->db->update('usuario', $data);

	}
	
	function valLogin($usu_login){
		$this->db->select('u.id_usuario');
		$this->db->from('usuario u');
		$this->db->where('usu_login',$usu_login);
		$resultado= $this->db->get();
		if ($resultado->num_rows() > 0) {
			foreach ($resultado->result_array() as $row){
				$data[] = $row;
			}
		}
		$resultado->free_result();
		
	return $resultado;
	}


    /* Desarrollada el 13-02-2017*/
	public function obtener_todousuarioEmpresa($id){
        $this->db->select('us.id_usuario, us.id_tipo, us.usu_login, 
           	us.usu_clave, us.usu_estatus, us.usu_correo, us.usu_foto, 
            ue.uem_nombre as Nombre, ue.uem_cedula, tue.tuem_tipo, e.emp_nombre as Institucion, 
            e.emp_foto');
		$this->db->from('usuario us');
		$this->db->join('usuario_empresa ue', 'us.id_usuario = ue.id_usuario');
		$this->db->join('tipo_uempresa tue', 'ue.tuem_id = tue.tuem_id');
		$this->db->join('empresa e', 'ue.emp_id = e.emp_id');
		$this->db->where('us.id_usuario',$id);
        return $this->db->get()->result();
	}
	
    /* Desarrollada el 13-02-2017*/
    public function signOutUser(){
				$this->session->sess_destroy();
				return true;
	}

	public function obtenerIdUsuarios($login)
	{
		$this->db->select('u.id_usuario');
		$this->db->from('usuario u');
		$this->db->where('u.usu_login',$login);
		$resultado= $this->db->get();
		return $resultado->row();
		/*if ($resultado->num_rows() > 0) {
			foreach ($resultado->result_array() as $row){
				$data['id'] = $row;
			}
		}
		return $data;*/
	}

public function agregarPasante($cedula,$nombre,$apellido,$sexo,$escuela,$data){
	$data = array(
		'pas_cedula' => $cedula,
		'pas_nombre' => $nombre,
		'pas_apellido' => $apellido,
		'pas_sexo' => $sexo,
		'id_usuario' => $data,
		'id_escuela' =>$escuela

	);

	$this->db->insert('pasante',$data);
}


}
