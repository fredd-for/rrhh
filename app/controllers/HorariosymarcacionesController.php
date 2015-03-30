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
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.export.marc.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.export.calc.js');
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
                        'lsgh'=>$v->lsgh,
                        'compensacion'=>$v->compensacion,
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
    /**
     * Función para la exportación del reporte en formato Excel.
     * @param $n_rows Cantidad de lineas
     * @param $columns Array con las columnas mostradas en el reporte
     * @param $filtros Array con los filtros aplicados sobre las columnas.
     * @param $groups String con la cadena representativa de las columnas agrupadas. La separación es por comas.
     * @param $sorteds  Columnas ordenadas .
     */
    public function exportmarcacionesexcelAction($idRelaboral,$n_rows, $columns, $filtros,$groups,$sorteds)
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
            'estado_descripcion' => array('title' => 'Estado', 'width' => 15, 'align' => 'C', 'type' => 'varchar'),
            'gestion' => array('title' => 'Gestion', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'mes_nombre' => array('title' => 'Mes', 'width' => 20, 'align' => 'C', 'type' => 'varchar'),
            'turno' => array('title' => 'Turno', 'width' => 10, 'align' => 'C', 'type' => 'numeric'),
            'modalidad_marcacion' => array('title' => 'Modalidad', 'width' => 30, 'align' => 'C', 'type' => 'varchar'),
            'd1' => array('title' => 'Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado1_descripcion' => array('title' => 'Estado Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd2' => array('title' => 'Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado2_descripcion' => array('title' => 'Estado Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd3' => array('title' => 'Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado3_descripcion' => array('title' => 'Estado Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd4' => array('title' => 'Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado4_descripcion' => array('title' => 'Estado Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd5' => array('title' => 'Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado5_descripcion' => array('title' => 'Estado Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd6' => array('title' => 'Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado6_descripcion' => array('title' => 'Estado Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd7' => array('title' => 'Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado7_descripcion' => array('title' => 'Estado Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd8' => array('title' => 'Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado8_descripcion' => array('title' => 'Estado Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd9' => array('title' => 'Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado9_descripcion' => array('title' => 'Estado Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd10' => array('title' => 'Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado10_descripcion' => array('title' => 'Estado Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd11' => array('title' => 'Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado11_descripcion' => array('title' => 'Estado Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd12' => array('title' => 'Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado12_descripcion' => array('title' => 'Estado Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd13' => array('title' => 'Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado13_descripcion' => array('title' => 'Estado Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd14' => array('title' => 'Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado14_descripcion' => array('title' => 'Estado Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd15' => array('title' => 'Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado15_descripcion' => array('title' => 'Estado Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd16' => array('title' => 'Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado16_descripcion' => array('title' => 'Estado Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd17' => array('title' => 'Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado17_descripcion' => array('title' => 'Estado Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd18' => array('title' => 'Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado18_descripcion' => array('title' => 'Estado Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd19' => array('title' => 'Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado19_descripcion' => array('title' => 'Estado Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd20' => array('title' => 'Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado20_descripcion' => array('title' => 'Estado Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd21' => array('title' => 'Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado21_descripcion' => array('title' => 'Estado Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd22' => array('title' => 'Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado22_descripcion' => array('title' => 'Estado Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd23' => array('title' => 'Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado23_descripcion' => array('title' => 'Estado Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd24' => array('title' => 'Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado24_descripcion' => array('title' => 'Estado Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd25' => array('title' => 'Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado25_descripcion' => array('title' => 'Estado Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd26' => array('title' => 'Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado26_descripcion' => array('title' => 'Estado Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd27' => array('title' => 'Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado27_descripcion' => array('title' => 'Estado Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd28' => array('title' => 'Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado28_descripcion' => array('title' => 'Estado Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd29' => array('title' => 'Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado29_descripcion' => array('title' => 'Estado Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd30' => array('title' => 'Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado30_descripcion' => array('title' => 'Estado Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd31' => array('title' => 'Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado31_descripcion' => array('title' => 'Estado Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'ultimo_dia' => array('title' => 'Ultimo Dia Procesado', 'width' => 10, 'align' => 'C', 'type' => 'numeric'),
            'atrasos' => array('title' => 'Atrasos', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'faltas' => array('title' => 'Faltas', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'abandono' => array('title' => 'Abandono', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'omision' => array('title' => 'Omision', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'lsgh' => array('title' => 'LSGH', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'observacion' => array('title' => 'Observacion', 'width' => 15, 'align' => 'L', 'type' => 'varchar')
        );
        $agruparPor = ($groups!="")?explode(",",$groups):array();
        $widthsSelecteds = $this->DefineWidths($generalConfigForAllColumns, $columns,$agruparPor);
        $ancho = 0;
        if($idRelaboral>0&&count($widthsSelecteds)>0) {
            foreach ($widthsSelecteds as $w) {
                $ancho = $ancho + $w;
            }
            $excel = new exceloasis();
            $excel->tableWidth = $ancho;
            #region Proceso de generación del documento Excel
            $excel->debug = 0;
            $excel->title_rpt = utf8_decode('Reporte Marcaciones');
            $excel->header_title_empresa_rpt = utf8_decode('Empresa Estatal de Transporte por Cable "Mi Teleférico"');
            $alignSelecteds = $excel->DefineAligns($generalConfigForAllColumns, $columns, $agruparPor);
            $colSelecteds = $excel->DefineCols($generalConfigForAllColumns, $columns, $agruparPor);
            $colTitleSelecteds = $excel->DefineTitleCols($generalConfigForAllColumns, $columns, $agruparPor);
            $alignTitleSelecteds = $excel->DefineTitleAligns(count($colTitleSelecteds));
            $formatTypes = $excel->DefineTypeCols($generalConfigForAllColumns, $columns, $agruparPor);
            $gruposSeleccionadosActuales = $excel->DefineDefaultValuesForGroups($groups);
            $excel->generalConfigForAllColumns = $generalConfigForAllColumns;
            $excel->colTitleSelecteds = $colTitleSelecteds;
            $excel->widthsSelecteds = $widthsSelecteds;
            $excel->alignSelecteds = $alignSelecteds;
            $excel->alignTitleSelecteds = $alignTitleSelecteds;

            $cantCol = count($colTitleSelecteds);
            $excel->ultimaLetraCabeceraTabla = $excel->columnasExcel[$cantCol-1];
            $excel->penultimaLetraCabeceraTabla = $excel->columnasExcel[$cantCol-2];
            $excel->numFilaCabeceraTabla = 4;
            $excel->primeraLetraCabeceraTabla = "A";
            $excel->segundaLetraCabeceraTabla = "B";
            $excel->celdaInicial = $excel->primeraLetraCabeceraTabla.$excel->numFilaCabeceraTabla;
            $excel->celdaFinal = $excel->ultimaLetraCabeceraTabla.$excel->numFilaCabeceraTabla;
            if($cantCol<=9){
                $excel->defineOrientation("V");
                $excel->defineSize("C");
            }elseif($cantCol<=13){
                $excel->defineOrientation("H");
                $excel->defineSize("C");
            }else{
                $excel->defineOrientation("H");
                $excel->defineSize("O");
            }
            if ($excel->debug == 1) {
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^idRelaboral^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
                echo "<p>".$idRelaboral;
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::COLUMNAS::::::::::::::::::::::::::::::::::::::::::<p>";
                print_r($columns);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::FILTROS::::::::::::::::::::::::::::::::::::::::::<p>";
                print_r($filtros);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::GRUPOS::::::::::::::::::::::::::::::::::::::::::::<p>";
                echo "<p>" . $groups;
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
                    if ($excel->debug == 1) {
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
                                    $where .= $filtros[$k]['columna'] . " ILIKE '%" . $filtros[$k]['valor'] . "%'";
                                break;
                            case 'EQUAL':
                                $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                                $ini = 0;
                                foreach ($arr_val as $col) {
                                    if ($excel->debug == 1) {

                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                        echo $filtros[$k]['columna'] . "-->" . $col;
                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                    }
                                    if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                        //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        if ($ini == 0) {
                                            $where .= " (";
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
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        } else $where .= " OR ";
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
                                        if ($ini == 0) {
                                            $where .= " (";
                                        }
                                        switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                            case 'int4':
                                            case 'numeric':
                                                $where .= $filtros[$k]['columna'] . " = '" . $fecha . "'";
                                                break;
                                            case 'date':
                                                //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                                if ($ini == 0) {
                                                    $where .= $filtros[$k]['columna'] . " BETWEEN ";
                                                } else {
                                                    $where .= " AND ";
                                                }
                                                $where .= "'" . $fecha . "'";

                                                break;
                                            case 'varchar':
                                            case 'bpchar':
                                                //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " ILIKE '" . $col . "'";
                                                break;
                                        }
                                        $ini++;
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        }
                                    }
                                }
                                break;
                            case 'LESS_THAN_OR_EQUAL':
                                $cond_fil .= utf8_encode(" que sea menor o igual que:  " . $filtros[$k]['valor']);
                                $where .= $filtros[$k]['columna'] . ' <= "' . $filtros[$k]['valor'] . '"';
                                break;
                        }
                        $yaConsiderados[] = $filtros[$k]['columna'];
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
                            $where .= $filtros[$k]['columna'] . " ILIKE '%" . $filtros[$k]['valor'] . "%'";
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
            $obj = new Fhorariosymarcaciones();
            if ($where != "") $where = " WHERE " . $where;
            $groups_aux = "";
            if ($groups != "") {
                /**
                 * Se verifica que no se considere la columna nombres debido a que contenido ya esta ordenado por las
                 * columnas p_apellido, s_apellido, c_apellido, p_anombre, s_nombre, t_nombre
                 */
                /*if (strrpos($groups, "nombres")) {
                    if (strrpos($groups, ",")) {
                        $arr = explode(",", $groups);
                        foreach ($arr as $val) {
                            if ($val != "nombres")
                                $groups_aux[] = $val;
                        }
                        $groups = implode(",", $groups_aux);
                    } else $groups = "";
                }*/
                if (is_array($sorteds) && count($sorteds) > 0) {
                    if ($groups != "") $groups .= ",";
                    $coma = "";
                    if ($excel->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                }
                if ($groups != "")
                    $groups = " ORDER BY " . $groups . ",relaboral_id,gestion,mes,turno,modalidadmarcacion_id";
                if ($excel->debug == 1) echo "<p>La consulta es: " . $groups . "<p>";
            } else {
                if (is_array($sorteds) && count($sorteds) > 0) {
                    $coma = "";
                    if ($excel->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                    $groups = " ORDER BY " . $groups;
                }

            }
            if ($excel->debug == 1) echo "<p>WHERE------------------------->" . $where . "<p>";
            if ($excel->debug == 1) echo "<p>GROUP BY------------------------->" . $groups . "<p>";
            $resul = $obj->getAll("WHERE relaboral_id=".$idRelaboral,$groups);

            $horariosymarcaciones = array();
            foreach ($resul as $v) {
                $horariosymarcaciones[] = array(
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
                    'lsgh'=>$v->lsgh,
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
                    'fecha_mod'=>$v->fecha_mod
                );
            }
            #region Espacio para la definición de valores para la cabecera de la tabla
            $excel->FechaHoraReporte = date("d-m-Y H:i:s");
            $j = 0;
            $agrupadores = array();
            if ($groups != "")
                $agrupadores = explode(",", $groups);

            $dondeCambio = array();
            $queCambio = array();
            $excel->header();
            $fila=$excel->numFilaCabeceraTabla;
            if (count($horariosymarcaciones) > 0){
                $excel->RowTitle($colTitleSelecteds,$fila);
                $celdaInicial=$excel->primeraLetraCabeceraTabla.$fila;
                $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                if ($excel->debug == 1) {
                    echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                    print_r($horariosymarcaciones);
                    echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                }
                foreach ($horariosymarcaciones as $i => $val) {
                    if (count($agrupadores) > 0) {
                        if ($excel->debug == 1) {
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                            print_r($gruposSeleccionadosActuales);
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                        }
                        $agregarAgrupador = 0;
                        $aux = array();
                        $dondeCambio = array();
                        foreach ($gruposSeleccionadosActuales as $key => $valor) {
                            if ($valor != $val[$key]) {
                                $agregarAgrupador = 1;
                                $aux[$key] = $val[$key];
                                $dondeCambio[] = $key;
                                $queCambio[$key] = $val[$key];
                            } else {
                                $aux[$key] = $val[$key];
                            }
                        }
                        $gruposSeleccionadosActuales = $aux;
                        if ($agregarAgrupador == 1) {
                            $agr = $excel->DefineTitleColsByGroups($generalConfigForAllColumns, $dondeCambio, $queCambio);
                            if($excel->debug==1){
                                echo "<p>+++++++++++++++++++++++++++AGRUPADO POR++++++++++++++++++++++++++++++++++++++++<p></p>";
                                print_r($agr);
                                echo "<p>+++++++++++++++++++++++++++AGRUPADO POR++++++++++++++++++++++++++++++++++++++++<p></p>";
                            }
                            $excel->borderGroup($celdaInicial,$celdaFinalDiagonalTabla);
                            $fila++;
                            /*
                             * Si es que hay agrupadores, se inicia el conteo desde donde empieza el agrupador
                             */
                            $celdaInicial=$excel->primeraLetraCabeceraTabla.$fila;
                            $excel->Agrupador($agr,$fila);
                            $excel->RowTitle($colTitleSelecteds,$fila);
                        }
                        $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                        $rowData = $excel->DefineRows($j + 1, $horariosymarcaciones[$j], $colSelecteds);
                        if ($excel->debug == 1) {
                            echo "<p>···································FILA·················································<p></p>";
                            print_r($rowData);
                            echo "<p>···································FILA·················································<p></p>";
                        }
                        $excel->Row($rowData,$alignSelecteds,$formatTypes,$fila);
                        $fila++;

                    } else {
                        $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                        $rowData = $excel->DefineRows($j + 1, $val, $colSelecteds);
                        if ($excel->debug == 1) {
                            echo "<p>···································FILA·················································<p></p>";
                            print_r($rowData);
                            echo "<p>···································FILA·················································<p></p>";
                        }
                        $excel->Row($rowData,$alignSelecteds,$formatTypes,$fila);
                        $fila++;
                    }
                    $j++;
                }
                $fila--;
                $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                $excel->borderGroup($celdaInicial,$celdaFinalDiagonalTabla);
            }
            $excel->ShowLeftFooter = true;
            //$excel->secondPage();
            if ($excel->debug == 0) {
                $excel->display("AppData/reporte_marcaciones.xls","I");
            }
            #endregion Proceso de generación del documento PDF
        }
    }
    /**
     * Función para la exportación del reporte con cálculos en rango de fechas en formato Excel.
     * @param $n_rows Cantidad de lineas
     * @param $columns Array con las columnas mostradas en el reporte
     * @param $filtros Array con los filtros aplicados sobre las columnas.
     * @param $groups String con la cadena representativa de las columnas agrupadas. La separación es por comas.
     * @param $sorteds  Columnas ordenadas .
     */
    public function exportcalculosexcelAction($fechaIni,$fechaFin,$n_rows, $columns, $filtros,$groups,$sorteds)
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
            'nombres' => array('title' => 'Nombres', 'width' => 50, 'align' => 'L', 'type' => 'varchar'),
            'ci' => array('title' => 'CI', 'width' => 30, 'align' => 'C', 'type' => 'varchar'),
            'expd' => array('title' => 'EXP', 'width' => 10, 'align' => 'C', 'type' => 'varchar'),
            'estado_descripcion' => array('title' => 'Estado', 'width' => 15, 'align' => 'C', 'type' => 'varchar'),
            'gestion' => array('title' => 'Gestion', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'mes_nombre' => array('title' => 'Mes', 'width' => 20, 'align' => 'C', 'type' => 'varchar'),
            'turno' => array('title' => 'Turno', 'width' => 10, 'align' => 'C', 'type' => 'numeric'),
            'modalidad_marcacion' => array('title' => 'Modalidad', 'width' => 30, 'align' => 'C', 'type' => 'varchar'),
            'd1' => array('title' => 'Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado1_descripcion' => array('title' => 'Estado Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd2' => array('title' => 'Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado2_descripcion' => array('title' => 'Estado Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd3' => array('title' => 'Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado3_descripcion' => array('title' => 'Estado Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd4' => array('title' => 'Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado4_descripcion' => array('title' => 'Estado Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd5' => array('title' => 'Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado5_descripcion' => array('title' => 'Estado Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd6' => array('title' => 'Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado6_descripcion' => array('title' => 'Estado Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd7' => array('title' => 'Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado7_descripcion' => array('title' => 'Estado Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd8' => array('title' => 'Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado8_descripcion' => array('title' => 'Estado Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd9' => array('title' => 'Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado9_descripcion' => array('title' => 'Estado Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd10' => array('title' => 'Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado10_descripcion' => array('title' => 'Estado Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd11' => array('title' => 'Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado11_descripcion' => array('title' => 'Estado Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd12' => array('title' => 'Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado12_descripcion' => array('title' => 'Estado Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd13' => array('title' => 'Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado13_descripcion' => array('title' => 'Estado Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd14' => array('title' => 'Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado14_descripcion' => array('title' => 'Estado Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd15' => array('title' => 'Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado15_descripcion' => array('title' => 'Estado Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd16' => array('title' => 'Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado16_descripcion' => array('title' => 'Estado Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd17' => array('title' => 'Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado17_descripcion' => array('title' => 'Estado Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd18' => array('title' => 'Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado18_descripcion' => array('title' => 'Estado Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd19' => array('title' => 'Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado19_descripcion' => array('title' => 'Estado Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd20' => array('title' => 'Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado20_descripcion' => array('title' => 'Estado Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd21' => array('title' => 'Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado21_descripcion' => array('title' => 'Estado Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd22' => array('title' => 'Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado22_descripcion' => array('title' => 'Estado Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd23' => array('title' => 'Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado23_descripcion' => array('title' => 'Estado Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd24' => array('title' => 'Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado24_descripcion' => array('title' => 'Estado Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd25' => array('title' => 'Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado25_descripcion' => array('title' => 'Estado Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd26' => array('title' => 'Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado26_descripcion' => array('title' => 'Estado Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd27' => array('title' => 'Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado27_descripcion' => array('title' => 'Estado Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd28' => array('title' => 'Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado28_descripcion' => array('title' => 'Estado Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd29' => array('title' => 'Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado29_descripcion' => array('title' => 'Estado Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd30' => array('title' => 'Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado30_descripcion' => array('title' => 'Estado Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd31' => array('title' => 'Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado31_descripcion' => array('title' => 'Estado Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'ultimo_dia' => array('title' => 'Ultimo Dia Procesado', 'width' => 10, 'align' => 'C', 'type' => 'numeric'),
            'atrasos' => array('title' => 'Atrasos', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'faltas' => array('title' => 'Faltas', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'abandono' => array('title' => 'Abandono', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'omision' => array('title' => 'Omision', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'lsgh' => array('title' => 'LSGH', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'observacion' => array('title' => 'Observacion', 'width' => 15, 'align' => 'L', 'type' => 'varchar')
        );
        $agruparPor = ($groups!="")?explode(",",$groups):array();
        $widthsSelecteds = $this->DefineWidths($generalConfigForAllColumns, $columns,$agruparPor);
        $ancho = 0;
        if($fechaIni!=""&&$fechaFin!=""&&count($widthsSelecteds)>0) {
            foreach ($widthsSelecteds as $w) {
                $ancho = $ancho + $w;
            }
            $excel = new exceloasis();
            $excel->tableWidth = $ancho;
            #region Proceso de generación del documento Excel
            $excel->debug = 0;
            $excel->title_rpt = utf8_decode('Reporte Rango Marcaciones ('.$fechaIni.' al '.$fechaFin.')');
            $excel->header_title_empresa_rpt = utf8_decode('Empresa Estatal de Transporte por Cable "Mi Teleférico"');
            $alignSelecteds = $excel->DefineAligns($generalConfigForAllColumns, $columns, $agruparPor);
            $colSelecteds = $excel->DefineCols($generalConfigForAllColumns, $columns, $agruparPor);
            $colTitleSelecteds = $excel->DefineTitleCols($generalConfigForAllColumns, $columns, $agruparPor);
            $alignTitleSelecteds = $excel->DefineTitleAligns(count($colTitleSelecteds));
            $formatTypes = $excel->DefineTypeCols($generalConfigForAllColumns, $columns, $agruparPor);
            $gruposSeleccionadosActuales = $excel->DefineDefaultValuesForGroups($groups);
            $excel->generalConfigForAllColumns = $generalConfigForAllColumns;
            $excel->colTitleSelecteds = $colTitleSelecteds;
            if ($excel->debug == 1) {
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^COLUMNAS A MOSTRARSE^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^(".count($colSelecteds).")</p>";
                print_r($colSelecteds);
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
            }
            $excel->widthsSelecteds = $widthsSelecteds;
            $excel->alignSelecteds = $alignSelecteds;
            $excel->alignTitleSelecteds = $alignTitleSelecteds;

            $cantCol = count($colTitleSelecteds);
            $excel->ultimaLetraCabeceraTabla = $excel->columnasExcel[$cantCol-1];
            $excel->penultimaLetraCabeceraTabla = $excel->columnasExcel[$cantCol-2];
            $excel->numFilaCabeceraTabla = 4;
            $excel->primeraLetraCabeceraTabla = "A";
            $excel->segundaLetraCabeceraTabla = "B";
            $excel->celdaInicial = $excel->primeraLetraCabeceraTabla.$excel->numFilaCabeceraTabla;
            $excel->celdaFinal = $excel->ultimaLetraCabeceraTabla.$excel->numFilaCabeceraTabla;
            if($cantCol<=9){
                $excel->defineOrientation("V");
                $excel->defineSize("C");
            }elseif($cantCol<=13){
                $excel->defineOrientation("H");
                $excel->defineSize("C");
            }else{
                $excel->defineOrientation("H");
                $excel->defineSize("O");
            }
            if ($excel->debug == 1) {
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^Rango Fechas^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^</p>";
                echo $fechaIni."<-->".$fechaFin;
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::TOTAL COLUMNAS::::::::::::::::::::::::::::::::::::::::::<p>";
                print_r($columns);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::FILTROS::::::::::::::::::::::::::::::::::::::::::<p>";
                print_r($filtros);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::GRUPOS::::::::::::::::::::::::::::::::::::::::::::<p>";
                echo "<p>" . $groups;
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
                    if ($excel->debug == 1) {
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
                                    if ($excel->debug == 1) {

                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                        echo $filtros[$k]['columna'] . "-->" . $col;
                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                    }
                                    if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                        //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        if ($ini == 0) {
                                            $where .= " (";
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
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        } else $where .= " OR ";
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
                                        if ($ini == 0) {
                                            $where .= " (";
                                        }
                                        switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                            case 'int4':
                                            case 'numeric':
                                                $where .= $filtros[$k]['columna'] . " = '" . $fecha . "'";
                                                break;
                                            case 'date':
                                                //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                                if ($ini == 0) {
                                                    $where .= $filtros[$k]['columna'] . " BETWEEN ";
                                                } else {
                                                    $where .= " AND ";
                                                }
                                                $where .= "'" . $fecha . "'";

                                                break;
                                            case 'varchar':
                                            case 'bpchar':
                                                //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " ILIKE '" . $col . "'";
                                                break;
                                        }
                                        $ini++;
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        }
                                    }
                                }
                                break;
                            case 'LESS_THAN_OR_EQUAL':
                                $cond_fil .= utf8_encode(" que sea menor o igual que:  " . $filtros[$k]['valor']);
                                $where .= $filtros[$k]['columna'] . ' <= "' . $filtros[$k]['valor'] . '"';
                                break;
                        }
                        $yaConsiderados[] = $filtros[$k]['columna'];
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
            $obj = new Frelaboraleshorariosymarcaciones();
            if ($where != "") $where = " WHERE " . $where;
            $groups_aux = "";
            if ($groups != "") {
                /**
                 * Se verifica que no se considere la columna nombres debido a que contenido ya esta ordenado por las
                 * columnas p_apellido, s_apellido, c_apellido, p_anombre, s_nombre, t_nombre
                 */
                if (strrpos($groups, "nombres")) {
                    if (strrpos($groups, ",")) {
                        $arr = explode(",", $groups);
                        foreach ($arr as $val) {
                            if ($val != "nombres")
                                $groups_aux[] = $val;
                        }
                        $groups = implode(",", $groups_aux);
                    } else $groups = "";
                }
                if (is_array($sorteds) && count($sorteds) > 0) {
                    if ($groups != "") $groups .= ",";
                    $coma = "";
                    if ($excel->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                }
                if ($groups != "")
                    $groups = " ORDER BY " . $groups . ",relaboral_id,gestion,mes,turno,modalidadmarcacion_id";
                if ($excel->debug == 1) echo "<p>La consulta es: " . $groups . "<p>";
            } else {
                if (is_array($sorteds) && count($sorteds) > 0) {
                    $coma = "";
                    if ($excel->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                    $groups = " ORDER BY " . $groups;
                }

            }
            if ($excel->debug == 1) echo "<p>WHERE------------------------->" . $where . "<p>";
            if ($excel->debug == 1) echo "<p>GROUP BY------------------------->" . $groups . "<p>";
            $resul = $obj->getAllByRangeTwoMonth(0,$fechaIni,$fechaFin,$where,$groups);

            $horariosymarcaciones = array();
            foreach ($resul as $v) {
                $horariosymarcaciones[] = array(
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
                    'lsgh'=>$v->lsgh,
                    'compensacion'=>$v->compensacion,
                    'estado'=>$v->estado,
                    'estado_descripcion'=>$v->estado_descripcion,
                    'baja_logica'=>$v->baja_logica,
                    'agrupador'=>$v->agrupador,
                    'user_reg_id'=>$v->user_reg_id,
                    'fecha_reg'=>$v->fecha_reg,
                    'user_apr_id'=>$v->user_apr_id,
                    'fecha_apr'=>$v->fecha_apr,
                    'user_mod_id'=>$v->user_mod_id,
                    'fecha_mod'=>$v->fecha_mod
                );
            }
            #region Espacio para la definición de valores para la cabecera de la tabla
            $excel->FechaHoraReporte = date("d-m-Y H:i:s");
            $j = 0;
            $agrupadores = array();
            if ($groups != "")
                $agrupadores = explode(",", $groups);

            $dondeCambio = array();
            $queCambio = array();
            $excel->header();
            $fila=$excel->numFilaCabeceraTabla;
            if (count($horariosymarcaciones) > 0){
                $excel->RowTitle($colTitleSelecteds,$fila);
                $celdaInicial=$excel->primeraLetraCabeceraTabla.$fila;
                $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                if ($excel->debug == 1) {
                    echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                    print_r($horariosymarcaciones);
                    echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                }
                foreach ($horariosymarcaciones as $i => $val) {
                    if (count($agrupadores) > 0) {
                        if ($excel->debug == 1) {
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                            print_r($gruposSeleccionadosActuales);
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                        }
                        $agregarAgrupador = 0;
                        $aux = array();
                        $dondeCambio = array();
                        foreach ($gruposSeleccionadosActuales as $key => $valor) {
                            if ($valor != $val[$key]) {
                                $agregarAgrupador = 1;
                                $aux[$key] = $val[$key];
                                $dondeCambio[] = $key;
                                $queCambio[$key] = $val[$key];
                            } else {
                                $aux[$key] = $val[$key];
                            }
                        }
                        $gruposSeleccionadosActuales = $aux;
                        if ($agregarAgrupador == 1) {
                            $agr = $excel->DefineTitleColsByGroups($generalConfigForAllColumns, $dondeCambio, $queCambio);
                            if($excel->debug==1){
                                echo "<p>+++++++++++++++++++++++++++AGRUPADO POR++++++++++++++++++++++++++++++++++++++++<p></p>";
                                print_r($agr);
                                echo "<p>+++++++++++++++++++++++++++AGRUPADO POR++++++++++++++++++++++++++++++++++++++++<p></p>";
                            }
                            $excel->borderGroup($celdaInicial,$celdaFinalDiagonalTabla);
                            $fila++;
                            /*
                             * Si es que hay agrupadores, se inicia el conteo desde donde empieza el agrupador
                             */
                            $celdaInicial=$excel->primeraLetraCabeceraTabla.$fila;
                            $excel->Agrupador($agr,$fila);
                            $excel->RowTitle($colTitleSelecteds,$fila);
                        }
                        $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                        $rowData = $excel->DefineRows($j + 1, $horariosymarcaciones[$j], $colSelecteds);
                        if ($excel->debug == 1) {
                            echo "<p>···································FILA·················································<p></p>";
                            print_r($rowData);
                            echo "<p>···································FILA·················································<p></p>";
                        }
                        $excel->Row($rowData,$alignSelecteds,$formatTypes,$fila);
                        $fila++;

                    } else {
                        $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                        $rowData = $excel->DefineRows($j + 1, $val, $colSelecteds);
                        if ($excel->debug == 1) {
                            echo "<p>···································FILA·················································<p></p>";
                            print_r($rowData);
                            echo "<p>···································FILA·················································<p></p>";
                        }
                        $excel->Row($rowData,$alignSelecteds,$formatTypes,$fila);
                        $fila++;
                    }
                    $j++;
                }
                $fila--;
                $celdaFinalDiagonalTabla=$excel->ultimaLetraCabeceraTabla.$fila;
                $excel->borderGroup($celdaInicial,$celdaFinalDiagonalTabla);
            }
            $excel->ShowLeftFooter = true;
            //$excel->secondPage();
            if ($excel->debug == 0) {
                $excel->display("AppData/reporte_marcaciones.xls","I");
            }
            #endregion Proceso de generación del documento PDF
        }
    }

    /**
     * Función para el despliegue del reporte de marcaciones en formato PDF.
     * @param $idRelaboral
     * @param $n_rows
     * @param $columns
     * @param $filtros
     * @param $groups
     * @param $sorteds
     */
    public function exportmarcacionespdfAction($idRelaboral,$n_rows, $columns, $filtros,$groups,$sorteds)
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
            'estado_descripcion' => array('title' => 'Estado', 'width' => 15, 'align' => 'C', 'type' => 'varchar'),
            'gestion' => array('title' => 'Gestion', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'mes_nombre' => array('title' => 'Mes', 'width' => 20, 'align' => 'C', 'type' => 'varchar'),
            'turno' => array('title' => 'Turno', 'width' => 10, 'align' => 'C', 'type' => 'numeric'),
            'modalidad_marcacion' => array('title' => 'Modalidad', 'width' => 30, 'align' => 'C', 'type' => 'varchar'),
            'd1' => array('title' => 'Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado1_descripcion' => array('title' => 'Estado Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd2' => array('title' => 'Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado2_descripcion' => array('title' => 'Estado Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd3' => array('title' => 'Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado3_descripcion' => array('title' => 'Estado Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd4' => array('title' => 'Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado4_descripcion' => array('title' => 'Estado Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd5' => array('title' => 'Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado5_descripcion' => array('title' => 'Estado Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd6' => array('title' => 'Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado6_descripcion' => array('title' => 'Estado Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd7' => array('title' => 'Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado7_descripcion' => array('title' => 'Estado Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd8' => array('title' => 'Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado8_descripcion' => array('title' => 'Estado Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd9' => array('title' => 'Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado9_descripcion' => array('title' => 'Estado Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd10' => array('title' => 'Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado10_descripcion' => array('title' => 'Estado Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd11' => array('title' => 'Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado11_descripcion' => array('title' => 'Estado Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd12' => array('title' => 'Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado12_descripcion' => array('title' => 'Estado Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd13' => array('title' => 'Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado13_descripcion' => array('title' => 'Estado Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd14' => array('title' => 'Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado14_descripcion' => array('title' => 'Estado Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd15' => array('title' => 'Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado15_descripcion' => array('title' => 'Estado Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd16' => array('title' => 'Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado16_descripcion' => array('title' => 'Estado Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd17' => array('title' => 'Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado17_descripcion' => array('title' => 'Estado Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd18' => array('title' => 'Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado18_descripcion' => array('title' => 'Estado Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd19' => array('title' => 'Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado19_descripcion' => array('title' => 'Estado Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd20' => array('title' => 'Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado20_descripcion' => array('title' => 'Estado Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd21' => array('title' => 'Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado21_descripcion' => array('title' => 'Estado Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd22' => array('title' => 'Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado22_descripcion' => array('title' => 'Estado Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd23' => array('title' => 'Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado23_descripcion' => array('title' => 'Estado Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd24' => array('title' => 'Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado24_descripcion' => array('title' => 'Estado Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd25' => array('title' => 'Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado25_descripcion' => array('title' => 'Estado Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd26' => array('title' => 'Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado26_descripcion' => array('title' => 'Estado Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd27' => array('title' => 'Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado27_descripcion' => array('title' => 'Estado Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd28' => array('title' => 'Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado28_descripcion' => array('title' => 'Estado Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd29' => array('title' => 'Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado29_descripcion' => array('title' => 'Estado Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd30' => array('title' => 'Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado30_descripcion' => array('title' => 'Estado Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd31' => array('title' => 'Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado31_descripcion' => array('title' => 'Estado Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'ultimo_dia' => array('title' => 'U/Dia', 'width' => 10, 'align' => 'C', 'type' => 'numeric'),
            'atrasos' => array('title' => 'Atrasos', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'faltas' => array('title' => 'Faltas', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'abandono' => array('title' => 'Abandono', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'omision' => array('title' => 'Omision', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'lsgh' => array('title' => 'LSGH', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'observacion' => array('title' => 'Obs.', 'width' => 30, 'align' => 'L', 'type' => 'varchar')
        );
        $agruparPor = ($groups!="")?explode(",",$groups):array();
        $widthsSelecteds = $this->DefineWidths($generalConfigForAllColumns, $columns,$agruparPor);
        $ancho = 0;
        if(count($widthsSelecteds)>0) {
            foreach ($widthsSelecteds as $w) {
                $ancho = $ancho + $w;
            }
            if ($ancho > 215.9) {
                if ($ancho > 270) {
                    $pdf = new pdfoasis('L', 'mm', 'Legal');
                    $pdf->pageWidth = 355;
                } else {
                    $pdf = new pdfoasis('L', 'mm', 'Letter');
                    $pdf->pageWidth = 280;
                }
            } else {
                $pdf = new pdfoasis('P', 'mm', 'Letter');
                $pdf->pageWidth = 215.9;
            }
            $pdf->tableWidth = $ancho;
            #region Proceso de generación del documento PDF
            $pdf->debug =0;
            $pdf->title_rpt = utf8_decode('Reporte Marcaciones');
            $pdf->header_title_empresa_rpt = utf8_decode('Empresa Estatal de Transporte por Cable "Mi Teleférico"');
            $alignSelecteds = $pdf->DefineAligns($generalConfigForAllColumns, $columns, $agruparPor);
            $colSelecteds = $pdf->DefineCols($generalConfigForAllColumns, $columns, $agruparPor);
            if ($pdf->debug == 1) {
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^COLUMNAS A MOSTRARSE^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^(".count($colSelecteds).")</p>";
                print_r($colSelecteds);
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
            }
            $colTitleSelecteds = $pdf->DefineTitleCols($generalConfigForAllColumns, $columns, $agruparPor);
            $alignTitleSelecteds = $pdf->DefineTitleAligns(count($colTitleSelecteds));
            $gruposSeleccionadosActuales = $pdf->DefineDefaultValuesForGroups($groups);
            $pdf->generalConfigForAllColumns = $generalConfigForAllColumns;
            $pdf->colTitleSelecteds = $colTitleSelecteds;
            $pdf->widthsSelecteds = $widthsSelecteds;
            $pdf->alignSelecteds = $alignSelecteds;
            $pdf->alignTitleSelecteds = $alignTitleSelecteds;
            if ($pdf->debug == 1) {
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^idRelaboral^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
                echo "<p>".$idRelaboral;
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::TOTAL COLUMNAS::::::::::::::::::::::::::::::::::::::::::(".count($columns).")<p>";
                print_r($columns);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::FILTROS::::::::::::::::::::::::::::::::::::::::::(".count($filtros).")<p>";
                print_r($filtros);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::GRUPOS::::::::::::::::::::::::::::::::::::::::::::<p>";
                echo "<p>" . $groups;
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
                    if ($pdf->debug == 1) {
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
                                $where .= $filtros[$k]['columna'] . " ILIKE '%" . $filtros[$k]['valor'] . "%'";
                                break;
                            case 'EQUAL':
                                $cond_fil .= utf8_encode(" que contenga el valor:  " . $filtros[$k]['valor']);
                                $ini = 0;
                                foreach ($arr_val as $col) {
                                    if ($pdf->debug == 1) {

                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                        echo $filtros[$k]['columna'] . "-->" . $col;
                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                    }
                                    if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                        //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        if ($ini == 0) {
                                            $where .= " (";
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
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        } else $where .= " OR ";
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
                                        if ($ini == 0) {
                                            $where .= " (";
                                        }
                                        switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                            case 'int4':
                                            case 'numeric':
                                                $where .= $filtros[$k]['columna'] . " = '" . $fecha . "'";
                                                break;
                                            case 'date':
                                                //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                                if ($ini == 0) {
                                                    $where .= $filtros[$k]['columna'] . " BETWEEN ";
                                                } else {
                                                    $where .= " AND ";
                                                }
                                                $where .= "'" . $fecha . "'";

                                                break;
                                            case 'varchar':
                                            case 'bpchar':
                                                //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " ILIKE '" . $col . "'";
                                                break;
                                        }
                                        $ini++;
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        }
                                    }
                                }
                                break;
                            case 'LESS_THAN_OR_EQUAL':
                                $cond_fil .= utf8_encode(" que sea menor o igual que:  " . $filtros[$k]['valor']);
                                $where .= $filtros[$k]['columna'] . ' <= "' . $filtros[$k]['valor'] . '"';
                                break;
                        }
                        $yaConsiderados[] = $filtros[$k]['columna'];
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
                            $where .= $filtros[$k]['columna'] . " ILIKE '%" . $filtros[$k]['valor'] . "%'";
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
            $obj = new Fhorariosymarcaciones();
            if ($where != "") $where = " WHERE " . $where;
            $groups_aux = "";
            if ($groups != "") {
                /**
                 * Se verifica que no se considere la columna nombres debido a que contenido ya esta ordenado por las
                 * columnas p_apellido, s_apellido, c_apellido, p_anombre, s_nombre, t_nombre
                 */
                /*if (strrpos($groups, "nombres")) {
                    if (strrpos($groups, ",")) {
                        $arr = explode(",", $groups);
                        foreach ($arr as $val) {
                            if ($val != "nombres")
                                $groups_aux[] = $val;
                        }
                        $groups = implode(",", $groups_aux);
                    } else $groups = "";
                }*/
                if (is_array($sorteds) && count($sorteds) > 0) {
                    if ($groups != "") $groups .= ",";
                    $coma = "";
                    if ($pdf->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                }
                if ($groups != "")
                    $groups = " ORDER BY " . $groups . ",relaboral_id,gestion,mes,turno,modalidadmarcacion_id";
                if ($pdf->debug == 1) echo "<p>La consulta es: " . $groups . "<p>";
            } else {
                if (is_array($sorteds) && count($sorteds) > 0) {
                    $coma = "";
                    if ($pdf->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                    $groups = " ORDER BY " . $groups;
                }

            }
            if ($pdf->debug == 1) echo "<p>WHERE------------------------->" . $where . "<p>";
            if ($pdf->debug == 1) echo "<p>GROUP BY------------------------->" . $groups . "<p>";
            $resul = $obj->getAll("WHERE relaboral_id=".$idRelaboral,$groups);

            $horariosymarcaciones = array();
            foreach ($resul as $v) {
                $horariosymarcaciones[] = array(
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
                    'lsgh'=>$v->lsgh,
                    'compensacion'=>$v->compensacion,
                    'observacion'=>$v->observacion,
                    'estado'=>$v->estado,
                    'estado_descripcion'=>$v->estado_descripcion
                );
            }
            //$pdf->Open("L");
            /**
             * Si el ancho supera el establecido para una hoja tamaño carta, se la pone en posición horizontal
             */

            $pdf->AddPage();
            if ($pdf->debug == 1) {
                echo "<p>El ancho es:: " . $ancho;
            }
            #region Espacio para la definición de valores para la cabecera de la tabla
            $pdf->FechaHoraReporte = date("d-m-Y H:i:s");
            $j = 0;
            $agrupadores = array();
            //echo "<p>++++++++++>".$groups;
            if ($groups != "")
                $agrupadores = explode(",", $groups);

            $dondeCambio = array();
            $queCambio = array();

            if (count($horariosymarcaciones) > 0){
                foreach ($horariosymarcaciones as $i => $val) {
                    if (($pdf->pageWidth - $pdf->tableWidth) > 0) $pdf->SetX(($pdf->pageWidth - $pdf->tableWidth) / 2);
                    if (count($agrupadores) > 0) {
                        if ($pdf->debug == 1) {
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                            print_r($gruposSeleccionadosActuales);
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                        }
                        $agregarAgrupador = 0;
                        $aux = array();
                        $dondeCambio = array();
                        foreach ($gruposSeleccionadosActuales as $key => $valor) {
                            if ($valor != $val[$key]) {
                                $agregarAgrupador = 1;
                                $aux[$key] = $val[$key];
                                $dondeCambio[] = $key;
                                $queCambio[$key] = $val[$key];
                            } else {
                                $aux[$key] = $val[$key];
                            }
                        }
                        $gruposSeleccionadosActuales = $aux;
                        if ($agregarAgrupador == 1) {
                            $pdf->Ln();
                            $pdf->DefineColorHeaderTable();
                            $pdf->SetAligns($alignTitleSelecteds);
                            //if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                            $agr = $pdf->DefineTitleColsByGroups($generalConfigForAllColumns, $dondeCambio, $queCambio);
                            $pdf->Agrupador($agr);
                            $pdf->RowTitle($colTitleSelecteds);
                        }
                        $pdf->DefineColorBodyTable();
                        $pdf->SetAligns($alignSelecteds);
                        if (($pdf->pageWidth - $pdf->tableWidth) > 0) $pdf->SetX(($pdf->pageWidth - $pdf->tableWidth) / 2);
                        $rowData = $pdf->DefineRows($j + 1, $horariosymarcaciones[$j], $colSelecteds);
                        $pdf->Row($rowData);

                    } else {
                        //if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                        if($pdf->debug==1){
                            echo "<p>***********************************VALOR POR LA LINEA ".($j + 1)."***************************************************</p>";
                            print_r($val);
                            echo "<p>***************************************************************************************</p>";
                        }
                        $pdf->DefineColorBodyTable();
                        $pdf->SetAligns($alignSelecteds);
                        $rowData = $pdf->DefineRows($j + 1, $val, $colSelecteds);
                        $pdf->Row($rowData);
                    }
                    //if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                    $j++;
                }
            }
            $pdf->ShowLeftFooter = true;
            if($pdf->debug==0)$pdf->Output('reporte_marcaciones.pdf','I');
            #endregion Proceso de generación del documento PDF
        }
    }
    /**
     * Función para el despliegue del reporte de cálculos de marcaciones en formato PDF.
     * @param $fechaIni
     * @param $fechaFin
     * @param $n_rows
     * @param $columns
     * @param $filtros
     * @param $groups
     * @param $sorteds
     */
    public function exportcalculospdfAction($fechaIni,$fechaFin,$n_rows, $columns, $filtros,$groups,$sorteds)
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
            'nombres' => array('title' => 'Nombres', 'width' => 50, 'align' => 'L', 'type' => 'varchar'),
            'ci' => array('title' => 'CI', 'width' => 30, 'align' => 'C', 'type' => 'varchar'),
            'expd' => array('title' => 'EXP', 'width' => 10, 'align' => 'C', 'type' => 'varchar'),
            'estado_descripcion' => array('title' => 'Estado', 'width' => 15, 'align' => 'C', 'type' => 'varchar'),
            'gestion' => array('title' => 'Gestion', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'mes_nombre' => array('title' => 'Mes', 'width' => 20, 'align' => 'C', 'type' => 'varchar'),
            'turno' => array('title' => 'Turno', 'width' => 10, 'align' => 'C', 'type' => 'numeric'),
            'modalidad_marcacion' => array('title' => 'Modalidad', 'width' => 30, 'align' => 'C', 'type' => 'varchar'),
            'd1' => array('title' => 'Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado1_descripcion' => array('title' => 'Estado Dia 1', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd2' => array('title' => 'Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado2_descripcion' => array('title' => 'Estado Dia 2', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd3' => array('title' => 'Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado3_descripcion' => array('title' => 'Estado Dia 3', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd4' => array('title' => 'Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado4_descripcion' => array('title' => 'Estado Dia 4', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd5' => array('title' => 'Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado5_descripcion' => array('title' => 'Estado Dia 5', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd6' => array('title' => 'Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado6_descripcion' => array('title' => 'Estado Dia 6', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd7' => array('title' => 'Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado7_descripcion' => array('title' => 'Estado Dia 7', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd8' => array('title' => 'Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado8_descripcion' => array('title' => 'Estado Dia 8', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd9' => array('title' => 'Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado9_descripcion' => array('title' => 'Estado Dia 9', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd10' => array('title' => 'Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado10_descripcion' => array('title' => 'Estado Dia 10', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd11' => array('title' => 'Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado11_descripcion' => array('title' => 'Estado Dia 11', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd12' => array('title' => 'Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado12_descripcion' => array('title' => 'Estado Dia 12', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd13' => array('title' => 'Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado13_descripcion' => array('title' => 'Estado Dia 13', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd14' => array('title' => 'Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado14_descripcion' => array('title' => 'Estado Dia 14', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd15' => array('title' => 'Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado15_descripcion' => array('title' => 'Estado Dia 15', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd16' => array('title' => 'Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado16_descripcion' => array('title' => 'Estado Dia 16', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd17' => array('title' => 'Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado17_descripcion' => array('title' => 'Estado Dia 17', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd18' => array('title' => 'Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado18_descripcion' => array('title' => 'Estado Dia 18', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd19' => array('title' => 'Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado19_descripcion' => array('title' => 'Estado Dia 19', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd20' => array('title' => 'Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado20_descripcion' => array('title' => 'Estado Dia 20', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd21' => array('title' => 'Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado21_descripcion' => array('title' => 'Estado Dia 21', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd22' => array('title' => 'Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado22_descripcion' => array('title' => 'Estado Dia 22', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd23' => array('title' => 'Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado23_descripcion' => array('title' => 'Estado Dia 23', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd24' => array('title' => 'Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado24_descripcion' => array('title' => 'Estado Dia 24', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd25' => array('title' => 'Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado25_descripcion' => array('title' => 'Estado Dia 25', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd26' => array('title' => 'Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado26_descripcion' => array('title' => 'Estado Dia 26', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd27' => array('title' => 'Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado27_descripcion' => array('title' => 'Estado Dia 27', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd28' => array('title' => 'Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado28_descripcion' => array('title' => 'Estado Dia 28', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd29' => array('title' => 'Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado29_descripcion' => array('title' => 'Estado Dia 29', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd30' => array('title' => 'Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado30_descripcion' => array('title' => 'Estado Dia 30', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'd31' => array('title' => 'Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'date'),
            /*'estado31_descripcion' => array('title' => 'Estado Dia 31', 'width' => 18, 'align' => 'C', 'type' => 'varchar'),*/
            'ultimo_dia' => array('title' => 'U/Dia', 'width' => 10, 'align' => 'C', 'type' => 'numeric'),
            'atrasos' => array('title' => 'Atrasos', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'faltas' => array('title' => 'Faltas', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'abandono' => array('title' => 'Abandono', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'omision' => array('title' => 'Omision', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'lsgh' => array('title' => 'LSGH', 'width' => 20, 'align' => 'C', 'type' => 'numeric'),
            'observacion' => array('title' => 'Obs.', 'width' => 30, 'align' => 'L', 'type' => 'varchar')
        );
        $agruparPor = ($groups!="")?explode(",",$groups):array();
        $widthsSelecteds = $this->DefineWidths($generalConfigForAllColumns, $columns,$agruparPor);
        $ancho = 0;
        if(count($widthsSelecteds)>0) {
            foreach ($widthsSelecteds as $w) {
                $ancho = $ancho + $w;
            }
            if ($ancho > 215.9) {
                if ($ancho > 270) {
                    $pdf = new pdfoasis('L', 'mm', 'Legal');
                    $pdf->pageWidth = 355;
                } else {
                    $pdf = new pdfoasis('L', 'mm', 'Letter');
                    $pdf->pageWidth = 280;
                }
            } else {
                $pdf = new pdfoasis('P', 'mm', 'Letter');
                $pdf->pageWidth = 215.9;
            }
            $pdf->tableWidth = $ancho;
            #region Proceso de generación del documento PDF
            $pdf->debug =0;
            $pdf->title_rpt = utf8_decode('Reporte Rango Marcaciones ('.$fechaIni.' al '.$fechaFin.')');
            $pdf->header_title_empresa_rpt = utf8_decode('Empresa Estatal de Transporte por Cable "Mi Teleférico"');
            $alignSelecteds = $pdf->DefineAligns($generalConfigForAllColumns, $columns, $agruparPor);
            $colSelecteds = $pdf->DefineCols($generalConfigForAllColumns, $columns, $agruparPor);
            if ($pdf->debug == 1) {
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^COLUMNAS A MOSTRARSE^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^(".count($colSelecteds).")</p>";
                print_r($colSelecteds);
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
            }
            $colTitleSelecteds = $pdf->DefineTitleCols($generalConfigForAllColumns, $columns, $agruparPor);
            $alignTitleSelecteds = $pdf->DefineTitleAligns(count($colTitleSelecteds));
            $gruposSeleccionadosActuales = $pdf->DefineDefaultValuesForGroups($groups);
            $pdf->generalConfigForAllColumns = $generalConfigForAllColumns;
            $pdf->colTitleSelecteds = $colTitleSelecteds;
            $pdf->widthsSelecteds = $widthsSelecteds;
            $pdf->alignSelecteds = $alignSelecteds;
            $pdf->alignTitleSelecteds = $alignTitleSelecteds;
            if ($pdf->debug == 1) {
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^Rango Fecha^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
                echo $fechaIni."<->".$fechaFin;
                echo "<p>^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::TOTAL COLUMNAS::::::::::::::::::::::::::::::::::::::::::(".count($columns).")<p>";
                print_r($columns);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::FILTROS::::::::::::::::::::::::::::::::::::::::::(".count($filtros).")<p>";
                print_r($filtros);
                echo "<p>::::::::::::::::::::::::::::::::::::::::::::GRUPOS::::::::::::::::::::::::::::::::::::::::::::<p>";
                echo "<p>" . $groups;
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
                    if ($pdf->debug == 1) {
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
                                    if ($pdf->debug == 1) {

                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                        echo $filtros[$k]['columna'] . "-->" . $col;
                                        echo "<p>.........................recorriendo las columnas multiseleccionadas: .............................................";
                                    }
                                    if (isset($generalConfigForAllColumns[$filtros[$k]['columna']]['type'])) {
                                        //$where .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                        if ($ini == 0) {
                                            $where .= " (";
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
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        } else $where .= " OR ";
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
                                        if ($ini == 0) {
                                            $where .= " (";
                                        }
                                        switch (@$generalConfigForAllColumns[$filtros[$k]['columna']]['type']) {
                                            case 'int4':
                                            case 'numeric':
                                                $where .= $filtros[$k]['columna'] . " = '" . $fecha . "'";
                                                break;
                                            case 'date':
                                                //$whereEqueals .= $filtros[$k]['columna']." = '".$filtros[$k]['valor']."'";
                                                if ($ini == 0) {
                                                    $where .= $filtros[$k]['columna'] . " BETWEEN ";
                                                } else {
                                                    $where .= " AND ";
                                                }
                                                $where .= "'" . $fecha . "'";

                                                break;
                                            case 'varchar':
                                            case 'bpchar':
                                                //$whereEqueals .= $filtros[$k]['columna']." ILIKE '".$filtros[$k]['valor']."'";
                                                $where .= $filtros[$k]['columna'] . " ILIKE '" . $col . "'";
                                                break;
                                        }
                                        $ini++;
                                        if ($ini == count($arr_val)) {
                                            $where .= ") ";
                                        }
                                    }
                                }
                                break;
                            case 'LESS_THAN_OR_EQUAL':
                                $cond_fil .= utf8_encode(" que sea menor o igual que:  " . $filtros[$k]['valor']);
                                $where .= $filtros[$k]['columna'] . ' <= "' . $filtros[$k]['valor'] . '"';
                                break;
                        }
                        $yaConsiderados[] = $filtros[$k]['columna'];
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
            $obj = new Frelaboraleshorariosymarcaciones();
            if ($where != "") $where = " WHERE " . $where;
            $groups_aux = "";
            if ($groups != "") {
                /**
                 * Se verifica que no se considere la columna nombres debido a que contenido ya esta ordenado por las
                 * columnas p_apellido, s_apellido, c_apellido, p_anombre, s_nombre, t_nombre
                 */
                if (strrpos($groups, "nombres")) {
                    if (strrpos($groups, ",")) {
                        $arr = explode(",", $groups);
                        foreach ($arr as $val) {
                            if ($val != "nombres")
                                $groups_aux[] = $val;
                        }
                        $groups = implode(",", $groups_aux);
                    } else $groups = "";
                }
                if (is_array($sorteds) && count($sorteds) > 0) {
                    if ($groups != "") $groups .= ",";
                    $coma = "";
                    if ($pdf->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                }
                if ($groups != "")
                    $groups = " ORDER BY " . $groups . ",relaboral_id,gestion,mes,turno,modalidadmarcacion_id";
                if ($pdf->debug == 1) echo "<p>La consulta es: " . $groups . "<p>";
            } else {
                if (is_array($sorteds) && count($sorteds) > 0) {
                    $coma = "";
                    if ($pdf->debug == 1) {
                        echo "<p>===========================================Orden======================================</p>";
                        print_r($sorteds);
                        echo "<p>===========================================Orden======================================</p>";
                    }
                    foreach ($sorteds as $ord => $orden) {
                        $groups .= $coma . $ord;
                        if ($orden['asc'] == '') $groups .= " ASC"; else$groups .= " DESC";
                        $coma = ",";
                    }
                    $groups = " ORDER BY " . $groups;
                }

            }
            if ($pdf->debug == 1) echo "<p>WHERE------------------------->" . $where . "<p>";
            if ($pdf->debug == 1) echo "<p>GROUP BY------------------------->" . $groups . "<p>";
            $resul = $obj->getAllByRangeTwoMonth(0,$fechaIni,$fechaFin,$where,$groups);

            $horariosymarcaciones = array();
            foreach ($resul as $v) {
                $horariosymarcaciones[] = array(
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
                    'lsgh'=>$v->lsgh,
                    'compensacion'=>$v->compensacion,
                    'estado'=>$v->estado,
                    'estado_descripcion'=>$v->estado_descripcion,
                    'baja_logica'=>$v->baja_logica,
                    'agrupador'=>$v->agrupador,
                    'user_reg_id'=>$v->user_reg_id,
                    'fecha_reg'=>$v->fecha_reg,
                    'user_apr_id'=>$v->user_apr_id,
                    'fecha_apr'=>$v->fecha_apr,
                    'user_mod_id'=>$v->user_mod_id,
                    'fecha_mod'=>$v->fecha_mod
                );
            }
            //$pdf->Open("L");
            /**
             * Si el ancho supera el establecido para una hoja tamaño carta, se la pone en posición horizontal
             */

            $pdf->AddPage();
            if ($pdf->debug == 1) {
                echo "<p>El ancho es:: " . $ancho;
            }
            #region Espacio para la definición de valores para la cabecera de la tabla
            $pdf->FechaHoraReporte = date("d-m-Y H:i:s");
            $j = 0;
            $agrupadores = array();
            //echo "<p>++++++++++>".$groups;
            if ($groups != "")
                $agrupadores = explode(",", $groups);

            $dondeCambio = array();
            $queCambio = array();

            if (count($horariosymarcaciones) > 0){
                foreach ($horariosymarcaciones as $i => $val) {
                    if (($pdf->pageWidth - $pdf->tableWidth) > 0) $pdf->SetX(($pdf->pageWidth - $pdf->tableWidth) / 2);
                    if (count($agrupadores) > 0) {
                        if ($pdf->debug == 1) {
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                            print_r($gruposSeleccionadosActuales);
                            echo "<p>|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||<p></p>";
                        }
                        $agregarAgrupador = 0;
                        $aux = array();
                        $dondeCambio = array();
                        foreach ($gruposSeleccionadosActuales as $key => $valor) {
                            if ($valor != $val[$key]) {
                                $agregarAgrupador = 1;
                                $aux[$key] = $val[$key];
                                $dondeCambio[] = $key;
                                $queCambio[$key] = $val[$key];
                            } else {
                                $aux[$key] = $val[$key];
                            }
                        }
                        $gruposSeleccionadosActuales = $aux;
                        if ($agregarAgrupador == 1) {
                            $pdf->Ln();
                            $pdf->DefineColorHeaderTable();
                            $pdf->SetAligns($alignTitleSelecteds);
                            //if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                            $agr = $pdf->DefineTitleColsByGroups($generalConfigForAllColumns, $dondeCambio, $queCambio);
                            $pdf->Agrupador($agr);
                            $pdf->RowTitle($colTitleSelecteds);
                        }
                        $pdf->DefineColorBodyTable();
                        $pdf->SetAligns($alignSelecteds);
                        if (($pdf->pageWidth - $pdf->tableWidth) > 0) $pdf->SetX(($pdf->pageWidth - $pdf->tableWidth) / 2);
                        $rowData = $pdf->DefineRows($j + 1, $horariosymarcaciones[$j], $colSelecteds);
                        $pdf->Row($rowData);

                    } else {
                        //if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                        if($pdf->debug==1){
                            echo "<p>***********************************VALOR POR LA LINEA ".($j + 1)."***************************************************</p>";
                            print_r($val);
                            echo "<p>***************************************************************************************</p>";
                        }
                        $pdf->DefineColorBodyTable();
                        $pdf->SetAligns($alignSelecteds);
                        $rowData = $pdf->DefineRows($j + 1, $val, $colSelecteds);
                        $pdf->Row($rowData);
                    }
                    //if(($pdf->pageWidth-$pdf->tableWidth)>0)$pdf->SetX(($pdf->pageWidth-$pdf->tableWidth)/2);
                    $j++;
                }
            }
            $pdf->ShowLeftFooter = true;
            if($pdf->debug==0)$pdf->Output('reporte_marcaciones.pdf','I');
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
} 