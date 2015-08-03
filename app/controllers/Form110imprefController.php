<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  31-07-2015
*/


class Form110imprefController extends ControllerBase{
    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
    }
    /**
     * Función para la carga del primer listado sobre la página de gestión de tolerancias de ingreso.
     * Se inhabilita la vista para el uso de jqwidgets,
     */
    public function getoneforrelaboralAction()
    {
        $this->view->disable();
        $obj = new Form110impref();
        $idRelaboral = 0;
        $form110impref = Array();
        $id = 0;
        $idRelaboral = 0;
        $gestion = 0;
        $mes = 0;
        if(isset($_POST["id"])&&$_POST["id"]>0)
        {
            $id = $_POST["id"];
        }
        if(isset($_POST["gestion"])&&$_POST["gestion"]>0)
        {
            $gestion = $_POST["gestion"];
        }
        if(isset($_POST["mes"])&&$_POST["mes"]>0)
        {
            $mes = $_POST["mes"];
        }
        if(isset($_POST["id_relaboral"])&&$_POST["id_relaboral"]>0&&$gestion>0&&$mes>0){
            if($id>0) $resul = Form110impref::findFirstById($id);
            else $resul = Form110impref::findFirst("relaboral_id=".$idRelaboral." AND gestion=".$gestion." AND mes=".$mes);
            if ($resul->count() > 0) {
                foreach ($resul as $v) {
                    $form110impref[] = array(
                        'nro_row' => 0,
                        'id'=>$v->id,
                        'relaboral_id'=>$v->relaboral_id,
                        'gestion'=>$v->gestion,
                        'mes'=>$v->mes,
                        'cantidad'=>$v->cantidad,
                        'monto_diario'=>$v->monto_diario,
                        'importe'=>$v->importe,
                        'impuesto'=>$v->impuesto,
                        'retencion'=>$v->retencion,
                        'fecha_form'=>$v->fecha_form != "" ? date("d-m-Y", strtotime($v->fecha_form)) : "",
                        'codigo'=>$v->codigo,
                        'observacion'=>$v->observacion!=null?$v->observacion:'',
                        'estado'=> $v->estado,
                        'estado_descripcion'=> ($v->estado==1)?"ACTIVO":"PASIVO",
                        'baja_logica'=> $v->baja_logica,
                        'agrupador'=> $v->agrupador,
                        'user_reg_id'=> $v->user_reg_id,
                        'fecha_reg'=> $v->fecha_reg,
                        'user_mod_id'=> $v->user_mod_id,
                        'fecha_mod'=> $v->fecha_mod
                    );
                }
            }
        }
        echo json_encode($form110impref);
    }
} 