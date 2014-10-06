<?php
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Seguimientos extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    public $fk_usuario;

    public $codigo_proceso;

    public $fk_unidad_organizacional;

    public $fk_cargo;

    public $codigo_cargo;

    public $nro_solicitud;

    public $f_solicitud;

    public $cert_presuestaria;

    public $f_cert_presuestaria;

    public $vacante;

    public $haber_basico;

    public $f_aprobacion_mae;

    public $tipo_contratacion;

    public $fk_componente;

    public $fk_fuentefinanciamiento;

    public $fk_partida;

    public $f_publicacion;

    public $f_recepcion;

    public $f_conclusion;

    public $f_aprobacion;

    public $fk_proceso;

    public $ubicacion_puesto;

    public $oficinas_id;

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
            'fk_usuario' => 'fk_usuario', 
            'codigo_proceso' => 'codigo_proceso', 
            'fk_unidad_organizacional' => 'fk_unidad_organizacional', 
            'fk_cargo' => 'fk_cargo', 
            'codigo_cargo' => 'codigo_cargo', 
            'nro_solicitud' => 'nro_solicitud', 
            'f_solicitud' => 'f_solicitud', 
            'cert_presupuestaria' => 'cert_presupuestaria', 
            'f_cert_presupuestaria' => 'f_cert_presupuestaria', 
            'vacante' => 'vacante', 
            'haber_basico' => 'haber_basico', 
            'f_aprobacion_mae' => 'f_aprobacion_mae', 
            'tipo_contratacion' => 'tipo_contratacion', 
            'fk_componente' => 'fk_componente', 
            'fk_fuentefinanciamiento' => 'fk_fuentefinanciamiento', 
            'fk_partida' => 'fk_partida', 
            'f_publicacion' => 'f_publicacion', 
            'f_recepcion' => 'f_recepcion', 
            'f_conclusion' => 'f_conclusion', 
            'f_aprobacion' => 'f_aprobacion', 
            'fk_proceso' => 'fk_proceso', 
            'ubicacion_puesto' => 'ubicacion_puesto', 
            'oficinas_id' => 'oficinas_id', 
            'fk_usuariosolicitud' => 'fk_usuariosolicitud',
            'activo' => 'activo'
        );
    }

     private $_db;

    
    public function lista() {
        $sql = "SELECT s.id,o.oficina,u.nombre,s.codigo_proceso,s.codigo_cargo,s.nro_solicitud,s.f_solicitud,c.cargo FROM seguimientos s, oficinatmp o, cargotmp c , usuarios u WHERE s.activo=TRUE AND s.fk_unidad_organizacional=o.id AND s.fk_cargo=c.id AND s.fk_usuariosolicitud=u.id order by s.id asc";
        $this->_db = new Seguimientos();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }


}
