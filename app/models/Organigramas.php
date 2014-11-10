<?php
/*
*   Sarha - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Ing. Freddy Velasco
*   Fecha Creación:  13-10-2014
*/
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

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
     *
     * @var integer
     */
    public $area_sustantiva;

    /**
     *
     * @var integer
     */
    public $visible;

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
            'fecha_mod' => 'fecha_mod',
            'area_sustantiva' => 'area_sustantiva',
            'visible' => 'visible'
        );
    }

    private $_db;
    public function lista() {
        $sql = "SELECT o.id,o.padre_id,org.unidad_administrativa as padre,d.direccion_administrativa,o.unidad_administrativa,o.nivel_estructural_id,o.da_id,n.nivel_estructural,o.sigla 
        FROM organigramas o, das d, nivelestructurales n, organigramas org
        WHERE o.da_id=d.id AND o.nivel_estructural_id=n.id AND o.baja_logica=1 AND o.padre_id=org.id ORDER BY o.padre_id ASC";
        $this->_db = new Seguimientos();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }

    /**
     * Función para la obtención del listado de áreas administrativas de acuerdo al parámetro enviado.
     * @param $idPadre Identificador del organigrama del cual se desea conocer las áreas dependientes.
     * @return Resultset Listado de organigramas con nivel estructural de area.
     */
    public function getAreas($idPadre=0)
    {
        $sql = "SELECT * from f_areas(".$idPadre.")";
        $this->_db = new Organigramas();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }

}
