<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  02-12-2014
*/
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Fcalendariolaboral  extends \Phalcon\Mvc\Model {
    public $id_calendariolaboral;
    public $calendario_fecha_ini;
    public $calendario_fecha_fin;
    public $calendario_observacion;
    public $calendario_estado;
    public $calendario_estado_descripcion;
    public $id_perfillaboral;
    public $perfil_laboral;
    public $perfil_laboral_grupo;
    public $tipo_horario_descripcion;
    public $perfil_laboral_observacion;
    public $perfil_laboral_estado;
    public $perfil_laboral_estado_descripcion;
    public $id_horariolaboral;
    public $horario_nombre;
    public $horario_nombre_alternativo;
    public $hora_entrada;
    public $hora_salida;
    public $horas_laborales;
    public $dias_laborales;
    public $rango_entrada;
    public $rango_salida;
    public $hora_inicio_rango_ent;
    public $hora_final_rango_ent;
    public $hora_inicio_rango_sal;
    public $hora_final_rango_sal;
    public $color;
    public $horario_fecha_ini;
    public $horario_fecha_fin;
    public $horario_observacion;
    public $horario_estado;
    public $horario_estado_descripcion;
    public $id_tolerancia;
    public $tolerancia;
    public $tolerancia_tipo_acumulacion;
    public $tolerancia_tipo_acumulacion_descripcion;
    public $tolerancia_consideracion_retraso;
    public $tolerancia_consideracion_retraso_descripcion;
    public $tolerancia_descripcion;
    public $tolerancia_fecha_ini;
    public $tolerancia_fecha_fin;
    public $tolerancia_observacion;
    public $tolerancia_estado;
    public $tolerancia_estado_descripcion;

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
            'id_calendariolaboral'=>'id_calendariolaboral',
            'calendario_fecha_ini'=>'calendario_fecha_ini',
            'calendario_fecha_fin'=>'calendario_fecha_fin',
            'calendario_observacion'=>'calendario_observacion',
            'calendario_estado'=>'calendario_estado',
            'calendario_estado_descripcion'=>'calendario_estado_descripcion',
            'id_perfillaboral'=>'id_perfillaboral',
            'perfil_laboral'=>'perfil_laboral',
            'perfil_laboral_grupo'=>'perfil_laboral_grupo',
            'tipo_horario_descripcion'=>'tipo_horario_descripcion',
            'perfil_laboral_observacion'=>'perfil_laboral_observacion',
            'perfil_laboral_estado'=>'perfil_laboral_estado',
            'perfil_laboral_estado_descripcion'=>'perfil_laboral_estado_descripcion',
            'id_horariolaboral'=>'id_horariolaboral',
            'horario_nombre'=>'horario_nombre',
            'horario_nombre_alternativo'=>'horario_nombre_alternativo',
            'hora_entrada'=>'hora_entrada',
            'hora_salida'=>'hora_salida',
            'horas_laborales'=>'horas_laborales',
            'dias_laborales'=>'dias_laborales',
            'rango_entrada'=>'rango_entrada',
            'rango_salida'=>'rango_salida',
            'hora_inicio_rango_ent'=>'hora_inicio_rango_ent',
            'hora_final_rango_ent'=>'hora_final_rango_ent',
            'hora_inicio_rango_sal'=>'hora_inicio_rango_sal',
            'hora_final_rango_sal'=>'hora_final_rango_sal',
            'color'=>'color',
            'horario_fecha_ini'=>'horario_fecha_ini',
            'horario_fecha_fin'=>'horario_fecha_fin',
            'horario_observacion'=>'horario_observacion',
            'horario_estado'=>'horario_estado',
            'horario_estado_descripcion'=>'horario_estado_descripcion',
            'id_tolerancia'=>'id_tolerancia',
            'tolerancia'=>'tolerancia',
            'tolerancia_tipo_acumulacion'=>'tolerancia_tipo_acumulacion',
            'tolerancia_tipo_acumulacion_descripcion'=>'tolerancia_tipo_acumulacion_descripcion',
            'tolerancia_consideracion_retraso'=>'tolerancia_consideracion_retraso',
            'tolerancia_consideracion_retraso_descripcion'=>'tolerancia_consideracion_retraso_descripcion',
            'tolerancia_descripcion'=>'tolerancia_descripcion',
            'tolerancia_fecha_ini'=>'tolerancia_fecha_ini',
            'tolerancia_fecha_fin'=>'tolerancia_fecha_fin',
            'tolerancia_observacion'=>'tolerancia_observacion',
            'tolerancia_estado'=>'tolerancia_estado',
            'tolerancia_estado_descripcion'=>'tolerancia_estado_descripcion'
        );
    }
    /**
     * Función para la obtención del listado de horarios laborales registrados en el calendario laboral.
     * @return Resultset
     */
    public function getAllRegisteredByPerfilLaboral($idPerfilLaboral)
    {
        $sql = "SELECT * FROM f_calendario_laboral_registrado($idPerfilLaboral)";
        $this->_db = new Fcalendariolaboral();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }
    /**
     * Función para la obtención del listado de horarios laborales registrados en el calendario laboral.
     * Considerando un periodo de tiempo.
     * @return Resultset
     */
    public function getAllRegisteredByPerfilLaboralRangoFechas($idPerfilLaboral,$fechaIni,$fechaFin)
    {
        $sql = "SELECT * FROM f_calendario_laboral_registrado($idPerfilLaboral)";
        if($fechaIni!=""&&$fechaFin!=""){
            $sql .= " WHERE calendario_fecha_ini BETWEEN '".$fechaIni."' and '".$fechaFin."'";
            $sql .= " OR calendario_fecha_fin BETWEEN '".$fechaIni."' and '".$fechaFin."'";
        }
        $this->_db = new Fcalendariolaboral();
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
    }
} 