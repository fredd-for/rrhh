<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  09-03-2015
*/
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Horariosymarcaciones extends \Phalcon\Mvc\Model {

    private $_db;
    public function initialize() {
        $this->_db = new Horariosymarcaciones();
    }
    /**
     * Función para el establecimiento del estado PLANILLADO para los registros de horarios y marcaciones de acuerdo a un gestión y mes determinados.
     * Es necesario mencionar que se considera un rango de fechas establecido en la tabla de parámetros para la realización de esta tarea.
     * @param $idRelaboral
     * @param $gestion
     * @param $mes
     * @return bool
     */
    public function planillarHorariosYMarcacionesPorSalarios($idRelaboral,$gestion,$mes){
        if($idRelaboral>0&&$gestion>0&&$mes>0) {
            $db = $this->getDI()->get('db');
            $res = $db->execute("SELECT f_horariosymarcaciones_planillar AS resultado FROM f_horariosymarcaciones_planillar($idRelaboral,$gestion,$mes)");
            return $res;
        }return false;
    }

    /**
     * Función para el establecimiento del estado PLANILLADO para los registros de horarios y marcaciones de acuerdo a un gestión y mes determinados.
     * Es necesario mencionar que se considera un rango de fechas establecido en la tabla de parámetros para la realización de esta tarea.
     * @param $idRelaboral
     * @param $gestion
     * @param $mes
     * @return bool
     */
    public function planillarHorariosYMarcacionesPorRefrigerios($idRelaboral,$gestion,$mes){
        if($idRelaboral>0&&$gestion>0&&$mes>0) {
            $db = $this->getDI()->get('db');
            $res = $db->execute("SELECT f_horariosymarcaciones_planillar_por_refrigerios AS resultado FROM f_horariosymarcaciones_planillar_por_refrigerios($idRelaboral,$gestion,$mes)");
            return $res;
        }return false;
    }
} 