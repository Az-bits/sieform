<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Querys extends CI_Model
{
    public function insertarTabla($tabla, $data)
    {
        $this->db->insert($tabla, $data);
        return $this->db->insert_id();
    }
    public function actualizarTabla($table, $tid, $id, $data)
    {
        $this->db->where($tid, $id);
        $this->db->update($table, $data);
    }
    public function buscarPersona($ci)
    {
        $sql = "SELECT id ,  ci, concat(nombre,' ',paterno,' ',materno) nombreCompleto, email, celular  FROM base_upea.vista_persona  WHERE ci LIKE '%$ci%'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function buscarPorCI($ci)
    {
        $sql = "SELECT id idpersona,  ci, concat(nombre,' ',paterno,' ',materno) nombreCompleto, email, celular  FROM base_upea.vista_persona  WHERE ci = $ci";
        $query = $this->db->query($sql);
        return $query->row();
    }
    public function eliminar($table, $idTable, $id)
    {
        $this->db->where($idTable, $id);
        $this->db->delete($table);
    }
    public function verifyExist($table, $hash = null)
    {
        return  $this->db->query(
            "SELECT nombre_archivo FROM multimedia m 
            LEFT JOIN $table mr ON mr.id_multimedia = m.id_multimedia
            WHERE m.hash_archivo = '$hash'"
        )->result_array();
    }
}
