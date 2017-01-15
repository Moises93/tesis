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
				'login' => $param['nombre'],
				'clave' => $param['clave']
			);
			$query = $this->db->get_where('usuario',$data);

			if($query->num_rows() == 1){
				$r = $query->row();
        // esto es una forma de agregar a la session un varios atributos de un usuario
				// $s_usuario = array(
				// 	's_nombre' => $r->nombre,
				// 	's_idusuario' => $r->idusuario
				// );
				// $this->session->userdata($s_usuario);
			//	$moises = $r->result();
         //$this->session->userdata('s_nombre', $moises[0]->nombre);
				return 1;
			}else{
				return 0;
				}
		}
}
