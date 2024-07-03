<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MantenimientoModel extends CI_Model
{
    // public $q = null;

    public function __construct()
    {
        $this->load->model('Querys', 'q');
    }

    //obtener un formulario o todos los formularios de mantenimiento
    public function getFormulariosMantenimiento($id = null)
    {
        $this->db->select(
            "
        id_formulario,
        id_solicitante,
        id_tecnico,
        vp.ci,
        vp.email,
        vp.celular,
        concat(vp.nombre,' ',vp.paterno,' ',vp.materno) solicitante,
        concat(vpe.nombre,' ',vpe.paterno,' ',vpe.materno) tecnico, 
        vpe.ci ci2,
        vpe.celular celular2,
        vpe.email email2,
        fm.id_defecto,    
        equipo,
        fm.id_tipo_equipo ,
        fm.id_marca,
        fm.id_modelo,
        fm.id_defecto,
        fm.email femail,
        fm.celular fcelular,
        estado_equipo,
        fecha_ini,
        area_origen,
        fecha_fin,
        fecha_creacion,
        d.descripcion defect,
        fm.descripcion,
        fm.tipo_mantenimiento,
        defecto,
        solucion,
        fm.estado
        "
        );
        $this->db->from('m_formularios_mantenimiento fm');
        $this->db->join('base_upea.vista_persona vp', 'fm.id_solicitante = vp.id');
        $this->db->join('base_upea.vista_persona vpe', 'fm.id_tecnico = vpe.id', 'left');
        $this->db->join('m_tipos_equipos te', 'te.id_tipo_equipo = fm.id_tipo_equipo', 'left');
        $this->db->join('m_defectos_equipo d', 'd.id_defecto = fm.id_defecto', 'left');

        //para la eliminación lógica
        $id !== null ?  $this->db->where('id_formulario', $id) : $this->db->where_in('fm.estado', array('A', 'C'));

        //retorno datos de la consulta
        return $id ? $this->db->get()->row() : $this->db->get()->result();
    }
    public function get_model_equipos()
    {
        $this->db->select("*");
        $this->db->from('m_modelos_equipos');
        return $this->db->get()->result();
    }
    public function get_marcas_equipos()
    {
        $this->db->select("*");
        $this->db->from('m_marcas_equipos');
        return $this->db->get()->result();
    }
    public function get_tipos_equipos()
    {
        $this->db->select("*");
        $this->db->from('m_tipos_equipos');
        return $this->db->get()->result();
    }
    public function get_defectos_equipo()
    {
        $this->db->select("*");
        $this->db->from('m_defectos_equipo');
        return $this->db->get()->result();
    }
    public function search_by_ci($ci)
    {
        // return $this->db->query("select * from base_upea.vista_persona where ci=$ci")->result();
        $this->db->select("*");
        $this->db->from('base_upea.vista_persona');
        $this->db->where('ci', $ci);
        return $this->db->get()->result();
    }

    public function veryfy_exits($ci)
    {
        // return $this->db->query("select * from base_upea.vista_persona where ci=$ci")->result();
        $this->db->select("*");
        $this->db->from('base_upea.vista_persona');
        $this->db->where('ci', $ci);
        return $this->db->get()->result();
    }

    public function getDataForReport($id = null)
    {
        $this->db->select(
            "
            fm.id_formulario,
            concat(vp.nombre,' ',vp.paterno,' ',vp.materno) solicitante,
            fm.email email,
            fm.celular celular,
            fm.tipo_mantenimiento,
            concat(vp2.nombre,' ',vp2.paterno,' ',vp2.materno) tecnico,
            vp2.email temail,
            vp2.celular tcelular,
            de.descripcion tipo_def,
            date_format(fm.fecha_ini, '%d-%m-%Y') fecha_ini,
            date_format(fm.fecha_fin, '%d-%m-%Y') fecha_fin  ,
            fm.defecto,
            fm.descripcion,
            solucion,
            fm.estado_equipo,
            te.equipo,
            area_origen,
            me.marca,
            me2.modelo       
        "
        );
        $this->db->from('m_formularios_mantenimiento fm');
        $this->db->join('base_upea.vista_persona vp', 'fm.id_solicitante = vp.id', 'left');
        $this->db->join('base_upea.vista_persona vp2', 'fm.id_tecnico = vp2.id', 'left');
        $this->db->join('m_defectos_equipo de', 'de.id_defecto = fm.id_defecto', 'left');
        $this->db->join('m_tipos_equipos te', 'te.id_tipo_equipo = fm.id_tipo_equipo', 'left');
        $this->db->join('m_marcas_equipos me', 'me.id_marca = fm.id_marca', 'left');
        $this->db->join('m_modelos_equipos me2 ', 'me2.id_modelo = fm.id_modelo', 'left');
        $this->db->where('fm.id_formulario', $id);

        //retorno datos de la consulta
        return $this->db->get()->row();
    }
}
