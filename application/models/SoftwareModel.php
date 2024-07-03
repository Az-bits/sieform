<?php
defined('BASEPATH') or exit('No direct script access allowed');
class SoftwareModel extends CI_Model
{
    public function getFormulariosSoftware($id = null)
    {
        $this->db->select("
            id_formulario, id_solicitante, id_desarrollador, concat(p.nombre,' ',p.paterno,' ',p.materno) solicitante, concat(p1.nombre,' ',p1.paterno,' ',p1.materno) desarrollador, modulo, opciones, observaciones,tipo_trabajo, estado, p.ci, p.email, p.celular, p1.ci ci2, p1.celular celular2, p1.email email2, fs.email femail, fs.celular fcelular, fecha_ini, fecha_fin, unidad
        ");
        $this->db->from('s_formularios_software fs');
        $this->db->join('base_upea.vista_persona p', 'fs.id_solicitante = p.id');
        $this->db->join('base_upea.vista_persona p1', 'fs.id_desarrollador = p1.id', 'left');

        $id !== null ?  $this->db->where('id_formulario', $id) : $this->db->where_in('estado', array('A', 'C'));
        return $id ? $this->db->get()->row() : $this->db->get()->result();
    }
    public function getDataForReport($id)
    {
        return $this->getFormulariosSoftware($id);
    }
}
