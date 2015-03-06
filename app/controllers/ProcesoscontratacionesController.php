<?php 
/**
* 
*/

class ProcesoscontratacionesController extends ControllerBase
{
	private $mes_array =array(
                "1" => "ENERO",
                "2"   => "FEBRERO",
                "3" => "MARZO",
                "4" => "ABRIL",
                "5" => "MAYO",
                "6" => "JUNIO",
                "7" => "JULIO",
                "8" => "AGOSTO",
                "9" => "SEPTIEMBRE",
                "10" => "OCTUBRE",
                "11" => "NOVIEMBRE",
                "12" => "DICIEMBRE"
                );

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
		$html='';
		foreach ($resul as $v) {
   			$html.='<tr>
							<td>'.$v->formacion_academica.'</td>
							<td>'.$v->exp_general.' '.$v->exp_general_aniomes.'</td>
							<td>'.$v->exp_profesional.' '.$v->exp_profesional_aniomes.'</td>
							<td>'.$v->exp_relacionado.' '.$v->exp_relacionado_aniomes.'</td>
					</tr>';
   		}
   		$this->view->disable();
		echo $html;
	}

	public function filtrarPostulantesAction()
	{
		$model = new Procesoscontrataciones();
		$resul = $model->filtrarPostulantes($_POST['id']);
		//sleep(5);
		if (count($resul)>0) {
			$msm = 'Exito: Se filtro correctamente los postulantes';
		}else{
			$msm = 'Error: No Se filtro correctamente los postulantes';
		}
		$this->view->disable();
		echo json_encode($msm);
	}

	public function verpostulantesAction($seguimiento_id)
	{
		$model = new Procesoscontrataciones();
		$resul = $model->listaCalificados($seguimiento_id);
		$this->view->setVar('calificados',$resul);		

		$model = new Procesoscontrataciones();
		$resul = $model->listaNoCalificados($seguimiento_id);
		$this->view->setVar('nocalificados',$resul);		

	}

	public function formulariopostulanteAction()
	{
		$calificacion = Pcalificaciones::findFirstById($_POST['id']);
		$model = new Procesoscontrataciones();
		$getcargo = $model->getcargopostula($calificacion->seguimiento_id);
		$getcargo_html="";
		foreach ($getcargo as $v) {
			$getcargo_html.='<tr>
							<td class="caja">'.$v->cargo.'</td>
						</tr>';
		}

		$resul = Ppostulantes::findFirstByid($_POST['postulante_id']);
		$model = new Ppostulantes();
   		$formacion = $model->listpformacion($_POST['postulante_id']);
   		$formacion_html='';
   		foreach ($formacion as $v) {
   			$formacion_html.='<tr>
							<td class="caja">'.$v->valor_1.'</td>
							<td class="caja">'.$v->documento_text.'</td>
							<td class="caja">'.$v->institucion.'</td>
							<td class="caja">'.$v->grado.'</td>
							<td class="caja">'.date("d-m-Y",strtotime($v->fecha_emision)).'</td>
							</tr>';
   		}
   		$expgeneral = Pexplabgenerales::find(array('baja_logica=1 and postulante_id='.$_POST['postulante_id'],'order' => 'gestion_desde ASC, mes_desde ASC'));
   		$expgeneral_html='';
   		foreach ($expgeneral as $v) {
   			$expgeneral_html.='<tr>
							<td class="caja">'.$this->mes_array[$v->mes_desde].' - '.$v->gestion_desde.'</td>
							<td class="caja">'.$this->mes_array[$v->mes_hasta].' - '.$v->gestion_hasta.'</td>
							<td class="caja">'.$v->cargo.'</td>
							<td class="caja">'.$v->empresa.'</td>
							<td class="caja">'.$v->motivo_retiro.'</td>
							<td class="caja">'.$v->doc_respaldo.'</td>
							</tr>';
   		}
   		$model = new Ppostulantes();
    	$expespecifica = $model->listpexplabespecifica($_POST['postulante_id'],$calificacion->seguimiento_id,1);
   		$expespecifica_html='';
   		foreach ($expespecifica as $v) {
   			$expespecifica_html.='<tr>
							<td class="caja">'.$this->mes_array[$v->mes_desde].' - '.$v->gestion_desde.'</td>
							<td class="caja">'.$this->mes_array[$v->mes_hasta].' - '.$v->gestion_hasta.'</td>
							<td class="caja">'.$v->cargo.'</td>
							<td class="caja">'.$v->institucion.'</td>
							<td class="caja">'.$v->desc_fun.'</td>
							<td class="caja">'.$v->doc_respaldo.'</td>
							</tr>';
   		}
   		$curso = Pcursos::find(array('baja_logica=1 and postulante_id='.$_POST['postulante_id'],'order' => 'id ASC'));
   		$curso_html='';
   		foreach ($curso as $v) {
   			$curso_html.='<tr>
							<td class="caja">'.$v->gestion.'</td>
							<td class="caja">'.$v->institucion.'</td>
							<td class="caja">'.$v->nombre_curso.'</td>
							<td class="caja">'.$v->duracion_hrs.'</td>
							</tr>';
   		}
   		$paquete = Ppaquetes::find(array('baja_logica=1 and postulante_id='.$_POST['postulante_id'],'order' => 'id ASC'));
   		$paquete_html='';
   		foreach ($paquete as $v) {
   			$paquete_html.='<tr>
							<td class="caja">'.$v->aplicacion.'</td>
							<td class="caja">'.$v->nivel.'</td>
							</tr>';
   		}
   		$idioma = Pidiomas::find(array('baja_logica=1 and postulante_id='.$_POST['postulante_id'],'order' => 'id ASC'));
   		$idioma_html='';
   		foreach ($idioma as $v) {
   			$idioma_html.='<tr>
							<td class="caja">'.$v->idioma.'</td>
							<td class="caja">'.$v->lectura.'</td>
							<td class="caja">'.$v->escritura.'</td>
							<td class="caja">'.$v->conversacion.'</td>
							</tr>';
   		}
   		$docencia = Pdocencias::find(array('baja_logica=1 and postulante_id='.$_POST['postulante_id'],'order' => 'id ASC'));
   		$docencia_html='';
   		foreach ($docencia as $v) {
   			$docencia_html.='<tr>
							<td class="caja">'.$v->gestion.'</td>
							<td class="caja">'.$v->institucion.'</td>
							<td class="caja">'.$v->materia.'</td>
							<td class="caja">'.$v->duracion.'</td>
							</tr>';
   		}
   		$referencia = Preferencias::find(array('baja_logica=1 and postulante_id='.$_POST['postulante_id'],'order' => 'id ASC'));
   		$referencia_html='';
   		foreach ($referencia as $v) {
   			$referencia_html.='<tr>
							<td class="caja">'.$v->nombres_y_apps.'</td>
							<td class="caja">'.$v->institucion.'</td>
							<td class="caja">'.$v->cargo.'</td>
							<td class="caja">'.$v->telefono.'</td>
							</tr>';
   		}
   		$referenciapersonal = Preferenciaspersonales::find(array('baja_logica=1 and postulante_id='.$_POST['postulante_id'],'order' => 'id ASC'));
   		$referenciapersonal_html='';
   		foreach ($referenciapersonal as $v) {
   			$referenciapersonal_html.='<tr>
							<td class="caja">'.$v->nombres_y_apps.'</td>
							<td class="caja">'.$v->parentesco.'</td>
							<td class="caja">'.$v->telefono.'</td>
							</tr>';
   		}
    	//$this->view->setVar('postulante',$resul);
		$nombre = "Luis Freddy Velasco";
		$html = '
		
		<div class="block">
			<center><h4>FORMULARIO ÚNICO DE POSTULACIÓN</h4></center>	
			<div class="table-responsive" >
				<table class="table table-vcenter table-striped tabla1">
						<tr>
							<th>CARGO AL QUE POSTULA</th>
						</tr>
						'.$getcargo_html.'
				</table>
				<h4><strong>Datos Personales</strong></h4>
				<table class="table table-vcenter table-striped tabla1">
						<tr>
							<th>NOMBRE(S)</th>
							<th>APELLIDO PATERNO</th>
							<th>APELLIDO MATERNO</th>
						</tr>
						<tr>
							<td class="caja">'.$resul->nombre.'</td>
							<td class="caja">'.$resul->app.'</td>
							<td class="caja">'.$resul->apm.'</td>
						</tr>
				</table>
				<table class="table table-vcenter table-striped tabla1">
						<tr>
							<th>CEDULA DE IDENTIDAD</th>
							<th>FECHA DE NACIMIENTO</th>
							<th>NACIONALIDAD</th>
							<th>ESTADO CIVIL</th>
							<th>CODIGO LIBRETA MILITAR</th>
							<th>CERTIFICADO DE EMPADRONAMIENTO</th>
						</tr>
						<tr>
							<td class="caja">'.$resul->ci.'</td>
							<td class="caja">'.$resul->fecha_nac.'</td>
							<td class="caja">'.$resul->nacionalidad.'</td>
							<td class="caja">'.$resul->estado_civil.'</td>
							<td class="caja">'.$resul->libreta_militar.'</td>
							<td class="caja">'.$resul->empadronamiento.'</td>
						</tr>
				</table>
				<table class="table table-vcenter table-striped tabla1">
						<tr>
							<th>DIRECCIÓN DE DOMICILIO</th>
							<th>TELEFONO</th>
							<th>TELEFONO DE CELULAR</th>
							<th>PARIENTES EN LA EMPRESA</th>
						</tr>
						<tr>
							<td class="caja">'.$resul->direccion.'</td>
							<td class="caja">'.$resul->telefono.'</td>
							<td class="caja">'.$resul->celular.'</td>
							<td class="caja">'.$resul->parentesco.'</td>
						</tr>
				</table>
				<table class="table table-vcenter table-striped tabla1">
						<tr>
							<th>CORREO ELECTRÓNICO</th>
							<th>LUGAR DE POSTULACIÓN</th>
							<th>FECHA DE REGISTRO</th>
						</tr>
						<tr>
							<td class="caja">'.$resul->correo.'</td>
							<td class="caja">'.$resul->lugar_postulacion.'</td>
							<td class="caja">'.date("d-m-Y",strtotime($resul->fecha_registro)).'</td>
						</tr>
				</table>
				<h4><strong>Formación Academica</strong></h4>
				<table class="table table-vcenter table-striped tabla1">
						<tr>
							<th>FORMACIÓN ACADEMICA</th>
							<th>DOCUMENTO</th>
							<th>INSTITUCIÓN</th>
							<th>GRADO O TITULO OBTENIDO</th>
							<th>FECHA EMISIÓN</th>
						</tr>
						'.$formacion_html.'
				</table>
				<h4><strong>Experiencia Laboral General</strong></h4>
				<table class="table table-vcenter table-striped tabla1">
						<tr>
							<th>DESDE</th>
							<th>HASTA</th>
							<th>CARGO</th>
							<th>EMPRESA O INSTITUCIÓN</th>
							<th>MOTIVO RETIRO</th>
							<th>DOC. DE RESPALDO</th>
						</tr>
						'.$expgeneral_html.'
				</table>
				<p style="font-size: 10px;"><strong>TOTAL EXPERIENCIA GENERAL: </strong> '.$this->calculoaniomes($calificacion->exp_general_meses).'</p>
				<h4><strong>Experiencia Laboral Especifica</strong></h4>
				<table class="table table-vcenter table-striped tabla1">
						<tr>
							<th>DESDE</th>
							<th>HASTA</th>
							<th>CARGO</th>
							<th>EMPRESA O INSTITUCIÓN</th>
							<th>DESCRIPCIÓN DE FUNCIONES</th>
							<th>DOC. DE RESPALDO</th>
						</tr>
						'.$expespecifica_html.'
				</table>
				<p style="font-size: 10px;"><strong>TOTAL EXPERIENCIA ESPECIFICA: </strong> '.$this->calculoaniomes($calificacion->exp_relacionado_meses).'</p>
				<p style="font-size: 10px;"><strong>TOTAL EXPERIENCIA PROFESIONAL: </strong> '.$this->calculoaniomes($calificacion->exp_profesional_meses).' </p>
				<h4><strong>Cursos, Seminarios y Talleres de Capacitación</strong></h4>
				<table class="table table-vcenter table-striped tabla1">
						<tr>
							<th>AÑO</th>
							<th>INSTITUCIÓN</th>
							<th>NOMBRE DEL CURSO</th>
							<th>DURACIÓN EN HORAS</th>
						</tr>
						'.$curso_html.'
				</table>
				<h4><strong>Manejo de Paquetes de Computación</strong></h4>
				<table class="table table-vcenter table-striped tabla1">
						<tr>
							<th>APLICACIÓN</th>
							<th>NIVEL</th>
						</tr>
						'.$paquete_html.'
				</table>
				<h4><strong>Idiomas</strong></h4>
				<table class="table table-vcenter table-striped tabla1">
						<tr>
							<th>IDIOMA</th>
							<th>LECTURA</th>
							<th>ESCRITURA</th>
							<th>CONVERSACIÓN</th>
						</tr>
						'.$idioma_html.'
				</table>
				<h4><strong>Docencia o Experiencia Académica</strong></h4>
				<table class="table table-vcenter table-striped tabla1">
						<tr>
							<th>AÑO</th>
							<th>INSTITUCIÓN</th>
							<th>NOMBRE DE LA MATERIA O CURSO IMPARTIDO</th>
							<th>DURACIÓN EN HORAS</th>
						</tr>
						'.$docencia_html.'
				</table>
				<h4><strong>Referencias Laborales</strong></h4>
				<table class="table table-vcenter table-striped tabla1">
						<tr>
							<th>NOMBRE(S) Y APELLIDO(S)</th>
							<th>INSTITUCIÓN</th>
							<th>CARGO</th>
							<th>TELEFONO(S)</th>
						</tr>
						'.$referencia_html.'
				</table>
				<h4><strong>Referencias Personales</strong></h4>
				<table class="table table-vcenter table-striped tabla1">
						<tr>
							<th>NOMBRE(S) Y APELLIDO(S)</th>
							<th>PARENTESCO</th>
							<th>TELEFONO(S)</th>
						</tr>
						'.$referenciapersonal_html.'
				</table>
				<br><br><br><br>
				<div style="margin: auto;text-align:center;width:200px;border-top-color:black;border-top-style:dotted;border-top-width:1px; ">FIRMA DEL POSTULANTE</div>
				<h5> FECHA DE EMISIÓN DEL REPORTE: '.date("d-m-Y H:i:s").' </h3>
				<h5> NOTA:ESTE DOCUMENTO DE POSTULACIÓN ES CONSIDERADO COMO UNA DECLARACIÓN JURADA, ESTO SIGNIFICA QUE TIENE VALOR DE PUNTUACIÓN AL MOMENTO DE EVALUAR SU POSTULACIÓN. </h3>
			</div>
		</div>


		<style type="text/css">
			.tabla1 {
				font-size: 11px;
				width: 100%;
			}
			th{
				font-size: 11px !import;
				text-align:center;
			}
			.caja {
				border-color: #444444;
				border-radius: 5px;
				border-style: solid;
				border-width: 1px;
				padding: 1px 10px;
				text-align: center;
			}
		</style>
		';
		$this->view->disable();
		echo $html;	
	}

	public function calculoaniomes($value='')
	{
		$meses = $value%12;
		$anio = floor($value/12);
		$cadena = $meses." MESES";
		if($anio>0){
			$cadena=$anio." AÑOS y ".$cadena;
		}
		return $cadena;
	}

}
?>