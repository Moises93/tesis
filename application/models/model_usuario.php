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
				'usu_login' => $param['nombre'],
				'usu_clave' => $param['clave']
			);

			$query = $this->db->get_where('usuario',$data);

			if($query->num_rows() == 1){
				//SI EL USUARIO EXISTE CONSULTO QUE TIPO DE USUARIO ES
				$r = $query->row();
				echo ($r->id_tipo);

				$datos['id'] = $r->id_usuario;
				$datos['Login'] = $r->usu_login;
				$datos['Name'] = $r->id_tipo;
				$this->session->set_userdata($datos);

				$query2 = $this->db->get_where('tipos_usuarios', array('id_tipo' => $r->id_tipo));
				$r_tipos = $query2->row();
				echo($r_tipos->tipo);
				//echo ($r_tipos->tipo);
        // esto es una forma de agregar a la session un varios atributos de un usuario
				// $s_usuario = array(
				// 	's_nombre' => $r->nombre,
				// 	's_idusuario' => $r->idusuario
				// );
				// $this->session->userdata($s_usuario);
			//	$moises = $r->result();
         //$this->session->userdata('s_nombre', $moises[0]->nombre);
				return $r_tipos->tipo;
			}else{
				return 0;
				}
		}
}
