<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
Fecha de Ultima Modificacion: 19-01-2017
Descripcion: 
Este modelo realiza consultas relacionadas a las tablas de pais y estado.
 */

class Model_tipoprofesor extends CI_Model
{
	//constructor predeterminado del modelo
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
	}

	function obtenerTiposProfesor(){
		$sql = "SELECT * FROM tipos_profesor";
		$rs = $this->db->query($sql);
		if($rs->num_rows() > 0){
			return $rs->result();
		}else{
			return array();	
		}
    }
}
