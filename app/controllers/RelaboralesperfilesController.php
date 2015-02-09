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
        $this->assets->addJs('/js/relaboralesperfiles/oasis.relaboralesperfiles.assign.group.js');
        $this->assets->addJs('/js/relaboralesperfiles/oasis.relaboralesperfiles.assign.single.js');


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
     * Función para la carga del listado de relaciones laborales con registro en un determinado perfil laboral.
     */
    public function listsingleAction()
    {
        $this->view->disable();
        $obj = new Relaboralesperfiles();
        $relaboral = Array();
        $idPerfilLaboral = 0;
        if(isset($_GET["id"])&&$_GET["id"]>0){
            $resul = $obj->getListRelaboralesByPerfil($_GET["id"]);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $relaboral[] = array(
                        'nro_row' => 0,
                        'id_relaboral' => $v->id_relaboral,
                        'id_persona' => $v->id_persona,
                        'p_nombre' => $v->p_nombre,
                        's_nombre' => $v->s_nombre,
                        't_nombre' => $v->t_nombre,
                        'p_apellido' => $v->p_apellido,
                        's_apellido' => $v->s_apellido,
                        'c_apellido' => $v->c_apellido,
                        'nombres' => $v->nombres,
                        'ci' => $v->ci,
                        'expd' => $v->expd,
                        'fecha_caducidad' => $v->fecha_caducidad,
                        'num_complemento' => '',
                        'fecha_nac' => $v->fecha_nac,
                        'edad' => $v->edad,
                        'lugar_nac' => $v->lugar_nac,
                        'genero' => $v->genero,
                        'e_civil' => $v->e_civil,
                        'item' => $v->item,
                        /*'carrera_adm' => $v->carrera_adm,*/
                        'num_contrato' => $v->num_contrato,
                        'contrato_numerador_estado' => $v->contrato_numerador_estado,
                        'id_solelabcontrato' => $v->id_solelabcontrato,
                        'solelabcontrato_regional_sigla' => $v->solelabcontrato_regional_sigla,
                        'solelabcontrato_numero' => $v->solelabcontrato_numero,
                        'solelabcontrato_gestion' => $v->solelabcontrato_gestion,
                        'solelabcontrato_codigo' => $v->solelabcontrato_codigo,
                        /*'solelabcontrato_user_reg_id' => $v->solelabcontrato_user_reg_id,*/
                        'solelabcontrato_fecha_sol' => $v->solelabcontrato_fecha_sol,
                        'fecha_ini' => $v->fecha_ini != "" ? date("d-m-Y", strtotime($v->fecha_ini)) : "",
                        'fecha_incor' => $v->fecha_incor != "" ? date("d-m-Y", strtotime($v->fecha_incor)) : "",
                        'fecha_fin' => $v->fecha_fin != "" ? date("d-m-Y", strtotime($v->fecha_fin)) : "",
                        'fecha_baja' => $v->fecha_baja != "" ? date("d-m-Y", strtotime($v->fecha_baja)) : "",
                        'fecha_ren' => $v->fecha_ren != "" ? date("d-m-Y", strtotime($v->fecha_ren)) : "",
                        'fecha_acepta_ren' => $v->fecha_acepta_ren != "" ? date("d-m-Y", strtotime($v->fecha_acepta_ren)) : "",
                        'fecha_agra_serv' => $v->fecha_agra_serv != "" ? date("d-m-Y", strtotime($v->fecha_agra_serv)) : "",
                        'motivo_baja' => $v->motivo_baja,
                        /*'motivosbajas_abreviacion' => $v->motivosbajas_abreviacion,*/
                        'descripcion_baja' => $v->descripcion_baja,
                        'descripcion_anu' => $v->descripcion_anu,
                        'id_cargo' => $v->id_cargo,
                        'cargo_codigo' => $v->cargo_codigo,
                        'cargo' => $v->cargo,
                        'cargo_resolucion_ministerial_id' => $v->cargo_resolucion_ministerial_id,
                        'cargo_resolucion_ministerial' => $v->cargo_resolucion_ministerial,
                        /*'id_nivelessalarial' => $v->id_nivelessalarial,*/
                        'nivelsalarial' => $v->nivelsalarial,
                        'nivelsalarial_resolucion_id' => $v->nivelsalarial_resolucion_id,
                        'nivelsalarial_resolucion' => $v->nivelsalarial_resolucion,
                        'numero_escala' => $v->numero_escala,
                        'gestion_escala' => $v->gestion_escala,
                        /*'sueldo' => $v->sueldo,*/
                        'sueldo' => str_replace(".00", "", $v->sueldo),
                        'id_procesocontratacion' => $v->id_procesocontratacion,
                        'proceso_codigo' => $v->proceso_codigo,
                        /*'id_convocatoria' => $v->id_convocatoria,*/
                        'convocatoria_codigo' => $v->convocatoria_codigo,
                        'convocatoria_tipo' => $v->convocatoria_tipo,
                        'id_fin_partida' => $v->id_fin_partida,
                        'fin_partida' => $v->fin_partida,
                        'id_condicion' => $v->id_condicion,
                        'condicion' => $v->condicion,
                        /*'categoria_relaboral' => $v->categoria_relaboral,*/
                        'id_da' => $v->id_da,
                        'direccion_administrativa' => $v->direccion_administrativa,
                        'organigrama_regional_id' => $v->organigrama_regional_id,
                        'organigrama_regional' => $v->organigrama_regional,
                        'id_regional' => $v->id_regional,
                        'regional' => $v->regional,
                        'regional_codigo' => $v->regional_codigo,
                        'id_departamento' => $v->id_departamento,
                        'departamento' => $v->departamento,
                        'id_provincia' => $v->id_provincia,
                        'provincia' => $v->provincia,
                        'id_localidad' => $v->id_localidad,
                        'localidad' => $v->localidad,
                        'residencia' => $v->residencia,
                        'unidad_ejecutora' => $v->unidad_ejecutora,
                        'cod_ue' => $v->cod_ue,
                        'id_gerencia_administrativa' => $v->id_gerencia_administrativa,
                        'gerencia_administrativa' => $v->gerencia_administrativa,
                        'id_departamento_administrativo' => $v->id_departamento_administrativo,
                        'departamento_administrativo' => $v->departamento_administrativo,
                        'id_organigrama' => $v->id_organigrama,
                        'unidad_administrativa' => $v->unidad_administrativa,
                        'organigrama_sigla' => $v->organigrama_sigla,
                        'organigrama_orden' => $v->organigrama_orden,
                        'id_area' => $v->id_area,
                        'area' => $v->area,
                        'id_ubicacion' => $v->id_ubicacion,
                        'ubicacion' => $v->ubicacion,
                        'unidades_superiores' => $v->unidades_superiores,
                        'unidades_dependientes' => $v->unidades_dependientes,
                        'partida' => $v->partida,
                        'fuente_codigo' => $v->fuente_codigo,
                        'fuente' => $v->fuente,
                        'organismo_codigo' => $v->organismo_codigo,
                        'organismo' => $v->organismo,
                        'observacion' => ($v->observacion != null) ? $v->observacion : "",
                        'estado' => $v->estado,
                        'estado_descripcion' => $v->estado_descripcion,
                        'estado_abreviacion' => $v->estado_abreviacion,
                        'tiene_contrato_vigente' => $v->tiene_contrato_vigente,
                        'id_eventual' => $v->id_eventual,
                        'id_consultor' => $v->id_consultor,
                        'user_reg_id' => $v->user_reg_id,
                        'fecha_reg' => $v->fecha_reg,
                        'user_mod_id' => $v->user_mod_id,
                        'fecha_mod' => $v->fecha_mod,
                        'persona_user_reg_id' => $v->persona_user_reg_id,
                        'persona_fecha_reg' => $v->persona_fecha_reg,
                        'persona_user_mod_id' => $v->persona_user_mod_id,
                        'persona_fecha_mod' => $v->persona_fecha_mod,
                        'relaboralperfil_id' => $v->relaboralperfil_id,
                        'relaboralperfil_perfillaboral_id' => $v->relaboralperfil_perfillaboral_id,
                        'relaboralperfil_perfil_laboral' => $v->relaboralperfil_perfil_laboral,
                        'relaboralperfil_grupo' => $v->relaboralperfil_grupo,
                        'relaboralperfil_ubicacion_principal_id' => $v->relaboralperfil_ubicacion_principal_id,
                        'relaboralperfil_ubicacion_id' => $v->relaboralperfil_ubicacion_id,
                        'relaboralperfil_ubicacion' => $v->relaboralperfil_ubicacion,
                        'relaboralperfil_estacion_id' => $v->relaboralperfil_estacion_id,
                        'relaboralperfil_estacion' => $v->relaboralperfil_estacion,
                        'relaboralperfil_fecha_ini' => $v->relaboralperfil_fecha_ini,
                        'relaboralperfil_fecha_fin' => $v->relaboralperfil_fecha_fin
                    );
                }
            }
        }
        echo json_encode($relaboral);
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