<?php

/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  04-12-2014
*/

class CalendariolaboralController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
    }
    /**
     * Función para la carga de la página de gestión de relaciones laborales.
     * Se cargan los combos necesarios.
     */
    public function indexAction()
    {   $this->assets->addJs('/js/calendariolaboral/oasis.calendariolaboral.index.js');
        $this->assets->addJs('/js/jquery.kolorpicker.js');
        $this->assets->addCss('/assets/css/kolorpicker.css');
        $this->assets->addCss('/assets/css/oasis.principal.css');
        $this->assets->addJs('/js/calendariolaboral/language/language/es-MX.js');
    }

    /**
     * Función para el registro de horarios en el sistema.
     */
    public function savehorarioAction(){
        $user_reg_id = 1;
        $user_mod_id = 1;
        $msj = Array();
        $gestion_actual = date("Y");
        $hoy = date("Y-m-d H:i:s");
        $fecha_fin = "31/12/" . $gestion_actual;
        $this->view->disable();
        if (isset($_POST["id"]) && $_POST["id"] > 0) {
            /**
             * Edición de Horario
             */
        }else{
            /**
             * Registro de Horario
             */
            $nombre = $_POST['nombre'];
            $nombre_alternativo = $_POST['nombre_alternativo'];
            $color = $_POST['color'];
            $hora_entrada = $_POST['hora_entrada'];
            $hora_salida = $_POST['hora_salida'];
            $minutos_tolerancia_acu = $_POST['minutos_tolerancia_acu'];
            $minutos_tolerancia_ent = $_POST['minutos_tolerancia_ent'];
            $minutos_tolerancia_sal = $_POST['minutos_tolerancia_sal'];
            $rango_entrada = $_POST['rango_entrada'];
            $rango_salida = $_POST['rango_salida'];
            $hora_inicio_rango_ent = $_POST['hora_inicio_rango_ent'];
            $hora_final_rango_ent = $_POST['hora_final_rango_ent'];
            $hora_inicio_rango_sal = $_POST['hora_inicio_rango_sal'];
            $hora_final_rango_sal = $_POST['hora_final_rango_sal'];
            $observacion = $_POST['observacion'];
            if($nombre!=''&& $color!=''&&$hora_entrada!=''&&$hora_salida!=''&&$minutos_tolerancia_acu!=''&&$minutos_tolerancia_ent!=''&&$minutos_tolerancia_sal!=''&&$hora_inicio_rango_ent!=''&&$hora_final_rango_ent!=''&&$hora_inicio_rango_sal!=''&&$hora_final_rango_sal!=''){
            $objHorarioLaboral = new Horarioslaborales();
                $objHorarioLaboral->nombre = $nombre;
                $objHorarioLaboral->nombre_alternativo = $nombre_alternativo;
                $objHorarioLaboral->hora_ent=$hora_entrada;
                $objHorarioLaboral->hora_sal=$hora_salida;
                $objHorarioLaboral->color=$color;
                $objHorarioLaboral->minutos_tolerancia_ent=$minutos_tolerancia_ent;
                $objHorarioLaboral->minutos_tolerancia_sal=$minutos_tolerancia_sal;
                $objHorarioLaboral->minutos_tolerancia_acu=$minutos_tolerancia_acu;
                $objHorarioLaboral->rango_entrada=$rango_entrada;
                $objHorarioLaboral->rango_salida=$rango_salida;
                $objHorarioLaboral->hora_inicio_rango_ent=$hora_inicio_rango_ent;
                $objHorarioLaboral->hora_final_rango_ent=$hora_final_rango_ent;
                $objHorarioLaboral->hora_inicio_rango_sal=$hora_inicio_rango_sal;
                $objHorarioLaboral->hora_final_rango_sal=$hora_final_rango_sal;
                $objHorarioLaboral->observacion=$observacion;
                $objHorarioLaboral->estado=2;
                $objHorarioLaboral->baja_logica=1;
                $objHorarioLaboral->agrupador=0;
                $objHorarioLaboral->user_reg_id=$user_reg_id;
                $objHorarioLaboral->fecha_reg=$hoy;
                try{
                    $ok = $objHorarioLaboral->save();
                    if ($ok)  {
                        $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se guard&oacute; correctamente.');
                    } else {
                        $msj = array('result' => 0, 'msj' => 'Error: No se guard&oacute; el horario.');
                    }
                }catch (\Exception $e) {
                    echo get_class($e), ": ", $e->getMessage(), "\n";
                    echo " File=", $e->getFile(), "\n";
                    echo " Line=", $e->getLine(), "\n";
                    echo $e->getTraceAsString();
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de Horario laboral laboral.');
                }
            }else{
                $msj = array('result' => 0, 'msj' => 'Error: Los datos enviados no cumplen los criterios necesarios para su registro.');
            }
        }
        echo json_encode($msj);
    }

    /**
     * Función para la obtención del listado de horarios registrados en el sistema
     */
    public function gethorariosregistradosAction(){
        $this->view->disable();
        $horariolaboral = Array();
            $obj = new Fhorarioslaborales();
            $resul = $obj->getHorariosLaborales();
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $horariolaboral[] = array(
                        'id_horariolaboral'=>$v->id_horariolaboral,
                        'nombre' => $v->nombre,
                        'nombre_alternativo' => $v->nombre_alternativo,
                        'hora_entrada'=> $v->hora_entrada,
                        'hora_salida'=> $v->hora_salida,
                        'horas_laborales'=> $v->horas_laborales,
                        'dias_laborales'=> $v->dias_laborales,
                        'minutos_tolerancia_ent'=> $v->minutos_tolerancia_ent,
                        'minutos_tolerancia_sal'=> $v->minutos_tolerancia_sal,
                        'minutos_tolerancia_acu'=> $v->minutos_tolerancia_acu,
                        'rango_entrada'=> $v->rango_entrada,
                        'rango_salida'=> $v->rango_salida,
                        'hora_inicio_rango_ent'=> $v->hora_inicio_rango_ent,
                        'hora_final_rango_ent'=> $v->hora_final_rango_ent,
                        'hora_inicio_rango_sal'=> $v->hora_inicio_rango_sal,
                        'hora_final_rango_sal'=> $v->hora_final_rango_sal,
                        'color'=> $v->color,
                        'fecha_ini'=> $v->fecha_ini,
                        'fecha_fin'=> $v->fecha_fin,
                        'observacion'=>$v->observacion!=null?$v->observacion:'',
                        'estado'=> $v->estado,
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