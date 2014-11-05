<?php

class PersonalController extends ControllerBase{

    public function initialize() {
        parent::initialize();
    }
    
    public function listarAction() {
      //echo 'hola';
    }
    public function registroAction() {
      //echo 'hola';
    }
    public function editarAction($id_personas){
        $resul = new personas();
        $resul = personas::findFirstById($id_personas);
        $res = new personascontactos();
        $res = personascontactos::findFirst(array('persona_id='.$id_personas.' AND baja_logica = 1','order' => 'id ASC'));
        $datos_personal = array(
            'id' => $resul->id,
            'p_nombre' => $resul->p_nombre,
            's_nombre' => $resul->s_nombre,
            't_nombre' => $resul->t_nombre,
            'p_apellido' => $resul->p_apellido,
            's_apellido' => $resul->s_apellido,
            'c_apellido' => $resul->c_apellido,
            'tipo_doc' => $resul->tipo_doc,
            'ci' => $resul->ci,
            'expd' => $resul->expd,
            'num_complemento' => $resul->num_complemento,
            'nacionalidad' => $resul->nacionalidad,
            'lugar_nac' => $resul->lugar_nac,
            'fecha_nac' => $resul->fecha_nac,
            'e_civil' => $resul->e_civil,
            'grupo_sanguineo'=> $resul->grupo_sanguineo,
            'genero' => $resul->genero,
            'nit' => $resul->nit,
            'num_func_sigma' => $resul->num_func_sigma,
            'num_lib_ser_militar' => $resul->num_lib_ser_militar,
            'num_reg_profesional' => $resul->num_reg_profesional,
            'observacion' => $resul->observacion,
            'id_personas_contactos' => $res->id,
            'direccion_dom' => $res->direccion_dom,
            'telefono_fijo' => $res->telefono_fijo,
            'telefono_inst' => $res->telefono_inst,
            'telefono_fax' => $res->telefono_fax,
            'celular_per' => $res->celular_per,
            'celular_inst' => $res->celular_inst,
            'e_mail_per' => $res->e_mail_per,
            'e_mail_inst' => $res->e_mail_inst,
            'interno_inst' => $res->interno_inst
        );
        $this->view->setVar('datos_personal', $datos_personal);
    }
    public function visualizarAction($id_personas){
        $resul = new personas();
        $resul = personas::findFirstById($id_personas);
        $res = new personascontactos();
        $res = personascontactos::findFirst(array('persona_id='.$id_personas.' AND baja_logica = 1','order' => 'id ASC'));
        $datos_personal = array(
            'id' => $resul->id,
            'p_nombre' => $resul->p_nombre,
            's_nombre' => $resul->s_nombre,
            't_nombre' => $resul->t_nombre,
            'p_apellido' => $resul->p_apellido,
            's_apellido' => $resul->s_apellido,
            'c_apellido' => $resul->c_apellido,
            'tipo_doc' => $resul->tipo_doc,
            'ci' => $resul->ci,
            'expd' => $resul->expd,
            'num_complemento' => $resul->num_complemento,
            'nacionalidad' => $resul->nacionalidad,
            'lugar_nac' => $resul->lugar_nac,
            'fecha_nac' => date("d-m-Y",strtotime($resul->fecha_nac)),
            'e_civil' => $resul->e_civil,
            'grupo_sanguineo'=> $resul->grupo_sanguineo,
            'genero' => $resul->genero,
            'nit' => $resul->nit,
            'num_func_sigma' => $resul->num_func_sigma,
            'num_lib_ser_militar' => $resul->num_lib_ser_militar,
            'num_reg_profesional' => $resul->num_reg_profesional,
            'observacion' => $resul->observacion,
            'id_personas_contactos' => $res->id,
            'direccion_dom' => $res->direccion_dom,
            'telefono_fijo' => $res->telefono_fijo,
            'telefono_inst' => $res->telefono_inst,
            'telefono_fax' => $res->telefono_fax,
            'celular_per' => $res->celular_per,
            'celular_inst' => $res->celular_inst,
            'e_mail_per' => $res->e_mail_per,
            'e_mail_inst' => $res->e_mail_inst,
            'interno_inst' => $res->interno_inst
        );
        $this->view->setVar('datos_personal', $datos_personal);
    }
    public function listAction()
    {
        $resul = personas::find(array('baja_logica=:activo1:','bind'=>array('activo1'=>'1'),'order' => 'id ASC'));
        $this->view->disable();
        foreach ($resul as $v) {
            $customers[] = array(
                'id' => $v->id,
                'p_nombre' => $v->p_nombre,
                's_nombre' => $v->s_nombre,
                'p_apellido' => $v->p_apellido,
                's_apellido' => $v->s_apellido,
                'ci' => $v->ci,
                'fecha_nac' => date("d-m-Y",strtotime($v->fecha_nac)),
                'lugar_nac' => $v->lugar_nac,
                'genero' => $v->genero,
                'e_civil' => $v->e_civil,
            );
        }
        echo json_encode($customers);
    }
    public function deleteAction(){
        $resul = personas::findFirstById($_POST['id']);
        $resul->baja_logica = 0;
        $resul->save();
        $this->view->disable();
        echo json_encode();
    }
    public function saveAction()
    {
        if (isset($_POST['id'])) {
            $hoy = date("Y-m-d H:i:s");
            //$date = new DateTime($hoydia);
            //$hoy = $date->format('Y-m-d H:i:s');
            $date = new DateTime($_POST['fecha_nac']);
            $fecha_nac = $date->format('Y-m-d');//echo $fecha_nac." | ".$hoy;
            if ($_POST['id']>0) {
                $resul = new personas();
                $resul = personas::findFirstById($_POST['id']);
                $resul->p_nombre = $_POST['p_nombre'];
                if ($_POST['s_nombre'] == ''){
                    $resul->s_nombre = NULL;
                } else {
                    $resul->s_nombre = $_POST['s_nombre'];
                }
                if ($_POST['t_nombre'] == ''){
                    $resul->t_nombre = NULL;
                } else {
                    $resul->t_nombre = $_POST['t_nombre'];
                }
                $resul->p_apellido = $_POST['p_apellido'];
                if ($_POST['s_apellido']==''){
                    $resul->s_apellido = NULL;
                } else {
                    $resul->s_apellido = $_POST['s_apellido'];
                }
                if (isset($_POST['c_apellido'])){
                  $resul->c_apellido = $_POST['c_apellido'];
                } else {
                  $resul->c_apellido = NULL;
                }
                $resul->ci = $_POST['ci'];
                $resul->expd = $_POST['expd'];
                if (isset($_POST['num_complemento'])){
                  $resul->num_complemento = $_POST['num_complemento'];
                } else {
                  $resul->num_complemento = NULL;
                }
                $resul->fecha_nac = $fecha_nac;
                $resul->lugar_nac = $_POST['lugar_nac'];
                $resul->genero = $_POST['sexo'];
                $resul->e_civil = $_POST['e_civil'];
                $resul->codigo = $_POST['ci'];
                $resul->nacionalidad = $_POST['nacionalidad'];
                if ($_POST['nit'] == ''){
                    $resul->nit = NULL;
                } else {
                    $resul->nit = $_POST['nit'];
                }
                if ($_POST['num_func_sigma'] != ''){
                  $resul->num_func_sigma = $_POST['num_func_sigma'];
                } else {
                  $resul->num_func_sigma = NULL;
                }
                $resul->grupo_sanguineo = $_POST['grupo_sanguineo'];
                if ($_POST['num_lib_ser_militar'] == ''){
                    $resul->num_lib_ser_militar = NULL;
                } else {
                    $resul->num_lib_ser_militar = $_POST['num_lib_ser_militar'];
                }
                if (isset($_POST['num_reg_profesional'])){
                  $resul->num_reg_profesional = $_POST['num_reg_profesional'];
                } else {
                  $resul->num_reg_profesional = NULL;
                }
                if ($_POST['observacion'] == ''){
                    $resul->observacion = NULL;
                } else {
                    $resul->observacion = $_POST['observacion'];
                }
                $resul->user_mod_id = 1;
                $resul->fecha_mod = $hoy;
                $resul->tipo_doc = $_POST['tipo_doc'];
                $resul->save();
                if ($resul->save()) {
                    $res = new personascontactos();
                    $res = personascontactos::findFirst(array('persona_id='.$_POST['id'].' AND baja_logica = 1','order' => 'id ASC'));
                    if(!$res){
                        $res = new personascontactos();
                    }
                    $res->persona_id = $resul->id;
                    if($_POST['direccion_dom'] == ''){
                        $res->direccion_dom = NULL;
                    } else {
                        $res->direccion_dom = $_POST['direccion_dom'];
                    }
                    if($_POST['telefono_fijo'] == ''){
                        $res->telefono_fijo = NULL;
                    } else {
                        $res->telefono_fijo = $_POST['telefono_fijo'];
                    }
                    if($_POST['telefono_inst'] == ''){
                        $res->telefono_inst = NULL;
                    } else {
                        $res->telefono_inst = $_POST['telefono_inst'];
                    }
                    if($_POST['telefono_fax'] == ''){
                        $res->telefono_fax = NULL;
                    } else {
                        $res->telefono_fax = $_POST['telefono_fax'];
                    }
                    if($_POST['interno_inst'] == ''){
                        $res->interno_inst = NULL;
                    } else {
                        $res->interno_inst = $_POST['interno_inst'];
                    }
                    if($_POST['celular_per'] == ''){
                        $res->celular_per = NULL;
                    } else {
                        $res->celular_per = $_POST['celular_per'];
                    }
                    if($_POST['celular_inst'] == ''){
                        $res->celular_inst = NULL;
                    } else {
                        $res->celular_inst = $_POST['celular_inst'];
                    }
                    if($_POST['e_mail_per'] == ''){
                        $res->e_mail_per = NULL;
                    } else {
                        $res->e_mail_per = $_POST['e_mail_per'];
                    }
                    if($_POST['e_mail_inst'] == ''){
                        $res->e_mail_inst = NULL;
                    } else {
                        $res->e_mail_inst = $_POST['e_mail_inst'];
                    }
                    $res->estado = 0;
                    $res->baja_logica = 1;
                    if ($res->save()){
                        $msm = array('msm' => 'Exito: Se guardo correctamente' );
                    } else {
                        $msm = array('msm' => 'Error: No se guardo el registro' );
                    }
                }
            } else {
                try{
                $resul = new personas();
                $resul->p_nombre = $_POST['p_nombre'];
                if ($_POST['s_nombre'] == ''){
                    $resul->s_nombre = NULL;
                } else {
                    $resul->s_nombre = $_POST['s_nombre'];
                }
                if ($_POST['t_nombre'] == ''){
                    $resul->t_nombre = NULL;
                } else {
                    $resul->t_nombre = $_POST['t_nombre'];
                }
                $resul->p_apellido = $_POST['p_apellido'];
                if ($_POST['s_apellido']==''){
                    $resul->s_apellido = NULL;
                } else {
                    $resul->s_apellido = $_POST['s_apellido'];
                }
                if (isset($_POST['c_apellido'])){
                  $resul->c_apellido = $_POST['c_apellido'];
                } else {
                  $resul->c_apellido = NULL;
                }
                $resul->ci = $_POST['ci'];
                $resul->expd = $_POST['expd'];
                if (isset($_POST['num_complemento'])){
                  $resul->num_complemento = $_POST['num_complemento'];
                } else {
                  $resul->num_complemento = NULL;
                }
                $resul->fecha_nac = $fecha_nac;
                $resul->lugar_nac = $_POST['lugar_nac'];
                $resul->genero = $_POST['sexo'];
                $resul->e_civil = $_POST['e_civil'];
                $resul->codigo = $_POST['ci'];
                $resul->nacionalidad = $_POST['nacionalidad'];
                if ($_POST['nit'] == ''){
                    $resul->nit = NULL;
                } else {
                    $resul->nit = $_POST['nit'];
                }
                if ($_POST['num_func_sigma'] != ''){
                  $resul->num_func_sigma = $_POST['num_func_sigma'];
                } else {
                  $resul->num_func_sigma = NULL;
                }
                $resul->grupo_sanguineo = $_POST['grupo_sanguineo'];
                if ($_POST['num_lib_ser_militar'] == ''){
                    $resul->num_lib_ser_militar = NULL;
                } else {
                    $resul->num_lib_ser_militar = $_POST['num_lib_ser_militar'];
                }
                if (isset($_POST['num_reg_profesional'])){
                  $resul->num_reg_profesional = $_POST['num_reg_profesional'];
                } else {
                  $resul->num_reg_profesional = NULL;
                }
                if ($_POST['observacion'] == ''){
                    $resul->observacion = NULL;
                } else {
                    $resul->observacion = $_POST['observacion'];
                }
                $resul->estado = 0;
                $resul->baja_logica = 1;
                $resul->user_reg_id = 1;
                $resul->fecha_reg = $hoy;
                $resul->tipo_doc = $_POST['tipo_doc'];
                $resul->agrupador = 0;
                //echo $_POST['tipo_doc'];
                //$resul->save();
                if ($resul->save()) {
                    $resul = personas::findFirst(array('ci="'.$_POST['ci'].'" AND p_apellido = "'.$_POST['p_apellido'].'"','order' => 'id ASC'));
                    $res = new personascontactos();
                    $res->persona_id = $resul->id;
                    if($_POST['direccion_dom'] == ''){
                        $res->direccion_dom = NULL;
                    } else {
                        $res->direccion_dom = $_POST['direccion_dom'];
                    }
                    if($_POST['telefono_fijo'] == ''){
                        $res->telefono_fijo = NULL;
                    } else {
                        $res->telefono_fijo = $_POST['telefono_fijo'];
                    }
                    if($_POST['telefono_inst'] == ''){
                        $res->telefono_inst = NULL;
                    } else {
                        $res->telefono_inst = $_POST['telefono_inst'];
                    }
                    if($_POST['telefono_fax'] == ''){
                        $res->telefono_fax = NULL;
                    } else {
                        $res->telefono_fax = $_POST['telefono_fax'];
                    }
                    if($_POST['interno_inst'] == ''){
                        $res->interno_inst = NULL;
                    } else {
                        $res->interno_inst = $_POST['interno_inst'];
                    }
                    if($_POST['celular_per'] == ''){
                        $res->celular_per = NULL;
                    } else {
                        $res->celular_per = $_POST['celular_per'];
                    }
                    if($_POST['celular_inst'] == ''){
                        $res->celular_inst = NULL;
                    } else {
                        $res->celular_inst = $_POST['celular_inst'];
                    }
                    if($_POST['e_mail_per'] == ''){
                        $res->e_mail_per = NULL;
                    } else {
                        $res->e_mail_per = $_POST['e_mail_per'];
                    }
                    if($_POST['e_mail_inst'] == ''){
                        $res->e_mail_inst = NULL;
                    } else {
                        $res->e_mail_inst = $_POST['e_mail_inst'];
                    }
                    $res->estado = 0;
                    $res->baja_logica = 1;
                    if ($res->save()){
                        $msm = array('msm' => 'Exito: Se guardo correctamente' );
                    } else {
                        $msm = array('msm' => 'Error: No se guardo el registro' );
                    }
                } else {
                    $msm = array('msm' => 'Error: No se guardo el registro' );
                }
                }catch (\Exception $e){
            echo get_class($e), ": ", $e->getMessage(), "\n";
            echo " File=", $e->getFile(), "\n";
            echo " Line=", $e->getLine(), "\n";
            echo $e->getTraceAsString();
        }
            }	
        } else {
          $msm = array('msm' => 'Error: no define Id' );
        }

        //$msm = array('msm' => 'Error: No..' );
	$this->view->disable();
	echo json_encode($msm);
        //echo $msm;
    }
    public function imprimirAction($n_rows, $rows){
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        for ($i=0;$i<$n_rows;$i++){
            $pdf->Cell(40,10, utf8_decode($rows[$i].),0,1);
        }
        $pdf->Output();
        $this->view->disable();
    }
}

