<?php 
/**
* 
*/

class DasController extends ControllerBase
{
	public function initialize() {
        parent::initialize();
    }

	public function indexAction()
	{
		$resul = Das::find(array('baja_logica=:activo1:','bind'=>array('activo1'=>'1'),'order' => 'id ASC'));
		$this->view->setVar('da', $resul);	


	}

	public function addAction()
	{
		if ($this->request->isPost()) {
			$resul = new Das();
			$resul->direccion_administrativa = $this->request->getPost('direccion_administrativa');
			$resul->codigo = $this->request->getPost('codigo');
			$resul->observacion = "";
			$resul->estado = 1;
			$resul->visible = 1;
			$resul->baja_logica = 1;
			if ($resul->save()) {
				$this->flashSession->success("Exito: Registro guardado correctamente...");
			}else{
				$this->flashSession->error("Error: no se guardo el registro...");
			}
			$this->response->redirect('/das');
			//return $this->forward("products/new");
		}

	}

	public function editAction($id)
	{
		$resul = Das::findFirstById($id);
		if ($this->request->isPost()) {
			$resul = Das::findFirstById($this->request->getPost('id'));
			$resul->direccion_administrativa = $this->request->getPost('direccion_administrativa');
			$resul->codigo = $this->request->getPost('codigo');
			$resul->observacion = "";
			if ($resul->save()) {
				$this->flashSession->success("Exito: Registro guardado correctamente...");
			}else{
				$this->flashSession->error("Error: no se guardo el registro...");
			}
			
			$this->response->redirect('/daes');
		}
		$this->view->setVar('da', $resul);		
		//echo $this->view->render('../nivelestructuras/add', array('nivelestructura' => 'hola'));
	}

	public function deleteAction($id)
	{
		$resul = Das::findFirstById($id);
		$resul->baja_logica = 0;
		if ($resul->save()) {
				$this->flashSession->success("Exito: Elimino correctamente el registro...");
			}else{
				$this->flashSession->error("Error: no se elimino ningun registro...");
		}
		$this->response->redirect('/das');
	}

	/*public function cargarAction()
	{
		for ($i=0; $i < 1000; $i++) { 
			$resul = new Das();
			$resul->nivelestructura = "nivelestructura".$i;
			$resul->descripcion = "descripcion".$i;
			$resul->activo = true;
			$resul->save();
		}
		
	}
	*/

}
?>