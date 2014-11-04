<?php
/**
 * Created by PhpStorm.
 * User: JLOZA
 * Date: 20/10/2014
 * Time: 08:29 PM
 */

class personas extends \Phalcon\Mvc\Model{
    public $id;
    public $postulante_id;
    public $p_nombre;
    public $s_nombre;
    public $t_nombre;
    public $p_apellido;
    public $s_apellido;
    public $c_apellido;
    public $ci;
    public $expd;
    public $num_complemento;
    public $fecha_nac;
    public $lugar_nac;
    public $genero;
    public $e_civil;
    public $codigo;
    public $nacionalidad;
    public $nit;
    public $num_func_sigma;
    public $grupo_sanguineo;
    public $num_lib_ser_militar;
    public $num_reg_profesional;
    public $observacion;
    public $nteger;
    public $visible;
    public $baja_logica;
    public $agrupador;
    public $user_reg_id;
    public $fecha_reg;
    public $user_mod_id;
    public $fecha_mod;
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
            'postulante_id'=>'',
            'p_nombre'=>'p_nombre',
            's_nombre'=>'s_nombre',
           't_nombre'=>'t_nombre',
            'p_apellido'=>'p_apellido',
            's_apellido'=>'s_apellido',
            'c_apellido'=>'c_apellido',
            'ci'=>'ci',
            'expd'=>'expd',
            'num_complemento'=>'num_complemento',
            'fecha_nac'=>'fecha_nac',
            'lugar_nac'=>'lugar_nac',
            'genero'=>'genero',
            'e_civil'=>'e_civil',
            'codigo'=>'codigo',
            'nacionalidad'=>'nacionalidad',
            'nit'=>'nit',
            'num_func_sigma'=>'num_func_sigma',
            'grupo_sanguineo'=>'grupo_sanguineo',
            'num_lib_ser_militar'=>'num_lib_ser_militar',
            'num_reg_profesional'=>'num_reg_profesional',
            'observacion'=>'observacion',
            'estado'=>'estado',
            'visible'=>'visible',
            'baja_logica'=>'baja_logica',
            'agrupador'=>'agrupador',
            'user_reg_id'=>'user_reg_id',
            'fecha_reg'=>'fecha_reg',
            'user_mod_id'=>'user_mod_id',
            'fecha_mod'=>'fecha_mod',      );
    }
} 