<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  02-03-2015
*/

class ControlexcepcionesController extends ControllerBase
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
    {
        $this->assets->addCss('/assets/css/bootstrap-switch.css');
        $this->assets->addJs('/js/switch/bootstrap-switch.js');
        $this->assets->addCss('/assets/css/oasis.principal.css');
        $this->assets->addCss('/assets/css/jquery-ui.css');
        $this->assets->addCss('/css/oasis.grillas.css');
        $this->assets->addJs('/js/numeric/jquery.numeric.js');
        $this->assets->addJs('/js/jquery.PrintArea.js');
        $this->assets->addCss('/assets/css/PrintArea.css');

        $this->assets->addCss('/assets/css/clockpicker.css');
        $this->assets->addJs('/js/clockpicker/clockpicker.js');

        $this->assets->addJs('/js/controlexcepciones/oasis.controlexcepciones.tab.js');
        $this->assets->addJs('/js/controlexcepciones/oasis.controlexcepciones.index.js');
        $this->assets->addJs('/js/controlexcepciones/oasis.controlexcepciones.list.js');
        $this->assets->addJs('/js/controlexcepciones/oasis.controlexcepciones.approve.js');
        $this->assets->addJs('/js/controlexcepciones/oasis.controlexcepciones.new.edit.js');
        $this->assets->addJs('/js/controlexcepciones/oasis.controlexcepciones.turns.excepts.js');
        $this->assets->addJs('/js/controlexcepciones/oasis.controlexcepciones.down.js');
        $this->assets->addJs('/js/controlexcepciones/oasis.controlexcepciones.move.js');
        $this->assets->addJs('/js/controlexcepciones/oasis.controlexcepciones.view.js');
        $this->assets->addJs('/js/controlexcepciones/oasis.controlexcepciones.f_horariosymarcaciones_calculos_rango_mismo_mes(integer, integer, integer, integer, integer).js');
        $this->assets->addJs('/js/controlexcepciones/oasis.controlexcepciones.view.splitter.js');
    }
    /**
     * Función para la obtención del listado de registros de control de excepciones.
     * Autor: JLM
     */
    public function listporrelaboralAction()
    {
        $this->view->disable();
        $controlexcepciones = Array();
        if(isset($_GET["id"])&&$_GET["id"]>0){
            $obj = new Fcontrolexcepciones();
            $idRelaboral = $_GET["id"];
            $resul = $obj->getAll("WHERE id_relaboral=".$idRelaboral);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $controlexcepciones[] = array(
                        'nro_row' => 0,
                        'id'=>$v->id_controlexcepcion,
                        'id_relaboral'=>$v->id_relaboral,
                        'fecha_ini' => $v->fecha_ini != "" ? date("d-m-Y", strtotime($v->fecha_ini)) : "",
                        'hora_ini'=>$v->hora_ini,
                        'fecha_fin' => $v->fecha_fin != "" ? date("d-m-Y", strtotime($v->fecha_fin)) : "",
                        'hora_fin'=>$v->hora_fin,
                        'justificacion'=>$v->justificacion,
                        'turno'=>$v->turno,
                        'turno_descripcion'=>$v->compensatoria==1?$v->turno!=null?$v->turno."°":null:null,
                        'entrada_salida'=>$v->entrada_salida,
                        'entrada_salida_descripcion'=>$v->compensatoria==1?$v->entrada_salida==0?"ENTRADA":"SALIDA":null,
                        'controlexcepcion_observacion'=>$v->controlexcepcion_observacion,
                        'controlexcepcion_estado'=>$v->controlexcepcion_estado,
                        'controlexcepcion_estado_descripcion'=>$v->controlexcepcion_estado_descripcion,
                        'controlexcepcion_user_reg_id'=>$v->controlexcepcion_user_reg_id,
                        'controlexcepcion_user_registrador'=>$v->controlexcepcion_user_registrador,
                        'controlexcepcion_fecha_reg'=>$v->controlexcepcion_fecha_reg != "" ? date("Y-m-d", strtotime($v->controlexcepcion_fecha_reg)) : "",
                        'controlexcepcion_user_apr_id'=>$v->controlexcepcion_user_apr_id,
                        'controlexcepcion_user_aprobador'=>$v->controlexcepcion_user_aprobador,
                        'controlexcepcion_fecha_apr'=>$v->controlexcepcion_fecha_apr != "" ? date("Y-m-d", strtotime($v->controlexcepcion_fecha_apr)) : "",
                        'controlexcepcion_user_mod_id'=>$v->controlexcepcion_user_mod_id,
                        'controlexcepcion_user_modificador'=>$v->controlexcepcion_user_modificador,
                        'controlexcepcion_fecha_mod'=>$v->controlexcepcion_fecha_mod != "" ? date("Y-m-d", strtotime($v->controlexcepcion_fecha_mod)) : "",
                        'excepcion_id'=>$v->excepcion_id,
                        'excepcion'=>$v->excepcion,
                        'tipoexcepcion_id'=>$v->tipoexcepcion_id,
                        'tipo_excepcion'=>$v->tipo_excepcion,
                        'codigo'=>$v->codigo,
                        'color'=>$v->color,
                        'compensatoria'=>$v->compensatoria,
                        'compensatoria_descripcion'=>$v->compensatoria_descripcion,
                        'genero_id'=>$v->genero_id,
                        'genero'=>$v->genero,
                        'cantidad'=>$v->cantidad,
                        'unidad'=>$v->unidad,
                        'fraccionamiento'=>$v->fraccionamiento,
                        'frecuencia_descripcion'=>$v->frecuencia_descripcion,
                        'redondeo'=>$v->redondeo,
                        'redondeo_descripcion'=>$v->redondeo_descripcion,
                        'observacion'=>$v->observacion,
                        'estado'=>$v->estado,
                        'estado_descripcion'=>$v->estado_descripcion,
                        'baja_logica'=>$v->baja_logica,
                        'agrupador'=>$v->agrupador,
                        'user_reg_id'=>$v->user_reg_id,
                        'fecha_reg'=>$v->fecha_reg,
                        'user_mod_id'=>$v->user_mod_id,
                        'fecha_mod'=>$v->fecha_mod,
                    );
                }
            }
        }
        echo json_encode($controlexcepciones);
    }

    /**
     * Función para la obtención del listado de controles de excepción para un registro de relación laboral considerando un rango de fechas.
     * El resultado repite registro de acuerdo a cada fecha dentro del rango de fechas.
     */
    public function listporrelaboralyrangoAction()
    {
        $this->view->disable();
        $controlexcepciones = Array();
        if(isset($_POST["id_relaboral"])&&$_POST["id_relaboral"]>0&&isset($_POST["fecha_ini"])&&isset($_POST["fecha_fin"])){
            $obj = new Fcontrolexcepciones();
            $idRelaboral = $_POST["id_relaboral"];
            $fechaIni = $_POST["fecha_ini"];
            $fechaFin = $_POST["fecha_fin"];
            $resul = $obj->getAllByRelaboralAndRange($idRelaboral,$fechaIni,$fechaFin);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $controlexcepciones[] = array(
                        'nro_row' => 0,
                        'id'=>$v->id_controlexcepcion,
                        'id_relaboral'=>$v->id_relaboral,
                        'fecha_ini'=>$v->fecha_ini,
                        'hora_ini'=>$v->hora_ini,
                        'fecha_fin'=>$v->fecha_fin,
                        'hora_fin'=>$v->hora_fin,
                        'justificacion'=>$v->justificacion,
                        'controlexcepcion_observacion'=>$v->controlexcepcion_observacion,
                        'controlexcepcion_estado'=>$v->controlexcepcion_estado,
                        'controlexcepcion_estado_descripcion'=>$v->controlexcepcion_estado_descripcion,
                        'controlexcepcion_user_reg_id'=>$v->controlexcepcion_user_reg_id,
                        'controlexcepcion_user_registrador'=>$v->controlexcepcion_user_registrador,
                        'controlexcepcion_fecha_reg'=>$v->controlexcepcion_fecha_reg != "" ? date("Y-m-d", strtotime($v->controlexcepcion_fecha_reg)) : "",
                        'controlexcepcion_user_apr_id'=>$v->controlexcepcion_user_apr_id,
                        'controlexcepcion_user_aprobador'=>$v->controlexcepcion_user_aprobador,
                        'controlexcepcion_fecha_apr'=>$v->controlexcepcion_fecha_apr != "" ? date("Y-m-d", strtotime($v->controlexcepcion_fecha_apr)) : "",
                        'controlexcepcion_user_mod_id'=>$v->controlexcepcion_user_mod_id,
                        'controlexcepcion_user_modificador'=>$v->controlexcepcion_user_modificador,
                        'controlexcepcion_fecha_mod'=>$v->controlexcepcion_fecha_mod != "" ? date("Y-m-d", strtotime($v->controlexcepcion_fecha_mod)) : "",
                        'excepcion_id'=>$v->excepcion_id,
                        'excepcion'=>$v->excepcion,
                        'tipoexcepcion_id'=>$v->tipoexcepcion_id,
                        'tipo_excepcion'=>$v->tipo_excepcion,
                        'codigo'=>$v->codigo,
                        'color'=>$v->color,
                        'compensatoria'=>$v->compensatoria,
                        'compensatoria_descripcion'=>$v->compensatoria_descripcion,
                        'genero_id'=>$v->genero_id,
                        'genero'=>$v->genero,
                        'cantidad'=>$v->cantidad,
                        'unidad'=>$v->unidad,
                        'fraccionamiento'=>$v->fraccionamiento,
                        'frecuencia_descripcion'=>$v->frecuencia_descripcion,
                        'redondeo'=>$v->redondeo,
                        'redondeo_descripcion'=>$v->redondeo_descripcion,
                        'observacion'=>$v->observacion,
                        'estado'=>$v->estado,
                        'estado_descripcion'=>$v->estado_descripcion,
                        'baja_logica'=>$v->baja_logica,
                        'agrupador'=>$v->agrupador,
                        'user_reg_id'=>$v->user_reg_id,
                        'fecha_reg'=>$v->fecha_reg,
                        'user_mod_id'=>$v->user_mod_id,
                        'fecha_mod'=>$v->fecha_mod,
                        'fecha' => $v->fecha != "" ? date("Y-m-d", strtotime($v->fecha)) : "",
                        'dia'=>$v->dia,
                        'dia_nombre'=>$v->dia_nombre,
                        'dia_nombre_abr_ing'=>$v->dia_nombre_abr_ing
                    );
                }
            }
        }
        echo json_encode($controlexcepciones);
    }
    /**
     * Función para el almacenamiento y actualización de un registro de Control de Excepción.
     * return array(EstadoResultado,Mensaje)
     * Los valores posibles para la variable EstadoResultado son:
     *  0: Error
     *   1: Procesado
     *  -1: Crítico Error
     *  -2: Error de Conexión
     *  -3: Usuario no Autorizado
     */
    public function saveAction()
    {
        $auth = $this->session->get('auth');
        $user_reg_id = $user_mod_id = $auth['id'];
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        if (isset($_POST["id"]) && $_POST["id"] > 0) {
            /**
             * Modificación de registro de Feriado
             */
            $idRelaboral = $_POST['relaboral_id'];
            $idExcepcion = $_POST['excepcion_id'];
            $fechaIni = $_POST['fecha_ini'];
            $horaIni = $_POST['hora_ini'];
            $fechaFin = $_POST['fecha_fin'];
            $horaFin = $_POST['hora_fin'];
            $justificacion = $_POST['justificacion'];
            $turno = $_POST['turno'];
            $entradaSalida = $_POST['entrada_salida'];
            $observacion = $_POST['observacion'];
            if($idRelaboral>0&&$idExcepcion>0&&$fechaIni!=''&&$horaIni!=''&&$fechaFin!=''&&$horaFin!=''&&$justificacion!=''){
                $objControlExcepciones = Controlexcepciones::findFirst(array("id=".$_POST["id"]));
                if(count($objControlExcepciones)>0){
                    $cantMismosDatos = Controlexcepciones::count(array("id!=".$_POST["id"]." AND relaboral_id=".$idRelaboral." AND excepcion_id = ".$idExcepcion." AND fecha_ini='".$fechaIni."' AND hora_ini='".$horaIni."' AND fecha_fin = '".$fechaFin."' AND hora_fin='".$horaFin."' AND baja_logica=1 AND estado>=0"));
                    if($cantMismosDatos==0){
                        $objControlExcepciones->relaboral_id = $idRelaboral;
                        $objControlExcepciones->excepcion_id = $idExcepcion;
                        $objControlExcepciones->fecha_ini = $fechaIni;
                        $objControlExcepciones->fecha_fin = $fechaFin;
                        $objControlExcepciones->hora_ini = $horaIni;
                        $objControlExcepciones->hora_fin = $horaFin;
                        $objControlExcepciones->justificacion=$justificacion;
                        if($turno>0){
                            $objControlExcepciones->turno=$turno;
                        }else $objControlExcepciones->turno=null;
                        if($entradaSalida>=0){
                            $objControlExcepciones->entrada_salida=$entradaSalida;
                        }else $objControlExcepciones->entrada_salida=null;
                        $objControlExcepciones->observacion=$observacion;
                        $objControlExcepciones->user_mod_id=$user_mod_id;
                        $objControlExcepciones->fecha_mod=$hoy;
                        try{
                            $ok = $objControlExcepciones->save();
                            if ($ok)  {
                                $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se modific&oacute; correctamente el registro del control de excepci&oacute;n.');
                            } else {
                                $msj = array('result' => 0, 'msj' => 'Error: No se modific&oacute; el registro del control de excepci&oacute;n.');
                            }
                        }catch (\Exception $e) {
                            echo get_class($e), ": ", $e->getMessage(), "\n";
                            echo " File=", $e->getFile(), "\n";
                            echo " Line=", $e->getLine(), "\n";
                            echo $e->getTraceAsString();
                            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro del control de excepci&oacute;n.');
                        }
                    }else $msj = array('result' => 0, 'msj' => 'Error: Los datos enviados son similares a otro registro existente, debe modificar los valores necesariamente.');
                }
            }else{
                $msj = array('result' => 0, 'msj' => 'Error: Los datos enviados no cumplen los criterios necesarios para su registro.');
            }
        }else{
            /**
             * Registro de Control de Excepción
             */
            $idRelaboral = $_POST['relaboral_id'];
            $idExcepcion = $_POST['excepcion_id'];
            $fechaIni = $_POST['fecha_ini'];
            $horaIni = $_POST['hora_ini'];
            $fechaFin = $_POST['fecha_fin'];
            $horaFin = $_POST['hora_fin'];
            $justificacion = $_POST['justificacion'];
            $turno = $_POST['turno'];
            $entradaSalida = $_POST['entrada_salida'];
            $observacion = $_POST['observacion'];
            if($idRelaboral>0&&$idExcepcion>0&&$fechaIni!=''&&$horaIni!=''&&$fechaFin!=''&&$horaFin!=''&&$justificacion!=''){
                $cantMismosDatos = Controlexcepciones::count(array("relaboral_id=".$idRelaboral." AND excepcion_id = ".$idExcepcion." AND fecha_ini='".$fechaIni."' AND hora_ini='".$horaIni."' AND fecha_fin = '".$fechaFin."' AND hora_fin='".$horaFin."' AND baja_logica=1 AND estado>=0"));
                if($cantMismosDatos==0){
                    $objControlExcepciones = new Controlexcepciones();
                    $objControlExcepciones->relaboral_id = $idRelaboral;
                    $objControlExcepciones->excepcion_id = $idExcepcion;
                    $objControlExcepciones->fecha_ini = $fechaIni;
                    $objControlExcepciones->fecha_fin = $fechaFin;
                    $objControlExcepciones->hora_ini = $horaIni;
                    $objControlExcepciones->hora_fin = $horaFin;
                    $objControlExcepciones->justificacion=$justificacion;
                    if($turno>0){
                        $objControlExcepciones->turno=$turno;
                    }else $objControlExcepciones->turno=null;
                    if($entradaSalida>=0){
                        $objControlExcepciones->entrada_salida=$entradaSalida;
                    }else $objControlExcepciones->entrada_salida=null;
                    $objControlExcepciones->observacion=$observacion;
                    $objControlExcepciones->estado=2;
                    $objControlExcepciones->baja_logica=1;
                    $objControlExcepciones->agrupador=0;
                    $objControlExcepciones->user_reg_id=$user_reg_id;
                    $objControlExcepciones->fecha_reg=$hoy;
                    try{
                        $ok = $objControlExcepciones->save();
                        if ($ok)  {
                            $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se guard&oacute; correctamente.');
                        } else {
                            $msj = array('result' => 0, 'msj' => 'Error: No se registr&oacute;.');
                        }
                    }catch (\Exception $e) {
                        echo get_class($e), ": ", $e->getMessage(), "\n";
                        echo " File=", $e->getFile(), "\n";
                        echo " Line=", $e->getLine(), "\n";
                        echo $e->getTraceAsString();
                        $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro del control de excepci&oacute;n.');
                    }
                }    else{
                    $msj = array('result' => 0, 'msj' => 'Error: Existe registro de control de excepci&oacute;n con datos similares.');
                }
            }else{
                $msj = array('result' => 0, 'msj' => 'Error: Los datos enviados no cumplen los criterios necesarios para su registro.');
            }
        }
        echo json_encode($msj);
    }
    /*
     * Función para la aprobación del registro de un control de excepción.
     */
    public function approveAction()
    {
        $auth = $this->session->get('auth');
        $user_mod_id = $auth['id'];
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        if (isset($_POST["id"]) && $_POST["id"] > 0) {
            /**
             * Aprobación de registro
             */
            $objControlExcepciones = Controlexcepciones::findFirstById($_POST["id"]);
            if ($objControlExcepciones->id > 0 && $objControlExcepciones->estado == 2) {
                try {
                    $objControlExcepciones->estado = 3;
                    $objControlExcepciones->user_mod_id = $user_mod_id;
                    $objControlExcepciones->user_apr_id = $user_mod_id;
                    $objControlExcepciones->fecha_mod = $hoy;
                    $objControlExcepciones->fecha_apr = $hoy;
                    $ok = $objControlExcepciones->save();
                    if ($ok) {
                        $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se aprob&oacute; correctamente el registro del control de  excepci&oacute;n.');
                    } else {
                        $msj = array('result' => 0, 'msj' => 'Error: No se aprob&oacute; el registro de control de excepci&oacute;n.');
                    }
                } catch (\Exception $e) {
                    echo get_class($e), ": ", $e->getMessage(), "\n";
                    echo " File=", $e->getFile(), "\n";
                    echo " Line=", $e->getLine(), "\n";
                    echo $e->getTraceAsString();
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro del control de excepci&oacute;n.');
                }
            } else {
                $msj = array('result' => 0, 'msj' => 'Error: El registro de control de excepci&oacute;n no cumple con el requisito establecido para su aprobaci&oacute;n, debe estar en estado EN PROCESO.');
            }
        } else {
            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se envi&oacute; el identificador del registro del control de excepci&oacute;n.');
        }
        echo json_encode($msj);
    }
    /**
     * Función para el la baja del registro de un control de excepción.
     * return array(EstadoResultado,Mensaje)
     * Los valores posibles para la variable EstadoResultado son:
     *  0: Error
     *   1: Procesado
     *  -1: Crítico Error
     *  -2: Error de Conexión
     *  -3: Usuario no Autorizado
     */
    public function downAction()
    {
        $auth = $this->session->get('auth');
        $user_mod_id = $auth['id'];
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        try {
            if (isset($_POST["id"]) && $_POST["id"] > 0) {
                /**
                 * Baja de registro
                 */
                $objControlExcepciones = Controlexcepciones::findFirstById($_POST["id"]);
                $objControlExcepciones->estado = 0;
                $objControlExcepciones->baja_logica = 1;
                $objControlExcepciones->user_mod_id = $user_mod_id;
                $objControlExcepciones->fecha_mod = $hoy;
                if ($objControlExcepciones->save()) {
                    $msj = array('result' => 1, 'msj' => '&Eacute;xito: Registro de Baja realizado de modo satisfactorio.');
                } else {
                    foreach ($objControlExcepciones->getMessages() as $message) {
                        echo $message, "\n";
                    }
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se pudo dar de baja al registro de la excepci&oacute;n.');
                }
            } else $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se efectu&oacute; la baja debido a que no se especific&oacute; el registro de la excepci&oacute;n.');
        } catch (\Exception $e) {
            echo get_class($e), ": ", $e->getMessage(), "\n";
            echo " File=", $e->getFile(), "\n";
            echo " Line=", $e->getLine(), "\n";
            echo $e->getTraceAsString();
            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro del control de excepci&oacute;n.');
        }
        echo json_encode($msj);
    }
    /**
     * Función para la verificación
     */
    public function verificacruceAction(){
        $auth = $this->session->get('auth');
        $user_mod_id = $auth['id'];
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        $id = $_POST['id'];
        $idRelaboral = $_POST['relaboral_id'];
        $idExcepcion = $_POST['excepcion_id'];
        $fechaIni = $_POST['fecha_ini'];
        $horaIni = $_POST['hora_ini'];
        $fechaFin = $_POST['fecha_fin'];
        $horaFin = $_POST['hora_fin'];
        $justificacion = $_POST['justificacion'];
        if($idRelaboral>0&&$idExcepcion>0&&$fechaIni!=''&&$horaIni!=''&&$fechaFin!=''&&$horaFin!=''&&$justificacion!=''){
            /**
             * Se realiza la verificación sobre el cruce de horarios y fechas de los controles de excepción existentes y la que se intenta registrar o modificar.
             */
            /*$objControlExcepciones = Controlexcepciones::findFirstById($_POST["id"]);
            if ($objControlExcepciones->id > 0 && $objControlExcepciones->estado == 2) {
                try {
                    $objControlExcepciones->estado = 1;
                    $objControlExcepciones->user_mod_id = $user_mod_id;
                    $objControlExcepciones->fecha_mod = $hoy;
                    $ok = $objControlExcepciones->save();
                    if ($ok) {
                        $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se aprob&oacute; correctamente el registro del control de  excepci&oacute;n.');
                    } else {
                        $msj = array('result' => 0, 'msj' => 'Error: No se aprob&oacute; el registro de control de excepci&oacute;n.');
                    }
                } catch (\Exception $e) {
                    echo get_class($e), ": ", $e->getMessage(), "\n";
                    echo " File=", $e->getFile(), "\n";
                    echo " Line=", $e->getLine(), "\n";
                    echo $e->getTraceAsString();
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro del control de excepci&oacute;n.');
                }
            } else {
                $msj = array('result' => 0, 'msj' => 'Error: El registro de control de excepci&oacute;n no cumple con el requisito establecido para su aprobaci&oacute;n, debe estar en estado EN PROCESO.');
            }*/
            $msj = array('result' => 0, 'msj' => 'No existe cruce de horarios ni fechas.');
        } else {
            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se envi&oacute; el identificador del registro del control de excepci&oacute;n.');
        }
        echo json_encode($msj);
    }

    /**
     * Función para el registro de un determinado tipo de permiso para un perfil laboral en particular.
     */
    public function savemassivebyperfilAction()
    {
        $auth = $this->session->get('auth');
        $user_reg_id = $auth['id'];
        $msj = Array();
        $this->view->disable();
        if (isset($_POST["id"]) && $_POST["id"] > 0){
            /**
             * Registro del Control de Excepción masivo
             */
            $idPerfilLaboral = $_POST['id'];
            $idExcepcion = $_POST['excepcion_id'];
            $fechaIni = $_POST['fecha_ini'];
            $horaIni = $_POST['hora_ini'];
            $fechaFin = $_POST['fecha_fin'];
            $horaFin = $_POST['hora_fin'];
            $estado = 3;
            $justificacion = $_POST['justificacion'];
            $observacion = $_POST['observacion'];
            if($idPerfilLaboral>0&&$idExcepcion>0&&$fechaIni!=''&&$horaIni!=''&&$fechaFin!=''&&$horaFin!=''&&$justificacion!=''){
                    try{
                        $obj = new Controlexcepciones();
                        $ok = $obj->registroMasivoPorPerfil($idPerfilLaboral,$fechaIni,$horaIni,$fechaFin,$horaFin,$justificacion,$observacion,$estado,$user_reg_id);
                        if ($ok)  {
                            $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se realiz&oacute; correctamente el registro masivo.');
                        } else {
                            $msj = array('result' => 0, 'msj' => 'Error: No se registr&oacute;.');
                        }
                    }catch (\Exception $e) {
                        echo get_class($e), ": ", $e->getMessage(), "\n";
                        echo " File=", $e->getFile(), "\n";
                        echo " Line=", $e->getLine(), "\n";
                        echo $e->getTraceAsString();
                        $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro del control de excepci&oacute;n masivo.');
                    }

            }else{
                $msj = array('result' => 0, 'msj' => 'Error: Los datos enviados no cumplen los criterios necesarios para su registro.');
            }
        }
        echo json_encode($msj);
    }
} 