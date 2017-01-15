<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_usuario extends CI_Model
{
	//constructor predeterminado del  modelossss
	function __construct()
	{
		parent::__construct();
	}

	public function existe($param)
		{
			$data = array
			(
				'nombre' => $param['nombre'],
				'clave' => $param['clave']
			);
			$query = $this->db->get_where('usuarios',$data);

			if($query->num_rows() == 1)
				return $query->row();
			else
				return FALSE;
		}
  }
