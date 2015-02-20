<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  18-02-2015
*/

class FeriadosController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        $this->assets->addJs('/js/jquery.PrintArea.js');
        $this->assets->addCss('/assets/css/PrintArea.css');
        $this->assets->addCss('/css/oasis.grillas.css');
        $this->assets->addCss('/assets/css/oasis.principal.css');
        $this->assets->addCss('/assets/css/bootstrap-switch.css');

        $this->assets->addJs('/js/relaborales/oasis.localizacion.js');
        $this->assets->addJs('/js/switch/bootstrap-switch.js');

        $this->assets->addJs('/js/feriados/oasis.feriados.tab.js');
        $this->assets->addJs('/js/feriados/oasis.feriados.index.js');
        $this->assets->addJs('/js/feriados/oasis.feriados.approve.js');
        $this->assets->addJs('/js/feriados/oasis.feriados.new.edit.js');
        $this->assets->addJs('/js/feriados/oasis.feriados.down.js');
    }
    /**
     * Función para la carga del primer listado sobre la página de gestión de tolerancias de ingreso.
     * Se inhabilita la vista para el uso de jqwidgets,
     */
    public function listAction()
    {
        $this->view->disable();
        $obj = new Fferiados();
        $resul = $obj->getAll();
        $horariolaboral = Array();
        //comprobamos si hay filas
        if ($resul->count() > 0) {
            foreach ($resul as $v) {
                $horariolaboral[] = array(
                    'nro_row' => 0,
                    'id'=>$v->id,
                    'feriado'=>$v->feriado,
                    'descripcion'=>$v->descripcion,
                    'regional_id'=>$v->regional_id,
                    'regional'=>$v->regional,
                    'horario_discontinuo'=>$v->horario_discontinuo,
                    'horario_discontinuo_descripcion'=>$v->horario_discontinuo_descripcion,
                    'horario_continuo'=>$v->horario_continuo,
                    'horario_continuo_descripcion'=>$v->horario_continuo_descripcion,
                    'horario_multiple'=>$v->horario_multiple,
                    'horario_multiple_descripcion'=>$v->horario_multiple_descripcion,
                    'cantidad_dias'=>$v->cantidad_dias,
                    'repetitivo'=>$v->repetitivo,
                    'repetitivo_descripcion'=>$v->repetitivo_descripcion,
                    'dia'=>$v->dia,
                    'mes'=>$v->mes,
                    'gestion'=>$v->gestion,
                    'observacion'=>$v->observacion!=null?$v->observacion:'',
                    'estado'=> $v->estado,
                    'estado_descripcion'=> $v->estado_descripcion,
                    'baja_logica'=> $v->baja_logica,
                    'agrupador'=> $v->agrupador,
                    'user_reg_id'=> $v->user_reg_id,
                    'fecha_reg'=> $v->fecha_reg,
                    'user_mod_id'=> $v->user_mod_id,
                    'fecha_mod'=> $v->fecha_mod
                );
            }
        }
        echo json_encode($horariolaboral);
    }
} 