<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
Fecha de Ultima Modificacion: 19-01-2017
Descripcion: 
Este modelo realiza consultas relacionadas a las tablas de pais y estado.
 */

class Model_usuarioempresa extends CI_Model
{
	//constructor predeterminado del modelo
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
	}

	/* Desarrollada el 13-02-2017*/
	public function obtenerFotoEmpresa($id){
               $this->db->select('em.emp_foto');
               $this->db->from('usuario_empresa ue');
               $this->db->join('empresa em', 'ue.emp_id = em.emp_id');
               $this->db->where('ue.id_usuario',$id);
               return $this->db->get()->result();
	}

	/* Desarrollada el 13-02-2017*/
	/**
	 * @param $id
	 * @return el usuaruio de un usuario_empresa
	 */
	public function obtener_usuarioempresa($id){
               $this->db->select('*');
               $this->db->from('usuario_empresa u');
               $this->db->where('u.id_usuario',$id);
               return $this->db->get()->result();
	}

	/**
	 * @param $id
	 * @return array (que contiene el usuario_empresa consultado)
	 */
	function obtenerUsuarioE($id){
		$data = array();
		$this->db->where('u.idusuario_empresa', $id);
		$query = $this->db->get('usuario_empresa u');
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data = $row;
			}
		}
		$query->free_result();
		return $data;
	}
}
