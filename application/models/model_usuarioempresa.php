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
	public function obtener_usuarioempresa($id){
               $this->db->select('*');
               $this->db->from('usuario_empresa u');
               $this->db->where('u.id_usuario',$id);
               return $this->db->get()->result();
	}
}
