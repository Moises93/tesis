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

	function getEmpresaPorId($id) {

		$data = array();
		$this->db->select('*');
		$this->db->from('empresa emp');
		$this->db->join('ubicacion ubi', 'emp.emp_id = ubi.emp_id');
		$this->db->join('pais pai', 'ubi.pais_id = pai.id');
		$this->db->join('estado est', 'ubi.estado_id=est.id');
		$this->db->join('rating_empresa remp', 'emp.emp_id = remp.emp_id','left');
		$this->db->where('emp.emp_id', $id);
		$query =  $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	function getComentariosEmpresa($id){
		$data = array();
		$this->db->select('*');
		$this->db->from('valoracion_empresa vemp');
		$this->db->join('usuario usu', 'usu.id_usuario=vemp.id_usuario');
		$this->db->where('emp_id', $id);
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
		$this->db->select('*');
		$this->db->from('usuario_empresa uemp');
		$this->db->join('usuario usu', 'uemp.id_usuario = usu.id_usuario');
		$this->db->join('empresa emp', 'uemp.emp_id = emp.emp_id');
		$query = $this->db->get();
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


	public function agregarUsuarioE($cedula,$nombre,$apellido,$sexo,$empresa,$data,$tipo,$telefono){
		$data = array(
			'uem_nombre' => $nombre,
			'uem_cedula' => $cedula,
			'id_usuario' => $data,
			'tuem_id' => $tipo,
			'emp_id' => $empresa,
			'uem_apellido' =>$apellido,
			'uem_sexo' =>$sexo,
			'uem_telefono' =>$telefono

		);

		$this->db->insert('usuario_empresa',$data);
	}

	function updUsuarioE($idusuario_empresa,$uem_nombre,$uem_cedula,$uem_apellido,$uem_telefono){
		$data = array(
			'uem_nombre' => $uem_nombre,
			'uem_cedula' => $uem_cedula,
			'uem_apellido' => $uem_apellido,
			'uem_telefono' => $uem_telefono
		);
		if(!empty($data))
		{
			$this->db->where('idusuario_empresa', $idusuario_empresa);
		    $this->db->update('usuario_empresa', $data);
			return TRUE;
		}
		return FALSE;
	}

	public function crearEscuelaEmpresa($data){

		$this->db->insert('empresa_escuela', $data);

		return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();

	}

	function actualizarEmpresa($id,$rif,$nombre,$correo,$telefono){
		$data = array(
			'emp_nombre' => $nombre,
			'emp_rif' => $rif,
			'emp_correo' => $correo,
			'emp_telefono' => $telefono
		);
		if(!empty($data))
		{
			$this->db->where('emp_id', $id);
			$this->db->update('empresa', $data);
			return TRUE;
		}
		return FALSE;
	}
	function consultarValoracion($idUser,$idemp){
		$data=array();
		$this->db->select('valor');
		$this->db->from('valoracion_empresa');
		$this->db->where('emp_id',$idemp);
		$this->db->where('id_usuario',$idUser);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}
	function actualizarValoracionEmpresa($idemp,$valor,$idUser,$comentario)
	{
		$data = array(
			'valor' => $valor,
			'comentario' =>$comentario
		);

		$this->db->where('emp_id', $idemp);
		$this->db->where('id_usuario', $idUser);
		$this->db->update('valoracion_empresa', $data);
	}

	function guardarValoracionEmpresa($idemp,$valor,$idUser,$comentario){
		$data = array(
			'emp_id' => $idemp,
			'id_usuario' => $idUser,
			'valor' => $valor,
			'comentario' =>$comentario
		);
		return $this->db->insert('valoracion_empresa',$data);
	}

	function consultarRating($idemp){

		$this->db->select('AVG(valor) promedio, count(emp_id) votos');
		$this->db->from('valoracion_empresa');
		$this->db->where('emp_id',$idemp);
		$query = $this->db->get();
		$rating = round($query->row()->promedio,1);
		$votos=$query->row()->votos;
		$data=array(
			'rating' => $rating,
			'votos' =>$votos,
			'emp_id'=>$idemp
		);
		return $data;
	}
	function actualizarRating($dato,$idemp){
		$data=array();
		$this->db->select('*');
		$this->db->from('rating_empresa');
		$this->db->where('emp_id',$idemp);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data[] = $row;
			}
		}

		if(count($data)>0){
			$this->db->where('emp_id', $idemp);
			$this->db->update('rating_empresa', $dato);
		}else{
			$this->db->insert('rating_empresa',$dato);
		}

	}

	/*busco aquellos que no aparezcan en la tabla pasantia y me traigo datos de usuario para el login*/
	function getCountPostulados() {
		$sql = "SELECT count(emp.emp_id) as Total from empresa as emp";


// Ejecuta Consulta
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return array();
		}

	}

	function getEmpresaPaginada($limit,$offset) {
		//$this->db->get()->result();
		$sql = "SELECT * from empresa emp";
		$sql = $sql . " join ubicacion ubi on emp.emp_id = ubi.emp_id ";
		$sql = $sql . " join pais pai on ubi.pais_id = pai.id";
		$sql = $sql . " join estado est on ubi.estado_id=est.id";
		$sql = $sql . " LIMIT $offset, $limit";

// Ejecuta Consulta
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return array();
		}


		/*$data = array();
		$this->db->select('*');
		$this->db->from('empresa emp');
		$this->db->join('ubicacion ubi', 'emp.emp_id = ubi.emp_id');
		$this->db->join('pais pai', 'ubi.pais_id = pai.id');
		$this->db->join('estado est', 'ubi.estado_id=est.id');
		$query =  $this->db->get($limit,$offset);
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;*/
	}


}
