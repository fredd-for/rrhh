<?php

class Nivelsalariales extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $resolucion_id;

    /**
     *
     * @var integer
     */
    public $gestion;

    /**
     *
     * @var string
     */
    public $categoria;

    /**
     *
     * @var integer
     */
    public $clase;

    /**
     *
     * @var integer
     */
    public $nivel;

    /**
     *
     * @var integer
     */
    public $sub_nivel_salarial;

    /**
     *
     * @var string
     */
    public $denominacion;

    /**
     *
     * @var double
     */
    public $sueldo;

    /**
     *
     * @var string
     */
    public $fecha_ini;

    /**
     *
     * @var string
     */
    public $fecha_fin;

    /**
     *
     * @var integer
     */
    public $estado;

    /**
     *
     * @var integer
     */
    public $baja_logica;

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
            'resolucion_id' => 'resolucion_id', 
            'gestion' => 'gestion', 
            'categoria' => 'categoria', 
            'clase' => 'clase', 
            'nivel' => 'nivel', 
            'sub_nivel_salarial' => 'sub_nivel_salarial', 
            'denominacion' => 'denominacion', 
            'sueldo' => 'sueldo', 
            'fecha_ini' => 'fecha_ini', 
            'fecha_fin' => 'fecha_fin', 
            'estado' => 'estado', 
            'baja_logica' => 'baja_logica'
        );
    }

}
