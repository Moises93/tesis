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


	public function updateProfesor($c,$v,$i){
		$data = array(
			$c => $v
		);
		$this->db->where('pro_id',$i);
		$this->db->update('profesor',$data);
	}

}
