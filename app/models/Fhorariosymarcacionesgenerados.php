<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  06-04-2015
*/


use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Fhorariosymarcacionesgenerados extends \Phalcon\Mvc\Model {
    public $relaboral_id;
    public $id_perfillaboral;
    public $perfil_laboral;
    public $grupo;
    public $perfil_fecha_ini;
    public $perfil_fecha_fin;
    public $gestion;
    public $mes;
    public $mes_nonmbre;
    public $rango_fecha_ini;
    public $rango_fecha_fin;
    public $estado;
    public $estado_descripcion;
    public $estado_global;
    public $prevista_estado;
    public $prevista_estado_descripcion;
    public $prevista_estado_global;

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
            'relaboral_id'=>'relaboral_id',
            'id_perfillaboral'=>'id_perfillaboral',
            'perfil_laboral'=>'perfil_laboral',
            'grupo'=>'grupo',
            'perfil_fecha_ini'=>'perfil_fecha_ini',
            'perfil_fecha_fin'=>'perfil_fecha_fin',
            'gestion'=>'gestion',
            'mes'=>'mes',
            'mes_nonmbre'=>'mes_nonmbre',
            'rango_fecha_ini'=>'rango_fecha_ini',
            'rango_fecha_fin'=>'rango_fecha_fin',
            'estado'=>'estado',
            'estado_descripcion'=>'estado_descripcion',
            'estado_global'=>'estado_global',
            'prevista_estado'=>'prevista_estado',
            'prevista_estado_descripcion'=>'prevista_estado_descripcion',
            'prevista_estado_global'=>'prevista_estado_global'
        );
    }
    private $_db;

    /**
     * Función para la obtención del listado descriptivo de horarios de marcación generados en el sistema.
     * @param $idRelaboral
     * @param $gestion
     * @param $mes
     * @param $clasemaracion
     * @param string $where
     * @param string $group
     * @return Resultset
     */
    public function getAll($idRelaboral,$gestion,$mes,$clasemaracion,$where='',$group='')
    {
        $sql = "SELECT * FROM f_horariosymarcaciones_generados($idRelaboral,$gestion,$mes,'$clasemaracion') ORDER BY gestion,mes";
        if($where!='')$sql .= $where;
        if($group!='')$sql .= $group;
        $this->_db = new Frelaborales();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }   /**
     * Función para la obtención del listado descriptivo de horarios de marcación generados en el sistema, considerando que
     * la consulta se efectua haciendo un cruce de información entre dos tipos de marcación. El caso de más uso será entre lo previsto (H) y lo efectivo (M).
     * @param $idRelaboral
     * @param $gestion
     * @param $mes
     * @param $clasemaracionA
     * @param $clasemaracionB
     * @param string $where
     * @param string $group
     * @return Resultset
     */
    public function getAllCruzada($idRelaboral,$gestion,$mes,$clasemarcacionA,$clasemarcacionB,$where='',$group='')
    {
        $sql = "SELECT m.*,h.estado as prevista_estado,h.estado_descripcion AS prevista_estado_descripcion,m.estado_global AS prevista_estado_global ";
        $sql .= "FROM f_horariosymarcaciones_generados($idRelaboral,$gestion,$mes,'$clasemarcacionA') m ";
        $sql .= "INNER JOIN f_horariosymarcaciones_generados($idRelaboral,$gestion,$mes,'$clasemarcacionB') h ON ";
        $sql .= "h.id_relaboral=m.id_relaboral AND h.id_perfillaboral = m.id_perfillaboral AND ";
        $sql .= "h.rango_fecha_ini=m.rango_fecha_ini AND ";
        $sql .= "h.rango_fecha_fin=m.rango_fecha_fin ";
        $sql .= "ORDER BY m.gestion,m.mes";

        if($where!='')$sql .= $where;
        if($group!='')$sql .= $group;
        $this->_db = new Frelaborales();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }
}