<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  24-10-2014
*/

class Ubicaciones  extends \Phalcon\Mvc\Model {
    public $id;
    public $padre_id;
    public $ubicacion;
    public $observacion;
    public $estado;
    public $baja_logica;
    public $agrupador;
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
            'id' => 'id',
            'padre_id' => 'padre_id',
            'ubicacion' => 'ubicacion',
            'observacion' => 'observacion',
            'estado' => 'estado',
            'baja_logica' => 'baja_logica',
            'agrupador'=>'agrupador'
        );
    }
} 