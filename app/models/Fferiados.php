<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  19-02-2015
*/
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Fferiados extends \Phalcon\Mvc\Model {
    public $id;
    public $feriado;
    public $descripcion;
    public $regional_id;
    public $regional;
    public $horario_discontinuo;
    public $horario_discontinuo_descripcion;
    public $horario_continuo;
    public $horario_continuo_descripcion;
    public $horario_multiple;
    public $horario_multiple_descripcion;
    public $cantidad_dias;
    public $repetitivo;
    public $repetitivo_descripcion;
    public $dia;
    public $mes;
    public $gestion;
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
            'feriado'=>'feriado',
            'descripcion'=>'descripcion',
            'regional_id'=>'regional_id',
            'regional'=>'regional',
            'horario_discontinuo'=>'horario_discontinuo',
            'horario_discontinuo_descripcion'=>'horario_discontinuo_descripcion',
            'horario_continuo'=>'horario_continuo',
            'horario_continuo_descripcion'=>'horario_continuo_descripcion',
            'horario_multiple'=>'horario_multiple',
            'horario_multiple_descripcion'=>'horario_multiple_descripcion',
            'cantidad_dias'=>'cantidad_dias',
            'repetitivo'=>'repetitivo',
            'repetitivo_descripcion'=>'repetitivo_descripcion',
            'dia'=>'dia',
            'mes'=>'mes',
            'mes_nombre'=>'mes_nombre',
            'gestion'=>'gestion',
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
    /**
     * Función para la obtención del listado de feriados.
     * @return Resultset
     */
    private $_db;
    public function getAll()
    {
        $sql = "SELECT * FROM f_feriados()";
        $this->_db = new Fferiados();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }

} 