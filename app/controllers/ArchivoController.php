<?php

class ArchivoController extends ControllerBase{

    public function initialize() {
        parent::initialize();
    }
    
    public function gestionAction() {
        
      
      
    }
    public function nuevoAction() {
      //echo 'hola';
        //$this->view->setVar('datos_personal', $datos_personal);
    }
    public function nuevoparametroAction($parametro) {
      //echo 'hola';
        $this->view->setVar('parametro', $parametro);
    }
    public function parametrosAction(){
        
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
    public function editarparametroAction($id_parametro){
        $resul = new parametros();
        $resul = parametros::findFirstById($id_parametro);
        $datos_parametro = array(
            'id' => $resul->id,
            'parametro' => $resul->parametro,
            'nivel' => $resul->nivel,
            'valor_1' => $resul->valor_1,
            'valor_2' => $resul->valor_2,
            'valor_3' => $resul->valor_3,
            'valor_4' => $resul->valor_4,
            'valor_5' => $resul->valor_5,
            'descripcion' => $resul->descripcion,
            'observacion' => $resul->observacion,
            'estado' => $resul->estado,
        );
        $this->view->setVar('datos_parametro', $datos_parametro);
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
    public function listAction($parametro)
    {
        $resul = parametros::find(array("baja_logica = 1 AND parametro = '".$parametro."'" ,'order' => 'id ASC'));
        $this->view->disable();
        foreach ($resul as $v) {
            $customers[] = array(
                'id' => $v->id,
                'parametro' => $v->parametro,
                'nivel' => $v->nivel,
                'valor_1' => $v->valor_1,
                'valor_2' => $v->valor_2,
                'valor_3' => $v->valor_3,
                'valor_4' => $v->valor_4,
                'valor_5' => $v->valor_5,
                'descripcion' => $v->descripcion,
                'observacion' => $v->observacion,
                'estado' => $v->estado,
                'baja_logica' => $v->baja_logica,
                'agrupador' => $v->agrupador,
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
    public function deleteparametroAction(){
        $resul = parametros::findFirstById($_POST['id']);
        $resul->baja_logica = 0;
        $resul->save();
        $this->view->disable();echo $_POST['id'];
        echo json_encode();
    }
    public function saveAction()
    {
        /*$numero2 = count($_POST);
            $tags2 = array_keys($_POST); // obtiene los nombres de las varibles
            $valores2 = array_values($_POST);// obtiene los valores de las varibles
            for($i=0;$i<$numero2;$i++){ 
                echo 'var : '.$tags2[$i].' val: '.$valores2[$i].' |';
            }*/
        if (isset($_POST['id'])) {
            $hoy = date("Y-m-d H:i:s");
            //$date = new DateTime($hoydia);
            //$hoy = $date->format('Y-m-d H:i:s');
            /*$date = new DateTime($_POST['fecha_nac']);
            $fecha_nac = $date->format('Y-m-d');//echo $fecha_nac." | ".$hoy;*/
            if ($_POST['id']>0) {
                $resul = new tipodocumento();
                $resul = tipodocumento::findFirstById($_POST['id']);
                $resul->tipo_documento = $_POST['tipo_documento'];
                $resul->codigo = $_POST['codigo'];
                $resul->consultor = $_POST['consultor'];
                $resul->eventual = $_POST['eventual'];
                $resul->permanente = $_POST['permanente'];
                $resul->carrera = $_POST['carrera'];
                $resul->tipopresdoc_id = $_POST['tipopresdoc_id'];
                $resul->periodopresdoc_id = $_POST['periodopresdoc_id'];
                $resul->tipoperssoldoc_id = $_POST['tipoperssoldoc_id'];
                $resul->tipoemisordoc_id = $_POST['tipoemisordoc_id'];
                $resul->tipofechaemidoc_id = $_POST['tipofechaemidoc_id'];
                $resul->grupoarchivos_id = $_POST['grupoarchivos_id'];
                $resul->sexo = $_POST['sexo'];
                if (isset($_POST['tipo_proceso_contratacion'])){
                    $resul->tipo_proceso_contratacion = $_POST['tipo_proceso_contratacion'];
                } else {
                    $resul->tipo_proceso_contratacion = NULL;
                }
                if ($_POST['nombre_carpeta'] == ''){
                    $resul->nombre_carpeta = NULL;
                } else {
                    $resul->nombre_carpeta = $_POST['ruta_carpeta'];
                }
                $resul->ruta_carpeta = '/';
                if (isset($_POST['formato_archivo_digital'])){
                    $resul->formato_archivo_digital = $_POST['formato_archivo_digital'];
                } else {
                    $resul->formato_archivo_digital = NULL;
                }
                if ($_POST['resolucion_archivo_digital']==''){
                    $resul->resolucion_archivo_digital = NULL;
                } else {
                    $resul->resolucion_archivo_digital = $_POST['resolucion_archivo_digital'];
                }
                if ($_POST['altura_archivo_digital'] == ''){
                  $resul->altura_archivo_digital = $_POST['altura_archivo_digital'];
                } else {
                  $resul->altura_archivo_digital = NULL;
                }
                if ($_POST['anchura_archivo_digital'] == ''){
                  $resul->anchura_archivo_digital = $_POST['anchura_archivo_digital'];
                } else {
                  $resul->anchura_archivo_digital = NULL;
                }
                if (isset($_POST['campo_aux_a'])){
                  $resul->campo_aux_a = $_POST['campo_aux_a'];
                } else {
                  $resul->campo_aux_a = NULL;
                }
                if (isset($_POST['tipo_dato_campo_aux_a'])){
                  $resul->tipo_dato_campo_aux_a = $_POST['tipo_dato_campo_aux_a'];
                } else {
                  $resul->tipo_dato_campo_aux_a = NULL;
                }
                if (isset($_POST['campo_aux_b'])){
                  $resul->campo_aux_b = $_POST['campo_aux_b'];
                } else {
                  $resul->campo_aux_b = NULL;
                }
                if (isset($_POST['tipo_dato_campo_aux_b'])){
                  $resul->tipo_dato_campo_aux_b = $_POST['tipo_dato_campo_aux_b'];
                } else {
                  $resul->tipo_dato_campo_aux_b = NULL;
                }
                if (isset($_POST['campo_aux_c'])){
                  $resul->campo_aux_c = $_POST['campo_aux_c'];
                } else {
                  $resul->campo_aux_c = NULL;
                }
                if (isset($_POST['tipo_dato_campo_aux_c'])){
                  $resul->tipo_dato_campo_aux_c = $_POST['tipo_dato_campo_aux_c'];
                } else {
                  $resul->tipo_dato_campo_aux_c = NULL;
                }
                if (isset($_POST['observacion'])){
                  $resul->observacion = $_POST['observacion'];
                } else {
                  $resul->observacion = NULL;
                }
                $resul->user_mod_id = 1;
                $resul->fecha_mod = $hoy;
                //$resul->save();
                if ($resul->save()) {
                    $msm = array('msm' => 'Exito: Se guardo correctamente' );
                } else {
                    $msm = array('msm' => 'Error: No se guardo el registro' );
                }
            } else {
                try{
                $resul = new tipodocumento();
                $resul->tipo_documento = $_POST['tipo_documento'];
                $resul->codigo = $_POST['codigo'];
                $resul->consultor = $_POST['consultor'];
                $resul->eventual = $_POST['eventual'];
                $resul->permanente = $_POST['permanente'];
                $resul->carrera = $_POST['carrera'];
                $resul->tipopresdoc_id = $_POST['tipopresdoc_id'];
                $resul->periodopresdoc_id = $_POST['periodopresdoc_id'];
                $resul->tipoperssoldoc_id = $_POST['tipoperssoldoc_id'];
                $resul->tipoemisordoc_id = $_POST['tipoemisordoc_id'];
                $resul->tipofechaemidoc_id = $_POST['tipofechaemidoc_id'];
                $resul->grupoarchivos_id = $_POST['grupoarchivos_id'];
                $resul->sexo = $_POST['sexo'];
                if (isset($_POST['tipo_proceso_contratacion'])){
                    $resul->tipo_proceso_contratacion = $_POST['tipo_proceso_contratacion'];
                } else {
                    $resul->tipo_proceso_contratacion = NULL;
                }
                if ($_POST['nombre_carpeta'] == ''){
                    $resul->nombre_carpeta = NULL;
                } else {
                    $resul->nombre_carpeta = $_POST['ruta_carpeta'];
                }
                $resul->ruta_carpeta = '/';
                if (isset($_POST['formato_archivo_digital'])){
                    $resul->formato_archivo_digital = $_POST['formato_archivo_digital'];
                } else {
                    $resul->formato_archivo_digital = NULL;
                }
                if ($_POST['resolucion_archivo_digital'] == ''){
                    $resul->resolucion_archivo_digital = NULL;
                } else {
                    $resul->resolucion_archivo_digital = $_POST['resolucion_archivo_digital'];
                }
                if ($_POST['altura_archivo_digital'] == ''){
                  $resul->altura_archivo_digital = NULL;
                } else {
                  $resul->altura_archivo_digital = $_POST['altura_archivo_digital'];
                }
                if ($_POST['anchura_archivo_digital'] == ''){
                  $resul->anchura_archivo_digital = NULL;
                } else {
                  $resul->anchura_archivo_digital = $_POST['anchura_archivo_digital'];
                }
                if (isset($_POST['campo_aux_a'])){
                  $resul->campo_aux_a = $_POST['campo_aux_a'];
                } else {
                  $resul->campo_aux_a = NULL;
                }
                if (isset($_POST['tipo_dato_campo_aux_a'])){
                  $resul->tipo_dato_campo_aux_a = $_POST['tipo_dato_campo_aux_a'];
                } else {
                  $resul->tipo_dato_campo_aux_a = NULL;
                }
                if (isset($_POST['campo_aux_b'])){
                  $resul->campo_aux_b = $_POST['campo_aux_b'];
                } else {
                  $resul->campo_aux_b = NULL;
                }
                if (isset($_POST['tipo_dato_campo_aux_b'])){
                  $resul->tipo_dato_campo_aux_b = $_POST['tipo_dato_campo_aux_b'];
                } else {
                  $resul->tipo_dato_campo_aux_b = NULL;
                }
                if (isset($_POST['campo_aux_c'])){
                  $resul->campo_aux_c = $_POST['campo_aux_c'];
                } else {
                  $resul->campo_aux_c = NULL;
                }
                if (isset($_POST['tipo_dato_campo_aux_c'])){
                  $resul->tipo_dato_campo_aux_c = $_POST['tipo_dato_campo_aux_c'];
                } else {
                  $resul->tipo_dato_campo_aux_c = NULL;
                }
                if (isset($_POST['observacion'])){
                  $resul->observacion = $_POST['observacion'];
                } else {
                  $resul->observacion = NULL;
                }
                $resul->estado = $_POST['estado'];
                $resul->baja_logica = 1;
                $resul->user_reg_id = 1;
                $resul->fecha_reg = $hoy;
                $resul->agrupador = 0;
                //echo $_POST['tipo_doc'];
                //$resul->save();
                if ($resul->save()) {
                    $msm = array('msm' => 'Exito: Se guardo correctamente' );
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
    public function saveparametroAction()
    {
        if (isset($_POST['id'])) {
            if ($_POST['id']>0) {
                $resul = new parametros();
                $resul = parametros::findFirstById($_POST['id']);
                if ($_POST['parametro'] == ''){
                    $resul->parametro = NULL;
                } else {
                    $resul->parametro = $_POST['parametro'];
                }
                if ($_POST['nivel'] == ''){
                    $resul->nivel = NULL;
                } else {
                    $resul->nivel = $_POST['nivel'];
                }
                $resul->valor_1 = $_POST['valor_1'];
                if ($_POST['valor_2'] == ''){
                    $resul->valor_2 = NULL;
                } else {
                    $resul->valor_2 = $_POST['valor_2'];
                }
                if ($_POST['valor_3'] == ''){
                    $resul->valor_3 = NULL;
                } else {
                    $resul->valor_3 = $_POST['valor_3'];
                }
                if (isset($_POST['valor_4'])){
                  $resul->valor_4 = $_POST['valor_4'];
                } else {
                  $resul->valor_4 = NULL;
                }
                if (isset($_POST['valor_5'])){
                  $resul->valor_5 = $_POST['valor_5'];
                } else {
                  $resul->valor_5 = NULL;
                }
                if ($_POST['descripcion']==''){
                    $resul->descripcion = NULL;
                } else {
                    $resul->descripcion = $_POST['descripcion'];
                }
                if (isset($_POST['observacion'])){
                  $resul->observacion = $_POST['observacion'];
                } else {
                  $resul->observacion = NULL;
                }
                $resul->save();
                if ($resul->save()) {
                    $msm = array('msm' => 'Exito: Se guardo correctamente' );
                } else {
                    $msm = array('msm' => 'Error: No se guardo el registro' );
                }
            } else {
                try{
                $resul = new parametros();//echo "param: ".$_POST['parametro'];
                $resul->parametro = $_POST['parametro'];
                if ($_POST['nivel'] == ''){
                    $resul->nivel = NULL;
                } else {
                    $resul->nivel = $_POST['nivel'];
                }
                $resul->valor_1 = $_POST['valor_1'];
                if ($_POST['valor_2'] == ''){
                    $resul->valor_2 = NULL;
                } else {
                    $resul->valor_2 = $_POST['valor_2'];
                }
                if ($_POST['valor_3'] == ''){
                    $resul->valor_3 = NULL;
                } else {
                    $resul->valor_3 = $_POST['valor_3'];
                }
                if (isset($_POST['valor_4'])){
                  $resul->valor_4 = $_POST['valor_4'];
                } else {
                  $resul->valor_4 = NULL;
                }
                if (isset($_POST['valor_5'])){
                  $resul->valor_5 = $_POST['valor_5'];
                } else {
                  $resul->valor_5 = NULL;
                }
                if ($_POST['descripcion']==''){
                    $resul->descripcion = NULL;
                } else {
                    $resul->descripcion = $_POST['descripcion'];
                }
                if (isset($_POST['observacion'])){
                  $resul->observacion = $_POST['observacion'];
                } else {
                  $resul->observacion = NULL;
                }
                $resul->agrupador = '0';
                $resul->estado = 0;
                $resul->baja_logica = 1;
                if ($resul->save()) {
                    $msm = array('msm' => 'Exito: Se guardo correctamente' );
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
}

