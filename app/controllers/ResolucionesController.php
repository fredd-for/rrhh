<?php 
/**
* 
*/

class ResolucionesController extends ControllerBase
{
	public function initialize() {
        parent::initialize();
    }

	public function indexAction()
	{
	}

	public function addAction()
	{
		if ($this->request->isPost()) {
			$resul = new Resoluciones();
			$resul->tipo_resolucion = $this->request->getPost('tipo_resolucion');
			$resul->numero_res = $this->request->getPost('numero_res');
			$resul->institucion_sector_id = 1;  //segun registro tabla instituciones 
			$resul->institucion_rectora_id = 2; //segun registro tabla instituciones 
			$resul->instituciones_otras = "";
			$resul->gestion_res = date("Y");
			$resul->fecha_emi = $this->request->getPost('fecha_emi');
			$resul->fecha_apr = $this->request->getPost('fecha_apr');
			$resul->estado = 1;
			$resul->baja_logica = 1;
			if ($resul->save()) {
				$this->flashSession->success("Exito: Registro guardado correctamente...");
			}else{
				$this->flashSession->error("Error: no se guardo el registro...");
			}
			$this->response->redirect('/resoluciones');
		}

	}

	public function editAction($id)
	{
		$resul = Resoluciones::findFirstById($id);
		if ($this->request->isPost()) {
			$resul = Resoluciones::findFirstById($this->request->getPost('id'));
			$resul->tipo_resolucion = $this->request->getPost('tipo_resolucion');
			$resul->numero_res = $this->request->getPost('numero_res');
			$resul->fecha_emi = $this->request->getPost('fecha_emi');
			$resul->fecha_apr = $this->request->getPost('fecha_apr');
			if ($resul->save()) {
				$this->flashSession->success("Exito: Registro guardado correctamente...");
			}else{
				$this->flashSession->error("Error: no se guardo el registro...");
			}
			
			$this->response->redirect('/resoluciones');
		}
		$this->view->setVar('resolucion', $resul);		
		//echo $this->view->render('../nivelestructuras/add', array('nivelestructura' => 'hola'));
	}

	public function listAction()
	{
		$resul = Resoluciones::find(array('baja_logica=:activo1:','bind'=>array('activo1'=>'1'),'order' => 'id ASC'));
		$this->view->disable();
		foreach ($resul as $v) {
			$customers[] = array(
				'id' => $v->id,
				'tipo_resolucion' => $v->tipo_resolucion,
				'numero_res' => $v->numero_res,
				'fecha_emi' => $v->fecha_emi,
				'fecha_apr' => $v->fecha_apr
				);
		}
		echo json_encode($customers);
	}

	public function saveAction()
	{
		if (isset($_POST['id'])) {
			$date = new DateTime($_POST['fecha_emi']);
			$fecha_emi = $date->format('Y-m-d');
			$date = new DateTime($_POST['fecha_apr']);
			$fecha_apr = $date->format('Y-m-d');

			if ($_POST['id']>0) {
				$resul = Resoluciones::findFirstById($_POST['id']);
				$resul->tipo_resolucion = $_POST['tipo_resolucion'];
				$resul->numero_res = $_POST['numero_res'];
				$resul->fecha_emi = $fecha_emi;
				$resul->fecha_apr = $fecha_apr;
				$resul->save()
			}
			else{
				$resul = new Resoluciones();
				$resul->tipo_resolucion = $_POST['tipo_resolucion'];
				$resul->numero_res = $_POST['numero_res'];
				$resul->institucion_sector_id = 1;  //segun registro tabla instituciones 
				$resul->institucion_rectora_id = 2; //segun registro tabla instituciones 
				$resul->gestion_res = date("Y");
				$resul->fecha_emi = $fecha_emi;
				$resul->fecha_apr = $fecha_apr;
				$resul->estado = 1;
				$resul->baja_logica = 1;
				$resul->save()
			}	
		}
		
		$this->view->disable();
		echo json_encode();
	}

	public function deleteAction(){
		$resul = Resoluciones::findFirstById($_POST['id']);
		$resul->baja_logica = 0;
		$resul->save()
		$this->view->disable();
		echo json_encode();
	}

}
?>