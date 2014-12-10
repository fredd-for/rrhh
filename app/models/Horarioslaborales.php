<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  05-12-2014
*/


use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Horarioslaborales extends \Phalcon\Mvc\Model {
    public $id;
    public $nombre;
    public $nombre_alternativo;
    public $hora_entrada;
    public $hora_salida;
    public $minutos_tolerancia_ent;
    public $minutos_tolerancia_sal;
    public $minutos_tolerancia_acu;
    public $rango_entrada;
    public $rango_salida;
    public $hora_inicio_rango_ent;
    public $hora_final_rango_ent;
    public $hora_inicio_rango_sal;
    public $hora_final_rango_sal;
    public $color;
    public $fecha_ini;
    public $fecha_fin;
    public $observacion;
    public $estado;
    public $baja_logica;
    public $agrupador;
    public $user_reg_id;
    public $fecha_reg;
    public $user_mod_id;
    public $fecha_mod;

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
            'nombre' => 'nombre',
            'nombre_alternativo' => 'nombre_alternativo',
            'hora_entrada'=>'hora_entrada',
            'hora_salida'=>'hora_salida',
            'minutos_tolerancia_ent'=>'minutos_tolerancia_ent',
            'minutos_tolerancia_sal'=>'minutos_tolerancia_sal',
            'minutos_tolerancia_acu'=>'minutos_tolerancia_acu',
            'rango_entrada'=>'rango_entrada',
            'rango_salida'=>'rango_salida',
            'hora_inicio_rango_ent'=>'hora_inicio_rango_ent',
            'hora_final_rango_ent'=>'hora_final_rango_ent',
            'hora_inicio_rango_sal'=>'hora_inicio_rango_sal',
            'hora_final_rango_sal'=>'hora_final_rango_sal',
            'color'=>'color',
            'fecha_ini'=>'fecha_ini',
            'fecha_fin'=>'fecha_fin',
            'observacion'=>'observacion',
            'estado'=>'estado',
            'baja_logica'=>'baja_logica',
            'agrupador'=>'agrupador',
            'user_reg_id'=>'user_reg_id',
            'fecha_reg'=>'fecha_reg',
            'user_mod_id'=>'user_mod_id',
            'fecha_mod'=>'fecha_mod'
        );
    }

} 