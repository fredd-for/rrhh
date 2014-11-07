<?php
/**
 * Created by PhpStorm.
 * User: JLOZA
 * Date: 14/10/2014
 * Time: 09:08 AM
 */

use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Fcargos  extends \Phalcon\Mvc\Model {
    public $id_cargos;
    public $codigo;
    public $id_estado;
    public $estado;
    public $id_finpartida;
    public $finpartida;
    public $id_condicion;
    public $condicion;
    public $id_organigrama;
    public $unidad_administrativa;
    public $id_gerencia_administrativa;
    public $gerencia_administrativa;
    public $id_departamento_administrativo;
    public $departamento_administrativo;
    public $id_nivelsalarial;
    public $nivelsalarial;
    public $cargo;
    public $sueldo;
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
            'id_cargos'=>'id_cargos',
            'codigo'=>'codigo',
            'id_estado'=>'id_estado',
            'estado'=>'estado',
            'id_finpartida'=>'id_finpartida',
            'finpartida'=>'finpartida',
            'id_condicion'=>'id_condicion',
            'condicion'=>'condicion',
            'id_organigrama'=>'id_organigrama',
            'unidad_administrativa'=>'unidad_administrativa',
            'id_gerencia_administrativa'=>'id_gerencia_administrativa',
            'gerencia_administrativa'=>'gerencia_administrativa',
            'id_departamento_administrativo'=>'id_departamento_administrativo',
            'departamento_administrativo'=>'departamento_administrativo',
            'id_nivelsalarial'=>'id_nivelsalarial',
            'nivelsalarial'=>'nivelsalarial',
            'cargo'=>'cargo',
            'sueldo'=>'sueldo',
        );
    }
    /**
     * Función para la obtención del listado de cargos cuyo código coincida con el registro.
     * @return Resultset
     */
    private $_db;
    public function getAllCargosAcefalos()
    {
        $sql = "SELECT * FROM f_cargos_acefalos()";
        $this->_db = new Fcargos();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }
}
?>