<?php
/*
*   Sarha - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Ing. Freddy Velasco
*   Fecha Creación:  13-10-2014
*/

class Organigramas extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $padre_id;

    /**
     *
     * @var string
     */
    public $gestion;

    /**
     *
     * @var string
     */
    public $da_id;

    /**
     *
     * @var string
     */
    public $regional_id;

    /**
     *
     * @var string
     */
    public $unidad_administrativa;

    /**
     *
     * @var string
     */
    public $nivel_estructural_id;

    /**
     *
     * @var string
     */
    public $sigla;

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
     * @var string
     */
    public $codigo;

    /**
     *
     * @var string
     */
    public $observacion;

    /**
     *
     * @var string
     */
    public $estado;

    /**
     *
     * @var string
     */
    public $baja_logica;

    /**
     *
     * @var string
     */
    public $user_reg_id;    

    /**
     *
     * @var string
     */
    public $fecha_reg;

    /**
     *
     * @var string
     */
    public $user_mod_id;

    /**
     *
     * @var string
     */
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
            'id' => 'id', 
            'padre_id' => 'padre_id', 
            'gestion' => 'gestion', 
            'da_id' => 'da_id',
            'regional_id' => 'regional_id',
            'unidad_administrativa' => 'unidad_administrativa',
            'nivel_estructural_id' => 'nivel_estructural_id',
            'sigla' => 'sigla',
            'fecha_ini' => 'fecha_ini',
            'fecha_fin' => 'fecha_fin',
            'codigo' => 'codigo',
            'observacion' => 'observacion',
            'estado' => 'estado',
            'baja_logica' => 'baja_logica',
            'user_reg_id' => 'user_reg_id',
            'fecha_reg' => 'fecha_reg',
            'user_mod_id' => 'user_mod_id',
            'fecha_mod' => 'fecha_mod'
        );
    }

}
