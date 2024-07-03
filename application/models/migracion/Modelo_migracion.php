<?php     defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
* @Institucion  SIE
*
* @Sistema      SISTEMA DE ACREDITACIÓN Y PLANILLAS HCU
*
* @Modulo       Modulo de Asistencia
*
* @Descripcion  Modelo del sistema de planillas de pagos que genera reporte en pdf mediante 
* consultas SQL con datos.
*
* @author      Nilda Rebeca Chuquichambi Paxi  
* @date       julio 2018
* @version     1.1
*
*/
    class Modelo_migracion extends CI_Model
    {
         function __construct(){
            parent::__construct();
            $this->load->database();
        }

    /**
    *@ESTA FUNCION REALIZA UN LISTADO DE LOS PAGOS, A CADA CONSEJERO PARA LUEGO GENERAR UN REPORTE DE PLANILLAS DE PAGO.
     *
    *@author Nilda Chuquichambi 
    */
     function lista_grupo($fecha_sesion=''){
        $sql="SELECT * FROM dp_auth_groups
        WHERE 1
        ";
//echo $sql;
        $query = $this->db->query($sql);
        if( $query->num_rows()>0 )
           return $query->result();
        else        
            return false;
    }
 
		
}
/* End of file Modelo_planilla_pago.php */
/* Location: ./application/models/nombramiento/Modelo_nombramiento.php */
