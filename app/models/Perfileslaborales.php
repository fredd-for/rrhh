<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  14-10-2014
*/
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Perfileslaborales  extends \Phalcon\Mvc\Model {

    private $_db;

    public function initialize() {
        $this->_db = new Perfileslaborales();
        //   parent::initialize();
    }

    /**
     * Función para la obtención del primer día disponible de registro en calendario laboral. La fecha se devuelve disgregada en tres
     * columnas, una para el día, otro para el mes y finalmente para la gestión.
     * @param $idPerfil
     * @return Resultset
     */
    public function getPrimerDiaSiguienteMesParaCalendario($idPerfil){
        $sql = "SELECT * FROM f_primer_dia_siguiente_mes_para_calendario(".$idPerfil.")";
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }
} 