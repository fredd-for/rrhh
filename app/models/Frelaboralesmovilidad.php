<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  17-11-2014
*/


use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Frelaboralesmovilidad extends \Phalcon\Mvc\Model {
    public $id_relaboral;
    public $id_relaboralmovilidad;
    public $id_gerencia_administrativa;
    public $gerencia_administrativa;
    public $id_departamento_administrativo;
    public $departamento_administrativo;
    public $id_organigrama;
    public $unidad_administrativa;
    public $organigrama_sigla;
    public $organigrama_codigo;
    public $id_area;
    public $area;
    public $id_ubicacion;
    public $ubicacion;
    public $numero;
    public $cargo;
    public $fecha_ini;
    public $fecha_fin;
    public $tipo_memorandum;
    public $memorandum_correlativo;
    public $memorandum_gestion;
    public $fecha_mem;
    public $observacion;
    public $estado;
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
            'id_relaboral'=>'id_relaboral',
            'id_relaboralmovilidad'=>'id_relaboralmovilidad',
            'id_gerencia_administrativa'=>'id_gerencia_administrativa',
            'gerencia_administrativa'=>'gerencia_administrativa',
            'id_departamento_administrativo'=>'id_departamento_administrativo',
            'departamento_administrativo'=>'departamento_administrativo',
            'id_organigrama'=>'id_organigrama',
            'unidad_administrativa'=>'unidad_administrativa',
            'organigrama_sigla'=>'organigrama_sigla',
            'organigrama_codigo'=>'organigrama_codigo',
            'id_area'=>'id_area',
            'area'=>'area',
            'id_ubicacion'=>'id_ubicacion',
            'ubicacion'=>'ubicacion',
            'numero'=>'numero',
            'cargo'=>'cargo',
            'fecha_ini'=>'fecha_ini',
            'fecha_fin'=>'fecha_fin',
            'tipo_memorandum'=>'tipo_memorandum',
            'memorandum_correlativo'=>'memorandum_correlativo',
            'memorandum_gestion'=>'memorandum_gestion',
            'fecha_mem'=>'fecha_mem',
            'observacion'=>'observacion',
            'estado'=>'estado'
        );
    }
    private $_db;
    /**
     * Función para la obtención de la totalidad de los registros de relaciones laborales.
     * @return Resultset
     */
    public function getAll()
    {
        $sql = "SELECT * from f_relaborales_movilidad()";
        $this->_db = new Frelaboralesmovilidad();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }
    /**
     * Función para la obtención de la totalidad de los registros de relaciones laborales para un persona en particular.
     * @return Resultset
     */
    public function getAllByOne($idRelaboral)
    {
        if($idRelaboral>0){
            $sql = "SELECT * from f_relaborales_movilidad()";
            $sql .=" WHERE id_relaboral=".$idRelaboral;
            $this->_db = new Frelaboralesmovilidad();
            return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
        }
    }

} 