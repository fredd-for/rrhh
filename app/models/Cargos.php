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
     *
     * @var integer
     */
    public $depende_id;

    
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
            'fin_partida_id' => 'fin_partida_id',
            'depende_id' => 'depende_id'
            
        );
    }

    private $_db;

    public function lista(){
        $sql = "SELECT ROW_NUMBER() OVER(ORDER BY c.id asc) AS nro,c.id,c.organigrama_id,o.unidad_administrativa,c.nivelsalarial_id,e.unidad_ejecutora,c.codigo,c.cargo,n.denominacion,n.sueldo,ca.estado,CASE WHEN c.estado=0  THEN 'ACEFALO'  WHEN c.estado=1  THEN 'ADJUDICADO'  ELSE 'OTRO'  END as estado1,c.fin_partida_id, f.denominacion as fuentefinanciamiento,c.cargo_estado_id
FROM cargos c 
INNER JOIN organigramas o ON c.organigrama_id=o.id
INNER JOIN ejecutoras e ON c.ejecutora_id=e.id
INNER JOIN nivelsalariales n ON c.nivelsalarial_id = n.id 
INNER JOIN cargosestados ca ON c.cargo_estado_id=ca.id
INNER JOIN finpartidas f ON c.fin_partida_id=f.id
WHERE c.baja_logica=1 order by c.id asc";
        $this->_db = new Cargos();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }


    public function listapac(){
        $sql = "SELECT  ROW_NUMBER() OVER(ORDER BY p.fecha_ini asc) AS nro,p.*, c.cargo,c.codigo,n.sueldo,o.unidad_administrativa 
        FROM pacs p
INNER JOIN cargos c ON p.cargo_id=c.id
INNER JOIN organigramas o ON c.organigrama_id=o.id
INNER JOIN nivelsalariales n ON c.nivelsalarial_id=n.id
WHERE p.baja_logica=1 order by p.fecha_ini asc";
        $this->_db = new Cargos();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }

    public function getCI($cargo_id='')
    {
        $sql = "select p.ci,p.p_nombre,p.p_apellido,p.s_apellido from relaborales r,personas p where r.cargo_id='$cargo_id' and r.estado = 1 and r.baja_logica=1 and r.persona_id = p.id";
        $this->_db = new Cargos();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }

    public function getPersonalOrganigrama($organigrama_id='')
    {
        $sql = "SELECT r.id,CONCAT(p.p_apellido,' ',p.s_apellido,' ',p.p_nombre,' ',p.s_nombre) as nombre,c.cargo
        FROM relaborales r, personas p, cargos c 
        WHERE r.estado = 1 AND r.baja_logica=1 AND r.organigrama_id = '$organigrama_id' AND r.persona_id=p.id AND r.cargo_id=c.id
        ORDER BY p.p_apellido ASC";
        $this->_db = new Cargos();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));   
    }

}
