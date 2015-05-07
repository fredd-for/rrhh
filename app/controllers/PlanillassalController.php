<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  22-04-2015
*/
class PlanillassalController extends ControllerBase{
    public function initialize()
    {
        parent::initialize();
    }
    /**
     * Función para la carga de la página de gestión de excepciones.
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
        $this->assets->addJs('/js/jqwidgets/jqxgrid.aggregates.js');

        $this->assets->addJs('/js/colorpicker-master/js/evol.colorpicker.min.js');
        $this->assets->addCss('/js/colorpicker-master/css/evol.colorpicker.css');

        $this->assets->addJs('/js/planillassal/oasis.planillassal.tab.js');
        $this->assets->addJs('/js/planillassal/oasis.planillassal.index.js');
        $this->assets->addJs('/js/planillassal/oasis.planillassal.new.edit.js');
        $this->assets->addJs('/js/planillassal/oasis.planillassal.approve.js');
        $this->assets->addJs('/js/planillassal/oasis.planillassal.export.js');
        $this->assets->addJs('/js/planillassal/oasis.planillassal.down.js');
    }

    /**
     * Función para la obtención del listado de planillas registradas en el sistema.
     */
    public function listAction(){
        $this->view->disable();
        $obj = new Fplanillassal();
        $planillassal = Array();
        $resul = $obj->getAll();
        //comprobamos si hay filas
        if ($resul->count() > 0) {
            foreach ($resul as $v) {
                $planillassal[] = array(
                    'id'=>$v->id,
                    'da_id'=>$v->da_id,
                    'ejecutora_id'=>$v->ejecutora_id,
                    'unidad_ejecutora'=>$v->unidad_ejecutora,
                    'regional_id'=>$v->regional_id,
                    'regional'=>$v->regional,
                    'gestion'=>$v->gestion,
                    'mes'=>$v->mes,
                    'mes_nombre'=>$v->mes_nombre,
                    'finpartida_id'=>$v->finpartida_id,
                    'fin_partida'=>$v->fin_partida,
                    'condicion_id'=>$v->condicion_id,
                    'condicion'=>$v->condicion,
                    'tipoplanilla_id'=>$v->tipoplanilla_id,
                    'tipo_planilla'=>$v->tipo_planilla,
                    'numero'=>$v->numero,
                    'total_ganado'=>$v->total_ganado,
                    'total_liquido'=>$v->total_liquido,
                    'observacion'=>$v->observacion,
                    'motivo_anu'=>$v->motivo_anu,
                    'estado'=>$v->estado,
                    'estado_descripcion'=>$v->estado_descripcion,
                    'baja_logica'=>$v->baja_logica,
                    'agrupador'=>$v->agrupador,
                    'user_reg_id'=>$v->user_reg_id,
                    'fecha_reg'=>$v->fecha_reg,
                    'user_mod_id'=>$v->user_mod_id,
                    'fecha_mod'=>$v->fecha_mod,
                    'user_ver_id'=>$v->user_ver_id,
                    'fecha_ver'=>$v->fecha_ver,
                    'user_apr_id'=>$v->user_apr_id,
                    'fecha_apr'=>$v->fecha_apr,
                    'user_rev_id'=>$v->user_rev_id,
                    'fecha_rev'=>$v->fecha_rev,
                    'user_anu_id'=>$v->user_anu_id,
                    'fecha_anu'=>$v->fecha_anu
                );
            }
        }
        echo json_encode($planillassal);
    }

    /**
     * Función para la obtención del listado de gestiones disponibles para la generación de planillas salariales.
     */
    public function getgestionesgeneracionAction(){
        $this->view->disable();
        $rangoGestiones = [];
        $hoy = date("Y-m-d");
        $objPlanilla = new Fplanillassal();
        $resul = $objPlanilla->getGestionesGeneracionPlanillas(NULL);
        if ($resul->count() > 0) {
            foreach ($resul as $v) {
                $rangoGestiones[] = $v->o_gestiones;
            }
        }
        echo json_encode($rangoGestiones);
    }

    /**
     * Función para la obtención del listado de meses disponibles para la generación de planillas salariales.
     */
    public function getmesesgeneracionAction(){
        $this->view->disable();
        $meses = [];
        if(isset($_POST["gestion"])&&$_POST["gestion"]>0){
            $objPlanilla = new Fplanillassal();
            $resul = $objPlanilla->getMesesGeneracionPlanillas($_POST["gestion"]);
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $meses[] = array(
                        'mes'=>$v->mes,
                        'mes_nombre' => $v->mes_nombre
                    );
                }
            }
        }
        echo json_encode($meses);
    }

    /**
     * Función para la obtención del listado de financimientos por partida disponibles para la generación de planillas salariales,
     * considerando una gestión y mes particulares.
     */
    public function getfinpartidasgeneracionAction(){
        $this->view->disable();
        $finpartidas = [];
        if(isset($_POST["gestion"])&&$_POST["gestion"]>0&&isset($_POST["mes"])&&$_POST["mes"]>0){
            $objPlanilla = new Fplanillassal();
            $resul = $objPlanilla->getFinPartidasGeneracionPlanillas($_POST["gestion"],$_POST["mes"]);
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $finpartidas[] = array(
                        'id_finpartida'=>$v->id_finpartida,
                        'fin_partida' => $v->fin_partida
                    );
                }
            }
        }
        echo json_encode($finpartidas);
    }
    /**
     * Función para la obtención del listado de tipos de planilla salarial disponibles.
     */
    public function gettiposplanillassalAction(){
        $this->view->disable();
        $tipos_planillas = [];
        if(isset($_POST["gestion"])&&$_POST["gestion"]>0&&isset($_POST["mes"])&&$_POST["mes"]>0&&isset($_POST["id_finpartida"])&&$_POST["id_finpartida"]>0){
            $objPlanilla = new Fplanillassal();
            $resul = $objPlanilla->getTiposPlanillasGeneracionPlanillas($_POST["gestion"],$_POST["mes"],$_POST["id_finpartida"]);
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $tipos_planillas[] = array(
                        'id_tipoplanilla'=>$v->id_tipoplanilla,
                        'numero' => $v->numero,
                        'tipo_planilla_disponible' => $v->tipo_planilla_disponible
                    );
                }
            }
        }
        echo json_encode($tipos_planillas);
    }

    /**
     * Función para la generación de planillas salariales.
     */
    public function displayplanpreviaAction(){
        $this->view->disable();
        $obj = new Fplanillassal();
        $planillassal = Array();
        $gestion = 0;
        $mes = 0;
        $idFinPartida = 0;
        $idTipoPlanilla = 0;
        $numeroPlanilla = 0;
        if(isset($_GET["gestion"])&&$_GET["gestion"]>0)
            $gestion = $_GET["gestion"];
        if(isset($_GET["mes"])&&$_GET["mes"]>0)
            $mes = $_GET["mes"];
        if(isset($_GET["id_finpartida"])&&$_GET["id_finpartida"]>0)
            $idFinPartida = $_GET["id_finpartida"];
        if(isset($_GET["id_tipoplanilla"])&&$_GET["id_tipoplanilla"]>0)
            $idTipoPlanilla = $_GET["id_tipoplanilla"];
        if(isset($_GET["numero"])&&$_GET["numero"]>0)
            $numeroPlanilla = $_GET["numero"];
        if($gestion>0&&$mes>0&&$idFinPartida>0&&$idTipoPlanilla>0&&$numeroPlanilla>=0){
            //$jsonIdRelaborales = json_encode(array("0"=>0));
            $jsonIdRelaborales = '';
            $resul = $obj->desplegarPlanillaPrevia($gestion,$mes,$idFinPartida,$jsonIdRelaborales);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $planillassal[] = array(
                        'id_relaboral'=>$v->id_relaboral,
                        'nombres'=>$v->nombres,
                        'ci'=>$v->ci,
                        'expd'=>$v->expd,
                        'sueldo'=>$v->sueldo,
                        'dias_efectivos'=>$v->dias_efectivos,
                        'faltas'=>$v->faltas,
                        'atrasos'=>$v->atrasos,
                        'faltas_atrasos'=>$v->faltas_atrasos,
                        'lsgh'=>$v->lsgh,
                        'otros'=>$v->otros,
                        'total_ganado'=>$v->total_ganado,
                        'total_liquido'=>$v->total_liquido,
                        'cargo'=>$v->cargo,
                        'total_ganado'=>$v->total_ganado,
                        'total_liquido'=>$v->total_liquido,
                        'estado'=>$v->estado,
                        'estado_descripcion'=>$v->estado_descripcion,
                        'available'=>false
                    );
                }
            }
        }
        echo json_encode($planillassal);
    }

    /**
     * Función para la generación de la planilla salarial.
     */
    public function genplanillaAction(){
        $this->view->disable();
        $obj = new Fplanillassal();
        $planillassal = Array();
        $gestion = 0;
        $mes = 0;
        $idFinPartida = 0;
        $idTipoPlanilla = 0;
        $numeroPlanilla = 0;
        $listadoIdRelaborales = "";
        $arrIdRelaborales = array();
        if(isset($_POST["gestion"])&&$_POST["gestion"]>0)
            $gestion = $_POST["gestion"];
        if(isset($_POST["mes"])&&$_POST["mes"]>0)
            $mes = $_POST["mes"];
        if(isset($_POST["id_finpartida"])&&$_POST["id_finpartida"]>0)
            $idFinPartida = $_POST["id_finpartida"];
        if(isset($_POST["id_tipoplanilla"])&&$_POST["id_tipoplanilla"]>0)
            $idTipoPlanilla = $_POST["id_tipoplanilla"];
        if(isset($_POST["numero"])&&$_POST["numero"]>0)
            $numeroPlanilla = $_POST["numero"];
        if(isset($_POST["id_relaborales"])&&$_POST["id_relaborales"]!=''){
            //$listadoIdRelaborales = str_replace("|",",",$_POST["id_relaborales"]);
            $arrIdRelaborales = explode("|",$_POST["id_relaborales"]);
        }
        $jsonIdRelaborales= json_encode($arrIdRelaborales);
        if($gestion>0&&$mes>0&&$idFinPartida>0&&$idTipoPlanilla>0&&$numeroPlanilla>=0&&$listadoIdRelaborales!=''){
            $resul = $obj->desplegarPlanillaPrevia($gestion,$mes,$idFinPartida,$jsonIdRelaborales);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {

                    /*$planillassal[] = array(
                        'id_relaboral'=>$v->id_relaboral,
                        'nombres'=>$v->nombres,
                        'ci'=>$v->ci,
                        'expd'=>$v->expd,
                        'sueldo'=>$v->sueldo,
                        'dias_efectivos'=>$v->dias_efectivos,
                        'faltas'=>$v->faltas,
                        'atrasos'=>$v->atrasos,
                        'faltas_atrasos'=>$v->faltas_atrasos,
                        'lsgh'=>$v->lsgh,
                        'otros'=>$v->otros,
                        'total_ganado'=>$v->total_ganado,
                        'total_liquido'=>$v->total_liquido,
                        'cargo'=>$v->cargo,
                        'total_ganado'=>$v->total_ganado,
                        'total_liquido'=>$v->total_liquido,
                        'estado'=>$v->estado,
                        'estado_descripcion'=>$v->estado_descripcion,
                        'chk'=>false
                    );*/
                }
            }
        }
        echo json_encode($planillassal);
    }
} 