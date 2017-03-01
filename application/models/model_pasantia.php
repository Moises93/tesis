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
        $this->db->get('pasantia');
        return $this->db->get()->result();
    }
}