<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 26/10/2015
 * Time: 02:57 PM
 */

class MisideasController extends ControllerBase{
    public function initialize()
    {
        parent::initialize();
    }
    /**
     * Función para la carga de la página de gestión de ideas de negocios.
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

        $this->assets->addJs('/js/misideas/oasis.misideas.tab.js');
        $this->assets->addJs('/js/misideas/oasis.misideas.index.js');
        $this->assets->addJs('/js/misideas/oasis.misideas.list.js');
        $this->assets->addJs('/js/misideas/oasis.misideas.approve.js');
        $this->assets->addJs('/js/misideas/oasis.misideas.new.edit.js');
        $this->assets->addJs('/js/misideas/oasis.misideas.down.js');
        $this->assets->addJs('/js/misideas/oasis.misideas.move.js');
        $this->assets->addJs('/js/misideas/oasis.misideas.export.js');
        $this->assets->addJs('/js/misideas/oasis.misideas.export.form.js');
        $this->assets->addJs('/js/misideas/oasis.misideas.view.js');
        $this->assets->addJs('/js/misideas/oasis.misideas.view.splitter.js');
        $this->assets->addJs('/js/misideas/oasis.misideas.send.js');
        $this->assets->addJs('/js/ckeditor/ckeditor.js');
        $auth = $this->session->get('auth');
        $objUsr = new Usuarios();
        $relaboral = $objUsr->getOneRelaboralActivo($auth['id']);
        if(is_object($relaboral)){
            $this->view->setVar('idRelaboral', $relaboral[0]->id_relaboral);
            $this->view->setVar('idPersona', $relaboral[0]->id_persona);
            $this->view->setVar('ci', $relaboral[0]->ci);
            $this->view->setVar('nombres', $relaboral[0]->nombres);
        }
    }

    /**
     * Función para la obtención del listado de ideas pertenecientes a una persona.
     */
    public function listAction()
    {
        $this->view->disable();
        $obj = new Fcontrolexcepciones();
        $controlexcepciones = Array();
        $idRelaboral=0;
        $data=array();
        if(isset($_GET["id"])){
            $idRelaboral = $_GET["id"];
            $where = "";
            $pagenum = $_GET['pagenum'];
            $pagesize = $_GET['pagesize'];
            $total_rows=0;
            $start = $pagenum * $pagesize;

            // filter data.
            if (isset($_GET['filterscount'])) {
                $filterscount = $_GET['filterscount'];

                if ($filterscount > 0) {
                    $where = " WHERE (";
                    $tmpdatafield = "";
                    $tmpfilteroperator = "";
                    for ($i = 0; $i < $filterscount; $i++) {
                        // get the filter's value.
                        $filtervalue = $_GET["filtervalue" . $i];
                        // get the filter's condition.
                        $filtercondition = $_GET["filtercondition" . $i];
                        // get the filter's column.
                        $filterdatafield = $_GET["filterdatafield" . $i];
                        // get the filter's operator.
                        $filteroperator = $_GET["filteroperator" . $i];

                        if ($tmpdatafield == "") {
                            $tmpdatafield = $filterdatafield;
                        } else if ($tmpdatafield <> $filterdatafield) {
                            $where .= ")AND(";
                        } else if ($tmpdatafield == $filterdatafield) {
                            if ($tmpfilteroperator == 0) {
                                $where .= " AND ";
                            } else
                                $where .= " OR ";
                        }

                        // build the "WHERE" clause depending on the filter's condition, value and datafield.
                        switch ($filtercondition) {
                            case "NOT_EMPTY":
                            case "NOT_NULL":
                                $where .= " " . $filterdatafield . " NOT LIKE '" . "" . "'";
                                break;
                            case "EMPTY":
                            case "NULL":
                                $where .= " " . $filterdatafield . " LIKE '" . "" . "'";
                                break;
                            case "CONTAINS_CASE_SENSITIVE":
                                $where .= " BINARY  " . $filterdatafield . " LIKE '%" . $filtervalue . "%'";
                                break;
                            case "CONTAINS":
                                $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue . "%'";
                                break;
                            case "DOES_NOT_CONTAIN_CASE_SENSITIVE":
                                $where .= " BINARY " . $filterdatafield . " NOT LIKE '%" . $filtervalue . "%'";
                                break;
                            case "DOES_NOT_CONTAIN":
                                $where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue . "%'";
                                break;
                            case "EQUAL_CASE_SENSITIVE":
                                $where .= " BINARY " . $filterdatafield . " = '" . $filtervalue . "'";
                                break;
                            case "EQUAL":
                                $where .= " " . $filterdatafield . " = '" . $filtervalue . "'";
                                break;
                            case "NOT_EQUAL_CASE_SENSITIVE":
                                $where .= " BINARY " . $filterdatafield . " <> '" . $filtervalue . "'";
                                break;
                            case "NOT_EQUAL":
                                $where .= " " . $filterdatafield . " <> '" . $filtervalue . "'";
                                break;
                            case "GREATER_THAN":
                                $where .= " " . $filterdatafield . " > '" . $filtervalue . "'";
                                break;
                            case "LESS_THAN":
                                $where .= " " . $filterdatafield . " < '" . $filtervalue . "'";
                                break;
                            case "GREATER_THAN_OR_EQUAL":
                                $where .= " " . $filterdatafield . " >= '" . $filtervalue . "'";
                                break;
                            case "LESS_THAN_OR_EQUAL":
                                $where .= " " . $filterdatafield . " <= '" . $filtervalue . "'";
                                break;
                            case "STARTS_WITH_CASE_SENSITIVE":
                                $where .= " BINARY " . $filterdatafield . " LIKE '" . $filtervalue . "%'";
                                break;
                            case "STARTS_WITH":
                                $where .= " " . $filterdatafield . " LIKE '" . $filtervalue . "%'";
                                break;
                            case "ENDS_WITH_CASE_SENSITIVE":
                                $where .= " BINARY " . $filterdatafield . " LIKE '%" . $filtervalue . "'";
                                break;
                            case "ENDS_WITH":
                                $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue . "'";
                                break;
                        }

                        if ($i == $filterscount - 1) {
                            $where .= ")";
                        }

                        $tmpfilteroperator = $filteroperator;
                        $tmpdatafield = $filterdatafield;
                    }
                }
            }
            if($idRelaboral>0){
                $resul = $obj->getAllByOneRelaboral($idRelaboral,$where,"",$start,$pagesize);
                //comprobamos si hay filas
                if (count($resul) > 0) {
                    $cex = Controlexcepciones::find(array("relaboral_id = ".$idRelaboral." AND baja_logica=1"));
                    $total_rows = $cex->count();
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
                            'controlexcepcion_fecha_reg'=>$v->controlexcepcion_fecha_reg != "" ? date("d-m-Y H:i:s", strtotime($v->controlexcepcion_fecha_reg)) : "",
                            'controlexcepcion_user_ver_id'=>$v->controlexcepcion_user_ver_id,
                            'controlexcepcion_user_verificador'=>$v->controlexcepcion_user_verificador,
                            'controlexcepcion_fecha_ver'=>$v->controlexcepcion_fecha_ver != "" ? date("d-m-Y H:i:s", strtotime($v->controlexcepcion_fecha_ver)) : "",
                            'controlexcepcion_user_apr_id'=>$v->controlexcepcion_user_apr_id,
                            'controlexcepcion_user_aprobador'=>$v->controlexcepcion_user_aprobador,
                            'controlexcepcion_fecha_apr'=>$v->controlexcepcion_fecha_apr != "" ? date("d-m-Y H:i:s", strtotime($v->controlexcepcion_fecha_apr)) : "",
                            'controlexcepcion_user_mod_id'=>$v->controlexcepcion_user_mod_id,
                            'controlexcepcion_user_modificador'=>$v->controlexcepcion_user_modificador,
                            'controlexcepcion_fecha_mod'=>$v->controlexcepcion_fecha_mod != "" ? date("d-m-Y H:i:s", strtotime($v->controlexcepcion_fecha_mod)) : "",
                            /*'excepcion_id'=>$v->id_excepcion,*/
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
                            'horario'=>$v->horario,
                            'horario_descripcion'=>$v->horario_descripcion,
                            'refrigerio'=>$v->refrigerio,
                            'refrigerio_descripcion'=>$v->refrigerio_descripcion,
                            'observacion'=>$v->observacion,
                            'estado'=>$v->estado,
                            'estado_descripcion'=>$v->estado_descripcion,
                            'baja_logica'=>$v->baja_logica,
                            'agrupador'=>$v->agrupador,
                            'boleta'=>$v->agrupador,
                            'boleta_descripcion'=>$v->agrupador==1?"SI":"NO",
                            'user_reg_id'=>$v->user_reg_id,
                            'fecha_reg'=>$v->fecha_reg,
                            'user_mod_id'=>$v->user_mod_id,
                            'fecha_mod'=>$v->fecha_mod
                        );
                    }
                }
            }
            $data[] = array(
                'TotalRows' => $total_rows,
                'Rows' => $controlexcepciones
            );
        }
        echo json_encode($data);
    }
} 