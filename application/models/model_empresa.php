<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
Fecha de Ultima Modificacion: 19-01-2017
Descripcion: 
Este modelo realiza consultas relacionadas a las tablas de pais y estado.
 */

class Model_empresa extends CI_Model
{
	//constructor predeterminado del modelo
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
	}

	public function crearEmpresa($data){

			$this->db->insert('empresa', $data);

			return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();

	}

	function getEmpresa() {

		$data = array();
		$this->db->select('*');
		$this->db->from('empresa emp');
		$this->db->join('ubicacion ubi', 'emp.emp_id = ubi.emp_id');
		$this->db->join('pais pai', 'ubi.pais_id = pai.id');
		$this->db->join('estado est', 'ubi.estado_id=est.id');
		$query =  $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}

	function getUsuarioEmpresa() {
		$data = array();
		$query = $this->db->get('usuario_empresa');
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	function getUsuarioDeEmpresa($EmpId){
		$data = array();
		$this->db->where('emp_id',$EmpId);
		$query= $this->db->get('usuario_empresa');
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
		
	}


	public function agregarUsuarioE($cedula,$nombre,$apellido,$sexo,$empresa,$data,$tipo){
		$data = array(
			'uem_nombre' => $nombre,
			'uem_cedula' => $cedula,
			'id_usuario' => $data,
			'tuem_id' => $tipo,
			'emp_id' => $empresa,
			'uem_apellido' =>$apellido,
			'uem_sexo' =>$sexo

		);

		$this->db->insert('usuario_empresa',$data);
	}

	function updUsuarioE($idusuario_empresa,$uem_nombre,$uem_cedula,$uem_apellido,$uem_sexo){
		$data = array(
			'uem_nombre' => $uem_nombre,
			'uem_cedula' => $uem_cedula,
			'uem_apellido' => $uem_apellido,
			'uem_sexo' => $uem_sexo
		);
		$this->db->where('idusuario_empresa', $idusuario_empresa);
		return $this->db->update('usuario_empresa', $data);

	}
}
