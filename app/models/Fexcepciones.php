<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  26-02-2014
*/
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
class Fexcepciones extends \Phalcon\Mvc\Model {
    public $id;
    public $excepcion;
    public $tipoexcepcion_id;
    public $tipo_excepcion;
    public $codigo;
    public $color;
    public $compensatoria;
    public $compensatoria_descripcion;
    public $genero_id;
    public $genero;
    public $cantidad;
    public $unidad;
    public $fraccionamiento;
    public $frecuencia_descripcion;
    public $redondeo;
    public $redondeo_descripcion;
    public $observacion;
    public $estado;
    public $estado_descripcion;
    public $baja_logica;
    public $agrupador;
    public $user_reg_id;
    public $fecha_reg;
    public $user_mod_id;
    public $fecha_mod;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("");
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id'=>'id',
            'excepcion'=>'excepcion',
            'tipoexcepcion_id'=>'tipoexcepcion_id',
            'tipo_excepcion'=>'tipo_excepcion',
            'codigo'=>'codigo',
            'color'=>'color',
            'compensatoria'=>'compensatoria',
            'compensatoria_descripcion'=>'compensatoria_descripcion',
            'genero_id'=>'genero_id',
            'genero'=>'genero',
            'cantidad'=>'cantidad',
            'unidad'=>'unidad',
            'fraccionamiento'=>'fraccionamiento',
            'frecuencia_descripcion'=>'frecuencia_descripcion',
            'redondeo'=>'redondeo',
            'redondeo_descripcion'=>'redondeo_descripcion',
            'observacion'=>'observacion',
            'estado'=>'estado',
            'estado_descripcion'=>'estado_descripcion',
            'baja_logica'=>'baja_logica',
            'agrupador'=>'agrupador',
            'user_reg_id'=>'user_reg_id',
            'fecha_reg'=>'fecha_reg',
            'user_mod_id'=>'user_mod_id',
            'fecha_mod'=>'fecha_mod'
        );
    }
    private $_db;

    /**
     * Función para la obtención del listado de registros de excepciones.
     * @param string $where
     * @param string $group
     * @return Resultset
     */
    public function getAll($where='',$group='')
    {
        $sql = "SELECT * FROM f_excepciones()";
        if($where!='')$sql .= $where;
        if($group!='')$sql .= $group;
        $this->_db = new Fexcepciones();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }
} 