<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  02-04-2015
*/
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Fplanillassal extends \Phalcon\Mvc\Model {
    public $id;
    public $da_id;
    public $ejecutora_id;
    public $regional_id;
    public $gestion;
    public $mes;
    public $finpartida_id;
    public $tipoplanilla_id;
    public $numero;
    public $total_ganado;
    public $total_liquido;
    public $observacion;
    public $motivo_anu;
    public $estado;
    public $estado_descripcion;
    public $baja_logica;
    public $agrupador;
    public $user_reg_id;
    public $fecha_reg;
    public $user_mod_id;
    public $fecha_mod;
    public $user_ver_id;
    public $fecha_ver;
    public $user_apr_id;
    public $fecha_apr;
    public $user_rev_id;
    public $fecha_rev;
    public $user_anu_id;
    public $fecha_anu;

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
            'id'=>'id',
            'da_id'=>'da_id',
            'ejecutora_id'=>'ejecutora_id',
            'regional_id'=>'regional_id',
            'gestion'=>'gestion',
            'mes'=>'mes',
            'finpartida_id'=>'finpartida_id',
            'tipoplanilla_id'=>'ipoplanilla_id',
            'numero'=>'numero',
            'total_ganado'=>'total_ganado',
            'total_liquido'=>'total_liquido',
            'observacion'=>'observacion',
            'motivo_anu'=>'motivo_anu',
            'estado'=>'estado',
            'estado_descripcion'=>'estado_descripcion',
            'baja_logica'=>'baja_logica',
            'agrupador'=>'agrupador',
            'user_reg_id'=>'user_reg_id',
            'fecha_reg'=>'fecha_reg',
            'user_mod_id'=>'user_mod_id',
            'fecha_mod'=>'fecha_mod',
            'user_ver_id'=>'user_ver_id',
            'fecha_ver'=>'fecha_ver',
            'user_apr_id'=>'user_apr_id',
            'fecha_apr'=>'fecha_apr',
            'user_rev_id'=>'user_rev_id',
            'fecha_rev'=>'fecha_rev',
            'user_anu_id'=>'user_anu_id',
            'fecha_anu'=>'fecha_anu'
        );
    }
    private $_db;

    /**
     * Función para la obtención del listado de planillas generadas a un momento en particular.
     * @param string $where
     * @param string $group
     * @return Resultset
     */
    public function getAll($where='',$group=''){
        $sql = "SELECT p.id as id_persona,CAST(REPLACE(p.p_apellido||' '||CASE WHEN p.s_apellido IS NOT NULL THEN p.s_apellido ELSE '' END ||CASE WHEN p.c_apellido IS NOT NULL THEN ' '||p.c_apellido ELSE '' END ||CASE WHEN p.p_nombre IS NOT NULL THEN ' '||p.p_nombre ELSE '' END ||CASE WHEN p.s_nombre IS NOT NULL THEN ' '||p.s_nombre ELSE '' END ||CASE WHEN p.t_nombre IS NOT NULL THEN ' '||p.t_nombre ELSE '' END ,'  ',' ') AS character varying) AS nombres,";
        if($where!='')$sql .= $where;
        if($group!='')$sql .= $group;
        $this->_db = new Fplanillassal();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }
}