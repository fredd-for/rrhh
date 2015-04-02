<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  02-04-2015
*/
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Fmarcaciones extends \Phalcon\Mvc\Model {
    public $id_persona;
    public $nombres;
    public $ci;
    public $expd;
    public $estado;
    public $estado_descripcion;
    public $gestion;
    public $mes;
    public $fecha;
    public $hora;
    public $id_maquina;
    public $maquina;
    public $user_reg_id;
    public $fecha_reg;
    public $fecha_ini_rango;
    public $fecha_fin_rango;

    public function initialize() {
        $this->setSchema("");
    }
    /**
     * Función para el mapeado de las columnas.
     */
    public function columnMap()
    {
        return array(
            'id_persona'=>'id_persona',
            'nombres'=>'nombres',
            'ci'=>'ci',
            'expd'=>'expd',
            'estado'=>'estado',
            'estado_descripcion'=>'estado_descripcion',
            'gestion'=>'gestion',
            'mes'=>'mes',
            'fecha'=>'fecha',
            'hora'=>'hora',
            'id_maquina'=>'id_maquina',
            'maquina'=>'maquina',
            'user_reg_id'=>'user_reg_id',
            'fecha_reg'=>'fecha_reg',
            'fecha_ini_rango'=>'fecha_ini_rango',
            'fecha_fin_rango'=>'fecha_fin_rango'
        );
    }

    private $_db;
    /**
     * Función para la obtención de la totalidad de los registros de marcaciones.
     * @return Resultset
     */
    public function getAll($where='',$group='')
    {
        $sql = "SELECT * FROM f_marcaciones()";
        if($where!='')$sql .= $where;
        if($group!='')$sql .= $group;
        $this->_db = new Fmarcaciones();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }
}
?>