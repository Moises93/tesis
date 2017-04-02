<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
Fecha de Ultima Modificacion: 19-01-2017
Descripcion: 
Este modelo realiza consultas relacionadas a las tablas de pais y estado.
 */

class Model_profesor extends CI_Model
{
	//constructor predeterminado del modelo
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
	}

	public function crearProfesor($data){
		$this->db->insert('profesor', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	public function obtProfesoresCoordinadores($idTipo){
		$this->db->select('us.id_usuario, us.id_tipo, us.usu_estatus, us.usu_correo, us.usu_foto, prf.pro_nombre as nombre, prf.pro_apellido as apellido, prf.pro_id, prf.pro_cedula, prf.pro_sexo, es.esc_nombre, es.id_escuela,tp.pro_tipo');
		$this->db->from('usuario us');
		$this->db->join('profesor prf', 'us.id_usuario = prf.id_usuario');
		$this->db->join('escuela es', 'prf.id_escuela = es.id_escuela');
		$this->db->join('tipos_profesor tp', 'prf.id_tipo = tp.id_tipo');
		$this->db->where('prf.id_tipo',$idTipo);
		return $this->db->get()->result();
	}
	public function buscarCoordinadorActivo($idEscuela){
		$this->db->select('*');
		$this->db->from('profesor prf');
		$this->db->join('usuario us', 'us.id_usuario = prf.id_usuario');
		$this->db->where('prf.id_tipo',2);
		$this->db->where('prf.id_escuela',$idEscuela);
		$this->db->where('us.usu_estatus',1);
		return $this->db->get()->result();

	}
	public function get_ProfesoresTipo($idEscuela,$idTipo){
		$data = array();
		$this->db->where('id_escuela',$idEscuela);
		$this->db->where('id_tipo',$idTipo);
		$query= $this->db->get('profesor');
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	public function obtProfesorPorEscuela($idEscuela){
		$data = array();
		$this->db->where('id_escuela',$idEscuela);
		$query= $this->db->get('profesor');
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	

	function getProfesor($pro_id){
		$data = array();
		$this->db->select('*');
		$this->db->from('profesor pro');
		$this->db->join('usuario usu', 'usu.id_usuario=pro.id_usuario');
		$this->db->where('pro.pro_id', $pro_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	public function updateProfesor($c,$v,$i){
		$data = array(
			$c => $v
		);
		$this->db->where('pro_id',$i);
		$this->db->update('profesor',$data);
	}

	public function  asignarCoordinador($idPro){
		$data = array(
			'id_tipo' => 2
		);
		$this->db->where('pro_id',$idPro);
		$this->db->update('profesor',$data);
	}
	
	public function  desasignarCoordinador($idPro){
		$data = array(
			'id_tipo' => 1
		);
		$this->db->where('pro_id',$idPro);
		$this->db->update('profesor',$data);
	}

	function actualizar_telefono($pro,$telefono){
		$data = array(
			'pro_telefono' => $telefono
		);
		if(!empty($data))
		{
			$this->db->where('pro_id', $pro);
			$this->db->update('profesor', $data);
			return TRUE;
		}
		return FALSE;
	}

	public function agregarProfesor($cedula,$nombre,$apellido,$sexo,$escuela,$data){
		$data = array(
			'pro_cedula' => $cedula,
			'pro_nombre' => $nombre,
			'pro_apellido' => $apellido,
			'pro_sexo' => $sexo,
			'id_usuario' => $data,
			'id_escuela' =>$escuela,
			'id_tipo' =>1,

		);

		$this->db->insert('profesor',$data);
	}



}
