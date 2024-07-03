<?php
defined('BASEPATH') or exit('No direct script access allowed');
class RedesModel extends CI_Model
{
    public function getFormulariosRedes($id = null)
    {
        $this->db->select("
            id_formulario,
            id_solicitante idpersona,
            id_tecnico idpersona2,
            concat(p.nombre,' ',p.paterno,' ',p.materno) nombreCompleto,
            concat(p2.nombre,' ',p2.paterno,' ',p2.materno) nombreCompleto2, 
            unidad, 
            observaciones, 
            p.ci, 
            p.email, 
            p.celular,
            p2.ci ci2, 
            p2.celular celular2, 
            p2.email email2, 
            fr.email femail, 
            fr.celular fcelular, 
            fecha_ini, 
            fecha_fin, 
            soporte_nivel_logico, 
            soporte_nivel_fisico, 
            fecha_fin, 
            descripcion, 
            fr.estado 
        ");
        $this->db->from('r_formularios_redes fr');
        $this->db->join('base_upea.vista_persona p', 'fr.id_solicitante = p.id', 'left');
        $this->db->join('base_upea.vista_persona p2', 'fr.id_tecnico = p2.id', 'left');

        $id !== null ?  $this->db->where('id_formulario', $id) : $this->db->where_in('fr.estado', array('A', 'C'));
        return $id ? $this->db->get()->row() : $this->db->get()->result();
    }
    public function getMaterialUpea()
    {
        return $this->db->query("SELECT * FROM r_materiales_upea")->result_array();
    }
    public function getProcedimientosRedes()
    {
        return $this->db->query("SELECT * FROM r_procedimientos_redes")->result_array();
    }
    public function getDefectosRedes()
    {
        return $this->db->query("SELECT * FROM r_defectos")->result_array();
    }

    public function getDatosParaCheckBox($id = null)
    {
        $data = [];
        $data['materiales'] = $this->db->query(
            "SELECT mu.*,mp.tag from r_materiales_usados mu
            LEFT JOIN r_materiales_upea mp ON mu.id_material = mp.id_material
            WHERE mu.id_formulario = $id"
        )->result_array();
        $data['defectos'] = $this->db->query(
            "SELECT dr.*,d.tag from r_defectos_reportados dr
            LEFT JOIN r_defectos d ON d.id_defecto = dr.id_defecto
            WHERE dr.id_formulario = $id
            "
        )->result_array();
        $data['procedimientos'] = $this->db->query(
            "SELECT pr.*,p.tag from r_procedimientos_realizados pr
            LEFT JOIN r_procedimientos_redes p ON pr.id_procedimiento_redes = p.id_procedimiento_redes
            WHERE pr.id_formulario = $id
            "
        )->result_array();
        return $data;
    }

    public function getDataForReport($id = null)
    {
        return $this->getFormulariosRedes($id);
    }

    public function getDefectorForReport($id = null)
    {
        $dataFull = [];
        $newData = array();
        $data = $this->db->query(
            "SELECT d.tag from r_defectos_reportados dr
            LEFT JOIN r_defectos d ON d.id_defecto = dr.id_defecto
            WHERE dr.id_formulario = $id
            "
        )->result_array();

        foreach ($data as $value) {
            $newData[] = $value['tag'];
        }
        $dataFull['defectos'] = $newData;

        $newData = array();
        $data = $this->db->query(
            "SELECT p.tag from r_procedimientos_realizados pr
            LEFT JOIN r_procedimientos_redes p ON pr.id_procedimiento_redes = p.id_procedimiento_redes
            WHERE pr.id_formulario = $id
            "
        )->result_array();

        foreach ($data as $value) {
            $newData[] = $value['tag'];
        }
        $dataFull['procedimientos'] = $newData;

        $data = $this->db->query(
            "SELECT mp.tag,cantidad from r_materiales_usados mu
            LEFT JOIN r_materiales_upea mp ON mu.id_material = mp.id_material
            WHERE mu.id_formulario = $id"
        )->result_array();

        $dataFull['materiales'] = $data;
        return $dataFull;
    }
}
