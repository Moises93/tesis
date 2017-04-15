<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
Fecha de Ultima Modificacion: 19-01-2017
Descripcion: 
Este modelo realiza consultas relacionadas a las tablas de pais y estado.
 */

class Model_habilidades extends CI_Model
{
	//constructor predeterminado del modelo
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
	}

	public function getTodosHabilidadesComputacion(){
		$sql = "SELECT * FROM habilidad WHERE id_escuela = 1";
		$rs = $this->db->query($sql);
		if($rs->num_rows() > 0){
			return $rs->result();
		}
		else{
			return array();	
		}
	}
	public function crearHabilidadEmpresa($data){

			$this->db->insert('habilidad_empresa', $data);

			return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();

	}

	public function crearHabilidadPasante($data){
		$this->db->insert('habilidad_pasante', $data);
		return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
	}

	public function getTodosHabilidadesNoPasante($id){
		$sql = "SELECT *
from habilidad h
where h.id_habilidad not in (
    select id_habilidad
    from habilidad_pasante
    where pas_id = $id

) and id_escuela = 1";
		$rs = $this->db->query($sql);
		if($rs->num_rows() > 0){
			return $rs->result();
		}
		else{
			return array();	
		}
	}
}
