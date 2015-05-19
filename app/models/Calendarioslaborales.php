<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  07-01-2015
*/
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
class Calendarioslaborales extends \Phalcon\Mvc\Model
{
    private $_db;
    public function initialize() {
        $this->_db = new Calendarioslaborales();
        //   parent::initialize();
    }
    /**
     * Función para la modificación del estado de los registros de turnos de un calendario al estado EN ELABORACIÓN,
     * de acuerdo a los parámetros enviados.
     * @param $fechaIni
     * @param $fechaFin
     * @param $finDeSemana
     * @return Resultset
     */
    public function retornaEstadoElaboracion($idUsuarioModificador,$idPerfilLaboral,$fechaIni,$fechaFin){
        $sql = "SELECT f_retorna_estado_elaboracion AS resultado,CASE WHEN f_retorna_estado_elaboracion=1 THEN 'Exito: La modificaci&oacuate;n se realiz&oacute; de forma satisfactoria.'";
        $sql .= " ELSE CAST('Error: No se pudo realizar la modificaci&oacute;n' AS CHARACTER VARYING) END AS msje FROM f_retorna_estado_elaboracion(".$idUsuarioModificador.",".$idPerfilLaboral.",'".$fechaIni."','".$fechaFin."')";
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }

    /**
     * Función para la modificación del estado de los registros de turnos de un calendario al estado EN ELABORACIÓN.
     * Lo particular de este método se debe a que es aplicable a los tipos de horarios CONTINUO, donde sólo se puede establecer
     * que horarios en especifico cambiar y no dar rangos.
     * @param $idUsuarioModificador
     * @param $idPerfilLaboral
     * @param $fechaIni
     * @param $fechaFin
     * @return Resultset
     */
    public function retornaEstadoElaboracionPorIdsCalendarios($idUsuarioModificador,$idPerfilLaboral,$idCalendarios){
        $sql = "SELECT f_retorna_estado_elaboracion_por_ids_calendarios AS resultado,CASE WHEN f_retorna_estado_elaboracion_por_ids_calendarios=1 THEN 'Exito: La modificaci&oacuate;n se realiz&oacute; de forma satisfactoria.'";
        $sql .= " ELSE CAST('Error: No se pudo realizar la modificaci&oacute;n' AS CHARACTER VARYING) END AS msj FROM f_retorna_estado_elaboracion_por_ids_calendarios(".$idUsuarioModificador.",".$idPerfilLaboral.",'".$idCalendarios."')";
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }

    /**
     * Función para conocer si una hora se encuentra dentro de un rango de horas.
     * @param $hora
     * @param $hora_ini
     * @param $hora_fin
     * @return Resultset
     */
    public function verificaHoraEnRango($hora,$hora_ini,$hora_fin){
        if($hora!=''&&$hora_ini!=''&&$hora_fin!=''){
            $sql = "SELECT f_verifica_hora_en_rango AS resultado,CASE WHEN f_verifica_hora_en_rango=1 THEN 'La hora ".$hora." se encuentra dentro del rango entre ".$hora_ini." A ".$hora_fin.".'";
            $sql .= " ELSE 'La hora ".$hora." NO se encuentra dentro del rango entre ".$hora_ini." A ".$hora_fin.".' END AS msj FROM f_verifica_hora_en_rango('".$hora."','".$hora_ini."','".$hora_fin."')";
            return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
        }
    }
    /**
     * Función para obtener el par fecha de inicio y finalización de un calendario en una gestión y mes determinados.
     * @param $gestion
     * @param $mes
     * @return Resultset
     */
    public function getFechaIniFinCalendar($gestion,$mes){
        if($gestion>0&&$mes>0) {
            $sql = "SELECT * FROM f_obtener_fecha_ini_fin_calendario($gestion,$mes) ";
            return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
        }
    }

}
