<?php
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
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
     *
     * @var integer
     */
    public $agrupador;

    /**
     *
     * @var integer
     */
    public $activo;

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
            'baja_logica' => 'baja_logica',
            'agrupador' => 'agrupador',
            'activo' => 'activo'
        );
    }

    private $_db;

    public function lista(){
        $sql = "SELECT n.id,n.resolucion_id,r.tipo_resolucion,r.numero_res,n.categoria,n.clase,n.denominacion,n.nivel,n.sueldo FROM nivelsalariales n, resoluciones r WHERE n.baja_logica=1 AND n.resolucion_id=r.id order by n.id asc";
        $this->_db = new Nivelsalariales();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }
    
}
