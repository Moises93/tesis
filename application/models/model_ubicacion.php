<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
Fecha de Ultima Modificacion: 19-01-2017
Descripcion: 
Este modelo realiza consultas relacionadas a las tablas de pais y estado.
 */

class Model_ubicacion extends CI_Model
{
	//constructor predeterminado del modelo
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
	}

	public function getTodosPaises(){
		$sql = "SELECT * FROM pais";
		$rs = $this->db->query($sql);
		if($rs->num_rows() > 0){
			return $rs->result();
		}
		else{
			return array();	
		}
	}
	public function getTodosEstados(){
		$sql = "SELECT * FROM estado";
		$rs = $this->db->query($sql);
		if($rs->num_rows() > 0){
			return $rs->result();
		}
		else{
			return array();	
		}
	}

	public function getEstadoxPais($pais){
		$sql = "SELECT * FROM estado WHERE ubicacion_id = ?";
    	$rs = $this->db->query($sql,array($pais));
	    // $this->db->where('ubicacion_id',$pais);
		// $rs = $this->db->get('estado');
		 if($rs->num_rows() > 0){
			return $rs;
		}else{
			return false;
		}
	}

	public function crearUbicacion($data){

			$this->db->insert('ubicacion', $data);

			return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();

	}
}
