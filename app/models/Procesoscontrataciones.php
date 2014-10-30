<?php

use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Procesoscontrataciones extends \Phalcon\Mvc\Model
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
    public $normativamod_id;

    /**
     *
     * @var string
     */
    public $codigo_convocatoria;

    /**
     *
     * @var integer
     */
    public $regional_id;

    /**
     *
     * @var string
     */
    public $codigo_proceso;

    /**
     *
     * @var integer
     */
    public $gestion;

    /**
     *
     * @var string
     */
    public $fecha_publ;

    /**
     *
     * @var string
     */
    public $fecha_recep;

    /**
     *
     * @var string
     */
    public $fecha_concl;

    /**
     *
     * @var integer
     */
    public $tipoconvocatoria_id;

    /**
     *
     * @var string
     */
    public $observacion;

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
    public $agrupador;

    /**
     *
     * @var integer
     */
    public $user_reg_id;

    /**
     *
     * @var string
     */
    public $fecha_reg;

    /**
     *
     * @var integer
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
            'normativamod_id' => 'normativamod_id', 
            'codigo_convocatoria' => 'codigo_convocatoria', 
            'regional_id' => 'regional_id', 
            'codigo_proceso' => 'codigo_proceso', 
            'gestion' => 'gestion', 
            'fecha_publ' => 'fecha_publ', 
            'fecha_recep' => 'fecha_recep', 
            'fecha_concl' => 'fecha_concl', 
            'tipoconvocatoria_id' => 'tipoconvocatoria_id', 
            'observacion' => 'observacion', 
            'estado' => 'estado', 
            'baja_logica' => 'baja_logica', 
            'agrupador' => 'agrupador', 
            'user_reg_id' => 'user_reg_id', 
            'fecha_reg' => 'fecha_reg', 
            'user_mod_id' => 'user_mod_id', 
            'fecha_mod' => 'fecha_mod'
        );
    }

    private $_db;
    public function lista() {
        $sql = "SELECT p.*, n.normativa,n.modalidad,n.denominacion FROM procesoscontrataciones p, normativasmod n WHERE p.normativamod_id=n.id ORDER BY p.id ASC";
        $this->_db = new Seguimientos();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }


}
