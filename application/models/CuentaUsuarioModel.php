<?php
defined('BASEPATH') or exit('No direct script access allowed');
class CuentaUsuarioModel extends CI_Model
{
    public function getFormulariosCuentasUsuario($id = null)
    {
        $this->db->select("
            fc.id_formulario,
            id_solicitante idpersona,
            id_tecnico idpersona2, 
            fc.id_sistema,
            concat(p.nombre,' ',p.paterno,' ',p.materno) nombreCompleto, 
            concat(p1.nombre,' ',p1.paterno,' ',p1.materno) nombreCompleto2, 
            sistema, 
            observaciones,
            fc.estado, 
            p.ci, 
            p.email, 
            p.celular, 
            p1.ci ci2, 
            p1.celular celular2, 
            p1.email email2, 
            fc.email femail, 
            fc.celular fcelular,
            unidad
        ");
        $this->db->from('c_formularios_cuenta_usuario fc');
        $this->db->join('base_upea.vista_persona p', 'fc.id_solicitante = p.id');
        $this->db->join('base_upea.vista_persona p1', 'fc.id_tecnico = p1.id', 'left');
        $this->db->join('c_sistemas s', 's.id_sistema = fc.id_sistema', 'left');

        $id !== null ?  $this->db->where('id_formulario', $id) : $this->db->where_in('fc.estado', array('A', 'C'));
        return $id ? $this->db->get()->row() : $this->db->get()->result();
    }
    public function getOperaciones($id)
    {
        $operaciones = '';
        $this->db->select("*");
        $this->db->from('c_operaciones_realizadas o');
        $this->db->join('c_tipos_operaciones t', 'o.id_tipo_operacion = t.id_tipo_operacion', 'left');
        $this->db->where('id_formulario', $id);
        $data = $this->db->get()->result();
        foreach ($data as $d) {
            $operaciones = $operaciones . $d->operacion . ', ';
        }
        return substr($operaciones, 0, -2);
    }
    public function getDatosParaCheckBox($id = 4)
    {
        $this->db->select("o.*,t.tag");
        $this->db->from('c_operaciones_realizadas o');
        $this->db->join('c_tipos_operaciones t', 'o.id_tipo_operacion = t.id_tipo_operacion', 'left');
        $this->db->where('id_formulario', $id);
        return $this->db->get()->result();
    }
    public function getDataCheckBox()
    {
        $this->db->select("tag");
        $this->db->from('c_tipos_operaciones  o');
        return $this->db->get()->result();
    }
    public function getDataForReport($id)
    {
        return $this->getFormulariosCuentasUsuario($id);
    }
}
