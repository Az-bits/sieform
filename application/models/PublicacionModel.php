<?php
defined('BASEPATH') or exit('No direct script access allowed');
class PublicacionModel extends CI_Model
{
    public function getPublicaciones($id = null, $init = null, $limit = null)
    {
        $this->db->select("
            p.id_publicacion,
            t.id_tipo_publicacion,
            t.tipo,
            visibilidad,
            p.estado,
            DATE_FORMAT(fecha_inicio, '%m/%d/%Y') fecha_inicio,
            DATE_FORMAT(fecha_fin, '%m/%d/%Y') fecha_fin,  
            detalle,
            m.id_multimedia,
            url
        ");
        $this->db->from('p_publicaciones p');
        $this->db->join('p_tipo_publicacion t', 'p.id_tipo_publicacion = t.id_tipo_publicacion', 'left');
        $this->db->join('p_multimedia_publicaciones mp', 'p.id_publicacion = mp.id_publicacion', 'left');
        $this->db->join('multimedia m', 'm.id_multimedia = mp.id_multimedia', 'left');


        $id !== null ?  $this->db->where('p.id_publicacion', $id) : $this->db->where_in('p.estado', array('A'));
        $this->db->order_by('p.id_publicacion', 'DESC');
        $this->db->limit($limit, $init);


        return $id ? $this->db->get()->row() : $this->db->get()->result();
    }
    public function datosFormulario()
    {
        $this->db->select("*");
        $this->db->from('p_tipo_publicacion');
        return $this->db->get()->result();
    }
    public function getImagen($url = null)
    {
        if ($url) {
            $imagenPath = $url;
        } else {
            $imagenPath = base_url('./assets/img/image.png');
        }

        $extension = pathinfo($imagenPath, PATHINFO_EXTENSION);
        $imagenData = file_get_contents($imagenPath);
        $base64 = 'data:image/' . $extension . ';base64,' . base64_encode($imagenData);
        return $base64;
    }

    public function getPublicacionesSearch($string)
    {
        $this->db->select("
            p.id_publicacion,
            t.id_tipo_publicacion,
            t.tipo,
            visibilidad,
            p.estado,
            DATE_FORMAT(fecha_inicio, '%m/%d/%Y') fecha_inicio,
            DATE_FORMAT(fecha_fin, '%m/%d/%Y') fecha_fin,  
            detalle,
            m.id_multimedia,
            url
        ");
        $this->db->from('p_publicaciones p');
        $this->db->join('p_tipo_publicacion t', 'p.id_tipo_publicacion = t.id_tipo_publicacion', 'left');
        $this->db->join('p_multimedia_publicaciones mp', 'p.id_publicacion = mp.id_publicacion', 'left');
        $this->db->join('multimedia m', 'm.id_multimedia = mp.id_multimedia', 'left');
        $this->db->where_in('p.estado', array('A'));
        $this->db->like('t.tipo', "$string");

        return $this->db->get()->result();
    }
    public function getCantidadPublicaciones()
    {
        $this->db->select("count(*) cantidad");
        $this->db->from('p_publicaciones p');
        $this->db->where_in('p.estado', array('A'));

        return $this->db->get()->row();
    }
}
