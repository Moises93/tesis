<?php
/**

 * User: Moises
 * Date: 28-02-2017
 * Time: 20:24
 */
class Model_pasantia extends CI_Model
{
    //constructor predeterminado del modelo
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

    function agregarPasantia($modalidad,$empresa,$tutorE,$tutorA,$escuela,
                             $estudiante,$fechaIni,$fechaFin,$estatus){
        $data = array(
            'estatus' => $estatus,
            'fecha_inicio' => $fechaIni,
            'fecha_final' => $fechaFin,
            'modalidad' => $modalidad,
            'idusuario_empresa' => $tutorE,
            'pas_id' =>$estudiante,
            'emp_id' =>$empresa,
            'pro_id' =>$tutorA,
            'id_escuela' =>$escuela

        );


        return $this->db->insert('pasantia',$data);
    }

    function getPasantia() {
        $this->db->select('*');
        $this->db->from('pasantia pas ');
        $this->db->join('usuario_empresa uem', 'pas.idusuario_empresa = uem.idusuario_empresa');
        $this->db->join('pasante pa', 'pas.pas_id= pa.pas_id');
        $this->db->join('usuario usu', 'usu.id_usuario= pa.id_usuario');
        $this->db->join('empresa emp', 'pas.emp_id=emp.emp_id','left'); //left join pora que traiga lo que aun no tienen tutores
        $this->db->join('profesor prof', 'pas.pro_id=prof.pro_id','left');
        $this->db->join('escuela esc', 'pas.id_escuela=esc.id_escuela');
        return $this->db->get()->result();
    }

    function actualizarTutorA($data){
        if(!empty($data)){
            $this->db->where('id_pasantia', $data['id_pasantia']);
            $this->db->update('pasantia', $data);
            return 1;
        }
        return FALSE;
    }
}