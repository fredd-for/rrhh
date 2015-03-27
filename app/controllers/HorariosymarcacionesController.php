<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  13-03-2015
*/

class HorariosymarcacionesController extends ControllerBase
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

        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.tab.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.index.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.list.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.approve.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.calculations.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.new.edit.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.turns.excepts.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.down.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.move.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.view.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.export.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.view.splitter.js');
    }
    /**
     * Función para la obtención del listado de registros de control de marcaciones.
     */
    public function listporrelaboralAction()
    {
        $this->view->disable();
        $horariosymarcaciones = Array();
        if(isset($_GET["id"])&&$_GET["id"]>0){
            $obj = new Fhorariosymarcaciones();
            $idRelaboral = $_GET["id"];
            $resul = $obj->getAll("WHERE relaboral_id=".$idRelaboral);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $horariosymarcaciones[] = array(
                        'nro_row' => 0,
                        'id'=>$v->id_horarioymarcacion,
                        'relaboral_id'=>$v->relaboral_id,
                        'gestion'=>$v->gestion,
                        'mes'=>$v->mes,
                        'mes_nombre'=>$v->mes_nombre,
                        'turno'=>$v->turno,
                        'grupo'=>$v->grupo,
                        'clasemarcacion'=>$v->clasemarcacion,
                        'clasemarcacion_descripcion'=>$v->clasemarcacion_descripcion,
                        'modalidadmarcacion_id'=>$v->modalidadmarcacion_id,
                        'modalidad_marcacion'=>$v->modalidad_marcacion,
                        'd1'=>$v->d1,
                        'calendariolaboral1_id'=>$v->calendariolaboral1_id,
                        'd2'=>$v->d2,
                        'calendariolaboral2_id'=>$v->calendariolaboral2_id,
                        'd3'=>$v->d3,
                        'calendariolaboral3_id'=>$v->calendariolaboral3_id,
                        'd4'=>$v->d4,
                        'calendariolaboral4_id'=>$v->calendariolaboral4_id,
                        'd5'=>$v->d5,
                        'calendariolaboral5_id'=>$v->calendariolaboral5_id,
                        'd6'=>$v->d6,
                        'calendariolaboral6_id'=>$v->calendariolaboral6_id,
                        'd7'=>$v->d7,
                        'calendariolaboral7_id'=>$v->calendariolaboral7_id,
                        'd8'=>$v->d8,
                        'calendariolaboral8_id'=>$v->calendariolaboral8_id,
                        'd9'=>$v->d9,
                        'calendariolaboral9_id'=>$v->calendariolaboral9_id,
                        'd10'=>$v->d10,
                        'calendariolaboral10_id'=>$v->calendariolaboral10_id,
                        'd11'=>$v->d11,
                        'calendariolaboral11_id'=>$v->calendariolaboral11_id,
                        'd12'=>$v->d12,
                        'calendariolaboral12_id'=>$v->calendariolaboral12_id,
                        'd13'=>$v->d13,
                        'calendariolaboral13_id'=>$v->calendariolaboral13_id,
                        'd14'=>$v->d14,
                        'calendariolaboral14_id'=>$v->calendariolaboral14_id,
                        'd15'=>$v->d15,
                        'calendariolaboral15_id'=>$v->calendariolaboral15_id,
                        'd16'=>$v->d16,
                        'calendariolaboral16_id'=>$v->calendariolaboral16_id,
                        'd17'=>$v->d17,
                        'calendariolaboral17_id'=>$v->calendariolaboral17_id,
                        'd18'=>$v->d18,
                        'calendariolaboral18_id'=>$v->calendariolaboral18_id,
                        'd19'=>$v->d19,
                        'calendariolaboral19_id'=>$v->calendariolaboral19_id,
                        'd20'=>$v->d20,
                        'calendariolaboral20_id'=>$v->calendariolaboral20_id,
                        'd21'=>$v->d21,
                        'calendariolaboral21_id'=>$v->calendariolaboral21_id,
                        'd22'=>$v->d22,
                        'calendariolaboral22_id'=>$v->calendariolaboral22_id,
                        'd23'=>$v->d23,
                        'calendariolaboral23_id'=>$v->calendariolaboral23_id,
                        'd24'=>$v->d24,
                        'calendariolaboral24_id'=>$v->calendariolaboral24_id,
                        'd25'=>$v->d25,
                        'calendariolaboral25_id'=>$v->calendariolaboral25_id,
                        'd26'=>$v->d26,
                        'calendariolaboral26_id'=>$v->calendariolaboral26_id,
                        'd27'=>$v->d27,
                        'calendariolaboral27_id'=>$v->calendariolaboral27_id,
                        'd28'=>$v->d28,
                        'calendariolaboral28_id'=>$v->calendariolaboral28_id,
                        'd29'=>$v->d29,
                        'calendariolaboral29_id'=>$v->calendariolaboral29_id,
                        'd30'=>$v->d30,
                        'calendariolaboral30_id'=>$v->calendariolaboral30_id,
                        'd31'=>$v->d31,
                        'calendariolaboral31_id'=>$v->calendariolaboral31_id,
                        'ultimo_dia'=>$v->ultimo_dia,
                        'atrasos'=>$v->atrasos,
                        'faltas'=>$v->faltas,
                        'abandono'=>$v->abandono,
                        'omision'=>$v->omision,
                        'compensacion'=>$v->compensacion,
                        'observacion'=>$v->observacion,
                        'estado'=>$v->estado,
                        'estado_descripcion'=>$v->estado_descripcion,
                        'baja_logica'=>$v->baja_logica,
                        'agrupador'=>$v->agrupador,
                        'user_reg_id'=>$v->user_reg_id,
                        'fecha_reg'=>$v->fecha_reg,
                        'user_apr_id'=>$v->user_apr_id,
                        'fecha_apr'=>$v->fecha_apr,
                        'user_mod_id'=>$v->user_mod_id,
                        'fecha_mod'=>$v->fecha_mod,
                    );
                }
            }
        }
        echo json_encode($horariosymarcaciones);
    }

    /**
     * Función para obtener el listado de marcaciones con los cálculos correspondiente considerando el rango de dos meses
     */
    public function listallbyrangeAction()
    {
        $this->view->disable();
        $horariosymarcaciones = Array();
        if(isset($_GET["fecha_ini"])&&isset($_GET["fecha_fin"])){
            $idRelaboral = 0;
            if(isset($_GET["id_relaboral"])&&$_GET["id_relaboral"]>0)
                $idRelaboral=$_GET["id_relaboral"];
            $fechaIni =$_GET["fecha_ini"];
            $fechaFin =$_GET["fecha_fin"];

            $obj = new Frelaboraleshorariosymarcaciones();
            $idRelaboral=0;
            $resul = $obj->getAllByRangeTwoMonth($idRelaboral,$fechaIni,$fechaFin,"");
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $horariosymarcaciones[] = array(
                        'nro_row' => 0,
                        #region Columnas de procedimiento f_relaborales()
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
                        'tiene_item' => $v->tiene_item,
                        'item' => $v->item,
                        'carrera_adm' => $v->carrera_adm,
                        'num_contrato' => $v->num_contrato,
                        'contrato_numerador_estado' => $v->contrato_numerador_estado,
                        'id_solelabcontrato' => $v->id_solelabcontrato,
                        'solelabcontrato_regional_sigla' => $v->solelabcontrato_regional_sigla,
                        'solelabcontrato_numero' => $v->solelabcontrato_numero,
                        'solelabcontrato_gestion' => $v->solelabcontrato_gestion,
                        'solelabcontrato_codigo' => $v->solelabcontrato_codigo,
                        'solelabcontrato_user_reg_id' => $v->solelabcontrato_user_reg_id,
                        'solelabcontrato_fecha_sol' => $v->solelabcontrato_fecha_sol,
                        'fecha_ing' => $v->fecha_ing != "" ? date("d-m-Y", strtotime($v->fecha_ing)) : "",
                        'fecha_ini' => $v->fecha_ini != "" ? date("d-m-Y", strtotime($v->fecha_ini)) : "",
                        'fecha_incor' => $v->fecha_incor != "" ? date("d-m-Y", strtotime($v->fecha_incor)) : "",
                        'fecha_fin' => $v->fecha_fin != "" ? date("d-m-Y", strtotime($v->fecha_fin)) : "",
                        'fecha_baja' => $v->fecha_baja != "" ? date("d-m-Y", strtotime($v->fecha_baja)) : "",
                        'fecha_ren' => $v->fecha_ren != "" ? date("d-m-Y", strtotime($v->fecha_ren)) : "",
                        'fecha_acepta_ren' => $v->fecha_acepta_ren != "" ? date("d-m-Y", strtotime($v->fecha_acepta_ren)) : "",
                        'fecha_agra_serv' => $v->fecha_agra_serv != "" ? date("d-m-Y", strtotime($v->fecha_agra_serv)) : "",
                        'motivo_baja' => $v->motivo_baja,
                        'motivosbajas_abreviacion' => $v->motivosbajas_abreviacion,
                        'descripcion_baja' => $v->descripcion_baja,
                        'descripcion_anu' => $v->descripcion_anu,
                        'id_cargo' => $v->id_cargo,
                        'cargo_codigo' => $v->cargo_codigo,
                        'cargo' => $v->cargo,
                        'cargo_resolucion_ministerial_id' => $v->cargo_resolucion_ministerial_id,
                        'cargo_resolucion_ministerial' => $v->cargo_resolucion_ministerial,
                        'id_nivelessalarial' => $v->id_nivelessalarial,
                        'nivelsalarial' => $v->nivelsalarial,
                        'nivelsalarial_resolucion_id' => $v->nivelsalarial_resolucion_id,
                        'nivelsalarial_resolucion' => $v->nivelsalarial_resolucion,
                        'numero_escala' => $v->numero_escala,
                        'gestion_escala' => $v->gestion_escala,
                        /*'sueldo' => $v->sueldo,*/
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
                        'relaboral_previo_id' => $v->relaboral_previo_id,
                        'observacion' => ($v->observacion != null) ? $v->observacion : "",
                        /*'relaboral_estado' => $v->relaboral_estado,
                        'relaboral_estado_descripcion' => $v->relaboral_estado_descripcion,
                        'relaboral_estado_abreviacion' => $v->relaboral_estado_abreviacion,
                        'tiene_contrato_vigente' => $v->tiene_contrato_vigente,
                        'id_eventual' => $v->id_eventual,*/
                        'id_consultor' => $v->id_consultor,
                        /*'user_reg_id' => $v->user_reg_id,
                        'fecha_reg' => $v->fecha_reg,
                        'user_mod_id' => $v->user_mod_id,
                        'fecha_mod' => $v->fecha_mod,*/
                        'persona_user_reg_id' => $v->persona_user_reg_id,
                        'persona_fecha_reg' => $v->persona_fecha_reg,
                        'persona_user_mod_id' => $v->persona_user_mod_id,
                        'persona_fecha_mod' => $v->persona_fecha_mod,
                        #endregion Columnas de procedimiento f_relaborales()


                        'id'=>$v->id_horarioymarcacion,
                        'relaboral_id'=>$v->relaboral_id,
                        'gestion'=>$v->gestion,
                        'mes'=>$v->mes,
                        'mes_nombre'=>$v->mes_nombre,
                        'turno'=>$v->turno,
                        'grupo'=>$v->grupo,
                        'clasemarcacion'=>$v->clasemarcacion,
                        'clasemarcacion_descripcion'=>$v->clasemarcacion_descripcion,
                        'modalidadmarcacion_id'=>$v->modalidadmarcacion_id,
                        'modalidad_marcacion'=>$v->modalidad_marcacion,
                        'd1'=>$v->d1,
                        'calendariolaboral1_id'=>$v->calendariolaboral1_id,
                        'd2'=>$v->d2,
                        'calendariolaboral2_id'=>$v->calendariolaboral2_id,
                        'd3'=>$v->d3,
                        'calendariolaboral3_id'=>$v->calendariolaboral3_id,
                        'd4'=>$v->d4,
                        'calendariolaboral4_id'=>$v->calendariolaboral4_id,
                        'd5'=>$v->d5,
                        'calendariolaboral5_id'=>$v->calendariolaboral5_id,
                        'd6'=>$v->d6,
                        'calendariolaboral6_id'=>$v->calendariolaboral6_id,
                        'd7'=>$v->d7,
                        'calendariolaboral7_id'=>$v->calendariolaboral7_id,
                        'd8'=>$v->d8,
                        'calendariolaboral8_id'=>$v->calendariolaboral8_id,
                        'd9'=>$v->d9,
                        'calendariolaboral9_id'=>$v->calendariolaboral9_id,
                        'd10'=>$v->d10,
                        'calendariolaboral10_id'=>$v->calendariolaboral10_id,
                        'd11'=>$v->d11,
                        'calendariolaboral11_id'=>$v->calendariolaboral11_id,
                        'd12'=>$v->d12,
                        'calendariolaboral12_id'=>$v->calendariolaboral12_id,
                        'd13'=>$v->d13,
                        'calendariolaboral13_id'=>$v->calendariolaboral13_id,
                        'd14'=>$v->d14,
                        'calendariolaboral14_id'=>$v->calendariolaboral14_id,
                        'd15'=>$v->d15,
                        'calendariolaboral15_id'=>$v->calendariolaboral15_id,
                        'd16'=>$v->d16,
                        'calendariolaboral16_id'=>$v->calendariolaboral16_id,
                        'd17'=>$v->d17,
                        'calendariolaboral17_id'=>$v->calendariolaboral17_id,
                        'd18'=>$v->d18,
                        'calendariolaboral18_id'=>$v->calendariolaboral18_id,
                        'd19'=>$v->d19,
                        'calendariolaboral19_id'=>$v->calendariolaboral19_id,
                        'd20'=>$v->d20,
                        'calendariolaboral20_id'=>$v->calendariolaboral20_id,
                        'd21'=>$v->d21,
                        'calendariolaboral21_id'=>$v->calendariolaboral21_id,
                        'd22'=>$v->d22,
                        'calendariolaboral22_id'=>$v->calendariolaboral22_id,
                        'd23'=>$v->d23,
                        'calendariolaboral23_id'=>$v->calendariolaboral23_id,
                        'd24'=>$v->d24,
                        'calendariolaboral24_id'=>$v->calendariolaboral24_id,
                        'd25'=>$v->d25,
                        'calendariolaboral25_id'=>$v->calendariolaboral25_id,
                        'd26'=>$v->d26,
                        'calendariolaboral26_id'=>$v->calendariolaboral26_id,
                        'd27'=>$v->d27,
                        'calendariolaboral27_id'=>$v->calendariolaboral27_id,
                        'd28'=>$v->d28,
                        'calendariolaboral28_id'=>$v->calendariolaboral28_id,
                        'd29'=>$v->d29,
                        'calendariolaboral29_id'=>$v->calendariolaboral29_id,
                        'd30'=>$v->d30,
                        'calendariolaboral30_id'=>$v->calendariolaboral30_id,
                        'd31'=>$v->d31,
                        'calendariolaboral31_id'=>$v->calendariolaboral31_id,
                        'ultimo_dia'=>$v->ultimo_dia,
                        'atrasos'=>$v->atrasos,
                        'faltas'=>$v->faltas,
                        'abandono'=>$v->abandono,
                        'omision'=>$v->omision,
                        'compensacion'=>$v->compensacion,
                        'observacion'=>$v->observacion,
                        'estado'=>$v->estado,
                        'estado_descripcion'=>$v->estado_descripcion,
                        'baja_logica'=>$v->baja_logica,
                        'agrupador'=>$v->agrupador,
                        'user_reg_id'=>$v->user_reg_id,
                        'fecha_reg'=>$v->fecha_reg,
                        'user_apr_id'=>$v->user_apr_id,
                        'fecha_apr'=>$v->fecha_apr,
                        'user_mod_id'=>$v->user_mod_id,
                        'fecha_mod'=>$v->fecha_mod,
                    );
                }
            }
        }
        echo json_encode($horariosymarcaciones);
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
} 