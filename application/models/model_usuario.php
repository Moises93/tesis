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
			echo($r->id_tipo);

			$datos['id'] = $r->id_usuario;
			$datos['Login'] = $r->usu_login;
			$datos['Name'] = $r->id_tipo;
			$this->session->set_userdata($datos);

			$query2 = $this->db->get_where('tipos_usuarios', array('id_tipo' => $r->id_tipo));
			$r_tipos = $query2->row();
			echo($r_tipos->tipo);
			//echo ($r_tipos->tipo);
			// esto es una forma de agregar a la session un varios atributos de un usuario
			// $s_usuario = array(
			// 	's_nombre' => $r->nombre,
			// 	's_idusuario' => $r->idusuario
			// );
			// $this->session->userdata($s_usuario);
			//	$moises = $r->result();
			//$this->session->userdata('s_nombre', $moises[0]->nombre);
			return $r_tipos->tipo;
		} else {
			return 0;
		}
	}

	public function consultar_usuarios()
	{

		$this->db->select('u.id_usuario,tu.tipo, u.usu_login, u.usu_clave, u.usu_estatus,u.usu_correo');
		$this->db->from('usuario u');
		$this->db->join('tipos_usuarios tu', 'u.id_tipo = tu.id_tipo');
		//$consulta = $this->db->get();
		//$resultado = $consulta->result();

		return $this->db->get()->result();
		#$consulta = $this->db->get('usuario');
		//return $resultado;


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


}
