<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  30-01-2015
*/
class RelaboralesperfilesController extends ControllerBase{
    public function initialize()
    {
        parent::initialize();
    }
    /**
     * Función para la carga de la página de gestión de asignación de perfiles laborales para personal de la empresa.
     */
    public function indexAction()
    {
        $this->assets->addJs('/js/jquery.PrintArea.js');
        $this->assets->addCss('/assets/css/PrintArea.css');

        $this->assets->addJs('/js/jquery.kolorpicker.js');
        $this->assets->addCss('/assets/css/kolorpicker.css');

        $this->assets->addJs('/js/slider/bootstrap-slider.js');
        $this->assets->addCss('/js/slider/bootstrap-slider.css');

        $this->assets->addJs('/js/duallistbox/jquery.bootstrap-duallistbox.js');
        $this->assets->addCss('/js/duallistbox/bootstrap-duallistbox.css');

        $this->assets->addCss('/assets/css/oasis.principal.css');

        $this->assets->addJs('/js/jqwidgets/jqxdragdrop.js');


        $this->assets->addJs('/js/relaboralesperfiles/oasis.relaboralesperfiles.tab.js');
        $this->assets->addJs('/js/relaboralesperfiles/oasis.relaboralesperfiles.index.js');
        $this->assets->addJs('/js/relaboralesperfiles/oasis.relaboralesperfiles.assign.js');


        $this->assets->addJs('/js/relaboralesperfiles/oasis.relaboralesperfiles.approve.js');
        $this->assets->addJs('/js/relaboralesperfiles/oasis.relaboralesperfiles.new.js');
        $this->assets->addJs('/js/relaboralesperfiles/oasis.relaboralesperfiles.edit.js');
        $this->assets->addJs('/js/relaboralesperfiles/oasis.relaboralesperfiles.down.js');

        $this->assets->addJs('/js/relaboralesperfiles/oasis.relaboralesperfiles.calendar.js');
        $this->assets->addJs('/js/relaboralesperfiles/oasis.relaboralesperfiles.calendar.new.edit.js');
        $this->assets->addJs('/js/relaboralesperfiles/oasis.relaboralesperfiles.cupos.js');

    }
    /**
     * Función para la carga del listado de grupos de asignaciones de perfil laboral considerando el rango de fechas.
    */
    public function listgroupAction()
    {
        $this->view->disable();
        $obj = new Frelaboralesperfiles();
        $relaboralperfilgrupo = Array();
        if(isset($_GET["id"])){
            //echo "<p>----->entro";
            $idPerfilLaboral = $_GET["id"];
            $resul = $obj->getAllByPerfil($idPerfilLaboral);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $relaboralperfilgrupo[] = array(
                        'nro_row'=>'',
                        'id' => $v->id,//Identificador del registro de ubicación al que corresponde el grupo
                        'padre_id' => $v->padre_id,
                        'id_ubicacion' => $v->id_ubicacion,
                        'ubicacion' => $v->ubicacion,
                        'id_estacion' => $v->id_estacion,
                        'estacion' => $v->estacion,
                        'color' => $v->color,
                        'id_perfillaboral' => $v->id_perfillaboral,
                        'perfil_laboral' => $v->perfil_laboral,
                        'fecha_ini' => $v->fecha_ini != "" ? date("d-m-Y", strtotime($v->fecha_ini)) : "",
                        'fecha_fin' => $v->fecha_fin != "" ? date("d-m-Y", strtotime($v->fecha_fin)) : "",
                        'estado' => $v->estado,
                        'estado_descripcion' => $v->estado_descripcion,
                        'tipo_horario' => $v->tipo_horario,
                        'tipo_horario_descripcion' => $v->tipo_horario_descripcion,
                        'cantidad' => $v->cantidad
                    );
                }
            }


        }
        echo json_encode($relaboralperfilgrupo);
    }

    /**
     * Función para el registro y edición de una asignación de perfil laboral.
     */
    public function saveAction(){
        $auth = $this->session->get('auth');
        $user_mod_id = $auth['id'];
        $user_reg_id = $auth['id'];
        $msj = Array();
        $gestion_actual = date("Y");
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        if (isset($_POST["id"]) && $_POST["id"] > 0) {
            /**
             * Edición de Asignación de Perfil Laboral
             */
            $idRelaboralPerfil = $_POST["id"];
            $idRelaboral = $_POST["id_relaboral"];
            $idPerfilLaboral = $_POST['id_perfillaboral'];
            $idUbicacion = $_POST['id_ubicacion'];
            if($idRelaboralPerfil>0&&$idPerfilLaboral>0&&$idRelaboral>0&&$idUbicacion>0&&$_POST['fecha_ini']!=''&&$_POST['fecha_fin']!=''){
                $objRelaboralPerfil = Relaboralesperfiles::findFirst(array("id=".$idRelaboralPerfil));
                $objRelaboralPerfil->relaboral_id=$idRelaboral;
                $objRelaboralPerfil->perfillaboral_id=$idPerfilLaboral;
                $objRelaboralPerfil->ubicacion_id=$idUbicacion;
                $date1 = new DateTime($_POST['fecha_ini']);
                $date2 = new DateTime($_POST['fecha_fin']);
                $fechaIni = $date1->format('Y-m-d');
                $fechaFin = $date2->format('Y-m-d');
                $objRelaboralPerfil->fecha_ini=$fechaIni;
                $objRelaboralPerfil->fecha_fin=$fechaFin;
                $objRelaboralPerfil->user_mod_id=$user_mod_id;
                $objRelaboralPerfil->fecha_mod=$hoy;
                try{
                    $ok = $objRelaboralPerfil->save();
                    if ($ok)  {
                        $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se guard&oacute; correctamente.');
                    } else {
                        $msj = array('result' => 0, 'msj' => 'Error: No se guard&oacute; la asignaci&oacute;n del Perfil Laboral.');
                    }
                }catch (\Exception $e) {
                    echo get_class($e), ": ", $e->getMessage(), "\n";
                    echo " File=", $e->getFile(), "\n";
                    echo " Line=", $e->getLine(), "\n";
                    echo $e->getTraceAsString();
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de asignaci&oacute;n del Perfil Laboral.');
                }
            }else{
                $msj = array('result' => 0, 'msj' => 'Error: Los datos enviados no cumplen los criterios necesarios para su registro.');
            }
        }else{
            /**
             * Registro de Asignación de Perfil Laboral.
             */
            $idRelaboral = $_POST['id_relaboral'];
            $idPerfilLaboral = $_POST['id_perfillaboral'];
            $idUbicacion = $_POST["id_ubicacion"];
            $fechaIni = $_POST['fecha_ini'];
            $fechaFin = $_POST['fecha_fin'];
            if($idRelaboral>0&&$idPerfilLaboral>0&&$idUbicacion>0&&$_POST['fecha_ini']!=''&&$_POST['fecha_fin']!=''){

                $objAuxRelaboralPerfil = Relaboralesperfiles::findFirst(array("relaboral_id=".$idRelaboral." AND perfillaboral_id=".$idPerfilLaboral." AND ubicacion_id=".$idUbicacion." AND fecha_ini='".$fechaIni."' AND fecha_fin='".$fechaFin."' AND estado>=1 AND baja_logica=1"));
                if($objAuxRelaboralPerfil==false){
                    $objRelaboralPerfil = new Relaboralesperfiles();
                    $objRelaboralPerfil->user_reg_id=$user_reg_id;
                    $objRelaboralPerfil->fecha_reg=$hoy;
                    $objRelaboralPerfil->estado=1;
                    $objRelaboralPerfil->baja_logica=1;
                    $objRelaboralPerfil->agrupador=0;
                }else{
                    $idRelaboralPerfil = $objAuxRelaboralPerfil->id;
                    $objRelaboralPerfil = Relaboralesperfiles::findFirstById($idRelaboralPerfil);
                    $objRelaboralPerfil->user_mod_id=$user_mod_id;
                    $objRelaboralPerfil->fecha_mod=$hoy;
                }
                $objRelaboralPerfil->relaboral_id = $idRelaboral;
                $objRelaboralPerfil->perfillaboral_id=$idPerfilLaboral;
                $objRelaboralPerfil->ubicacion_id=$idUbicacion;
                $date1 = new DateTime($_POST['fecha_ini']);
                $date2 = new DateTime($_POST['fecha_fin']);
                $fechaIni = $date1->format('Y-m-d');
                $fechaFin = $date2->format('Y-m-d');
                $objRelaboralPerfil->fecha_ini=$fechaIni;
                $objRelaboralPerfil->fecha_fin=$fechaFin;
                try{
                    //$ok = false;
                    $ok = $objRelaboralPerfil->save();
                    if ($ok)  {
                        $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se guard&oacute; correctamente.');
                    } else {
                        $msj = array('result' => 0, 'msj' => 'Error: No se guard&oacute; la asignaci&oacute;n del Perfil Laboral.');
                    }
                }catch (\Exception $e) {
                    echo get_class($e), ": ", $e->getMessage(), "\n";
                    echo " File=", $e->getFile(), "\n";
                    echo " Line=", $e->getLine(), "\n";
                    echo $e->getTraceAsString();
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de asignaci&oacute;n de Perfil Laboral.');
                }
            }else{
                $msj = array('result' => 0, 'msj' => 'Error: Los datos enviados no cumplen los criterios necesarios para su registro.');
            }
        }
        echo json_encode($msj);
    }
    /**
     * Función para el la baja del registro de una asignación de perfil laboral..
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
        $msj = Array();
        $auth = $this->session->get('auth');
        $user_mod_id = $auth['id'];
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        try {
            if (isset($_POST["id"]) && $_POST["id"] > 0) {
                /**
                 * Baja de registro
                 */
                $objRelaboralesperfiles = Relaboralesperfiles::findFirst(array("id=".$_POST["id"]));
                $objRelaboralesperfiles->estado = 0;
                $objRelaboralesperfiles->baja_logica = 0;
                $objRelaboralesperfiles->user_mod_id = $user_mod_id;
                $objRelaboralesperfiles->fecha_mod = $hoy;
                if ($objRelaboralesperfiles->save()) {
                    /**
                     * Se modifica el estado del registro de relación laboral y perfil.
                     */
                    $msj = array('result' => 1, 'msj' => '&Eacute;xito: Registro de Baja realizado de modo satisfactorio.');
                } else {
                    foreach ($objRelaboralesperfiles->getMessages() as $message) {
                        echo $message, "\n";
                    }
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; la baja del registro de asignaci&oacute;n de perfil laboral.');
                }



            } else $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; la baja del registro de asignaci&oacute;n de perfil laboral debido a que no se especific&oacute; el registro de perfil laboral.');
        } catch (\Exception $e) {
            echo get_class($e), ": ", $e->getMessage(), "\n";
            echo " File=", $e->getFile(), "\n";
            echo " Line=", $e->getLine(), "\n";
            echo $e->getTraceAsString();
            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de asignaci&oacute;n de perfil laboral.');
        }
        echo json_encode($msj);
    }

    /**
     * Función para la verificación de la existencia de sobre posición de fechas entre un perfil y otro registrado.
     */
    public function verifyoverlaydatesAction(){
        $msj = Array();
        $this->view->disable();
        $idRelaboralPerfil = 0;
        if (isset($_POST["id"]) && $_POST["id"] > 0)
        {
            $idRelaboralPerfil = $_POST["id"];
        }
        try {
            if (isset($_POST["id_relaboral"]) && $_POST["id_relaboral"] > 0&&
            isset($_POST["id_perfillaboral"])&&$_POST["id_perfillaboral"]>0&&
                isset($_POST["id_ubicacion"])&&$_POST["id_ubicacion"]>0&&
                isset($_POST["fecha_ini"])&&$_POST["fecha_ini"]!=''&&
            isset($_POST["fecha_fin"])&&$_POST["fecha_fin"]!=''
            ) {
                $objRelaboralesperfiles = new Relaboralesperfiles();
                $resul = $objRelaboralesperfiles->verificaSobrePosicionPerfiles($idRelaboralPerfil,$_POST["id_relaboral"],$_POST["id_perfillaboral"],$_POST["id_ubicacion"],$_POST["fecha_ini"],$_POST["fecha_fin"]);
                if ($resul->count() > 0) {
                    $valor = $resul[0];
                    if($valor->o_resultado==1){
                        $msj = array('result' => 1, 'msj' => 'Existe sobreposici&oacute;n');
                    }else{
                        $msj = array('result' => 0, 'msj' => 'No existe sobreposici&oacute;n');
                    }
                }
            } else $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No pudo realizar la verificaci&oacute;n por error en los datos enviados.');
        } catch (\Exception $e) {
            echo get_class($e), ": ", $e->getMessage(), "\n";
            echo " File=", $e->getFile(), "\n";
            echo " Line=", $e->getLine(), "\n";
            echo $e->getTraceAsString();
            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No pudo realizar la verificaci&oacute;n por error en la consulta.');
        }
        echo json_encode($msj);
    }
} 