<?php
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
class Cargos extends \Phalcon\Mvc\Model
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
    public $organigrama_id;

    /**
     *
     * @var integer
     */
    public $ejecutora_id;

    /**
     *
     * @var string
     */
    public $codigo;

    /**
     *
     * @var string
     */
    public $cargo;

    /**
     *
     * @var integer
     */
    public $nivelsalarial_id;

    /**
     *
     * @var integer
     */
    public $cargo_estado_id;

    /**
     *
     * @var integer
     */
    public $baja_logica;

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
     *
     * @var integer
     */
    public $estado;

    /**
     *
     * @var integer
     */
    public $fin_partida_id;

    
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
            'organigrama_id' => 'organigrama_id', 
            'ejecutora_id' => 'ejecutora_id', 
            'codigo' => 'codigo', 
            'cargo' => 'cargo', 
            'nivelsalarial_id' => 'nivelsalarial_id', 
            'cargo_estado_id' => 'cargo_estado_id', 
            'baja_logica' => 'baja_logica', 
            'user_reg_id' => 'user_reg_id', 
            'fecha_reg' => 'fecha_reg', 
            'user_mod_id' => 'user_mod_id', 
            'fecha_mod' => 'fecha_mod',
            'estado' => 'estado',
            'fin_partida_id' => 'fin_partida_id'
            
        );
    }

    private $_db;

    public function lista(){
        $sql = "SELECT c.id,o.unidad_administrativa,e.unidad_ejecutora,c.codigo,c.cargo,n.denominacion,n.sueldo,ca.estado,c.estado,c.fin_partida_id, f.denominacion as fuentefinanciamiento
FROM cargos c 
INNER JOIN organigramas o ON c.organigrama_id=o.id
INNER JOIN ejecutoras e ON c.ejecutora_id=e.id
INNER JOIN nivelsalariales n ON c.nivelsalarial_id = n.id 
INNER JOIN cargosestados ca ON c.cargo_estado_id=ca.id
INNER JOIN finpartidas f ON c.fin_partida_id=f.id
WHERE c.baja_logica=1 ";
        $this->_db = new Cargos();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }

}
