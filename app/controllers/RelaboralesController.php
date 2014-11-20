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
        $this->assets->addJs('/js/relaborales/oasis.relaborales.move.js');
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
                    'nombres' => $v->nombres,
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
                    'fecha_ini' => $v->fecha_ini != "" ? date("d-m-Y", strtotime($v->fecha_ini)) : "",
                    'fecha_incor' => $v->fecha_incor != "" ? date("d-m-Y", strtotime($v->fecha_incor)) : "",
                    'fecha_fin' => $v->fecha_fin != "" ? date("d-m-Y", strtotime($v->fecha_fin)) : "",
                    'fecha_baja' => $v->fecha_baja != "" ? date("d-m-Y", strtotime($v->fecha_baja)) : "",
                    'fecha_ren' => $v->fecha_ren != "" ? date("d-m-Y", strtotime($v->fecha_ren)) : "",
                    'fecha_acepta_ren' => $v->fecha_acepta_ren != "" ? date("d-m-Y", strtotime($v->fecha_acepta_ren)) : "",
                    'fecha_agra_serv' => $v->fecha_agra_serv != "" ? date("d-m-Y", strtotime($v->fecha_agra_Serv)) : "",
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
                    'id_procesocontratacion' => $v->id_procesocontratacion,
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
     * Función para listar los nombres de cargos
     */
    public function listnombrecargosAction()
    {
        $this->view->disable();
        $obj = new cargos();
        $resul = $obj->listNombresCargos();
        //comprobamos si hay filas
        if ($resul->count() > 0) {
            foreach ($resul as $v) {
                $cargos[] = array('cargo' => $v->cargo);
            }
        }
        echo json_encode($cargos);
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
        $resul = Motivosbajas::find(array('estado=1', 'order' => 'id ASC'));
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
        $user_reg_id = 1;
        $user_mod_id = 1;
        $msj = Array();
        $gestion_actual = date("Y");
        $hoy = date("Y-m-d H:i:s");
        $fecha_fin = "31/12/" . $gestion_actual;
        $this->view->disable();
        if (isset($_POST["id"]) && $_POST["id"] > 0) {
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
            $id_procesocontratacion = $_POST['id_procesocontratacion'];
            $date1 = new DateTime($_POST['fecha_inicio']);
            $date2 = new DateTime($_POST['fecha_incor']);
            $date3 = new DateTime($_POST['fecha_fin']);
            $fecha_ini = $date1->format('Y-m-d');
            $fecha_incor = $date2->format('Y-m-d');
            /**
             * Si la condición es consultoría se debe considerar la fecha enviada en el formulario.
             */
            if ($id_condicion == 2 || $id_condicion == 3) {
                $fecha_fin = $date3->format('Y-m-d');
            } else {
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
                    $objRelaboral->procesocontratacion_id = $id_procesocontratacion;
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
                    $objRelaboral->observacion = ($observacion == "") ? null : $observacion;
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
                        //$this->adjudicarCargo($objRelaboral->cargo_id,$objRelaboral->user_mod_id);
                        #region Registro del área de trabajo
                        if ($id_area > 0) {
                            /*
                             * Verificando la existencia del registro de relación laboral.                             *
                             */
                            //$objRA =  Relaboralesareas::findFirst(array('relaboral_id='.$objRelaboral->id.' AND baja_logica = 1 AND estado=1','order' => 'id ASC'));
                            $objRA = Relaboralesareas::findFirst(array('relaboral_id=' . $objRelaboral->id, 'order' => 'id ASC'));
                            if ($objRA->id > 0) {
                                $objRA->estado = 1;
                                $objRA->baja_logica = 1;
                                $objRA->organigrama_id = $id_area;
                                $objRA->user_mod_id = $user_reg_id;
                                $objRA->fecha_mod = $hoy;
                                $objRA->save();
                            } else {
                                $objRelArea = new Relaboralesareas();
                                $objRelArea->id = null;
                                $objRelArea->relaboral_id = $objRelaboral->id;
                                $objRelArea->organigrama_id = $id_area;
                                $objRelArea->observacion = null;
                                $objRelArea->estado = 1;
                                $objRelArea->baja_logica = 1;
                                $objRelArea->agrupador = 0;
                                $objRelArea->user_reg_id = $user_reg_id;
                                $objRelArea->fecha_reg = $hoy;
                                $objRelArea->save();
                            }
                        } else {
                            /*
                             * En caso de ser necesario descartar la pertenencia de una persona a un área en la cual se haya registrado con anterioridad
                             */
                            $objRelArea = Relaboralesareas::findFirst(array('relaboral_id=' . $objRelaboral->id, 'order' => 'id ASC'));
                            if ($objRelArea!=null&&$objRelArea->id > 0) {
                                $objRelArea->estado = 0;
                                $objRelArea->baja_logica = 0;
                                $objRelArea->user_mod_id = $user_reg_id;
                                $objRelArea->fecha_mod = $hoy;
                                $objRelArea->save();
                            }
                        }
                        #endregion Registro del área de trabajo
                        #region Registro de la ubicación de trabajo
                        //Si se ha registrado correctamente la relación laboral y se ha definido una ubicación de trabajo
                        if ($id_ubicacion > 0) {
                            //$ru = new Relaboralesubicaciones();
                            $ru = Relaboralesubicaciones::findFirst(array('relaboral_id=:relaboral_id1:'/*,'baja_logica=:activo1:','estado=:estado1:'*/, 'bind' => array('relaboral_id1' => $objRelaboral->id,/*'activo1'=>'1','estado1'=>1*/), 'order' => 'id ASC'));
                            if ($ru->id > 0) {
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
                            } else {
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
                $id_procesocontratacion = $_POST['id_procesocontratacion'];
                $date1 = new DateTime($_POST['fecha_inicio']);
                $date2 = new DateTime($_POST['fecha_incor']);
                $date3 = new DateTime($_POST['fecha_fin']);
                $fecha_ini = $date1->format('Y-m-d');
                $fecha_incor = $date2->format('Y-m-d');
                /**
                 * Si la condición es consultoría se debe considerar la fecha enviada en el formulario.
                 */
                if ($id_condicion == 2 || $id_condicion == 3) {
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
                        $objRelaboral->procesocontratacion_id = $id_procesocontratacion;
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
                        $objRelaboral->observacion = ($observacion == "") ? null : $observacion;
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
                            //$this->adjudicarCargo($id_cargo,$objRelaboral->user_mod_id);
                            #region Registro del área de trabajo
                            if ($id_area > 0) {
                                $objRelArea = new Relaboralesareas();
                                $objRelArea->id = null;
                                $objRelArea->relaboral_id = $objRelaboral->id;
                                $objRelArea->organigrama_id = $id_area;
                                $objRelArea->observacion = null;
                                $objRelArea->estado = 1;
                                $objRelArea->baja_logica = 1;
                                $objRelArea->agrupador = 0;
                                $objRelArea->user_reg_id = $user_reg_id;
                                $objRelArea->fecha_reg = $hoy;
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
        $user_mod_id = 1;
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        if (isset($_POST["id"]) && $_POST["id"] > 0) {
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
                        //$this->adjudicarCargo($objRelaboral->cargo_id,$user_mod_id);
                        $msj = array('result' => 1, 'msj' => '&Eacute:xito: Se aprob&oacute; correctamente el registro de relaci&oacute;n laboral.');
                    } else {
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
    {
        $ok = true;
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        try {
            if (isset($_POST["id"]) && $_POST["id"] > 0) {
                /**
                 * Baja de registro
                 */
                $objRelaboral = Relaborales::findFirstById($_POST["id"]);
                $id_motivo_baja = (isset($_POST['id_motivobaja'])) ? $_POST['id_motivobaja'] : 0;
                $fecha_baja = (isset($_POST['fecha_baja'])) ? $_POST['fecha_baja'] : '31-12-2014';
                $fecha_acepta_ren = (isset($_POST['fecha_acepta_ren'])) ? $_POST['fecha_acepta_ren'] : null;
                $fecha_agra_serv = (isset($_POST['fecha_agra_serv'])) ? $_POST['fecha_agra_serv'] : "";

                if ($id_motivo_baja > 0 && $fecha_baja != "" && $fecha_baja != null) {
                    /**
                     * Control de fechas necesarias por el tipo de motivo de baja.
                     */
                    $motivobaja = Motivosbajas::findFirstById($id_motivo_baja);
                    if ($motivobaja->id > 0) {
                        /**
                         * Se cargan los datos elementales.
                         */
                        $objRelaboral->motivobaja_id = $id_motivo_baja;
                        $objRelaboral->fecha_baja = $fecha_baja;

                        /**
                         * Si la fecha de renuncia es requerida
                         */
                        if ($motivobaja->fecha_ren > 0) {
                            if (isset($_POST['fecha_ren'])) {
                                $fecha_ren = $_POST['fecha_ren'];
                                $objRelaboral->fecha_ren = $fecha_ren;
                            } elseif ($motivobaja->fecha_ren == 1) {
                                $msj = array('result' => 0, 'msj' => 'Error: Debe registrar la fecha de renuncia si desea usar el tipo de baja seleccionado.');
                                $ok = false;
                            }
                        }
                        /**
                         * Si la fecha de aceptación de renuncia es requerida
                         */
                        if ($motivobaja->fecha_acepta_ren > 0) {
                            if (isset($_POST['fecha_acepta_ren'])) {
                                $fecha_acepta_ren = $_POST['fecha_acepta_ren'];
                                $objRelaboral->fecha_acepta_ren = $fecha_acepta_ren;
                            } elseif ($motivobaja->fecha_acepta_ren == 1) {
                                $msj = array('result' => 0, 'msj' => 'Error: Debe registrar la fecha de aceptaci&oacute;n de la renuncia si desea usar el tipo de baja seleccionado.');
                                $ok = false;
                            }
                        }
                        /**
                         * Si la fecha de agradecimiento es requerida
                         */
                        if ($motivobaja->fecha_agra_serv > 0) {
                            if (isset($_POST['fecha_agra_serv'])) {
                                $fecha_agra_serv = $_POST['fecha_agra_serv'];
                                $objRelaboral->fecha_agra_serv = $fecha_agra_serv;
                            } elseif ($motivobaja->fecha_agra_serv == 1) {
                                $msj = array('result' => 0, 'msj' => 'Error: Debe registrar la fecha de agradecimiento de servicios si desea usar el tipo de baja seleccionado.');
                                $ok = false;
                            }
                        }
                        /**
                         * Si el motivo de renuncia es no incorporación, la fecha de incorporación se establece en nulo.
                         */
                        if ($motivobaja->motivo_baja == "NO SE INCORPORA") {
                            $objRelaboral->fecha_incor = null;
                            $objRelaboral->fecha_baja = $objRelaboral->fecha_ini;
                        }
                        /**
                         * Se verifica que todos los datos requeridos para una baja esten registrados
                         */
                        if ($ok) {
                            $objRelaboral->estado = 0;
                            $objRelaboral->user_mod_id = 1;
                            $objRelaboral->fecha_mod = $hoy;
                            if ($objRelaboral->save()) {
                                /**
                                 * Se modifica el estado del cargo a desadjudicado a objeto de permitir su uso.
                                 */
                                //$this->desadjudicarCargo($objRelaboral->cargo_id,$objRelaboral->user_mod_id);
                                $msj = array('result' => 1, 'msj' => '&Eacute;xito: Registro de Baja realizado de modo satisfactorio.');
                            } else {
                                foreach ($objRelaboral->getMessages() as $message) {
                                    echo $message, "\n";
                                }
                                $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de relaci&oacute;n laboral.');
                            }
                        }
                    } else $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se registr&oacute; la baja de la relaci&oacute;n laboral debido a datos inv&acute;lidos para la tarea.');
                } else $msj = array('result' => 0, 'msj' => 'Error: No se registr&oacute; la baja de la relaci&oacute;n laboral debido a datos inv&acute;lidos para la tarea.');
            } else $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de relaci&oacute;n laboral debido a que no se especific&oacute; el registro de relaci&oacute;n laboral.');
        } catch (\Exception $e) {
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
    {
        $personas = Array();
        $this->view->disable();
        try {
            if (isset($_POST["id"]) && $_POST["id"] > 0) {
                $id_persona = $_POST["id"];
                $obj = new Fpersonas();
                $objPersona = $obj->getOne($id_persona);
                //findFirst("id = 1");
                if ($objPersona->count() > 0) {
                    foreach ($objPersona as $v) {
                        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                        $date = new DateTime($v->fecha_nac);
                        $fecha_nac = $date->format('d') . "-" . $meses[$date->format('m') - 1] . "-" . $date->format('Y');
                        $personas[] = array(
                            'id_persona' => $v->id_persona,
                            'postulante_id' => $v->postulante_id,
                            'p_nombre' => $v->p_nombre,
                            's_nombre' => $v->s_nombre,
                            't_nombre' => $v->t_nombre,
                            'p_apellido' => $v->p_apellido,
                            's_apellido' => $v->s_apellido,
                            'c_apellido' => $v->c_apellido,
                            'tipo_documento' => $v->tipo_documento,
                            'ci' => $v->ci,
                            'expd' => $v->expd,
                            'num_complemento' => $v->num_complemento,
                            'fecha_nac' => $fecha_nac,
                            'edad' => $v->edad,
                            'lugar_nac' => $v->lugar_nac,
                            'genero' => $v->genero,
                            'e_civil' => $v->e_civil,
                            'codigo' => $v->codigo,
                            'nacionalidad' => $v->nacionalidad,
                            'nit' => $v->nit,
                            'num_func_sigma' => $v->num_func_sigma,
                            'grupo_sanguineo' => $v->grupo_sanguineo,
                            'num_lib_ser_militar' => $v->num_lib_ser_militar,
                            'num_reg_profesional' => $v->num_reg_profesional,
                            'observacion' => $v->observacion,
                            'estado' => $v->estado,
                            'baja_logica' => $v->baja_logica,
                            'agrupador' => $v->agrupador,
                            'user_reg_id' => $v->user_reg_id,
                            'fecha_reg' => $v->fecha_reg,
                            'user_mod_id' => $v->user_mod_id,
                            'fecha_mod' => $v->fecha_mod,
                            'direccion_dom' => ($v->direccion_dom != null) ? $v->direccion_dom : '',
                            'telefono_fijo' => ($v->telefono_fijo != null) ? $v->telefono_fijo : '',
                            'telefono_inst' => ($v->telefono_inst != null) ? $v->telefono_inst : '',
                            'telefono_fax' => ($v->telefono_fax != null) ? $v->telefono_fax : '',
                            'interno_inst' => ($v->interno_inst != null) ? $v->interno_inst : '',
                            'celular_per' => ($v->celular_per != null) ? $v->celular_per : '',
                            'celular_inst' => ($v->celular_inst != null) ? $v->celular_inst : '',
                            'num_credencial' => ($v->num_credencial != null) ? $v->num_credencial : '',
                            'ac_no' => ($v->ac_no != null) ? $v->ac_no : '',
                            'e_mail_per' => ($v->e_mail_per != null) ? $v->e_mail_per : '',
                            'e_mail_inst' => ($v->e_mail_inst != null) ? $v->e_mail_inst : '',
                            'contacto_observacion' => ($v->contacto_observacion != null) ? $v->contacto_observacion : '',
                            'contacto_estado' => ($v->contacto_estado != null) ? $v->contacto_estado : ''
                        );
                    }
                }
            }
        } catch (\Exception $e) {
            echo get_class($e), ": ", $e->getMessage(), "\n";
            echo " File=", $e->getFile(), "\n";
            echo " Line=", $e->getLine(), "\n";
            echo $e->getTraceAsString();
        }
        echo json_encode($personas);
    }

    /*
     * Función para la obtención de la fotografía de la persona.
     * @param $ci Número de carnet de identidad
     * @param $num_complemento Número complemento
     */
    function obtenerrutafotoAction()
    {
        $this->view->disable();
        $msj = Array();
        $ruta = "";
        $rutaImagenesCredenciales = "/images/personal/";
        $extencionImagenesCredenciales = ".jpg";
        $num_complemento = "";
        if (isset($_POST["num_complemento"])) {
            $num_complemento = $_POST["num_complemento"];
        }
        try {
            if (isset($_POST["ci"])) {
                $ruta = "";
                $nombreImagenArchivo = $rutaImagenesCredenciales . trim($_POST["ci"]);
                if ($num_complemento != "") $nombreImagenArchivo = $nombreImagenArchivo . trim($num_complemento);
                $ruta = $nombreImagenArchivo . $extencionImagenesCredenciales;
                /**
                 * Se verifica la existencia del archivo
                 */
                if (file_exists(getcwd() . $ruta))
                    $msj = array('result' => 1, 'ruta' => $ruta, 'msj' => 'Resultado exitoso.');
                else $msj = array('result' => 0, 'ruta' => '/images/perfil-profesional.jpg', 'msj' => 'No se encontr&oacute; la fotograf&iacute;a. ' . $ruta);
            } else $msj = array('result' => 0, 'ruta' => '', 'msj' => 'No se envi&oacute; n&uacute;mero de documento.');
        } catch (\Exception $e) {
            echo get_class($e), ": ", $e->getMessage(), "\n";
            echo " File=", $e->getFile(), "\n";
            echo " Line=", $e->getLine(), "\n";
            echo $e->getTraceAsString();
            $msj = array('result' => -1, 'ruta' => $ruta, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de relaci&oacute;n laboral.');
        }
        echo json_encode($msj);
    }

    /*
     *  Función para la obtención de las gestiones en las cuales
     */
    function listgestionesporpersonaAction()
    {
        $gestiones = Array();
        $this->view->disable();
        try {
            if (isset($_POST["id"]) && $_POST["id"] > 0) {
                $obj = new Relaborales();
                $arr = $obj->getCol($_POST["id"]);
                foreach ($arr as $clave => $valor) {
                    $gestiones[] = $valor;
                }
            }
        } catch (\Exception $e) {
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
    {
        $relaboral = Array();
        if (isset($_POST["id"]) && $_POST["id"] > 0) {
            $gestion = 0;
            if (isset($_POST["gestion"]) && $_POST["gestion"] > 0) {
                $gestion = $_POST["gestion"];
            }
            $this->view->disable();
            $obj = new Frelaborales();
            $resul = $obj->getAllByPerson($_POST["id"], $gestion);
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
                        'fecha_ini' => $v->fecha_ini != "" ? date("d-m-Y", strtotime($v->fecha_ini)) : "",
                        'fecha_incor' => $v->fecha_incor != "" ? date("d-m-Y", strtotime($v->fecha_incor)) : "",
                        'fecha_fin' => $v->fecha_fin != "" ? date("d-m-Y", strtotime($v->fecha_fin)) : "",
                        'fecha_baja' => $v->fecha_baja != "" ? date("d-m-Y", strtotime($v->fecha_baja)) : "",
                        'fecha_ren' => $v->fecha_ren != "" ? date("d-m-Y", strtotime($v->fecha_ren)) : "",
                        'fecha_acepta_ren' => $v->fecha_acepta_ren != "" ? date("d-m-Y", strtotime($v->fecha_acepta_ren)) : "",
                        'fecha_agra_serv' => $v->fecha_agra_serv != "" ? date("d-m-Y", strtotime($v->fecha_agra_Serv)) : "",
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
                        'id_procesocontratacion' => $v->id_procesocontratacion,
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
                        'persona_fecha_mod' => $v->persona_fecha_mod
                    );
                }
            }
        }
        echo json_encode($relaboral);
    }
    /**
     * Función para la carga del historial de movilidad funcionaria.
     */
    public function listhistorialmovilidadAction()
    {   $this->view->disable();
        $relaboralmovilidad = Array();
        if (isset($_POST["id"]) && $_POST["id"] > 0) {

            $obj = new Frelaboralesmovilidad();
            $resul = $obj->getAllByOne($_POST["id"]);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    #endregion Control de valores para fechas para evitar error al momento de mostrar en grilla
                    $memorandum = $v->memorandum_correlativo."/".$v->memorandum_gestion;
                    $memorandum .= ($v->fecha_mem != "" )? " de ".date("d-m-Y", strtotime($v->fecha_mem)) : "";
                    $relaboralmovilidad[] = array(
                        'id_relaboral'=>$v->id_relaboral,
                        'id_relaboralmovilidad'=>$v->id_relaboralmovilidad,
                        'id_gerencia_administrativa'=>$v->id_gerencia_administrativa,
                        'gerencia_administrativa'=>$v->gerencia_administrativa,
                        'id_departamento_administrativo'=>$v->id_departamento_administrativo,
                        'departamento_administrativo'=>$v->departamento_administrativo,
                        'id_organigrama'=>$v->id_organigrama,
                        'unidad_administrativa'=>$v->unidad_administrativa,
                        'organigrama_sigla'=>$v->organigrama_sigla,
                        'organigrama_orden'=>$v->organigrama_orden,
                        'id_area'=>$v->id_area,
                        'area'=>$v->area,
                        'id_ubicacion'=>$v->id_ubicacion,
                        'ubicacion'=>$v->ubicacion,
                        'numero'=>$v->numero,
                        'cargo'=>$v->cargo,
                        'fecha_ini' => $v->fecha_ini != "" ? date("d-m-Y", strtotime($v->fecha_ini)) : "",
                        'fecha_fin' => $v->fecha_fin != "" ? date("d-m-Y", strtotime($v->fecha_fin)) : "",
                        'tipo_memorandum' => $v->tipo_memorandum,
                        'memorandum_correlativo'=>$v->memorandum_correlativo,
                        'memorandum_gestion'=>$v->memorandum_gestion,
                        'fecha_mem'=>$v->fecha_mem != "" ? date("d-m-Y", strtotime($v->fecha_mem)) : "",
                        'memorandum'=>$memorandum,
                        'observacion'=>$v->observacion!=null?$v->observacion:'',
                        'estado'=>$v->estado
                    );
                }
            }
        }
        echo json_encode($relaboralmovilidad);
    }
    /**
     * Función para la obtención del listado de áreas administrativas disponibles de acuerdo a un identificador de organigrama.
     * En caso de que dicho valor sea nulo o cero se devolverán todas las areas disponibles en el organigrama.
     */
    public function listareasAction()
    {
        $organigramas = Array();
        $this->view->disable();
        if (isset($_POST["id_padre"]) && $_POST["id_padre"] >= 0) {
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

    public function printbasicAction()
    {
        $pdf = new pdfoasis();

        $pdf->AddPage();

        $miCabecera = array('Nro', 'Nombre', 'Apellido', 'Matrícula');

        $misDatos = array(
            array('nombre' => 'Hugo', 'apellido' => 'Martínez', 'matricula' => '20420423'),
            array('nombre' => 'Araceli', 'apellido' => 'Morales', 'matricula' => '204909'),
            array('nombre' => 'Georgina', 'apellido' => 'Galindo', 'matricula' => '2043442'),
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
     * @param $groups String con la cadena representativa de las columnas agrupadas. La separación es por comas.
     */
    public function printAction($n_rows, $columns, $filtros,$groups,$sorteds)
    {   $columns = base64_decode(str_pad(strtr($columns, '-_', '+/'), strlen($columns) % 4, '=', STR_PAD_RIGHT));
        $filtros = base64_decode(str_pad(strtr($filtros, '-_', '+/'), strlen($columns) % 4, '=', STR_PAD_RIGHT));
        $groups = base64_decode(str_pad(strtr($groups, '-_', '+/'), strlen($groups) % 4, '=', STR_PAD_RIGHT));
        if($groups=='null'||$groups==null)$groups="";
        $sorteds = base64_decode(str_pad(strtr($sorteds, '-_', '+/'), strlen($sorteds) % 4, '=', STR_PAD_RIGHT));
        $columns = json_decode($columns, true);
        $filtros = json_decode($filtros, true);
        $sub_keys = array_keys($columns);//echo $sub_keys[0];
        $n_col = count($columns);//echo$keys[1];
        $sorteds = json_decode($sorteds, true);
    	/**
         * Especificando la configuración de las columnas
         */
        $generalConfigForAllColumns = array(
            'nro_row' => array('title' => 'Nro.', 'width' => 8, 'title-align'=>'C','align' => 'C', 'type' => 'int4'),
            'ubicacion' => array('title' => 'Ubicacion', 'width' => 20, 'align' => 'C', 'type' => 'varchar'),
            'condicion' => array('title' => 'Condicion', 'width' => 20, 'align' => 'C', 'type' => 'varchar'),
            'estado_descripcion' => array('title' => 'Estado', 'width' => 15, 'align' => 'C', 'type' => 'varchar'),
            'nombres' => array('title' => 'Nombres', 'width' => 30, 'align' => 'L', 'type' => 'varchar'),
            'ci' => array('title' => 'CI', 'width' => 12, 'align' => 'C', 'type' => 'varchar'),
            'expd' => array('title' => 'Exp.', 'width' => 8, 'align' => 'C', 'type' => 'bpchar'),
            'num_complemento' => array('title' => 'N/C', 'width' => 15, 'align' => 'C', 'type' => 'bpchar'),
            'gerencia_administrativa' => array('title' => 'Gerencia', 'width' => 30, 'align' => 'L', 'type' => 'varchar'),
            'departamento_administrativo' => array('title' => 'Departamento', 'width' => 30, 'align' => 'L', 'type' => 'varchar'),
            'area' => array('title' => 'Area', 'width' => 20, 'align' => 'L', 'type' => 'varchar'),
            'proceso_codigo' => array('title' => 'Proceso', 'width' => 15, 'align' => 'C', 'type' => 'varchar'),
            'nivelsalarial' => array('title' => 'Nivel', 'width' => 15, 'align' => 'C', 'type' => 'varchar'),
            'cargo' => array('title' => 'Cargo', 'width' => 30, 'align' => 'L', 'type' => 'varchar'),
            'sueldo' => array('title' => 'Haber', 'width' => 10, 'align' => 'R', 'type' => 'numeric'),
            'fecha_ini' => array('title' => 'Fecha Ini', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            'fecha_incor' => array('title' => 'Fecha Inc', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            'fecha_fin' => array('title' => 'Fecha Fin', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            'fecha_baja' => array('title' => 'Fecha Baja', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            'motivo_baja' => array('title' => 'Motivo Baja', 'width' => 20, 'align' => 'L', 'type' => 'varchar'),
            'observacion' => array('title' => 'Observacion', 'width' => 15, 'align' => 'L', 'type' => 'varchar')
        );
        $agruparPor = ($groups!="")?explode(",",$groups):array();
        $widthsSelecteds = $this->DefineWidths($generalConfigForAllColumns, $columns,$agruparPor);
        $ancho = 0;
        if(count($widthsSelecteds)>0){
            foreach($widthsSelecteds as $w){
                $ancho  =$ancho+   $w;
            }
            if ($ancho > 215.9) {
                if ($ancho > 270) {
                    $pdf = new pdfoasis('L','mm','Legal');
                    $pdf->pageWidth=355;
                }else {
                    $pdf = new pdfoasis('L','mm','Letter');
                    $pdf->pageWidth=280;
                }
            }
            else {
                $pdf = new pdfoasis('P','mm','Letter');
                $pdf->pageWidth=215.9;
            }
            $pdf->tableWidth = $ancho;
            #region Proceso de generación del documento PDF
            $pdf->debug=0;
            $pdf->title_rpt = utf8_decode('Reporte Relación Laboral');
            $pdf->header_title_empresa_rpt = utf8_decode('Empresa Estatal de Transporte por Cable "Mi Teleférico"');
            $alignSelecteds = $pdf->DefineAligns($generalConfigForAllColumns, $columns,$agruparPor);
            $colSelecteds = $pdf->DefineCols($generalConfigForAllColumns, $columns,$agruparPor);
            $colTitleSelecteds = $pdf->DefineTitleCols($generalConfigForAllColumns, $columns,$agruparPor);
            $alignTitleSelecteds = $pdf->DefineTitleAligns(count($colTitleSelecteds));
            $gruposSeleccionadosActuales=$pdf->DefineDefaultValuesForGroups($groups);
            $pdf->generalConfigForAllColumns = $generalConfigForAllColumns;
            $pdf->colTitleSelecteds = $colTitleSelecteds;
            $pdf->widthsSelecteds = $widthsSelecteds;
            $pdf->alignSelecteds = $alignSelecteds;
            $pdf->alignTitleSelecteds = $alignTitleSelecteds;
            if($pdf->debug==1){
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::COLUMNAS::::::::::::::::::::::::::::::::::::::::::<p>";
            print_r($columns);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::FILTROS::::::::::::::::::::::::::::::::::::::::::<p>";
            print_r($filtros);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::GRUPOS::::::::::::::::::::::::::::::::::::::::::::<p>";
                echo "<p>".$groups;
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::ORDEN::::::::::::::::::::::::::::::::::::::::::::<p>";
                print_r($sorteds);
                echo "<p>:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::<p>";
            }
            $where = '';
            $yaConsiderados = array();
            for ($k = 0; $k < count($filtros); $k++) {
                $cant = $this->obtieneCantidadVecesConsideracionPorColumnaEnFiltros($filtros[$k]['columna'], $filtros);
                $arr_val = $this->obtieneValoresConsideradosPorColumnaEnFiltros($filtros[$k]['columna'], $filtros);

                for ($j = 0; $j < $n_col; $j++) {
                    if ($sub_keys[$j] == $filtros[$k]['columna']) {
                        $col_fil = $columns[$sub_keys[$j]]['text'];
                    }
                }
                if ($filtros[$k]['tipo'] == 'datefilter') {
                    $filtros[$k]['valor'] = date("Y-m-d", strtotime($filtros[$k]['valor']));
                }
                $cond_fil = ' ' . $col_fil;
                if (!in_array($filtros[$k]['columna'], $yaConsiderados)) {

                    if (strlen($where) > 0) {
                        switch ($filtros[$k]['condicion']) {
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
                }
                if ($cant > 1) {
                    if($pdf->debug==1){
                        echo "<p>::::::::::::::::::::::::::::::::::::YA CONSIDERADOS:::::::::::::::::::::::::::::::::::::::::::::::<p>";
                        print_r($yaConsiderados);
                        echo "<p>::::::::::::::::::::::::::::::::::::YA CONSIDERADOS:::::::::::::::::::::::::::::::::::::::::::::::<p>";
                    }
                    if (!in_array($filtros[$k]['columna'], $yaConsiderados)) {
                        switch ($filtros[$k]['condicion']) {
                            case 'EMPTY':
                                $cond_fil .= utf8_encode(" que sea vacía ");
                                $where .= "(" . $filtros[$k]['columna'] . " IS NULL OR " . $filtros[$k]['columna'] . " ILIKE '')";
                                break;
                            case 'NOT_EMPTY':
                                $cond_fil .= utf8_encode(" que no sea vacía ");
                                $where .= "(" . $filtros[$k]['columna'] . " IS NOT NULL OR " . $filtros[$k]['columna'] . " NOT ILIKE '')";
                                break;
                            case 'CONTAINS':
                                $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                                if ($filtros[$k]['columna'] == "nombres") {
                                    $where .= "(p_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR s_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR t_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR p_apellido ILIKE '%" . $filtros[$k]['valor'] . "%' OR s_apellido ILIKE '%" . $filtros[$k]['valor'] . "%' OR c_apellido ILIKE '%" . $filtros[$k]['valor'] . "%')";
                                } else {
                                    $where .= $filtros[$k]['columna'] . " ILIKE '%" . $filtros[$k]['valor'] . "%'";
                                }
                                break;
                            case 'EQUAL':
                                $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                                $ini = 0;
                                foreach ($arr_val as $col) {
                                    if($pdf->debug==1){

                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                        echo $filtros[$k]['columna']."-->".$col;
                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                    }
                                    if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                        //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        if($ini==0){
                                            $where.=" (";
                                        }
                                        switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                            case 'int4':
                                            case 'numeric':
                                            case 'date':
                                                //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " = '" . $col . "'";
                                                break;
                                            case 'varchar':
                                            case 'bpchar':
                                                //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " ILIKE '" . $col . "'";
                                                break;
                                        }
                                        $ini++;
                                        if($ini==count($arr_val)){
                                            $where.=") ";
                                        }else $where .= " OR ";
                                    }
                                }
                                break;
                            case 'GREATER_THAN_OR_EQUAL':
                                $cond_fil .= utf8_encode(" que sea mayor o igual que:  " . $filtros[$k]['valor']);
                                $ini = 0;
                                foreach ($arr_val as $col) {
                                    //$fecha = date("Y-m-d", $col);
                                    $fecha = $col;
                                    if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                        //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        if($ini==0){
                                            $where.=" (";
                                        }
                                        switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                            case 'int4':
                                            case 'numeric':$where .= $filtros[$k]['columna'] . " = '" . $fecha . "'";break;
                                            case 'date':
                                                //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                                if($ini==0){
                                                    $where .= $filtros[$k]['columna']. " BETWEEN " ;
                                                }else {
                                                    $where .= " AND " ;
                                                }
                                                $where.="'".$fecha."'";

                                                break;
                                            case 'varchar':
                                            case 'bpchar':
                                                //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " ILIKE '" . $col . "'";
                                                break;
                                        }
                                        $ini++;
                                        if($ini==count($arr_val)){
                                            $where.=") ";
                                        }
                                    }
                                }
                                break;
                            case 'LESS_THAN_OR_EQUAL':
                                $cond_fil .= utf8_encode(" que sea menor o igual que:  " . $filtros[$k]['valor']);
                                $where .= $filtros[$k]['columna'] . ' <= "' . $filtros[$k]['valor'] . '"';
                                break;
                        }
                        $yaConsiderados[]=$filtros[$k]['columna'];
                    }
                } else {
                    switch ($filtros[$k]['condicion']) {
                        case 'EMPTY':
                            $cond_fil .= utf8_encode(" que sea vacía ");
                            $where .= "(" . $filtros[$k]['columna'] . " IS NULL OR " . $filtros[$k]['columna'] . " ILIKE '')";
                            break;
                        case 'NOT_EMPTY':
                            $cond_fil .= utf8_encode(" que no sea vacía ");
                            $where .= "(" . $filtros[$k]['columna'] . " IS NOT NULL OR " . $filtros[$k]['columna'] . " NOT ILIKE '')";
                            break;
                        case 'CONTAINS':
                            $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                            if ($filtros[$k]['columna'] == "nombres") {
                                $where .= "(p_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR s_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR t_nombre ILIKE '%" . $filtros[$k]['valor'] . "%' OR p_apellido ILIKE '%" . $filtros[$k]['valor'] . "%' OR s_apellido ILIKE '%" . $filtros[$k]['valor'] . "%' OR c_apellido ILIKE '%" . $filtros[$k]['valor'] . "%')";
                            } else {
                                $where .= $filtros[$k]['columna'] . " ILIKE '%" . $filtros[$k]['valor'] . "%'";
                            }
                            break;
                        case 'EQUAL':
                            $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                            if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                    case 'int4':
                                    case 'numeric':
                                    case 'date':
                                        //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                        $where .= $filtros[$k]['columna'] . " = '" . $filtros[$k]['valor'] . "'";
                                        break;
                                    case 'varchar':
                                    case 'bpchar':
                                        //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        $where .= $filtros[$k]['columna'] . " ILIKE '" . $filtros[$k]['valor'] . "'";
                                        break;
                                }
                            }
                            break;
                        case 'GREATER_THAN_OR_EQUAL':
                            $cond_fil .= utf8_encode(" que sea mayor o igual que:  " . $filtros[$k]['valor']);
                            $where .= $filtros[$k]['columna'] . ' >= "' . $filtros[$k]['valor'] . '"';
                            break;
                        case 'LESS_THAN_OR_EQUAL':
                            $cond_fil .= utf8_encode(" que sea menor o igual que:  " . $filtros[$k]['valor']);
                            $where .= $filtros[$k]['columna'] . ' <= "' . $filtros[$k]['valor'] . '"';
                            break;
                    }
                }

            }
            $obj = new Frelaborales();
            if($where!="")$where=" WHERE ".$where;
            $groups_aux = "";
            if($groups!=""){
                /**
                 * Se verifica que no se considere la columna nombres debido a que contenido ya esta ordenado por las
                 * columnas p_apellido, s_apellido, c_apellido, p_anombre, s_nombre, t_nombre
                 */
                if(strrpos($groups, "nombres")){
                    if(strrpos($groups, ",")){
                        $arr = explode(",",$groups);
                        foreach($arr as $val){
                            if($val!="nombres")
                                $groups_aux[]=$val;
                        }
                        $groups = implode(",",$groups_aux);
                    }else $groups="";
                }
                if(is_array($sorteds)&&count($sorteds)>0){
                    if($groups!="")$groups.=",";
                    $coma="";
                    if($pdf->debug==1){
                        echo "<p>===========================================Ordenadossss======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Ordenadossss======================================</p>";
                    }
                    foreach($sorteds as $ord=>$orden){
                        $groups.=$coma.$ord;
                        if($orden['asc']=='')$groups.=" ASC";else$groups.=" DESC";
                        $coma=",";
                    }
                }
          if($groups!="")
                    $groups=" ORDER BY ".$groups.",p_apellido,s_apellido,c_apellido,p_nombre,s_nombre,t_nombre,id_da,fecha_ini";
                if($pdf->debug==1)echo "<p>La consulta es: ".$groups."<p>";
            }else{
                if(is_array($sorteds)&&count($sorteds)>0){
                    $coma="";
                    if($pdf->debug==1){
                        echo "<p>===========================================Ordenadossss======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Ordenadossss======================================</p>";
                    }
                    foreach($sorteds as $ord=>$orden){
                        $groups.=$coma.$ord;
                        if($orden['asc']=='')$groups.=" ASC";else$groups.=" DESC";
                        $coma=",";
                    }
                    $groups = " ORDER BY ".$groups;
                }

            }
            if($pdf->debug==1)echo "<p>WHERE------------------------->".$where."<p>";
            if($pdf->debug==1)echo "<p>GROUP BY------------------------->".$groups."<p>";
            $resul = $obj->getAllWithPersonsOneRecord($where,$groups);

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
                    'nombres' => $v->nombres,
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
                    'fecha_ini' => $v->fecha_ini != "" ? date("d-m-Y", strtotime($v->fecha_ini)) : "",
                    'fecha_incor' => $v->fecha_incor != "" ? date("d-m-Y", strtotime($v->fecha_incor)) : "",
                    'fecha_fin' => $v->fecha_fin != "" ? date("d-m-Y", strtotime($v->fecha_fin)) : "",
                    'fecha_baja' => $v->fecha_baja != "" ? date("d-m-Y", strtotime($v->fecha_baja)) : "",
                    'fecha_ren' => $v->fecha_ren != "" ? date("d-m-Y", strtotime($v->fecha_ren)) : "",
                    'fecha_acepta_ren' => $v->fecha_acepta_ren != "" ? date("d-m-Y", strtotime($v->fecha_acepta_ren)) : "",
                    'fecha_agra_serv' => $v->fecha_agra_serv != "" ? date("d-m-Y", strtotime($v->fecha_agra_Serv)) : "",
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
                    'id_procesocontratacion' => $v->id_procesocontratacion,
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
                    'persona_fecha_mod' => $v->persona_fecha_mod
                );
            }
            //$pdf->Open("L");
            /**
             * Si el ancho supera el establecido para una hoja tamaño carta, se la pone en posición horizontal
             */

            $pdf->AddPage();
            if($pdf->debug==1){
                echo "<p>El ancho es:: ".$ancho;
            }
            #region Espacio para la definición de valores para la cabecera de la tabla
            $pdf->FechaHoraReporte = date("d-m-Y H:i:s");
            $j = 0;
            $agrupadores = array();
            //echo "<p>++++++++++>".$groups;
            if($groups!="")
                $agrupadores = explode(",", $groups);

            $dondeCambio = array();
            $queCambio = array();

            if (count($relaboral) > 0)
                foreach ($relaboral as $i => $val) {
                    if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                    if(count($agrupadores)>0){
                        if($pdf->debug==1){
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                            print_r($gruposSeleccionadosActuales);
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                        }
                        $agregarAgrupador=0;
                        $aux = array();
                        $dondeCambio = array();
                        foreach($gruposSeleccionadosActuales as $key=>$valor){
                            if($valor!=$val[$key]){
                                $agregarAgrupador=1;
                                $aux[$key]=$val[$key];
                                $dondeCambio[]=$key;
                                $queCambio[$key]= $val[$key];
                            }else{
                                $aux[$key]=$val[$key];
                            }
                        }
                        $gruposSeleccionadosActuales = $aux;
                        if($agregarAgrupador==1){
                            $pdf->Ln();
                            $pdf->DefineColorHeaderTable();
                            $pdf->SetAligns($alignTitleSelecteds);
                            //if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                            $agr=$pdf->DefineTitleColsByGroups($generalConfigForAllColumns,$dondeCambio,$queCambio);
                            $pdf->Agrupador($agr);
                            $pdf->RowTitle($colTitleSelecteds);
                        }
                        $pdf->DefineColorBodyTable();
                        $pdf->SetAligns($alignSelecteds);
                        if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                        $rowData = $pdf->DefineRows($j + 1, $relaboral[$j], $colSelecteds);
                        $pdf->Row($rowData);

                    }else{
                        //if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                        $pdf->DefineColorBodyTable();
                        $pdf->SetAligns($alignSelecteds);
                        $rowData = $pdf->DefineRows($j + 1, $val, $colSelecteds);
                        $pdf->Row($rowData);
                    }
                    //if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                    $j++;
                }

            $pdf->ShowLeftFooter = true;
            if($pdf->debug==0)$pdf->Output('reporte_relaboral.pdf','I');
            #endregion Proceso de generación del documento PDF
        }
    }
    /**
     * Función para la generación del array con los anchos de columna definido, en consideración a las columnas mostradas.
     * @param $generalWiths Array de los anchos y alineaciones de columnas disponibles.
     * @param $columns Array de las columnas con las propiedades de oculto (hidden:1) y visible (hidden:null).
     * @return array Array con el listado de anchos por columna a desplegarse.
     */
    function DefineWidths($widthAlignAll,$columns,$exclude=array()){
        $arrRes = Array();
        $arrRes[]=8;
        foreach($columns as $key => $val){
            if(isset($widthAlignAll[$key])){
                if(!isset($val['hidden'])||$val['hidden']!=true){
                    if(!in_array($key,$exclude)||count($exclude)==0)
                        $arrRes[]=$widthAlignAll[$key]['width'];
                }
            }
        }
        return $arrRes;
    }
    /*
     * Función para obtener la cantidad de veces que se considera una misma columna en el filtrado.
     * @param $columna
     * @param $array
     * @return int
     */
    function obtieneCantidadVecesConsideracionPorColumnaEnFiltros($columna, $array)
    {
        $cont = 0;
        if (count($array) >= 1) {
            foreach ($array as $key => $val) {
                if (in_array($columna, $val)) {
                    $cont++;
                }
            }
        }
        return $cont;
    }

    /**
     * Función para la obtención de los valores considerados en el filtro enviado.
     * @param $columna Nombre de la columna
     * @param $array Array con los registro de busquedas.
     * @return array Array con los valores considerados en el filtrado enviado.
     */
    function obtieneValoresConsideradosPorColumnaEnFiltros($columna, $array)
    {
        $arr_col = array();
        $cont = 0;
        if (count($array) >= 1) {
            foreach ($array as $key => $val) {
                if (in_array($columna, $val)) {
                    $arr_col[] = $val["valor"];
                }
            }
        }
        return $arr_col;
    }
    /**
     * Función para la obtención del listado de tipos de memorándum.
     */
    function listtiposmemorandumsAction(){
        $this->view->disable();
        $resul = Tipomemorandum::find(array('estado=:estado1: and agrupador=:agrupador1:','bind'=>array('estado1'=>1,'agrupador1'=>1),'order' => 'id ASC'));
        //comprobamos si hay filas
        if ($resul->count() > 0) {
            foreach ($resul as $v) {
                $tipomemorandum[] = array(
                    'id' => $v->id,
                    'tipo_memorandum' => $v->tipo_memorandum,
                    'cabecera' => $v->cabecera,
                    'abreviacion' => $v->abreviacion,
                    'observacion' => $v->observacion,
                    'estado' => $v->estado,
                    'agrupador' => $v->agrupador
                );
            }
        }
        echo json_encode($tipomemorandum);
    }
    /**
     * Función para la obtención del listado de gestiones disponibles para la generación de memorándums.
     * Se muestra la gestión actual menos la gestión pasada.
     */
    function listgestionesmemorandumsAction(){
        $this->view->disable();
        $gestionActual = date("Y");
        $gestionPasada = $gestionActual-1;
        $gestiones = array();
        for($ges=$gestionActual;$ges>=$gestionPasada;$ges--){
            $gestiones[] = array('gestion'=>$ges);
        }
        echo json_encode($gestiones);
    }

    /**
     * Función para la obtención del listado de gerencias administrativas.
     */
    function listgerenciasAction(){
        $this->view->disable();
        $org = new Organigramas();
        $resul = $org->getGerencias();
        //comprobamos si hay filas
        if ($resul->count() > 0) {
            foreach ($resul as $v) {
                $gerencias[] = array(
                    'id' => $v->id,
                    'padre_id' => $v->padre_id,
                    'gestion' => $v->gestion,
                    'da_id' => $v->da_id,
                    'regional_id' => $v->regional_id,
                    'unidad_administrativa' => $v->unidad_administrativa,
                    'nivel_estructural_id' => $v->nivel_estructural_id,
                    'sigla' => $v->sigla,
                    'fecha_ini' => $v->fecha_ini,
                    'fecha_fin' => $v->fecha_fin,
                    'orden' => $v->orden,
                    'observacion' => $v->observacion,
                    'estado' => $v->estado,
                    'baja_logica' => $v->baja_logica,
                    'user_reg_id' => $v->user_reg_id,
                    'fecha_reg' => $v->fecha_reg,
                    'user_mod_id' => $v->user_mod_id,
                    'fecha_mod' => $v->fecha_mod,
                    'area_sustantiva' => $v->area_sustantiva,
                    'visible' => $v->visible
                );
            }
        }
        echo json_encode($gerencias);
    }
    /**
     * Función para la obtención del listado de departamentos administrativos.
     * El nombre de la función se especifica así pues se prevé necesitarse el listado de los departamentos del país.
     */
    function listdepartamentosadministrativosAction(){
        $this->view->disable();
        $org = new Organigramas();
        $padre_id = $_GET["padre_id"];
        $resul = $org->getDepartamentosAdministrativosPorGerencia($padre_id);
        //comprobamos si hay filas
        if ($resul->count() > 0) {
            foreach ($resul as $v) {
                $gerencias[] = array(
                    'id' => $v->id,
                    'padre_id' => $v->padre_id,
                    'gestion' => $v->gestion,
                    'da_id' => $v->da_id,
                    'regional_id' => $v->regional_id,
                    'unidad_administrativa' => $v->unidad_administrativa,
                    'nivel_estructural_id' => $v->nivel_estructural_id,
                    'sigla' => $v->sigla,
                    'fecha_ini' => $v->fecha_ini,
                    'fecha_fin' => $v->fecha_fin,
                    'orden' => $v->orden,
                    'observacion' => $v->observacion,
                    'estado' => $v->estado,
                    'baja_logica' => $v->baja_logica,
                    'user_reg_id' => $v->user_reg_id,
                    'fecha_reg' => $v->fecha_reg,
                    'user_mod_id' => $v->user_mod_id,
                    'fecha_mod' => $v->fecha_mod,
                    'area_sustantiva' => $v->area_sustantiva,
                    'visible' => $v->visible
                );
            }
        }
        echo json_encode($gerencias);
    }

    /**
     * Función para la obtención del listado de áreas administrativas.
     */
    function listareasadministrativasAction(){
        $this->view->disable();
        $org = new Organigramas();
        $padre_id = $_GET["padre_id"];
        $resul = $org->getAreasAdministrativas($padre_id);
        //comprobamos si hay filas
        $areas = array();
        if ($resul->count() > 0) {
            foreach ($resul as $v) {
                $areas[] = array(
                    'id' => $v->id,
                    'padre_id' => $v->padre_id,
                    'gestion' => $v->gestion,
                    'da_id' => $v->da_id,
                    'regional_id' => $v->regional_id,
                    'unidad_administrativa' => $v->unidad_administrativa,
                    'nivel_estructural_id' => $v->nivel_estructural_id,
                    'sigla' => $v->sigla,
                    'fecha_ini' => $v->fecha_ini,
                    'fecha_fin' => $v->fecha_fin,
                    'orden' => $v->orden,
                    'observacion' => $v->observacion,
                    'estado' => $v->estado,
                    'baja_logica' => $v->baja_logica,
                    'user_reg_id' => $v->user_reg_id,
                    'fecha_reg' => $v->fecha_reg,
                    'user_mod_id' => $v->user_mod_id,
                    'fecha_mod' => $v->fecha_mod,
                    'area_sustantiva' => $v->area_sustantiva,
                    'visible' => $v->visible
                );
            }
        }
        echo json_encode($areas);
    }
}