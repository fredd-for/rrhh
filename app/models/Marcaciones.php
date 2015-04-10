<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  02-04-2015
*/
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Marcaciones extends \Phalcon\Mvc\Model {

    public function initialize() {
        $this->_db = new Marcaciones();
    }
    private $_db;
    /**
     * Función para obtener la marcación valida dentro para una persona, en una fecha y rango de marcaciones válidas.
     * En caso de enviarse un valor no nulo para el parámetro i_id_maquina se realiza el filtro con dicha máquina, en caso contrario
     * se buscará de acuerdo a los registros establecidos en el registro de perfil laboral.
     * @param $idMaquina
     * @param $idRelaboral
     * @param $fecha
     * @param $horaIniRango
     * @param $horaFinRango
     */
    public function getMarcacionValida($idMaquina,$idRelaboral,$fecha,$horaIniRango,$horaFinRango){
        $sql = "SELECT CASE WHEN f_obtener_marcacion_valida IS NULL THEN 0 ELSE 1 END as resultado from f_obtener_marcacion_valida($idMaquina,$idRelaboral,'$fecha','$horaIniRango','$horaFinRango')";
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }

    /**
     * Función para obtener el registro de la marcación válida
     * @param $idMaquina
     * @param $idRelaboral
     * @param $fecha
     * @param $horaIniRango
     * @param $horaFinRango
     * @return Resultset
     */
    public function getOneMarcacionValida($idMaquina,$idRelaboral,$fecha,$horaIniRango,$horaFinRango){
        $sql = "SELECT * FROM marcaciones ";
        $sql .= "WHERE persona_id=(SELECT persona_id FROM relaborales WHERE id=$idRelaboral LIMIT 1) ";
        $sql .= "AND fecha='$fecha' AND '$horaIniRango'<=hora AND hora<='$horaFinRango' ";
        $sql .= "AND maquina_id IN (CASE WHEN '$idMaquina' IS NOT NULL AND $idMaquina>0 THEN $idMaquina ELSE ";
        $sql .= "(SELECT rpm.maquina_id FROM relaboralesperfiles rp ";
        $sql .= "INNER JOIN relaboralesperfilesmaquinas rpm ON rp.id = rpm.relaboralperfil_id ";
        $sql .= "WHERE '$fecha' BETWEEN rp.fecha_ini AND rp.fecha_fin ";
        $sql .= "AND rp.relaboral_id=$idRelaboral AND rp.estado=1 AND rp.baja_logica=1) ";
        $sql .= "END) ORDER BY hora LIMIT 1";
        //echo "\--->".$sql;
        $this->_db = new Marcaciones();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }
}
?>