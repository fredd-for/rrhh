<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  02-06-2015
*/

class PlanillasrefController extends ControllerBase{
    public function initialize()
    {
        parent::initialize();
    }
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

        $this->assets->addJs('/js/planillasref/oasis.planillasref.tab.js');
        $this->assets->addJs('/js/planillasref/oasis.planillasref.index.js');
        $this->assets->addJs('/js/planillasref/oasis.planillasref.generate.js');
        $this->assets->addJs('/js/planillasref/oasis.planillasref.edit.js');
        $this->assets->addJs('/js/planillasref/oasis.planillasref.view.js');
        $this->assets->addJs('/js/planillasref/oasis.planillasref.approve.js');
        $this->assets->addJs('/js/planillasref/oasis.planillasref.export.js');
        $this->assets->addJs('/js/planillasref/oasis.planillasref.down.js');
    }
    /**
     * Función para la obtención del listado de planillas registradas en el sistema.
     */
    public function listAction(){
        $this->view->disable();
        $obj = new Fplanillasref();
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
                    'numero'=>$v->numero==0?null:$v->numero,
                    'total_ganado'=>$v->total_ganado,
                    'total_liquido'=>$v->total_liquido,
                    'cantidad_relaborales'=>$v->cantidad_relaborales,
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
     * Función para la obtención del listado de meses disponibles para la generación de planillas salariales.
     */
    public function getmesesgeneracionAction(){
        $this->view->disable();
        $meses = [];
        if(isset($_POST["gestion"])&&$_POST["gestion"]>0){
            $objPlanilla = new Fplanillasref();
            $resul = $objPlanilla->getMesesGeneracionPlanillasRef($_POST["gestion"]);
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
            $objPlanilla = new Fplanillasref();
            $resul = $objPlanilla->getFinPartidasGeneracionPlanillasRef($_POST["gestion"],$_POST["mes"]);
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
    public function gettiposplanillasrefAction(){
        $this->view->disable();
        $tipos_planillas = [];
        if(isset($_POST["gestion"])&&$_POST["gestion"]>0&&isset($_POST["mes"])&&$_POST["mes"]>0&&isset($_POST["id_finpartida"])&&$_POST["id_finpartida"]>0){
            $objPlanilla = new Fplanillasref();
            $resul = $objPlanilla->getTiposPlanillasGeneracionPlanillasRef($_POST["gestion"],$_POST["mes"],$_POST["id_finpartida"]);
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
        $obj = new Frelaboralesplanillaref();
        $planillassal = Array();
        $gestion = 0;
        $mes = 0;
        $idFinPartida = 0;
        $idTipoPlanilla = 0;
        $numeroPlanilla = 0;
        $jsonIdRelaborales = '';
        $arrIdRelaborales = array();
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
        if(isset($_GET["id_relaborales"])&&$_GET["id_relaborales"]!=''){
            $arrIdRelaborales = explode("|",$_GET["id_relaborales"]);
        }
        if(count($arrIdRelaborales)>0){
            $jsonIdRelaborales = '{';
            foreach($arrIdRelaborales as $clave => $idRelaboral){
                $jsonIdRelaborales .= '"'.$clave.'":'.$idRelaboral.',';
            }
            $jsonIdRelaborales .= ',';
            $jsonIdRelaborales = str_replace(",,","",$jsonIdRelaborales);
            $jsonIdRelaborales .= '}';
        }
        if($gestion>0&&$mes>0&&$idFinPartida>0&&$idTipoPlanilla>0&&$numeroPlanilla>=0){

            $resul = $obj->desplegarPlanillaPreviaRef($gestion,$mes,$idFinPartida,$jsonIdRelaborales);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $planillassal[] = array(
                        'id_relaboral'=>$v->id_relaboral,
                        'cargo'=>$v->cargo,
                        'gerencia_administrativa'=>$v->gerencia_administrativa,
                        'departamento_administrativo'=>$v->departamento_administrativo,
                        'area'=>$v->area,
                        'ubicacion'=>$v->ubicacion,
                        'fin_partida'=>$v->fin_partida,
                        'id_procesocontratacion'=>$v->id_procesocontratacion,
                        'procesocontratacion_codigo'=>$v->procesocontratacion_codigo,
                        'nombres'=>$v->nombres,
                        'ci'=>$v->ci,
                        'expd'=>$v->expd,
                        'sueldo'=>$v->sueldo,
                        'dias_efectivos'=>$v->dias_efectivos,
                        'monto_diario'=>$v->monto_diario,
                        'faltas'=>$v->faltas,
                        'lsgh'=>$v->lsgh,
                        'otros'=>$v->otros,
                        'total_ganado'=>$v->total_ganado,
                        'total_liquido'=>$v->total_liquido,
                        'cargo'=>$v->cargo,
                        'total_descuentos'=>$v->total_descuentos,
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
        $obj = new Frelaboralesplanillasal();
        $auth = $this->session->get('auth');
        $user_reg_id = $auth['id'];
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $planillassal = Array();
        $gestion = 0;
        $mes = 0;
        $idFinPartida = 0;
        $idTipoPlanilla = 0;
        $numeroPlanilla = 0;
        $arrIdRelaborales = array();
        $observacion = "";
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
            $arrIdRelaborales = explode("|",$_POST["id_relaborales"]);
        }
        if(isset($_POST["obs"])&&$_POST["obs"]!=''){
            $observacion = $_POST["obs"];
        }
        if(count($arrIdRelaborales)>0){
            $jsonIdRelaborales = '{';
            foreach($arrIdRelaborales as $clave => $idRelaboral){
                $jsonIdRelaborales .= '"'.$clave.'":'.$idRelaboral.',';
            }
            $jsonIdRelaborales .= ',';
            $jsonIdRelaborales = str_replace(",,","",$jsonIdRelaborales);
            $jsonIdRelaborales .= '}';
        }
        if($gestion>0&&$mes>0&&$idFinPartida>0&&$idTipoPlanilla>0&&$numeroPlanilla>=0&&$jsonIdRelaborales!=''){
            $resul = $obj->desplegarPlanillaPrevia($gestion,$mes,$idFinPartida,$jsonIdRelaborales);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                $planillasal = new Planillassal();
                $planillasal->da_id = 1;//Valor prefijado mientras no se tenga en la institución más Direcciones Administrativas
                $planillasal->ejecutora_id = 1;//Valor prefijado mientras no se tenga en la institución de más unidades ejecutoras.
                $planillasal->regional_id = 1; //Valor prefijado mientras no se tenga en la institución de más regionales.
                $planillasal->gestion = $gestion;
                $planillasal->mes = $mes;
                $planillasal->finpartida_id = $idFinPartida;
                $planillasal->tipoplanilla_id=$idTipoPlanilla;
                $planillasal->numero=$numeroPlanilla;
                $planillasal->total_ganado=0;
                $planillasal->total_liquido=0;
                if($observacion!=''){
                    $planillasal->observacion=$observacion;;
                }
                $planillasal->estado=1;
                $planillasal->baja_logica=1;
                $planillasal->agrupador=0;
                $planillasal->user_reg_id=$user_reg_id;
                $planillasal->fecha_reg=$hoy;
                $totalGanado = 0;
                $totalLiquido = 0;
                $cantidadPlanillados = 0;
                try{
                    if($planillasal->save()){
                        foreach ($resul as $v) {
                            #region registro del descuento correspondiente
                            $descuento = new Descuentos();
                            $descuento->relaboral_id = $v->id_relaboral;
                            $descuento->gestion = $v->gestion;
                            $descuento->mes = $v->mes;
                            $descuento->faltas = $v->faltas;
                            $descuento->atrasos = $v->atrasos;
                            $descuento->lsgh = $v->lsgh;
                            $descuento->omision = $v->omision;
                            $descuento->abandono = $v->abandono;
                            $descuento->omision = $v->omision;
                            $descuento->retencion = $v->retencion;
                            $descuento->total_descuentos = $v->total_descuentos;
                            $descuento->otros = $v->otros;
                            $descuento->estado = 1;
                            $descuento->baja_logica=1;
                            $descuento->agrupador=0;
                            $descuento->user_reg_id=$user_reg_id;
                            $descuento->fecha_reg=$hoy;
                            $descuento->faltas_atrasos = $v->faltas_atrasos!=null?$v->faltas_atrasos:0;
                            if ($descuento->save()) {
                                #region registro del pago salarial
                                $pagossal = new Pagossal();
                                $pagossal->relaboral_id = $v->id_relaboral;
                                $pagossal->planillasal_id = $planillasal->id;
                                $pagossal->descuento_id = $descuento->id;
                                $pagossal->dias_efectivos = $v->dias_efectivos;
                                $pagossal->aporte_laboral_afp = $v->aporte_laboral_afp;
                                $pagossal->ganado = $v->total_ganado;
                                $totalGanado += $v->total_ganado;
                                $pagossal->liquido = $v->total_liquido;
                                $totalLiquido += $v->total_liquido;
                                $pagossal->estado = 1;
                                $pagossal->baja_logica = 1;
                                $pagossal->agrupador = 0;
                                $pagossal->user_reg_id = $user_reg_id;
                                $pagossal->fecha_reg = $hoy;

                                if ($pagossal->save()) {
                                    /**
                                     * Una vez registrada la planilla se debe planillar los registros de horarios y marcaciones,
                                     * que consiste en poner en un estado PLANILLADO en el rango correspondiente para el registro de horarios y marcaciones
                                     */
                                    $obj = new Horariosymarcaciones();
                                    $ok = $obj->planillarHorariosYMarcaciones($v->id_relaboral,$gestion,$mes);
                                    if($ok)$cantidadPlanillados++;
                                }else break;
                                #endregion registro del pago salarial
                            }else break;
                            #endregion registro del descuento correspondiente
                        }
                        if($cantidadPlanillados==count($resul)){
                            $planillasal->total_ganado = $totalGanado;
                            $planillasal->total_liquido = $totalLiquido;
                            if($planillasal->save()){
                                $msj = array('result' => 1, 'msj' => 'Generaci&oacute;n exitosa de la Planilla Salarial con '.$cantidadPlanillados.' registros considerados.');
                            }
                        }else{
                            /**
                             * Se eliminan todos los pagos que se pudieran haber registrado con la planilla.
                             */
                            $db = $this->getDI()->get('db');
                            $db->execute("DELETE FROM pagossal WHERE planillasal_id=".$planillasal->id);
                            $db->execute("DELETE FROM planillassal WHERE id=".$planillasal->id);
                            $msj = array('result' => 0, 'msj' => 'Error 1: No se guard&oacute; el registro de la planilla debido a errores en datos enviados.');
                        }
                    }else{
                        $msj = array('result' => 0, 'msj' => 'Error 2: No se guard&oacute; el registro debido a datos erroneos enviados.');
                    }
                }catch (\Exception $e) {
                    echo get_class($e), ": ", $e->getMessage(), "\n";
                    echo " File=", $e->getFile(), "\n";
                    echo " Line=", $e->getLine(), "\n";
                    echo $e->getTraceAsString();
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de planilla salarial.');
                }

            }else{
                $msj = array('result' => 0, 'msj' => 'No se consider&oacute; ning&uacute;n registro para la planilla salarial.');
            }
        }
        echo json_encode($msj);
    }
    /**
     * Función para mostrar la planilla generada (efectiva).
     */
    public function displayplanefectivaAction(){
        $this->view->disable();
        $obj = new Frelaboralesplanillasal();
        $planillassal = Array();
        $idPlanillaSal = 0;
        if(isset($_GET["id"])&&$_GET["id"]>0)
            $idPlanillaSal = $_GET["id"];
        if($idPlanillaSal>0){
            $resul = $obj->desplegarPlanillaEfectiva($idPlanillaSal);
            //comprobamos si hay filas
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $planillassal[] = array(
                        'id_relaboral'=>$v->id_relaboral,
                        'cargo'=>$v->cargo,
                        'gerencia_administrativa'=>$v->gerencia_administrativa,
                        'departamento_administrativo'=>$v->departamento_administrativo,
                        'area'=>$v->area,
                        'ubicacion'=>$v->ubicacion,
                        'fin_partida'=>$v->fin_partida,
                        'id_procesocontratacion'=>$v->id_procesocontratacion,
                        'procesocontratacion_codigo'=>$v->procesocontratacion_codigo,
                        'nombres'=>$v->nombres,
                        'ci'=>$v->ci,
                        'expd'=>$v->expd,
                        'nivel_salarial'=>$v->nivel_salarial,
                        'sueldo'=>str_replace(".00","",$v->sueldo),
                        'dias_efectivos'=>$v->dias_efectivos,
                        'faltas'=>$v->faltas,
                        'atrasos'=>$v->atrasos,
                        'faltas_atrasos'=>$v->faltas_atrasos,
                        'lsgh'=>$v->lsgh,
                        'omision'=>$v->omision,
                        'abandono'=>$v->abandono,
                        'otros'=>$v->otros,
                        'aporte_laboral_afp'=>$v->aporte_laboral_afp,
                        'total_descuentos'=>$v->total_descuentos,
                        'total_ganado'=>$v->total_ganado,
                        'total_liquido'=>$v->total_liquido,
                        'total_ganado'=>$v->total_ganado,
                        'total_liquido'=>$v->total_liquido,
                        'estado'=>$v->estado,
                        'estado_descripcion'=>$v->estado_descripcion
                    );
                }
            }
        }
        echo json_encode($planillassal);
    }
    /**
     * Función para la edición del registro de planilla y/o regisotros de pagos relacionados.
     * opcion: 0 => Modificar sólo el registro de la planilla
     *         1 => Modificar sólo los regisotrs de los pagos
     *         2 => Modificar los registros de las planillas y los pagos
     */
    public function editAction(){
        $this->view->disable();
        $auth = $this->session->get('auth');
        $user_mod_id = $auth['id'];
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $idPlanillaSal = 0;
        $observacion = "";
        $opcion = 0;
        $ok=true;
        if(isset($_POST["id"])&&$_POST["id"]>0)
            $idPlanillaSal = $_POST["id"];
        if(isset($_POST["opcion"])&&$_POST["opcion"]>0)
            $opcion = $_POST["opcion"];
        if(isset($_POST["observacion"])&&$_POST["observacion"]!='')
            $observacion = $_POST["observacion"];
        if($idPlanillaSal>0){
            /**
             * Se modifica el registro de planilla salarial
             */
            if($opcion==0||$opcion==2) {
                try{
                    $planillasal = Planillassal::findFirstById($idPlanillaSal);
                    if($planillasal->id>0){
                        $planillasal->observacion = $observacion;
                        $planillasal->user_mod_id = $user_mod_id;
                        $planillasal->fecha_reg = $hoy;
                        $ok=$planillasal->save();
                        if($ok)$ms = 'Modificaci&oacute;n exitosa del registro de planilla salarial.';
                        else $ms = 'No se pudo modificar el registro de planilla salarial.';
                    }else{
                        $ok=false;
                        $ms = 'No se pudo modificar el registro de planilla salarial debido a que no se encontr&oacute;.';
                    }
                }catch (\Exception $e) {
                    echo get_class($e), ": ", $e->getMessage(), "\n";
                    echo " File=", $e->getFile(), "\n";
                    echo " Line=", $e->getLine(), "\n";
                    echo $e->getTraceAsString();
                    $ms = 'Error cr&iacute;tico: No se modific&oacute; el registro de planilla salarial.';
                }
            }
            if($ok){
                /**
                 * Se modifican los registros de pagos salariales
                 */
                if($opcion==1||$opcion==2) {
                    if($ms!='')$ms .= ' ';
                    try{
                        $db = $this->getDI()->get('db');
                        $ok=$db->execute("UPDATE TABLE pagossal SET observacion='$observacion',user_mod_id=".$user_mod_id.",fecha_mod=CURRENT_DATE WHERE planillasal_id=".$idPlanillaSal);
                        if($ok)$ms .= 'Modificaci&oacute; exitosa de los Pagos Salariales relacionados a la planilla salarial.';
                        else $ms .= 'No se pudo modificar los registros de Pagos Salariales relacionados a la planilla salarial.';
                    }catch (\Exception $e) {
                        echo get_class($e), ": ", $e->getMessage(), "\n";
                        echo " File=", $e->getFile(), "\n";
                        echo " Line=", $e->getLine(), "\n";
                        echo $e->getTraceAsString();
                        $ms .= 'Error cr&iacute;tico: No se modificaron los registros de pagos salariales.';
                    }
                }
            }
            if($ok) $msj = array('result' => 1, 'msj' => $ms);
            else  $msj = array('result' => 0, 'msj' => $ms);

        }
        echo json_encode($msj);
    }

    /**
     * Función para aprobar un registro de Planilla Salarial.
     */
    public function approveAction(){
        $this->view->disable();
        $auth = $this->session->get('auth');
        $user_apr_id = $auth['id'];
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $idPlanillaSal = 0;
        $ok=true;
        if(isset($_POST["id"])&&$_POST["id"]>0)
            $idPlanillaSal = $_POST["id"];
        if($idPlanillaSal>0){
            try{
                $planillasal = Planillassal::findFirstById($idPlanillaSal);
                if($planillasal->id>0){
                    $planillasal->estado = 3;
                    $planillasal->user_apr_id = $user_apr_id;
                    $planillasal->fecha_apr = $hoy;
                    $planillasal->save();
                    $msj = array('result' => 1, 'msj' => 'Aprobaci&oacute;n exitosa del registro.');
                }else{
                    $msj = array('result' => 0, 'msj' => 'Error: No se pudo aprobar el registro de Planilla Salarial.');
                }
            }catch (\Exception $e) {
                echo get_class($e), ": ", $e->getMessage(), "\n";
                echo " File=", $e->getFile(), "\n";
                echo " Line=", $e->getLine(), "\n";
                echo $e->getTraceAsString();
                $msj = array('result' => 0, 'msj' => 'Error cr&iacute;tico: No se pudo aprobar el registro de Planilla Salarial debido a un error en los datos enviados.');
            }
        }
        echo json_encode($msj);
    }

    /**
     * Función para dar de baja una Planilla Salarial
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
                $objPlanillaSal = Planillassal::findFirstById($_POST["id"]);
                $objPlanillaSal->estado = 0;
                $objPlanillaSal->baja_logica = 0;//Debido a que no es necesario que el registro continúe apareciendo en estado pasivo.
                $objPlanillaSal->user_mod_id = $user_mod_id;
                $objPlanillaSal->fecha_mod = $hoy;
                if ($objPlanillaSal->save()) {
                    $db = $this->getDI()->get('db');
                    $ok=$db->execute("UPDATE pagossal SET estado=0,baja_logica=0,user_mod_id=".$user_mod_id.",fecha_mod=CURRENT_DATE,user_anu_id=".$user_mod_id.",fecha_anu=CURRENT_DATE WHERE planillasal_id=".$_POST["id"]);
                    if($ok)$msj = array('result' => 1, 'msj' => '&Eacute;xito: Registro de Baja realizado de modo satisfactorio.');
                    else $msj = array('result' => 0, 'msj' => 'No se pudo realizar la baja de los registros de baja para esta planilla.');
                } else {
                    foreach ($objPlanillaSal->getMessages() as $message) {
                        echo $message, "\n";
                    }
                    $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se pudo dar de baja al registro de la Planilla Salarial.');
                }
            } else $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se efectu&oacute; la baja debido a que no se especific&oacute; el registro de la Planilla Salarial.');
        } catch (\Exception $e) {
            echo get_class($e), ": ", $e->getMessage(), "\n";
            echo " File=", $e->getFile(), "\n";
            echo " Line=", $e->getLine(), "\n";
            echo $e->getTraceAsString();
            $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guard&oacute; el registro de la Planilla Salarial.');
        }
        echo json_encode($msj);
    }
} 