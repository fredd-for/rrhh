<?php

class Cargosperfiles extends \Phalcon\Mvc\Model
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
    public $nivelsalarial_id;

    /**
     *
     * @var string
     */
    public $formacion_academica0;

    /**
     *
     * @var string
     */
    public $formacion_academica;

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
     *
     * @var integer
     */
    public $exp_general_lic0_anio;

    /**
     *
     * @var integer
     */
    public $exp_general_lic0_mes;

    /**
     *
     * @var integer
     */
    public $exp_general_tec0_anio;

    /**
     *
     * @var integer
     */
    public $exp_general_tec0_mes;

    /**
     *
     * @var integer
     */
    public $exp_profesional_lic0_anio;

    /**
     *
     * @var integer
     */
    public $exp_profesional_lic0_mes;

    /**
     *
     * @var integer
     */
    public $exp_profesional_tec0_anio;

    /**
     *
     * @var integer
     */
    public $exp_profesional_tec0_mes;

    /**
     *
     * @var integer
     */
    public $exp_relacionado_lic0_anio;

    /**
     *
     * @var integer
     */
    public $exp_relacionado_lic0_mes;

/**
     *
     * @var integer
     */
    public $exp_relacionado_tec0_anio;

    /**
     *
     * @var integer
     */
    public $exp_relacionado_tec0_mes;

    /**
     *
     * @var integer
     */
    public $exp_general_lic_anio;

    /**
     *
     * @var integer
     */
    public $exp_general_lic_mes;

    /**
     *
     * @var integer
     */
    public $exp_general_tec_anio;

    /**
     *
     * @var integer
     */
    public $exp_general_tec_mes;

    /**
     *
     * @var integer
     */
    public $exp_profesional_lic_anio;

    /**
     *
     * @var integer
     */
    public $exp_profesional_lic_mes;

    /**
     *
     * @var integer
     */
    public $exp_profesional_tec_anio;

    /**
     *
     * @var integer
     */
    public $exp_profesional_tec_mes;

    /**
     *
     * @var integer
     */
    public $exp_relacionado_lic_anio;

    /**
     *
     * @var integer
     */
    public $exp_relacionado_lic_mes;

    /**
     *
     * @var integer
     */
    public $exp_relacionado_tec_anio;

    /**
     *
     * @var integer
     */
    public $exp_relacionado_tec_mes;

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
            'nivelsalarial_id' => 'nivelsalarial_id', 
            'formacion_academica0' => 'formacion_academica0', 
            'formacion_academica' => 'formacion_academica', 
            'estado' => 'estado', 
            'baja_logica' => 'baja_logica', 
            'exp_general_lic0_anio' => 'exp_general_lic0_anio', 
            'exp_general_lic0_mes' => 'exp_general_lic0_mes', 
            'exp_general_tec0_anio' => 'exp_general_tec0_anio', 
            'exp_general_tec0_mes' => 'exp_general_tec0_mes', 
            'exp_profesional_lic0_anio' => 'exp_profesional_lic0_anio', 
            'exp_profesional_lic0_mes' => 'exp_profesional_lic0_mes', 
            'exp_profesional_tec0_anio' => 'exp_profesional_tec0_anio', 
            'exp_profesional_tec0_mes' => 'exp_profesional_tec0_mes', 
            'exp_relacionado_lic0_anio' => 'exp_relacionado_lic0_anio', 
            'exp_relacionado_lic0_mes' => 'exp_relacionado_lic0_mes', 
            'exp_relacionado_tec0_anio' => 'exp_relacionado_tec0_anio', 
            'exp_relacionado_tec0_mes' => 'exp_relacionado_tec0_mes', 
            'exp_general_lic_anio' => 'exp_general_lic_anio', 
            'exp_general_lic_mes' => 'exp_general_lic_mes', 
            'exp_general_tec_anio' => 'exp_general_tec_anio', 
            'exp_general_tec_mes' => 'exp_general_tec_mes', 
            'exp_profesional_lic_anio' => 'exp_profesional_lic_anio', 
            'exp_profesional_lic_mes' => 'exp_profesional_lic_mes', 
            'exp_profesional_tec_anio' => 'exp_profesional_tec_anio', 
            'exp_profesional_tec_mes' => 'exp_profesional_tec_mes', 
            'exp_relacionado_lic_anio' => 'exp_relacionado_lic_anio', 
            'exp_relacionado_lic_mes' => 'exp_relacionado_lic_mes', 
            'exp_relacionado_tec_anio' => 'exp_relacionado_tec_anio', 
            'exp_relacionado_tec_mes' => 'exp_relacionado_tec_mes'
        );
    }

}
