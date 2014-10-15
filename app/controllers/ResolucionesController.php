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
		$resul = Resoluciones::find(array('baja_logica=:activo1:','bind'=>array('activo1'=>'1'),'order' => 'id ASC'));
		$this->view->setVar('resolucion', $resul);	
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

	public function deleteAction($id)
	{
		$resul = Resoluciones::findFirstById($id);
		$resul->baja_logica = 0;
		if ($resul->save()) {
				$this->flashSession->success("Exito: Elimino correctamente el registro...");
			}else{
				$this->flashSession->error("Error: no se elimino ningun registro...");
		}
		$this->response->redirect('/resoluciones');
	}

}
?>