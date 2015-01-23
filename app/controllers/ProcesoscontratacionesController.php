<?php 
/**
* 
*/

class ProcesoscontratacionesController extends ControllerBase
{
	public function initialize() {
		parent::initialize();
	}

	public function indexAction()
	{
		$resul=Normativasmod::find(array('baja_logica=1','order'=>'id ASC'));
		$this->view->setVar('normativamod',$resul);

		//$this->tag->setDefault("padre_id", $id);
		$organigrama_id = $this->tag->select(
			array(
				'organigrama_id',
				Organigramas::find(array('baja_logica=1','order' => 'unidad_administrativa ASC')),
				'using' => array('id', "unidad_administrativa"),
				'useEmpty' => true,
				'emptyText' => '(Seleccionar)',
				'emptyValue' => '0',
				'class' => 'form-control select-chosen'
				)
			);
		$this->view->setVar('organigrama_id',$organigrama_id);

		//$this->tag->setDefault("padre_id", $id);
		$seguimientoestado = $this->tag->select(
			array(
				'seguimiento_estado_id',
				Seguimientosestados::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "estado"),
				'useEmpty' => false,
				'emptyText' => '(Seleccionar)',
				'emptyValue' => '0',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('seguimientoestado',$seguimientoestado);
	}

	public function listAction()
	{
		//$resul = Procesoscontrataciones::find(array('baja_logica=1','order' => 'id ASC'));
		$model = new Procesoscontrataciones();
		$resul= $model->lista();
		$this->view->disable();
		foreach ($resul as $v) {
			$customers[] = array(
				'id' => $v->id,
				'denominacion' => $v->denominacion,
				'codigo_convocatoria' => $v->codigo_convocatoria,
				'normativamod_id' => $v->normativamod_id,
				'fecha_publ' => $v->fecha_publ,
				'fecha_recep' => $v->fecha_recep,
				'fecha_concl' => $v->fecha_concl,
				);
		}
		echo json_encode($customers);
	}

	public function listseguimientoAction()
	{
		//$resul = Seguimientos::find(array('baja_logica=1','order' => 'id ASC'));
		$pc = new Procesoscontrataciones();
		$resul= $pc->listseguimiento();
		
		$this->view->disable();
		foreach ($resul as $v) {
			$customers[] = array(
				'id' => $v->id,
				'pac_id' => $v->pac_id,
				'proceso_contratacion_id' => $v->proceso_contratacion_id,
				'codigo' => $v->codigo,
				'cargo' => $v->cargo,
				'sueldo' => $v->sueldo,
				'estado' => $v->estado,
				'unidad_administrativa' => $v->unidad_administrativa
				);
		}
		echo json_encode($customers);
	}


	public function addAction()
	{	$auth = $this->session->get('auth');
		$resul=Normativasmod::find(array('baja_logica=1','order'=>'id ASC'));
		$this->view->setVar('normativamod',$resul);

		$resolucion_ministerial0 = Resoluciones::findFirst(array("uso=1 and activo=1 and baja_logica=1"));
		$this->view->setVar('tipo_resolucion',$resolucion_ministerial0->tipo_resolucion);

		if ($this->request->isPost()) {
			$resul = new Procesoscontrataciones();
				$resul->normativamod_id = $_POST['normativamod_id'];
				$resul->codigo_convocatoria = $_POST['codigo_convocatoria2'];
				$resul->regional_id = 1;
				$resul->codigo_proceso = "MT-".$_POST['codigo_convocatoria2'];
				$resul->gestion = date("Y");
				$resul->fecha_publ = date("Y-m-d",strtotime($_POST['fecha_publ']));
				$resul->fecha_recep = date("Y-m-d",strtotime($_POST['fecha_recep']));
				$resul->fecha_concl = date("Y-m-d",strtotime($_POST['fecha_concl']));
				$resul->tipoconvocatoria_id = 1;
				$resul->observacion = $_POST['observacion'];
				$resul->estado = 1;
				$resul->baja_logica = 1;
				$resul->agrupador = 1;
				$resul->user_reg_id = $auth['id'];
				$resul->fecha_reg = date("Y-m-d H:i:s");
				if ($resul->save()) {
					$pac_id = explode(',', $_POST['pac_ids']);
					foreach ($pac_id as $v) {
						$resul2 = new Seguimientos();
						$resul2->pac_id = $v;
						$resul2->proceso_contratacion_id = $resul->id;
						$resul2->seguimiento_estado_id = 1;
						$resul2->codigo_proceso = $_POST['codigo_convocatoria2'];
						$resul2->estado = 1;
						$resul2->user_reg_id = $auth['id'];
						$resul2->organigrama_id = 0;
						$resul2->fecha_reg = date("Y-m-d H:i:s");
						$resul2->baja_logica = 1;
						$resul2->save();
						
					}
				$this->flashSession->success("Exito: Registro guardado correctamente...");
					
				}else{
					$this->flashSession->error("Error: no se guardo el registro...");
				}
				
				$this->response->redirect('/procesoscontrataciones');
		}
		
	}

	public function editAction($id)
	{	$auth = $this->session->get('auth');
		$resul=Normativasmod::find(array('baja_logica=1','order'=>'id ASC'));
		$this->view->setVar('normativamod',$resul);

		$resul= Procesoscontrataciones::findFirstById($id);
		$this->view->setVar('procesocontratacion',$resul);

		$resolucion_ministerial0 = Resoluciones::findFirst(array("uso=1 and activo=1 and baja_logica=1"));
		$this->view->setVar('tipo_resolucion',$resolucion_ministerial0->tipo_resolucion);

		if ($this->request->isPost()) {
			$resul = Procesoscontrataciones::findFirstById($id);
			$resul->normativamod_id = $_POST['normativamod_id'];
			$resul->codigo_convocatoria = $_POST['codigo_convocatoria2'];
			$resul->regional_id = 1;
			$resul->codigo_proceso = "MT-".$_POST['codigo_convocatoria2'];
			$resul->fecha_publ = date("Y-m-d",strtotime($_POST['fecha_publ']));
			$resul->fecha_recep = date("Y-m-d",strtotime($_POST['fecha_recep']));
			$resul->fecha_concl = date("Y-m-d",strtotime($_POST['fecha_concl']));
			$resul->observacion = $_POST['observacion'];
				// $resul->tipoconvocatoria_id = 1;
				// $resul->estado = 1;
				// $resul->baja_logica = 1;
				// $resul->agrupador = 1;
				// $resul->user_reg_id = $auth['id'];
				// $resul->fecha_reg = date("Y-m-d H:i:s");
			if ($resul->save()) {
				$pac_id = explode(',', $_POST['pac_ids']);
				$model = new Procesoscontrataciones();
				$resul4 = $model->seguimientoCero($id);

				foreach ($pac_id as $v) {
					
					$resul5=Seguimientos::findFirst(array('proceso_contratacion_id='.$id.' AND pac_id='.$v,'order'=>'id DESC','limit'=> 1));
					if ($resul5!=false) {
						$resul2=Seguimientos::findFirstById($resul5->id);
						$resul2->baja_logica = 1;
						$resul2->save();
					}else{
						$resul2 = new Seguimientos();
						$resul2->pac_id = $v;
						$resul2->proceso_contratacion_id = $resul->id;
						$resul2->seguimiento_estado_id = 1;
						$resul2->codigo_proceso = $_POST['codigo_convocatoria2'];
						$resul2->estado = 1;
						$resul2->user_reg_id = $auth['id'];
						$resul2->organigrama_id = 0;
						$resul2->fecha_reg = date("Y-m-d H:i:s");
						$resul2->baja_logica = 1;
						$resul2->save();	
					}

				}
				$this->flashSession->success("Exito: Registro guardado correctamente...");

			}else{
				$this->flashSession->error("Error: no se guardo el registro...");
			}

			$this->response->redirect('/procesoscontrataciones');
		}
		
	}

	/*
	public function saveAction()
	{	$auth = $this->session->get('auth');
		if (isset($_POST['id'])) {
			$date = new DateTime($_POST['fecha_publ']);
			$fecha_publ = $date->format('Y-m-d');
			$date = new DateTime($_POST['fecha_recep']);
			$fecha_recep = $date->format('Y-m-d');
			$date = new DateTime($_POST['fecha_concl']);
			$fecha_concl = $date->format('Y-m-d');

			if ($_POST['id']>0) {
				$resul = Procesoscontrataciones::findFirstById($_POST['id']);
				$resul->normativamod_id = $_POST['normativamod_id'];
				$resul->codigo_convocatoria = $_POST['codigo_convocatoria'];
				$resul->codigo_proceso = "MT-".$_POST['codigo_convocatoria'];
				//$resul->gestion = date("Y");
				$resul->fecha_publ = $fecha_publ;
				$resul->fecha_recep = $fecha_recep;
				$resul->fecha_concl = $fecha_concl;
				if ($resul->save()) {
					$msm = array('msm' => 'Exito: Se guardo correctamente' );
				}else{
					$msm = array('msm' => 'Error: No se guardo el registro' );
				}
			}
			else{
				$resul = new Procesoscontrataciones();
				$resul->normativamod_id = $_POST['normativamod_id'];
				$resul->codigo_convocatoria = $_POST['codigo_convocatoria'];
				$resul->regional_id = 1;
				$resul->codigo_proceso = "MT-".$_POST['codigo_convocatoria'];
				$resul->gestion = date("Y");
				$resul->fecha_publ = date("Y-m-d",strtotime($_POST['fecha_publ']));
				$resul->fecha_recep = date("Y-m-d",strtotime($_POST['fecha_recep']));
				$resul->fecha_concl = date("Y-m-d",strtotime($_POST['fecha_concl']));
				$resul->tipoconvocatoria_id = 1;
				$resul->estado = 1;
				$resul->baja_logica = 1;
				$resul->agrupador = 1;
				$resul->user_reg_id = $auth['id'];
				$resul->fecha_reg = date("Y-m-d H:i:s");

				if ($resul->save()) {
					$msm = array('msm' => 'Exito: Se guardo correctamente' );
				}else{
					$msm = array('msm' => 'Error: No se guardo el registro' );
				}
				
			
			}	
		}
		$this->view->disable();
		echo json_encode($msm);
	}
*/
	public function deleteAction(){
		$resul = Procesoscontrataciones::findFirstById($_POST['id']);
		$resul->baja_logica = 0;
		if ($resul->save()) {
			$resul2 = Seguimientos::find(array('proceso_contratacion_id='.$resul->id));
			foreach ($resul2 as $v) {
				$resul3 = Seguimientos::findFirstById($v->id);
				$resul3->baja_logica = 0;
				$resul3->save();
			}
			$msm = 'Exito: Se elimino correctamente';
		}else{
			$msm = 'Error: No se elimino el registro';
		}
		$this->view->disable();
		echo json_encode($msm);
	}

public function listpacAction()
{
	//$estado = array('Rechazado','Espera','Proceso','Aprobado','Adjudicado');
	$model = new Cargos();
	$resul = $model->listapac(1);
	$this->view->disable();
	foreach ($resul as $v) {
		$customers[] = array(
			'id' => $v->id,
			'tipo_resolucion' => $v->tipo_resolucion,
			'unidad_administrativa' => $v->unidad_administrativa,
			'codigo' => $v->codigo,
			'cargo' => $v->cargo,
			'sueldo' => $v->sueldo,
			'gestion' => $v->gestion,
			'fecha_ini' => date("d-m-Y",strtotime($v->fecha_ini)),
			'fecha_fin' => date("d-m-Y",strtotime($v->fecha_fin))
			);
	}
	echo json_encode($customers);
}


public function listpaceditAction($proceso_contratacion_id)
{
	//$estado = array('Rechazado','Espera','Proceso','Aprobado','Adjudicado');
	$model = new Cargos();
	$resul = $model->listaeditpac($proceso_contratacion_id);
	$this->view->disable();
	foreach ($resul as $v) {
		$customers[] = array(
			'id' => $v->id,
			'tipo_resolucion' => $v->tipo_resolucion,
			'unidad_administrativa' => $v->unidad_administrativa,
			'codigo' => $v->codigo,
			'cargo' => $v->cargo,
			'sueldo' => $v->sueldo,
			'gestion' => $v->gestion,
			'proceso_contratacion_id' => $v->proceso_contratacion_id,
			'fecha_ini' => date("d-m-Y",strtotime($v->fecha_ini)),
			'fecha_fin' => date("d-m-Y",strtotime($v->fecha_fin))
			);
	}
	echo json_encode($customers);
}


	public function getSeguimientoAction()
	{
	$model = new Procesoscontrataciones();
	$resul = $model->getSeguimiento($_POST['id']);
	$this->view->disable();
	foreach ($resul as $v) {
		$customers = array(
			'id_seguimiento' => $v->id,
			'pac_id' => $v->pac_id,
			'proceso_contratacion_id' => $v->proceso_contratacion_id,
			'codigo_convocatoria' => $v->codigo_convocatoria,
			'organigrama_id' => $v->organigrama_id,
			'usuario_sol' => $v->usuario_sol,
			'fecha_sol' => $v->fecha_sol,
			'cert_presupuestaria' => $v->cert_presupuestaria,
			'fecha_cert_pre' => $v->fecha_cert_pre,
			'fecha_apr_mae' => $v->fecha_apr_mae,
			'seguimiento_estado_id' => $v->seguimiento_estado_id,
			'denominacion' => $v->denominacion
			);
	}
	echo json_encode($customers);
	}

	public function editSeguimientoAction()
	{
		$fecha_sol = null;
		$fecha_cert_pre = null;
		$fecha_apr_mae = NULL;
		if ($_POST['fecha_sol']!='') {
			$fecha_sol = date("Y-m-d",strtotime($_POST['fecha_sol']));
		}
		if ($_POST['fecha_cert_pre']!='') {
			$fecha_cert_pre = date("Y-m-d",strtotime($_POST['fecha_cert_pre']));
		}
		if ($_POST['fecha_apr_mae']!='') {
			$fecha_apr_mae = date("Y-m-d",strtotime($_POST['fecha_apr_mae']));
		}
		

		$resul = Seguimientos::findFirstById($_POST['id']);
		$resul->fecha_sol = $fecha_sol;
		$resul->fecha_cert_pre = $fecha_cert_pre;
		$resul->fecha_apr_mae = $fecha_apr_mae;
		$resul->organigrama_id = $_POST['organigrama_id'];
		$resul->usuario_sol = $_POST['usuario_sol'];
		$resul->cert_presupuestaria = $_POST['cert_presupuestaria'];
		$resul->seguimiento_estado_id = $_POST['seguimiento_estado_id'];
		if ($resul->save()) {
					$msm = 'Exito: Se guardo correctamente';
				}else{
					$msm = 'Error: No se guardo el registro';
				}
		$this->view->disable();
		echo json_encode($msm);

	}


	public function saveAdjudicadoAction()
	{
		

			if ($_POST['id_seguimiento']>0) {
				$resul = new Adjudicatarios();
				$resul->nombre = $_POST['nombre'];
				$resul->seguimiento_id = $_POST['id_seguimiento'];
				$resul->ci = $_POST['ci'];
				$resul->baja_logica = 1;
				if ($resul->save()) {
					$msm = 'Exito: Se guardo correctamente';
				}else{
					$msm = 'Error: No se guardo el registro';
				}
			}
		
	$this->view->disable();
	echo json_encode($msm);
	}

	public function listAdjudicadoAction()
	{
			$html='';
			if ($_POST['id_seguimiento']>0) {
				$resul=Adjudicatarios::find(array('baja_logica=1 and seguimiento_id='.$_POST['id_seguimiento'],'order'=>'id ASC'));
				foreach ($resul as $v) {
					$nombre = $v->nombre.' - '.$v->ci;
					$html.= '<li class="list-group-item "><button class="btn btn-warning btn-circle badge delete_adjudicado" type="button" adjudicado="'.$v->id.'" nombre="'.$nombre.'" ><i class="fa fa-times"></i></button>'.$nombre.'</li>'; 	
					//$html.= '<li class="freddy">'.$v->nombre.' - '.$v->ci.' - '.$v->id.'</li>'; 	
				}	
			}
	$this->view->disable();
	echo $html;
	}

	public function deleteAdjudicadoAction()
	{
		$resul = Adjudicatarios::findFirstById($_POST['id']);
		$resul->baja_logica = 0;
		if ($resul->save()) {
					$msm = 'Exito: Se elimino correctamente';
				}else{
					$msm = 'Error: No se elimino el registro';
				}
		$this->view->disable();
		echo json_encode($msm);
	}

	public function saveComisionAction()
	{
		if (isset($_POST['id_seguimiento'])) {

			if ($_POST['id_seguimiento']>0) {
				$resul = new Comisioncalificaciones();
				//$resul->nombre = $_POST['nombre'];
				$resul->seguimiento_id = $_POST['id_seguimiento'];
				$resul->nombre = $_POST['nombre'];
				$resul->cargo = $_POST['cargo'];
				$resul->baja_logica = "1";
				if ($resul->save()) {
					$msm = 'Exito: Se guardo correctamente';
				}else{
					$msm = 'Error: No se guardo el registro';
				}
			}
		}
	$this->view->disable();
	echo json_encode($msm);
	}

	public function listComisionAction()
	{
			$html='';
			if ($_POST['id_seguimiento']>0) {
				$resul=Comisioncalificaciones::find(array('baja_logica=1 and seguimiento_id='.$_POST['id_seguimiento'],'order'=>'id ASC'));
				foreach ($resul as $v) {
					$nombre = $v->cargo.' - '.$v->nombre;
					$html.= '<li class="list-group-item "><button class="btn btn-warning btn-circle badge delete_comision" type="button" comision="'.$v->id.'" nombre="'.$nombre.'" ><i class="fa fa-times"></i></button>'.$nombre.'</li>'; 	
					//$html.= '<li class="freddy">'.$v->nombre.' - '.$v->ci.' - '.$v->id.'</li>'; 	
				}	
			}
	$this->view->disable();
	echo $html;
	}

	public function deleteComisionAction()
	{
		$resul = Comisioncalificaciones::findFirstById($_POST['id']);
		$resul->baja_logica = 0;
		if ($resul->save()) {
					$msm = 'Exito: Se elimino correctamente';
				}else{
					$msm = 'Error: No se elimino el registro';
				}
		$this->view->disable();
		echo json_encode($msm);
	}


	public function getPerfilCargoAction()
	{
	$model = new Procesoscontrataciones();
	$resul = $model->getPerfilCargo($_POST['id_seguimiento']);
	$this->view->disable();
	foreach ($resul as $v) {
		if ($v->area_sustantiva==1) {
			$customers = array(
			'id_seguimiento' => $v->id,
			'formacion_academica' => $v->formacion_academica,
			'exp_general_lic_anio' => $v->exp_general_lic_anio,
			'exp_general_lic_mes' => $v->exp_general_lic_mes,
			'exp_general_tec_anio' => $v->exp_general_tec_anio,
			'exp_general_tec_mes' => $v->exp_general_tec_mes,
			'exp_profesional_lic_anio' => $v->exp_profesional_lic_anio,
			'exp_profesional_lic_mes' => $v->exp_profesional_lic_mes,
			'exp_profesional_tec_anio' => $v->exp_profesional_tec_anio,
			'exp_profesional_tec_mes' => $v->exp_profesional_tec_mes,
			'exp_relacionado_lic_anio' => $v->exp_relacionado_lic_anio,
			'exp_relacionado_lic_mes' => $v->exp_relacionado_lic_mes,
			'exp_relacionado_tec_anio' => $v->exp_relacionado_tec_anio,
			'exp_relacionado_tec_mes' => $v->exp_relacionado_tec_mes

			);
		}else{
			$customers = array(
			'id_seguimiento' => $v->id,
			'formacion_academica' => $v->formacion_academica0,
			'exp_general_lic_anio' => $v->exp_general_lic0_anio,
			'exp_general_lic_mes' => $v->exp_general_lic0_mes,
			'exp_general_tec_anio' => $v->exp_general_tec0_anio,
			'exp_general_tec_mes' => $v->exp_general_tec0_mes,
			'exp_profesional_lic_anio' => $v->exp_profesional_lic0_anio,
			'exp_profesional_lic_mes' => $v->exp_profesional_lic0_mes,
			'exp_profesional_tec_anio' => $v->exp_profesional_tec0_anio,
			'exp_profesional_tec_mes' => $v->exp_profesional_tec0_mes,
			'exp_relacionado_lic_anio' => $v->exp_relacionado_lic0_anio,
			'exp_relacionado_lic_mes' => $v->exp_relacionado_lic0_mes,
			'exp_relacionado_tec_anio' => $v->exp_relacionado_tec0_anio,
			'exp_relacionado_tec_mes' => $v->exp_relacionado_tec0_mes
			);	
		}
	}
	echo json_encode($customers);
	}

}
?>