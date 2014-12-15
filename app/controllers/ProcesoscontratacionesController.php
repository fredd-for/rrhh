<?php 
/**
* 
*/

class ProcesoscontratacionesController extends ControllerBaseFreddy
{
	public function initialize() {
		parent::initialize();
	}

	public function indexAction()
	{
		$this->assets
                    ->addJs('/js/jqwidgets/simulator.js')
                    ->addJs('/js/jqwidgets/jqxcore.js')
                    ->addJs('/js/jqwidgets/jqxdata.js')
                    ->addJs('/js/jqwidgets/jqxbuttons.js')
                    ->addJs('/js/jqwidgets/jqxscrollbar.js')
                    ->addJs('/js/jqwidgets/jqxdatatable.js')
                    ->addJs('/js/jqwidgets/jqxlistbox.js')
                    ->addJs('/js/jqwidgets/jqxdropdownlist.js')
                    ->addJs('/js/jqwidgets/jqxpanel.js')
                    ->addJs('/js/jqwidgets/jqxradiobutton.js')
                    ->addJs('/js/jqwidgets/jqxinput.js')
                    ->addJs('/js/datepicker/bootstrap-datepicker.js')
                    ->addJs('/js/datatables/dataTables.bootstrap.js')

                    ->addJs('/js/jqwidgets/jqxmenu.js')
                    ->addJs('/js/jqwidgets/jqxgrid.js')
                    ->addJs('/js/jqwidgets/jqxgrid.filter.js')
                    ->addJs('/js/jqwidgets/jqxgrid.sort.js')
                    ->addJs('/js/jqwidgets/jqxtabs.js')
                    ->addJs('/js/jqwidgets/jqxgrid.selection.js')
                    ->addJs('/js/jqwidgets/jqxcalendar.js')
                    ->addJs('/js/jqwidgets/jqxdatetimeinput.js')
                    ->addJs('/js/jqwidgets/jqxcheckbox.js')
                    ->addJs('/js/jqwidgets/jqxgrid.grouping.js')
                    ->addJs('/js/jqwidgets/jqxgrid.pager.js')
                    ->addJs('/js/jqwidgets/jqxnumberinput.js')
                    ->addJs('/js/jqwidgets/jqxwindow.js')
                    ->addJs('/js/jqwidgets/globalization/globalize.js')
                    ->addJs('/js/jqwidgets/jqxcombobox.js')
                    ->addJs('/js/jqwidgets/jqxexpander.js')
                    ->addJs('/js/jqwidgets/globalization/globalize.js')
                    ->addJs('/js/jqwidgets/jqxvalidator.js')
                    ->addJs('/js/jqwidgets/jqxmaskedinput.js')
                    ->addJs('/js/jqwidgets/jqxchart.js')
                    ->addJs('/js/jqwidgets/jqxgrid.columnsresize.js')
                    ->addJs('/js/jqwidgets/jqxsplitter.js')
                    ->addJs('/js/jqwidgets/jqxtree.js')
                    ->addJs('/js/jqwidgets/jqxdata.export.js')
                    ->addJs('/js/jqwidgets/jqxgrid.export.js')
                    ->addJs('/js/jqwidgets/jqxgrid.edit.js')
                    ->addJs('/js/jqwidgets/jqxnotification.js')
                    ->addJs('/js/jqwidgets/jqxbuttongroup.js')
                    ->addJs('/js/bootbox.js')

            ;
		$resul=Normativasmod::find(array('baja_logica=1','order'=>'id ASC'));
		$this->view->setVar('normativamod',$resul);
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
				'fecha_publ' => date("Y-m-d",strtotime($v->fecha_publ)),
				'fecha_recep' => date("Y-m-d",strtotime($v->fecha_recep)),
				'fecha_concl' => date("Y-m-d",strtotime($v->fecha_concl)),
				);
		}
		echo json_encode($customers);
	}

	public function listseguimientoAction()
	{
		$resul = Seguimientos::find(array('baja_logica=1','order' => 'id ASC'));
		/*$model = new Procesoscontrataciones();
		$resul= $model->listaseguimiento();
		*/
		$this->view->disable();
		foreach ($resul as $v) {
			$customers[] = array(
				'id' => $v->id,
				'proceso_contratacion_id' => $v->proceso_contratacion_id,
				'codigo_cargo' => $v->codigo_cargo,
				'cargo' => $v->cargo,
				'sueldo' => $v->sueldo,
				);
		}
		echo json_encode($customers);
	}


	public function addAction()
	{	
		$this->assets
                    // ->addJs('/js/jqwidgets/simulator.js')
                    ->addJs('/js/jqwidgets/jqxcore.js')
                    ->addJs('/js/jqwidgets/jqxdata.js')
                    ->addJs('/js/jqwidgets/jqxbuttons.js')
                    ->addJs('/js/jqwidgets/jqxscrollbar.js')
                    ->addJs('/js/jqwidgets/jqxdatatable.js')
                    ->addJs('/js/jqwidgets/jqxlistbox.js')
                    ->addJs('/js/jqwidgets/jqxdropdownlist.js')
                    ->addJs('/js/jqwidgets/jqxpanel.js')
                    ->addJs('/js/jqwidgets/jqxradiobutton.js')
                    ->addJs('/js/jqwidgets/jqxinput.js')
                    // ->addJs('/js/datepicker/bootstrap-datepicker.js')
                    // ->addJs('/js/datatables/dataTables.bootstrap.js')

                    ->addJs('/js/jqwidgets/jqxmenu.js')
                    ->addJs('/js/jqwidgets/jqxgrid.js')
                    ->addJs('/js/jqwidgets/jqxgrid.filter.js')
                    ->addJs('/js/jqwidgets/jqxgrid.sort.js')
                    ->addJs('/js/jqwidgets/jqxtabs.js')
                    ->addJs('/js/jqwidgets/jqxgrid.selection.js')
                    ->addJs('/js/jqwidgets/jqxcalendar.js')
                    ->addJs('/js/jqwidgets/jqxdatetimeinput.js')
                    ->addJs('/js/jqwidgets/jqxcheckbox.js')
                    ->addJs('/js/jqwidgets/jqxgrid.grouping.js')
                    ->addJs('/js/jqwidgets/jqxgrid.pager.js')
                    ->addJs('/js/jqwidgets/jqxnumberinput.js')
                    ->addJs('/js/jqwidgets/jqxwindow.js')
                    ->addJs('/js/jqwidgets/globalization/globalize.js')
                    ->addJs('/js/jqwidgets/jqxcombobox.js')
                    ->addJs('/js/jqwidgets/jqxexpander.js')
                    ->addJs('/js/jqwidgets/jqxvalidator.js')
                    ->addJs('/js/jqwidgets/jqxmaskedinput.js')
                    // ->addJs('/js/jqwidgets/jqxchart.js')
                    ->addJs('/js/jqwidgets/jqxgrid.columnsresize.js')
                    ->addJs('/js/jqwidgets/jqxsplitter.js')
                    ->addJs('/js/jqwidgets/jqxtree.js')
                    ->addJs('/js/jqwidgets/jqxdata.export.js')
                    // ->addJs('/js/jqwidgets/jqxgrid.export.js')
                    // ->addJs('/js/jqwidgets/jqxgrid.edit.js')
                    // ->addJs('/js/jqwidgets/jqxnotification.js')
                    // ->addJs('/js/jqwidgets/jqxbuttongroup.js')
                    ->addJs('/js/bootbox.js')

            ;

		$auth = $this->session->get('auth');
		$resul=Normativasmod::find(array('baja_logica=1','order'=>'id ASC'));
		$this->view->setVar('normativamod',$resul);

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
		$resul->save();
		$this->view->disable();
		echo json_encode();
	}

	public function listpacAction()
	{
	$estado = array('Rechazado','Espera','Proceso','Aprobado','Adjudicado');
	$model = new Cargos();
	$resul = $model->listapac();
	$this->view->disable();
	foreach ($resul as $v) {
		$customers[] = array(
			'nro' => $v->nro,
			'id' => $v->id,
			'unidad_administrativa' => $v->unidad_administrativa,
			'codigo' => $v->codigo,
			'cargo' => $v->cargo,
			'sueldo' => $v->sueldo,
			'gestion' => $v->gestion,
			'fecha_ini' => date("d-m-Y",strtotime($v->fecha_ini)),
			'fecha_fin' => date("d-m-Y",strtotime($v->fecha_fin)),
			'estado' => $estado[$v->estado]
			);
	}
	echo json_encode($customers);
	}

}
?>