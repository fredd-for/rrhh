<?php

/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  13-10-2014
*/

class RelaboralesController extends ControllerBase
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
        $this->assets->addCss('/css/oasis.tabla.incrementable.css');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.tab.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.list.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.approve.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.new.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.edit.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.down.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.view.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.print.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.view.splitter.js');
        $this->assets->addJs('/js/relaborales/oasis.localizacion.js');
        $this->assets->addCss('/assets/css/oasis.principal.css');
        $ubicaciones = $this->tag->select(
            array(
                'lstUbicaciones',
                Ubicaciones::find(array('baja_logica=1', 'order' => 'id ASC')),
                'using' => array('id', "ubicacion"),
                'useEmpty' => true,
                'emptyText' => 'Seleccionar..',
                'emptyValue' => '',
                'class' => 'form-control new-relab'
            )
        );
        $this->view->setVar('ubicaciones', $ubicaciones);

        $categorias = $this->tag->select(
            array(
                'lstCategorias',
                Categorias::find(array('order' => 'id ASC')),
                'using' => array('id', "categoria"),
                'useEmpty' => true,
                'emptyText' => 'Seleccionar..',
                'emptyValue' => '',
                'class' => 'form-control new-relab'
            )
        );
        $this->view->setVar('categorias', $categorias);
    }

    /**
     * Función para la carga del primer listado sobre la página de gestión de relaciones laborales.
     * Se inhabilita la vista para el uso de jqwidgets,
     */
    public function listAction()
    {
        $this->view->disable();
        $obj = new Frelaborales();
        $resul = $obj->getAllWithPersonsOneRecord();
        $permisoC = true;
        $permisoR = true;
        $permisoU = true;
        $permisoD = true;
        //comprobamos si hay filas
        if ($resul->count() > 0) {
            foreach ($resul as $v) {
                $chk = '';
                $new = '';
                $edit = '';
                $down = '';
                $view = '';
                $chk = '<input type="checkbox" id="chk_' . $v->id_relaboral . '">';
                // Se evalua el permiso de creación de nuevo registro
                if ($permisoC) {
                    if ($v->tiene_contrato_vigente == 0) {
                        $new = '<input type="button" id="btn_new_' . $v->id_relaboral . '" value=Nuevo class=btn_new>';
                    }
                }
                //Se evalua el permiso de edición de registro
                if ($permisoU) {
                    if ($v->estado == 2) {
                        $edit = '<input type="button" id="btn_edit_' . $v->id_relaboral . '" value=Editar class=btn_edit>';
                    }
                }
                //Se evalua
                $aprobar = '<input type="button" id="btn_appr_' . $v->id_relaboral . '" value="Aprobar" class="btn_approve">';
                $down = '<input type="button" id="btn_del_' . $v->id_relaboral . '" value="Baja" class="btn_del">';
                $view = '<input type="button" id="btn_view_' . $v->id_relaboral . '" value="Ver" class="btn_view">';
                $relaboral[] = array(
                    'chk' => $chk,
                    'nro_row' => 0,
                    'nuevo' => $new,
                    'aprobar' => $aprobar,
                    'editar' => $edit,
                    'eliminar' => $down,
                    'ver' => $view,
                    'id_relaboral' => $v->id_relaboral,
                    'id_persona' => $v->id_persona,
                    'p_nombre' => $v->p_nombre,
                    's_nombre' => $v->s_nombre,
                    't_nombre' => $v->t_nombre,
                    'p_apellido' => $v->p_apellido,
                    's_apellido' => $v->s_apellido,
                    'c_apellido' => $v->c_apellido,
                    'nombres' => $v->p_nombre . " " . $v->s_nombre . " " . $v->t_nombre . " " . $v->p_apellido . " " . $v->s_apellido . " " . $v->c_apellido,
                    'ci' => $v->ci,
                    'expd' => $v->expd,
                    'num_complemento' => $v->num_complemento,
                    'fecha_nac' => $v->fecha_nac,
                    'edad' => $v->edad,
                    'lugar_nac' => $v->lugar_nac,
                    'genero' => $v->genero,
                    'e_civil' => $v->e_civil,
                    'item' => $v->item,
                    'carrera_amd' => $v->carrera_amd,
                    'num_contrato' => $v->num_contrato,
                    'contrato_numerador_estado' => $v->contrato_numerador_estado,
                    'id_solelabcontrato' => $v->id_solelabcontrato,
                    'solelabcontrato_regional_sigla' => $v->solelabcontrato_regional_sigla,
                    'solelabcontrato_numero' => $v->solelabcontrato_numero,
                    'solelabcontrato_gestion' => $v->solelabcontrato_gestion,
                    'solelabcontrato_codigo' => $v->solelabcontrato_codigo,
                    'solelabcontrato_user_reg_id' => $v->solelabcontrato_user_reg_id,
                    'solelabcontrato_fecha_sol' => $v->solelabcontrato_fecha_sol,
                    'fecha_ini' => $v->fecha_ini!=""?date("d-m-Y", strtotime($v->fecha_ini)):"",
                    'fecha_incor' => $v->fecha_incor!=""?date("d-m-Y", strtotime($v->fecha_incor)):"",
                    'fecha_fin' => $v->fecha_fin!=""?date("d-m-Y", strtotime($v->fecha_fin)):"",
                    'fecha_baja' => $v->fecha_baja!=""?date("d-m-Y", strtotime($v->fecha_baja)):"",
                    'fecha_ren' => $v->fecha_ren!=""?date("d-m-Y", strtotime($v->fecha_ren)):"",
                    'fecha_acepta_ren' => $v->fecha_acepta_ren!=""?date("d-m-Y", strtotime($v->fecha_acepta_ren)):"",
                    'fecha_agra_serv' => $v->fecha_agra_serv!=""?date("d-m-Y", strtotime($v->fecha_agra_Serv)):"",
                    'motivo_baja' => $v->motivo_baja,
                    'motivosbajas_abreviacion' => $v->motivosbajas_abreviacion,
                    'descripcion_baja' => $v->descripcion_baja,
                    'descripcion_anu' => $v->descripcion_anu,
                    'id_cargo' => $v->id_cargo,
                    'cargo_codigo' => $v->cargo_codigo,
                    'cargo' => $v->cargo,
                    'id_nivelessalarial' => $v->id_nivelessalarial,
                    'nivelsalarial' => $v->nivelsalarial,
                    'nivelsalarial_resolucion_id' => $v->nivelsalarial_resolucion_id,
                    'numero_escala' => $v->numero_escala,
                    'gestion_escala' => $v->gestion_escala,
                    'sueldo' => $v->sueldo,
                    'id_proceso' => $v->id_proceso,
                    'proceso_codigo' => $v->proceso_codigo,
                    'id_convocatoria' => $v->id_convocatoria,
                    'convocatoria_codigo' => $v->convocatoria_codigo,
                    'convocatoria_tipo' => $v->convocatoria_tipo,
                    'id_fin_partida' => $v->id_fin_partida,
                    'fin_partida' => $v->fin_partida,
                    'id_condicion' => $v->id_condicion,
                    'condicion' => $v->condicion,
                    'categoria_relaboral' => $v->categoria_relaboral,
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
                    'organigrama_codigo' => $v->organigrama_codigo,
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
                    'observacion' => ($v->observacion!=null)?$v->observacion:"",
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
                    'persona_fecha_mod' => $v->persona_fecha_mod
                );
            }
        }
        echo json_encode($relaboral);
    }

    /**
     * Función para la obtención del listado de cargos al momento de registrar una nueva relación laboral.
     */
    public function listcargosAction()
    {
        $this->assets->addJs('/js/relaborales/oasis.relaborales.tab.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.list.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.new.js');
        $this->assets->addCss('/js/css/oasis.tabla.incrementable.css');
        $this->view->disable();
        $obj = new Fcargos();
        $resul = $obj->getAllCargosAcefalos();
        //comprobamos si hay filas
        if ($resul->count() > 0) {
            foreach ($resul as $v) {
                $relaboral[] = array(
                    'seleccionable' => 'seleccionable',
                    'codigo' => $v->codigo,
                    'finpartida' => $v->finpartida,
                    'id_condicion' => $v->id_condicion,
                    'condicion' => $v->condicion,
                    'cargo' => $v->cargo,
                    'id_cargo' => $v->id_cargo,
                    'nivelsalarial' => $v->nivelsalarial,
                    'sueldo' => $v->sueldo,
                    'id_gerencia_administrativa' => $v->id_gerencia_administrativa,
                    'gerencia_administrativa' => $v->gerencia_administrativa,
                    'id_departamento_administrativo' => $v->id_departamento_administrativo,
                    'departamento_administrativo' => $v->departamento_administrativo,
                    'id_organigrama' => $v->id_organigrama,
                    'unidad_administrativa' => $v->unidad_administrativa,
                );
            }
        }
        echo json_encode($relaboral);
    }

    /**
     * Función para la obtención del listado de procesos disponibles.
     */
    public function listprocesosAction()
    {
        $this->assets->addJs('/js/relaborales/oasis.relaborales.tab.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.list.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.new.js');
        $this->assets->addCss('/js/css/oasis.tabla.incrementable.css');
        $this->view->disable();
        $id_condicion = $_POST["id_condicion"];
        $obj = new Procesoscontrataciones();
        $objProcesosContrataciones = $obj->listaProcesosPorCondicion($id_condicion);
        if ($objProcesosContrataciones->count() > 0) {
            foreach ($objProcesosContrataciones as $v) {
                $procesos[] = array(
                    'id' => $v->id,
                    'codigo_proceso' => $v->codigo_proceso
                );
            }
        }
        echo json_encode($procesos);
    }

    /**
     * Función para la obtención del ubicaciones disponibles.
     */
    public function listubicacionesAction()
    {
        $this->assets->addJs('/js/relaborales/oasis.relaborales.tab.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.list.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.new.js');
        $this->assets->addCss('/js/css/oasis.tabla.incrementable.css');
        $this->view->disable();
        $resul = Ubicaciones::find(array('order' => 'id ASC'));
        if ($resul->count() > 0) {
            foreach ($resul as $v) {
                $ubicaciones[] = array(
                    'id' => $v->id,
                    'ubicacion' => $v->ubicacion
                );
            }
        }
        echo json_encode($ubicaciones);
    }

    /**
     * Función para la obtención del listado de motivos de baja disponibles.
     */
    public function listmotivosbajasAction()
    {
        $this->assets->addJs('/js/relaborales/oasis.relaborales.tab.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.list.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.new.js');
        $this->assets->addJs('/js/relaborales/oasis.relaborales.down.js');
        $this->assets->addCss('/js/css/oasis.tabla.incrementable.css');
        $this->view->disable();
        $resul = Motivosbajas::find(array('estado=1','order' => 'id ASC'));
        if ($resul->count() > 0) {
            foreach ($resul as $v) {
                $motivosbajas[] = array(
                    'id' => $v->id,
                    'motivo_baja' => $v->motivo_baja,
                    'permanente' => $v->permanente,
                    'eventual' => $v->eventual,
                    'consultor' => $v->consultor,
                    'fecha_ren' => $v->fecha_ren,
                    'fecha_acepta_ren' => $v->fecha_acepta_ren,
                    'fecha_agra_serv' => $v->fecha_agra_serv
                );
            }
        }
        echo json_encode($motivosbajas);
    }
    /**
     * Función para el almacenamiento y actualización de un registro de relación laboral.
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
        $user_reg_id=1;
        $user_mod_id=1;
        $msj = Array();
        $gestion_actual = date("Y");
        $hoy = date("Y-m-d H:i:s");
        $fecha_fin = "31/12/" . $gestion_actual;
        $this->view->disable();
        if (isset($_POST["id"])&&$_POST["id"] > 0) {
            /**
             * Edición de registro
             */
            $objRelaboral = Relaborales::findFirstById($_POST["id"]);
            $id_persona = $_POST['id_persona'];
            $id_cargo = $_POST['id_cargo'];
            $num_contrato = $_POST['num_contrato'];
            $observacion = $_POST['observacion'];
            $cargo = Cargos::findFirstById($id_cargo);
            $id_organigrama = $cargo->organigrama_id;
            $id_finpartida = $cargo->fin_partida_id;
            $id_nivelsalarial = $cargo->nivelsalarial_id;
            $id_relaboral = null;
            $finpartida = Finpartidas::findFirstById($id_finpartida);
            $id_condicion = $finpartida->condicion_id;
            $id_area = $_POST['id_area'];
            $id_ubicacion = $_POST['id_ubicacion'];
            $id_regional = $_POST['id_regional'];
            $id_proceso = $_POST['id_proceso'];
            $date1 = new DateTime($_POST['fecha_inicio']);
            $date2 = new DateTime($_POST['fecha_incor']);
            $date3 = new DateTime($_POST['fecha_fin']);
            $fecha_ini = $date1->format('Y-m-d');
            $fecha_incor = $date2->format('Y-m-d');
            /**
             * Si la condición es consultoría se debe considerar la fecha enviada en el formulario.
             */
            if ($id_condicion == 2||$id_condicion == 3) {
                $fecha_fin = $date3->format('Y-m-d');
            }else{
                $fecha_fin = $objRelaboral->fecha_fin;
            }
            if ($id_persona > 0 && $id_cargo > 0) {
                try {

                    $objRelaboral->cargo_id = $id_cargo;
                    $objRelaboral->num_contrato = $num_contrato == '' ? null : $num_contrato;
                    $objRelaboral->da_id = 1;
                    $objRelaboral->regional_id = $id_regional;
                    $objRelaboral->organigrama_id = $id_organigrama;
                    $objRelaboral->ejecutora_id = 1;
                    $objRelaboral->proceso_id = $id_proceso;
                    $objRelaboral->cargo_id = $id_cargo;
                    $objRelaboral->certificacionitem_id = null;
                    $objRelaboral->finpartida_id = $id_finpartida;
                    $objRelaboral->condicion_id = $id_condicion;
                    $objRelaboral->carrera_adm = 0;
                    $objRelaboral->pagado = 0;
                    $objRelaboral->nivelsalarial_id = $id_nivelsalarial;
                    $objRelaboral->fecha_ini = $fecha_ini;
                    $objRelaboral->fecha_incor = $fecha_incor;
                    $objRelaboral->fecha_fin = $fecha_fin;
                    $objRelaboral->observacion = ($observacion=="")?null:$observacion;
                    /**
                     * Con este valor eventualmente para presentación
                     * --->
                     */
                    $objRelaboral->estado = 1;
                    /*
                     * <---
                     */
                    $objRelaboral->baja_logica = 1;
                    $objRelaboral->user_mod_id = $user_mod_id;
                    $objRelaboral->fecha_mod = $hoy;
                    $objRelaboral->agrupador = 0;
                    $ok = $objRelaboral->save();
                    if ($ok) {
                        /**
                         * Modificar el estado del cargo a adjudicado
                         */
                        $this->adjudicarCargo($objRelaboral->cargo_id,$objRelaboral->user_mod_id);
                        #region Registro del área de trabajo
                        if($id_area>0){
                            /*
                             * Verificando la existencia del registro de relación laboral.                             *
                             */
                            //$objRA =  Relaboralesareas::findFirst(array('relaboral_id='.$objRelaboral->id.' AND baja_logica = 1 AND estado=1','order' => 'id ASC'));
                            $objRA = Relaboralesareas::findFirst(array('relaboral_id='.$objRelaboral->id,'order' => 'id ASC'));
                            if($objRA->id>0){
                                $objRA->estado= 1;
                                $objRA->baja_logica= 1;
                                $objRA->organigrama_id= $id_area;
                                $objRA->user_mod_id= $user_reg_id;
                                $objRA->fecha_mod= $hoy;
                                $objRA->save();
                            }else{
                                $objRelArea = new Relaboralesareas();
                                $objRelArea->id= null;
                                $objRelArea->relaboral_id= $objRelaboral->id;
                                $objRelArea->organigrama_id= $id_area;
                                $objRelArea->observacion= null;
                                $objRelArea->estado= 1;
                                $objRelArea->baja_logica= 1;
                                $objRelArea->agrupador= 0;
                                $objRelArea->user_reg_id= $user_reg_id;
                                $objRelArea->fecha_reg= $hoy;
                                $objRelArea->save();
                            }
                        }else{
                            /*
                             * En caso de ser necesario descartar la pertenencia de una persona a un área en la cual se haya registrado con anterioridad
                             */
                            $objRelArea = Relaboralesareas::findFirst(array('relaboral_id='.$objRelaboral->id,'order' => 'id ASC'));
                            if($objRelArea->id>0){
                                $objRelArea->estado=0;
                                $objRelArea->baja_logica= 0;
                                $objRelArea->user_mod_id= $user_reg_id;
                                $objRelArea->fecha_mod= $hoy;
                                $objRelArea->save();
                            }
                        }
                        #endregion Registro del área de trabajo
                        #region Registro de la ubicación de trabajo
                        //Si se ha registrado correctamente la relación laboral y se ha definido una ubicación de trabajo
                        if ($id_ubicacion > 0) {
                            //$ru = new Relaboralesubicaciones();
                            $ru = Relaboralesubicaciones::findFirst(array('relaboral_id=:relaboral_id1:'/*,'baja_logica=:activo1:','estado=:estado1:'*/,'bind'=>array('relaboral_id1'=>$objRelaboral->id,/*'activo1'=>'1','estado1'=>1*/),'order' => 'id ASC'));
                            if($ru->id>0){
                                /**
                                 * Si existia el registro de ubicación
                                 */
                                $ru->ubicacion_id = $id_ubicacion;
                                $ru->fecha_ini = $objRelaboral->fecha_ini;
                                $ru->estado = 1;
                                $ru->baja_logica = 1;
                                $ru->agrupador = 0;
                                if ($ru->save()) {
                                    //Si se ha especificado un area para la especificación de la dependencia de la persona.
                                    /*if($id_area>0){


                                    }*/
                                    $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se guard&oacute; correctamente.');
                                } else {
                                    $msj = array('result' => 0, 'msj' => 'Error: No se guard&oacute; la ubicaci&oacute;n del trabajo.');
                                }
                            }else{
                                /**
                                 * Si no se tenía registro de ubicación
                                 */
                                $ru = new Relaboralesubicaciones();
                                $ru->relaboral_id = $objRelaboral->id;
                                $ru->ubicacion_id = $id_ubicacion;
                                $ru->fecha_ini = $objRelaboral->fecha_ini;
                                $ru->estado = 1;
                                $ru->baja_logica = 1;
                                $ru->agrupador = 0;
                                if ($ru->save()) {
                                    $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se guard&oacute; correctamente.');
                                } else {
                                    $msj = array('result' => 0, 'msj' => 'Error: No se guard&oacute; la ubicaci&oacute;n del trabajo.');
                                }
                            }
                        } else {
                            $msj = array('result' => 0, 'msj' => 'Error: No se guard&oacute; la ubicaci&oacute;n del trabajo.');
                        }
                        #region de registro de la ubicación de trabajo
                    } else {
                        foreach ($objRelaboral->getMessages() as $message) {
                            echo $message, "\n";
                        }
                        $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de relaci&oacute;n laboral.');
                    }
                } catch (\Exception $e) {
                    echo get_class($e), ": ", $e->getMessage(), "\n";
                    echo " File=", $e->getFile(), "\n";
                    echo " Line=", $e->getLine(), "\n";
                    echo $e->getTraceAsString();
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de relaci&oacute;n laboral.');
                }
            } else {
                $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro debido a datos erroneos de la persona o cargo.');
            }
        } else {
            /**
             * Nuevo Registro
             */
            if (isset($_POST['id_persona']) && isset($_POST['id_cargo'])) {
                $id_persona = $_POST['id_persona'];
                $id_cargo = $_POST['id_cargo'];
                $num_contrato = $_POST['num_contrato'];
                $observacion = $_POST['observacion'];

                $cargo = Cargos::findFirstById($id_cargo);
                $id_organigrama = $cargo->organigrama_id;
                $id_finpartida = $cargo->fin_partida_id;
                $id_nivelsalarial = $cargo->nivelsalarial_id;
                $id_relaboral = null;
                $finpartida = Finpartidas::findFirstById($id_finpartida);
                $id_condicion = $finpartida->condicion_id;

                $id_area = $_POST['id_area'];
                $id_ubicacion = $_POST['id_ubicacion'];
                $id_regional = $_POST['id_regional'];
                $id_proceso = $_POST['id_proceso'];
                $date1 = new DateTime($_POST['fecha_inicio']);
                $date2 = new DateTime($_POST['fecha_incor']);
                $date3 = new DateTime($_POST['fecha_fin']);
                $fecha_ini = $date1->format('Y-m-d');
                $fecha_incor = $date2->format('Y-m-d');
                /**
                 * Si la condición es consultoría se debe considerar la fecha enviada en el formulario.
                 */
                if ($id_condicion == 2||$id_condicion == 3) {
                    $fecha_fin = $date3->format('Y-m-d');
                }
                if ($id_persona > 0 && $id_cargo > 0) {
                    try {
                        $objRelaboral = new Relaborales();
                        $objRelaboral->id = null;
                        $objRelaboral->persona_id = $id_persona;
                        $objRelaboral->cargo_id = $id_cargo;
                        $objRelaboral->num_contrato = $num_contrato == '' ? null : $num_contrato;
                        $objRelaboral->da_id = 1;
                        $objRelaboral->regional_id = $id_regional;
                        $objRelaboral->organigrama_id = $id_organigrama;
                        $objRelaboral->ejecutora_id = 1;
                        $objRelaboral->proceso_id = $id_proceso;
                        $objRelaboral->cargo_id = $id_cargo;
                        $objRelaboral->certificacionitem_id = null;
                        $objRelaboral->finpartida_id = $id_finpartida;
                        $objRelaboral->condicion_id = $id_condicion;
                        $objRelaboral->carrera_adm = 0;
                        $objRelaboral->pagado = 0;
                        $objRelaboral->nivelsalarial_id = $id_nivelsalarial;
                        $objRelaboral->fecha_ini = $fecha_ini;
                        $objRelaboral->fecha_incor = $fecha_incor;
                        $objRelaboral->fecha_fin = $fecha_fin;
                        $objRelaboral->observacion = ($observacion=="")?null:$observacion;
                        /*
                         * Modificación expresa debido a la anulación del formulario de aprobación de registros de relación laboral.
                         * El registro de relación laboral
                         * -->
                         */
                        $objRelaboral->estado = 1;
                        /**
                         * <--
                         */
                        $objRelaboral->baja_logica = 1;
                        $objRelaboral->user_reg_id = $user_reg_id;
                        $objRelaboral->fecha_reg = $hoy;
                        $objRelaboral->agrupador = 0;
                        $ok = $objRelaboral->save();
                        if ($ok) {
                            /**
                             * Se modifica el estado del cargo para que se considere como adjudicado.
                             */
                            $this->adjudicarCargo($objRelaboral->cargo_id,$objRelaboral->user_mod_id);
                            #region Registro del área de trabajo
                            if($id_area>0){
                                $objRelArea = new Relaboralesareas();
                                $objRelArea->id= null;
                                $objRelArea->relaboral_id= $objRelaboral->id;
                                $objRelArea->organigrama_id= $id_area;
                                $objRelArea->observacion= null;
                                $objRelArea->estado= 1;
                                $objRelArea->baja_logica= 1;
                                $objRelArea->agrupador= 0;
                                $objRelArea->user_reg_id= $user_reg_id;
                                $objRelArea->fecha_reg= $hoy;
                                $objRelArea->save();
                            }
                            #endregion Registro del área de trabajo
                            #region Registro de la ubicación de trabajo
                            //Si se ha registrado correctamente la relación laboral y se ha definido una ubicación de trabajo
                            if ($objRelaboral->id > 0 && $id_ubicacion > 0) {
                                $ru = new Relaboralesubicaciones();
                                $ru->relaboral_id = $objRelaboral->id;
                                $ru->ubicacion_id = $id_ubicacion;
                                $ru->fecha_ini = $objRelaboral->fecha_ini;
                                $ru->estado = 1;
                                $ru->baja_logica = 1;
                                $ru->agrupador = 0;
                                if ($ru->save()) {
                                    //Si se ha especificado un area para la especificación de la dependencia de la persona.
                                    /*if($id_area>0){


                                    }*/

                                    $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se guard&oacute; correctamente.');
                                } else {
                                    $msj = array('result' => 0, 'msj' => 'Error: No se guard&oacute; la ubicaci&oacute;n del trabajo.');
                                }
                            } else {
                                $msj = array('result' => 0, 'msj' => 'Error: No se guard&oacute; la ubicaci&oacute;n del trabajo.');
                            }
                            #region de registro de la ubicación de trabajo
                        } else {
                            foreach ($objRelaboral->getMessages() as $message) {
                                echo $message, "\n";
                            }
                            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de relaci&oacute;n laboral.');
                        }
                    } catch (\Exception $e) {
                        echo get_class($e), ": ", $e->getMessage(), "\n";
                        echo " File=", $e->getFile(), "\n";
                        echo " Line=", $e->getLine(), "\n";
                        echo $e->getTraceAsString();
                        $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de relaci&oacute;n laboral.');
                    }
                } else {
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro debido a datos erroneos de la persona o cargo.');
                }
            } else {
                $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro debido a datos erroneos de la persona o cargo.');
            }
        }
        echo json_encode($msj);
    }

    /*
     * Función para la aprobación del registro de relación laboral que se encontraba en estado EN PROCESO.
     */
    public function approveAction()
    {
        $user_mod_id=1;
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        if (isset($_POST["id"])&&$_POST["id"] > 0) {
            /**
             * Aprobación de registro
             */
            $objRelaboral = Relaborales::findFirstById($_POST["id"]);
            if ($objRelaboral->id > 0 && $objRelaboral->estado == 2) {
                try {
                    $objRelaboral->estado = 1;
                    $objRelaboral->user_mod_id = $user_mod_id;
                    $objRelaboral->fecha_mod = $hoy;
                    $ok = $objRelaboral->save();
                    if ($ok) {
                        $this->adjudicarCargo($objRelaboral->cargo_id,$user_mod_id);
                        $msj = array('result' => 1, 'msj' => '&Eacute:xito: Se aprob&oacute; correctamente el registro de relaci&oacute;n laboral.');
                    }else{
                        $msj = array('result' => 0, 'msj' => 'Error: No se aprob&oacute; el registro de relaci&oacute;n laboral.');
                    }
                } catch (\Exception $e) {
                    echo get_class($e), ": ", $e->getMessage(), "\n";
                    echo " File=", $e->getFile(), "\n";
                    echo " Line=", $e->getLine(), "\n";
                    echo $e->getTraceAsString();
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de relaci&oacute;n laboral.');
                }
            } else {
                $msj = array('result' => 0, 'msj' => 'Error: El registro de relaci&oacute;n laboral no cumple con el requisito establecido para su aprobaci&oacute;n, debe estar en estado EN PROCESO.');
            }
        } else {
            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se envi&oacute; el identificador del registro de relaci&oacute;n laboral.');
        }
        echo json_encode($msj);
    }

    /**
     * Función para el la baja del registro de una relación laboral..
     * return array(EstadoResultado,Mensaje)
     * Los valores posibles para la variable EstadoResultado son:
     *  0: Error
     *   1: Procesado
     *  -1: Crítico Error
     *  -2: Error de Conexión
     *  -3: Usuario no Autorizado
     */
    public function downAction()
    {   $ok=true;
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        try{
            if (isset($_POST["id"])&&$_POST["id"] > 0) {
            /**
             * Baja de registro
             */
            $objRelaboral = Relaborales::findFirstById($_POST["id"]);
            $id_motivo_baja = (isset($_POST['id_motivobaja']))?$_POST['id_motivobaja']:0;
            $fecha_baja = (isset($_POST['fecha_baja']))?$_POST['fecha_baja']:'31-12-2014';
            $fecha_acepta_ren = (isset($_POST['fecha_acepta_ren']))?$_POST['fecha_acepta_ren']:null;
            $fecha_agra_serv = (isset($_POST['fecha_agra_serv']))?$_POST['fecha_agra_serv']:"";

            if($id_motivo_baja>0&&$fecha_baja!=""&&$fecha_baja!=null){
                /**
                 * Control de fechas necesarias por el tipo de motivo de baja.
                 */
                $motivobaja=Motivosbajas::findFirstById($id_motivo_baja);
                if($motivobaja->id>0){
                    /**
                     * Se cargan los datos elementales.
                     */
                    $objRelaboral->motivobaja_id=$id_motivo_baja;
                    $objRelaboral->fecha_baja=$fecha_baja;

                    /**
                     * Si la fecha de renuncia es requerida
                     */
                    if($motivobaja->fecha_ren>0){
                        if(isset($_POST['fecha_ren'])){
                            $fecha_ren = $_POST['fecha_ren'];
                            $objRelaboral->fecha_ren=$fecha_ren;
                        }elseif($motivobaja->fecha_ren==1){
                            $msj = array('result' => 0, 'msj' => 'Error: Debe registrar la fecha de renuncia si desea usar el tipo de baja seleccionado.');
                            $ok=false;
                        }
                    }
                    /**
                     * Si la fecha de aceptación de renuncia es requerida
                     */
                    if($motivobaja->fecha_acepta_ren>0){
                        if(isset($_POST['fecha_acepta_ren'])){
                            $fecha_acepta_ren = $_POST['fecha_acepta_ren'];
                            $objRelaboral->fecha_acepta_ren=$fecha_acepta_ren;
                        }elseif($motivobaja->fecha_acepta_ren==1){
                            $msj = array('result' => 0, 'msj' => 'Error: Debe registrar la fecha de aceptaci&oacute;n de la renuncia si desea usar el tipo de baja seleccionado.');
                            $ok=false;
                        }
                    }
                    /**
                     * Si la fecha de agradecimiento es requerida
                     */
                    if($motivobaja->fecha_agra_serv>0){
                        if(isset($_POST['fecha_agra_serv'])){
                            $fecha_agra_serv = $_POST['fecha_agra_serv'];
                            $objRelaboral->fecha_agra_serv=$fecha_agra_serv;
                        }elseif($motivobaja->fecha_agra_serv==1){
                            $msj = array('result' => 0, 'msj' => 'Error: Debe registrar la fecha de agradecimiento de servicios si desea usar el tipo de baja seleccionado.');
                            $ok=false;
                        }
                    }
                    /**
                     * Si el motivo de renuncia es no incorporación, la fecha de incorporación se establece en nulo.
                     */
                    if($motivobaja->motivo_baja=="NO SE INCORPORA"){
                        $objRelaboral->fecha_incor=null;
                        $objRelaboral->fecha_baja=$objRelaboral->fecha_ini;
                    }
                    /**
                     * Se verifica que todos los datos requeridos para una baja esten registrados
                     */
                    if($ok){
                        $objRelaboral->estado=0;
                        $objRelaboral->user_mod_id=1;
                        $objRelaboral->fecha_mod = $hoy;
                        if ($objRelaboral->save()) {
                            /**
                             * Se modifica el estado del cargo a desadjudicado a objeto de permitir su uso.
                             */
                            $this->desadjudicarCargo($objRelaboral->cargo_id,$objRelaboral->user_mod_id);
                            $msj = array('result' => 1, 'msj' => '&Eacute;xito: Registro de Baja realizado de modo satisfactorio.');
                        } else {
                            foreach ($objRelaboral->getMessages() as $message) {
                                echo $message, "\n";
                            }
                            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de relaci&oacute;n laboral.');
                        }
                    }
                } else $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se registr&oacute; la baja de la relaci&oacute;n laboral debido a datos inv&acute;lidos para la tarea.');
                }else $msj = array('result' => 0, 'msj' => 'Error: No se registr&oacute; la baja de la relaci&oacute;n laboral debido a datos inv&acute;lidos para la tarea.');
            }else $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de relaci&oacute;n laboral debido a que no se especific&oacute; el registro de relaci&oacute;n laboral.');
        }catch (\Exception $e) {
                    echo get_class($e), ": ", $e->getMessage(), "\n";
                    echo " File=", $e->getFile(), "\n";
                    echo " Line=", $e->getLine(), "\n";
                    echo $e->getTraceAsString();
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de relaci&oacute;n laboral.');
                }
        echo json_encode($msj);
    }

    /**
     * Función para la obtención de los datos referentes a una persona en especifico.
     */
    public function personascontactoAction()
    {   $personas = Array();
        $this->view->disable();
        try{
            if (isset($_POST["id"])&&$_POST["id"] > 0) {
                $id_persona = $_POST["id"];
                $obj = new Fpersonas();
                $objPersona = $obj->getOne($id_persona);
                //findFirst("id = 1");
                if ($objPersona->count() > 0) {
                    foreach ($objPersona as $v) {
                        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                        $date = new DateTime($v->fecha_nac);
                        $fecha_nac = $date->format('d')."-".$meses[$date->format('m')-1]."-".$date->format('Y');
                        $personas[] = array(
                            'id_persona' =>$v->id_persona,
                            'postulante_id'=>$v->postulante_id,
                            'p_nombre'=>$v->p_nombre,
                            's_nombre'=>$v->s_nombre,
                            't_nombre'=>$v->t_nombre,
                            'p_apellido'=>$v->p_apellido,
                            's_apellido'=>$v->s_apellido,
                            'c_apellido'=>$v->c_apellido,
                            'tipo_documento'=>$v->tipo_documento,
                            'ci'=>$v->ci,
                            'expd'=>$v->expd,
                            'num_complemento'=>$v->num_complemento,
                            'fecha_nac'=>$fecha_nac,
                            'edad'=>$v->edad,
                            'lugar_nac'=>$v->lugar_nac,
                            'genero'=>$v->genero,
                            'e_civil'=>$v->e_civil,
                            'codigo'=>$v->codigo,
                            'nacionalidad'=>$v->nacionalidad,
                            'nit'=>$v->nit,
                            'num_func_sigma'=>$v->num_func_sigma,
                            'grupo_sanguineo'=>$v->grupo_sanguineo,
                            'num_lib_ser_militar'=>$v->num_lib_ser_militar,
                            'num_reg_profesional'=>$v->num_reg_profesional,
                            'observacion'=>$v->observacion,
                            'estado'=>$v->estado,
                            'baja_logica'=>$v->baja_logica,
                            'agrupador'=>$v->agrupador,
                            'user_reg_id'=>$v->user_reg_id,
                            'fecha_reg'=>$v->fecha_reg,
                            'user_mod_id'=>$v->user_mod_id,
                            'fecha_mod'=>$v->fecha_mod,
                            'direccion_dom'=>($v->direccion_dom!=null)?$v->direccion_dom:'',
                            'telefono_fijo'=>($v->telefono_fijo!=null)?$v->telefono_fijo:'',
                            'telefono_inst'=>($v->telefono_inst!=null)?$v->telefono_inst:'',
                            'telefono_fax'=>($v->telefono_fax!=null)?$v->telefono_fax:'',
                            'interno_inst'=>($v->interno_inst!=null)?$v->interno_inst:'',
                            'celular_per'=>($v->celular_per!=null)?$v->celular_per:'',
                            'celular_inst'=>($v->celular_inst!=null)?$v->celular_inst:'',
                            'num_credencial'=>($v->num_credencial!=null)?$v->num_credencial:'',
                            'ac_no'=>($v->ac_no!=null)?$v->ac_no:'',
                            'e_mail_per'=>($v->e_mail_per!=null)?$v->e_mail_per:'',
                            'e_mail_inst'=>($v->e_mail_inst!=null)?$v->e_mail_inst:'',
                            'contacto_observacion'=>($v->contacto_observacion!=null)?$v->contacto_observacion:'',
                            'contacto_estado'=>($v->contacto_estado!=null)?$v->contacto_estado:''
                        );
                    }
                }
            }
            }catch (\Exception $e) {
            echo get_class($e), ": ", $e->getMessage(), "\n";
            echo " File=", $e->getFile(), "\n";
            echo " Line=", $e->getLine(), "\n";
            echo $e->getTraceAsString();
        }
        echo json_encode($personas);
    }
    /**
     * Función para cambiar el estado de un cargo a adjudicado.
     * @param $id Identificador del cargo al cual se realiza
     * @param $id_usuario Identificador del usuario que realiza la solicitud de modificación de estado.
     * @return bool True: Se realizó correctamente la modificación; False: No se pudo realizar la modificación solicitada.
     */
    function adjudicarCargo($id,$id_usuario){
        if($id>0&&$id_usuario>0){
            $obj = Cargos::findFirstById($id);
            $obj->estado=1;
            $obj->user_mod_id=$id_usuario;
            $obj->fecha_mod = date("Y-m-d H:i:s");
            if($obj->save())return true;
            else return false;
        }else return false;
    }

    /**
     * Función para cambiar el estado de un cargo a desadjudicado.
     * @param $id Identificador del cargo al cual se modifica su estado.
     * @param $id_usuario Identificador del usuario que realiza la solicitud de modificación de estado.
     * @return bool True: Se realizó correctamente la modificación; False: No se pudo realizar la modificación solicitada.
     */
    function desadjudicarCargo($id,$id_usuario){
        if($id>0&&$id_usuario>0){
            $obj = Cargos::findFirstById($id);
            $obj->estado=0;
            $obj->user_mod_id=$id_usuario;
            $obj->fecha_mod = date("Y-m-d H:i:s");
            if($obj->save())return true;
            else return false;
        }else return false;
    }

    /*
     * Función para la obtención de la fotografía de la persona.
     * @param $ci Número de carnet de identidad
     * @param $num_complemento Número complemento
     */
    function obtenerrutafotoAction(){
        $this->view->disable();
        $msj = Array();
        $ruta = "";
        $nombreImagenArchivo = "";
        //$rutaImagenesCredenciales = "images/personal/";
        $rutaImagenesCredenciales = "/images/personal/";
        //$rutaImagenesCredenciales = "C:/xampp/htdocs/rrhh/public/images/personal/";

        $extencionImagenesCredenciales = ".jpg";
        $num_complemento = "";
        if(isset($_POST["num_complemento"])){
            $num_complemento = $_POST["num_complemento"];
        }
        try{
            if(isset($_POST["ci"])){
                $ruta="";
                $nombreImagenArchivo = $rutaImagenesCredenciales.trim($_POST["ci"]);
                //if($num_complemento!="")$nombreImagenArchivo .= $nombreImagenArchivo.trim($num_complemento);
                $ruta = $nombreImagenArchivo.$extencionImagenesCredenciales;
                /**
                 * Se verifica la existencia del archivo
                 */
                //echo $ruta;
                if(file_exists ( getcwd().$ruta ))
                //if(file_exists ($ruta))
                $msj = array('result' => 1, 'ruta'=>$ruta,'msj' => 'Resultado exitoso.');
                else $msj = array('result' => 0, 'ruta'=>'/images/perfil-profesional.jpg','msj' => 'No se encontr&oacute; la fotograf&iacute;a. '.$ruta);
            }else $msj = array('result' => 0, 'ruta'=>'','msj' => 'No se envi&oacute; n&uacute;mero de documento.');
        }catch (\Exception $e) {
            echo get_class($e), ": ", $e->getMessage(), "\n";
            echo " File=", $e->getFile(), "\n";
            echo " Line=", $e->getLine(), "\n";
            echo $e->getTraceAsString();
            $msj = array('result' => -1, 'ruta'=>$ruta, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de relaci&oacute;n laboral.');
        }
        echo json_encode($msj);
    }
    /*
     *  Función para la obtención de las gestiones en las cuales
     */
    function listgestionesporpersonaAction(){
        $gestiones = Array();
        $this->view->disable();
        try{
            if (isset($_POST["id"])&&$_POST["id"] > 0) {
                $obj = new Relaborales();
                $arr = $obj->getCol($_POST["id"]);
                foreach($arr as $clave => $valor)
                {
                    $gestiones[] = $valor;
                }
            }
        }catch (\Exception $e) {
            echo get_class($e), ": ", $e->getMessage(), "\n";
            echo " File=", $e->getFile(), "\n";
            echo " Line=", $e->getLine(), "\n";
            echo $e->getTraceAsString();
            //$msj = array('result' => -1, 'ruta'=>$ruta, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de relaci&oacute;n laboral.');
        }
        echo json_encode($gestiones);
  }
    /**
     * Función para la carga del primer listado sobre la página de gestión de relaciones laborales.
     * Se inhabilita la vista para el uso de jqwidgets,
     */
    public function listhistorialAction()
    {   $relaboral = Array();
       if(isset($_POST["id"])&&$_POST["id"]>0){
           $gestion = 0;
           if(isset($_POST["gestion"])&&$_POST["gestion"]>0){
               $gestion = $_POST["gestion"];
           }
           $this->view->disable();
           $obj = new Frelaborales();
           $resul = $obj->getAllByPerson($_POST["id"],$gestion);
           //comprobamos si hay filas
           if ($resul->count() > 0) {
               foreach ($resul as $v) {
                   #endregion Control de valores para fechas para evitar error al momento de mostrar en grilla
                   $relaboral[] = array(
                       'id_relaboral' => $v->id_relaboral,
                       'id_persona' => $v->id_persona,
                       'p_nombre' => $v->p_nombre,
                       's_nombre' => $v->s_nombre,
                       't_nombre' => $v->t_nombre,
                       'p_apellido' => $v->p_apellido,
                       's_apellido' => $v->s_apellido,
                       'c_apellido' => $v->c_apellido,
                       'nombres' => $v->p_nombre . " " . $v->s_nombre . " " . $v->t_nombre . " " . $v->p_apellido . " " . $v->s_apellido . " " . $v->c_apellido,
                       'ci' => $v->ci,
                       'expd' => $v->expd,
                       'num_complemento' => $v->num_complemento,
                       'fecha_nac' => $v->fecha_nac,
                       'edad' => $v->edad,
                       'lugar_nac' => $v->lugar_nac,
                       'genero' => $v->genero,
                       'e_civil' => $v->e_civil,
                       'item' => $v->item,
                       'carrera_amd' => $v->carrera_amd,
                       'num_contrato' => $v->num_contrato,
                       'contrato_numerador_estado' => $v->contrato_numerador_estado,
                       'id_solelabcontrato' => $v->id_solelabcontrato,
                       'solelabcontrato_regional_sigla' => $v->solelabcontrato_regional_sigla,
                       'solelabcontrato_numero' => $v->solelabcontrato_numero,
                       'solelabcontrato_gestion' => $v->solelabcontrato_gestion,
                       'solelabcontrato_codigo' => $v->solelabcontrato_codigo,
                       'solelabcontrato_user_reg_id' => $v->solelabcontrato_user_reg_id,
                       'solelabcontrato_fecha_sol' => $v->solelabcontrato_fecha_sol,
                       'fecha_ini' => $v->fecha_ini!=""?date("d-m-Y", strtotime($v->fecha_ini)):"",
                       'fecha_incor' => $v->fecha_incor!=""?date("d-m-Y", strtotime($v->fecha_incor)):"",
                       'fecha_fin' => $v->fecha_fin!=""?date("d-m-Y", strtotime($v->fecha_fin)):"",
                       'fecha_baja' => $v->fecha_baja!=""?date("d-m-Y", strtotime($v->fecha_baja)):"",
                       'fecha_ren' => $v->fecha_ren!=""?date("d-m-Y", strtotime($v->fecha_ren)):"",
                       'fecha_acepta_ren' => $v->fecha_acepta_ren!=""?date("d-m-Y", strtotime($v->fecha_acepta_ren)):"",
                       'fecha_agra_serv' => $v->fecha_agra_serv!=""?date("d-m-Y", strtotime($v->fecha_agra_Serv)):"",
                       'motivo_baja' => $v->motivo_baja,
                       'motivosbajas_abreviacion' => $v->motivosbajas_abreviacion,
                       'descripcion_baja' => $v->descripcion_baja,
                       'descripcion_anu' => $v->descripcion_anu,
                       'id_cargo' => $v->id_cargo,
                       'cargo_codigo' => $v->cargo_codigo,
                       'cargo' => $v->cargo,
                       'id_nivelessalarial' => $v->id_nivelessalarial,
                       'nivelsalarial' => $v->nivelsalarial,
                       'nivelsalarial_resolucion_id' => $v->nivelsalarial_resolucion_id,
                       'numero_escala' => $v->numero_escala,
                       'gestion_escala' => $v->gestion_escala,
                       'sueldo' => $v->sueldo,
                       'id_proceso' => $v->id_proceso,
                       'proceso_codigo' => $v->proceso_codigo,
                       'id_convocatoria' => $v->id_convocatoria,
                       'convocatoria_codigo' => $v->convocatoria_codigo,
                       'convocatoria_tipo' => $v->convocatoria_tipo,
                       'id_fin_partida' => $v->id_fin_partida,
                       'fin_partida' => $v->fin_partida,
                       'id_condicion' => $v->id_condicion,
                       'condicion' => $v->condicion,
                       'categoria_relaboral' => $v->categoria_relaboral,
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
                       'organigrama_codigo' => $v->organigrama_codigo,
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
                       'observacion' => ($v->observacion!=null)?$v->observacion:"",
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
                       'persona_fecha_mod' => $v->persona_fecha_mod
                   );
               }
           }
       }
        echo json_encode($relaboral);
    }

    /**
     * Función para la obtención del listado de áreas administrativas disponibles de acuerdo a un identificador de organigrama.
     * En caso de que dicho valor sea nulo o cero se devolverán todas las areas disponibles en el organigrama.
     */
    public function listareawsAction(){
        $organigramas = Array();
        $this->view->disable();
        if(isset($_POST["id_padre"])&&$_POST["id_padre"]>=0){
            $obj = new Organigramas();
            $resul = $obj->getAreas($_POST["id_padre"]);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $organigramas[] = array(
                        'id_area' => $v->id_area,
                        'padre_id' => $v->padre_id,
                        'gestion' => $v->gestion,
                        'da_id' => $v->da_id,
                        'regional_id' => $v->regional_id,
                        'unidad_administrativa' => $v->unidad_administrativa,
                        'nivel_estructural_id' => $v->nivel_estructural_id,
                        'sigla' => $v->sigla,
                        'fecha_ini' => $v->fecha_ini,
                        'fecha_fin' => $v->fecha_fin,
                        'codigo' => $v->codigo,
                        'observacion' => $v->observacion,
                        'estado' => $v->estado,
                        'baja_logica' => $v->baja_logica,
                        'user_reg_id' => $v->user_reg_id,
                        'fecha_reg' => $v->fecha_reg,
                        'user_mod_id' => $v->user_mod_id,
                        'fecha_mod' => $v->fecha_mod,
                        'area_sustantiva' => $v->area_sustantiva
                    );
                }
            }
        }
        echo json_encode($organigramas);
    }
    public function printbasicAction(){
        $pdf = new pdfoasis();

        $pdf->AddPage();

        $miCabecera = array('Nro','Nombre', 'Apellido', 'Matrícula');

        $misDatos = array(
            array('nombre' => 'Hugo', 'apellido' => 'Martínez', 'matricula' => '20420423'),
            array('nombre' => 'Araceli', 'apellido' => 'Morales', 'matricula' =>  '204909'),
            array('nombre' => 'Georgina', 'apellido' => 'Galindo', 'matricula' =>  '2043442'),
            array('nombre' => 'Luis', 'apellido' => 'Dolores', 'matricula' => '20411122'),
            array('nombre' => 'Mario', 'apellido' => 'Linares', 'matricula' => '2049990'),
            array('nombre' => 'Viridiana', 'apellido' => 'Badillo', 'matricula' => '20418855'),
            array('nombre' => 'Yadira', 'apellido' => 'García', 'matricula' => '20443335')
        );

        $pdf->tablaHorizontal($miCabecera, $misDatos);

        $pdf->Output(); //Salida al navegador
    }
    /**
     * Función para la obtención del reporte de relaciones laborales en formato PDF.
     * @param $n_rows Cantidad de lineas
     * @param $columns Array con las columnas mostradas en el reporte
     * @param $filtros Array con los filtros aplicados sobre las columnas.
     */
    public function printAction($n_rows, $columns, $filtros){
        $columns = base64_decode(str_pad(strtr($columns, '-_', '+/'), strlen($columns) % 4, '=', STR_PAD_RIGHT));
        $filtros = base64_decode(str_pad(strtr($filtros, '-_', '+/'), strlen($columns) % 4, '=', STR_PAD_RIGHT));
        $pdf = new pdfoasis();
        $pdf->title_rpt= utf8_decode('Reporte Relacion Laboral "Mi teleférico"');
        $columns = json_decode($columns,true);
        $filtros = json_decode($filtros,true);
        $sub_keys = array_keys($columns);//echo $sub_keys[0];
        $n_col = count($columns);//echo$keys[1];
        /**
         * Especificando la configuración de las columnas
         */
        $widthAlignAll = array(
            'nro_row' => array('title'=>'Nro.','width'=>8,'align'=>'C'),
            'ubicacion' => array('title'=>'Ubicacion','width'=>15,'align'=>'C'),
            'condicion' => array('title'=>'Condicion','width'=>15,'align'=>'C'),
            'estado_descripcion'=> array('title'=>'Estado','width'=>15,'align'=>'C'),
            'nombres'=> array('title'=>'Nombres','width'=>30,'align'=>'L'),
            'ci'=> array('title'=>'CI','width'=>15,'align'=>'C'),
            'expd'=> array('title'=>'Exp.','width'=>15,'align'=>'C'),
            'num_complemento'=> array('title'=>'N/C','width'=>15,'align'=>'C'),
            'gerencia_administrativa'=> array('title'=>'Gerencia','width'=>30,'align'=>'L'),
            'departamento_administrativo'=> array('title'=>'Departamento','width'=>30,'align'=>'L'),
            'area'=> array('title'=>'Area','width'=>20,'align'=>'L'),
            'proceso_codigo'=> array('title'=>'Proceso','width'=>15,'align'=>'C'),
            'nivelsalarial'=> array('title'=>'Nivel','width'=>15,'align'=>'C'),
            'cargo'=> array('title'=>'Cargo','width'=>30,'align'=>'L'),
            'sueldo'=> array('title'=>'Haber','width'=>10,'align'=>'R'),
            'fecha_ini'=> array('title'=>'Fecha Ini','width'=>15,'align'=>'C'),
            'fecha_incor'=> array('title'=>'Fecha Incor','width'=>15,'align'=>'C'),
            'fecha_fin'=> array('title'=>'Fecha Fin','width'=>15,'align'=>'C'),
            'fecha_baja'=> array('title'=>'Fecha Baja','width'=>15,'align'=>'C'),
            'motivo_baja'=> array('title'=>'Motivo Baja','width'=>15,'align'=>'L'),
            'observacion'=> array('title'=>'Observacion','width'=>15,'align'=>'L')
        );
        $widthsSelecteds = $pdf->DefineWidths($widthAlignAll,$columns);
        $alignSelecteds = $pdf->DefineAligns($widthAlignAll,$columns);
        $colSelecteds = $pdf->DefineCols($widthAlignAll,$columns);
        $colTitleSelecteds = $pdf->DefineTitleCols($widthAlignAll,$columns);
        //echo ">>>>".count($colSelecteds);
        /*echo "<p>-------------------------------------------------------------------------------------------------------------</p>";
        print_r($colTitleSelecteds);
        echo "<p>-------------------------------------------------------------------------------------------------------------</p>";*/
        $where = '';
        $whereEqual = '';
        for($k=0;$k<count($filtros);$k++){
            for ($j=0;$j<$n_col;$j++){
                if ($sub_keys[$j] == $filtros[$k]['columna']){
                    $col_fil = $columns[$sub_keys[$j]]['text'];//echo $col_fil;
                }
            }
            $cond_fil = ' '.$col_fil;
            if (strlen($where)>0){
                switch ($filtros[$k]['condicion']){
                    case 'EMPTY':
                        $where .= ' AND ';
                        break;
                    case 'NOT_EMPTY':
                        $where .= ' AND ';
                        break;
                    case 'CONTAINS':
                        $where .= ' AND ';
                        break;
                    case 'EQUAL':
                        $where .= ' AND ';
                        break;
                    case 'GREATER_THAN_OR_EQUAL':
                        $where .= ' AND ';
                        break;
                    case 'LESS_THAN_OR_EQUAL':
                        $where .= ' AND ';
                        break;
                }


            }
            if ($filtros[$k]['tipo'] == 'datefilter'){
                $filtros[$k]['valor'] = date("Y-m-d",strtotime($filtros[$k]['valor']));
            }
            /*echo "<p>-------------------------------------------------------------------------------------------------------------</p>";
            print_r($filtros);
            echo "<p>-------------------------------------------------------------------------------------------------------------</p>";
*/

            switch ($filtros[$k]['condicion']){
                case 'EMPTY':
                    $cond_fil .= utf8_encode(" que sea vacía ");
                    $where .= "(".$filtros[$k]['columna']." IS NULL OR ".$filtros[$k]['columna']." ILIKE '')";
                    break;
                case 'NOT_EMPTY':
                    $cond_fil .= utf8_encode(" que no sea vacía ");
                    $where .= "(".$filtros[$k]['columna']." IS NOT NULL OR ".$filtros[$k]['columna']." NOT ILIKE '')";
                    break;
                case 'CONTAINS':
                    $cond_fil .= utf8_encode(" que contenga el valor:  ".$filtros[$k]['valor']);
                    if($filtros[$k]['columna']=="nombres"){
                        $where .= "(p_nombre ILIKE '%".$filtros[$k]['valor']."%' OR s_nombre ILIKE '%".$filtros[$k]['valor']."%' OR t_nombre ILIKE '%".$filtros[$k]['valor']."%' OR p_apellido ILIKE '%".$filtros[$k]['valor']."%' OR s_apellido ILIKE '%".$filtros[$k]['valor']."%' OR c_apellido ILIKE '%".$filtros[$k]['valor']."%')";
                    }else {
                        $where .= $filtros[$k]['columna']." ILIKE '%".$filtros[$k]['valor']."%'";
                    }break;
                case 'EQUAL':
                    $cond_fil .= utf8_encode(" que contenga el valor:  ".$filtros[$k]['valor']);
                    $where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                    break;
                case 'GREATER_THAN_OR_EQUAL':
                    $cond_fil .= utf8_encode(" que sea mayor o igual que:  ".$filtros[$k]['valor']);
                    $where .= $filtros[$k]['columna'].' >= "'.$filtros[$k]['valor'].'"';
                    break;
                case 'LESS_THAN_OR_EQUAL':
                    $cond_fil .= utf8_encode(" que sea menor o igual que:  ".$filtros[$k]['valor']);
                    $where .= $filtros[$k]['columna'].' <= "'.$filtros[$k]['valor'].'"';
                    break;
            }

        }
        $obj = new Frelaborales();
        $resul = $obj->getAllWithPersonsOneRecord($where);
        //echo "<p>:::".$where;
        $relaboral = array();
        foreach ($resul as $v) {
            $relaboral[] = array(
                'id_relaboral' => $v->id_relaboral,
                'id_persona' => $v->id_persona,
                'p_nombre' => $v->p_nombre,
                's_nombre' => $v->s_nombre,
                't_nombre' => $v->t_nombre,
                'p_apellido' => $v->p_apellido,
                's_apellido' => $v->s_apellido,
                'c_apellido' => $v->c_apellido,
                'nombres' => $v->p_nombre . " " . $v->s_nombre . " " . $v->t_nombre . " " . $v->p_apellido . " " . $v->s_apellido . " " . $v->c_apellido,
                'ci' => $v->ci,
                'expd' => $v->expd,
                'num_complemento' => $v->num_complemento,
                'fecha_nac' => $v->fecha_nac,
                'edad' => $v->edad,
                'lugar_nac' => $v->lugar_nac,
                'genero' => $v->genero,
                'e_civil' => $v->e_civil,
                'item' => $v->item,
                'carrera_amd' => $v->carrera_amd,
                'num_contrato' => $v->num_contrato,
                'contrato_numerador_estado' => $v->contrato_numerador_estado,
                'id_solelabcontrato' => $v->id_solelabcontrato,
                'solelabcontrato_regional_sigla' => $v->solelabcontrato_regional_sigla,
                'solelabcontrato_numero' => $v->solelabcontrato_numero,
                'solelabcontrato_gestion' => $v->solelabcontrato_gestion,
                'solelabcontrato_codigo' => $v->solelabcontrato_codigo,
                'solelabcontrato_user_reg_id' => $v->solelabcontrato_user_reg_id,
                'solelabcontrato_fecha_sol' => $v->solelabcontrato_fecha_sol,
                'fecha_ini' => $v->fecha_ini!=""?date("d-m-Y", strtotime($v->fecha_ini)):"",
                'fecha_incor' => $v->fecha_incor!=""?date("d-m-Y", strtotime($v->fecha_incor)):"",
                'fecha_fin' => $v->fecha_fin!=""?date("d-m-Y", strtotime($v->fecha_fin)):"",
                'fecha_baja' => $v->fecha_baja!=""?date("d-m-Y", strtotime($v->fecha_baja)):"",
                'fecha_ren' => $v->fecha_ren!=""?date("d-m-Y", strtotime($v->fecha_ren)):"",
                'fecha_acepta_ren' => $v->fecha_acepta_ren!=""?date("d-m-Y", strtotime($v->fecha_acepta_ren)):"",
                'fecha_agra_serv' => $v->fecha_agra_serv!=""?date("d-m-Y", strtotime($v->fecha_agra_Serv)):"",
                'motivo_baja' => $v->motivo_baja,
                'motivosbajas_abreviacion' => $v->motivosbajas_abreviacion,
                'descripcion_baja' => $v->descripcion_baja,
                'descripcion_anu' => $v->descripcion_anu,
                'id_cargo' => $v->id_cargo,
                'cargo_codigo' => $v->cargo_codigo,
                'cargo' => $v->cargo,
                'id_nivelessalarial' => $v->id_nivelessalarial,
                'nivelsalarial' => $v->nivelsalarial,
                'nivelsalarial_resolucion_id' => $v->nivelsalarial_resolucion_id,
                'numero_escala' => $v->numero_escala,
                'gestion_escala' => $v->gestion_escala,
                //'sueldo' => $v->sueldo,
                'sueldo' => str_replace(".00", "", $v->sueldo),
                'id_proceso' => $v->id_proceso,
                'proceso_codigo' => $v->proceso_codigo,
                'id_convocatoria' => $v->id_convocatoria,
                'convocatoria_codigo' => $v->convocatoria_codigo,
                'convocatoria_tipo' => $v->convocatoria_tipo,
                'id_fin_partida' => $v->id_fin_partida,
                'fin_partida' => $v->fin_partida,
                'id_condicion' => $v->id_condicion,
                'condicion' => $v->condicion,
                'categoria_relaboral' => $v->categoria_relaboral,
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
                'organigrama_codigo' => $v->organigrama_codigo,
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
                'observacion' => ($v->observacion!=null)?$v->observacion:"",
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
                'persona_fecha_mod' => $v->persona_fecha_mod
            );
        }
        $pdf->Open("L");
        if(count($colSelecteds)>11)$pdf->AddPage("L");
        else $pdf->AddPage();
        #region Espacio para la definición de valores para la cabecera de la tabla
        $pdf->SetWidths($widthsSelecteds);
        //Color de las lineas de las celdas
        $pdf->DefineColorHeaderTable();
        $pdf->FechaHoraReporte = date("d-m-Y H:i:s");
        /**
         * Posición de la primera linea del reporte
         */
        $pdf->SetY(30);
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C'));
        $pdf->RowTitle($colTitleSelecteds);
        $j=0;
        $auxArray = array();
        if(count($relaboral)>0)
        foreach($relaboral as $i=>$val){
            $nb=0;$h=0;
            /**
             * Calculamos la última altura de registro impreso
             */
            if($j>0){
                /**
                 * Calculamos la altura que se alcanzo por la última columna impresa para ver si al imprimir lo nuevo sobre ella es necesario cambiar de página
                 */
                $data = $auxArray;
                for($i=0;$i<count($data);$i++)
                    $nb=max($nb, $pdf->NbLines($pdf->widths[$i], $data[$i]));
                $h=5*$nb;
            }
            /*
             *  Verificar el uso de la cabecera
             */
            if($pdf->GetY()+$h>=$pdf->PageBreakTrigger){
                $pdf->DefineColorHeaderTable();
                $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C','C'));
                $pdf->Row($colTitleSelecteds);
            }
                $pdf->DefineColorBodyTable();
                $pdf->SetAligns($alignSelecteds);
                $rowData = $pdf->DefineRows($j+1,$relaboral[$j],$colSelecteds);
                $pdf->Row($rowData);
                $auxArray = $rowData;
            $j++;
        }
        $pdf->ShowLeftFooter=true;
        $pdf->Output('reporte_relaboral.pdf','I');
    }
}