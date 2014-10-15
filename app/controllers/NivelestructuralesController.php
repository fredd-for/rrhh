<?php 
/**
* 
*/

class NivelestructuralesController extends ControllerBase
{
	public function initialize() {
        parent::initialize();
    }

	public function indexAction()
	{
		$resul = Nivelestructurales::find(array('baja_logica=:activo1:','bind'=>array('activo1'=>'1'),'order' => 'id ASC'));
		$this->view->setVar('nivelestructural', $resul);	


	}

	public function addAction()
	{
		if ($this->request->isPost()) {
			$resul = new Nivelestructurales();
			$resul->orden = $this->request->getPost('orden');
			$resul->nivel_estructural = $this->request->getPost('nivel_estructural');
			$resul->observacion = "";
			$resul->estado = 1;
			$resul->visible = 1;
			$resul->baja_logica = 1;
			if ($resul->save()) {
				$this->flashSession->success("Exito: Registro guardado correctamente...");
			}else{
				$this->flashSession->error("Error: no se guardo el registro...");
			}
			$this->response->redirect('/nivelestructurales');
			//return $this->forward("products/new");
		}

	}

	public function editAction($id)
	{
		$resul = Nivelestructurales::findFirstById($id);
		if ($this->request->isPost()) {
			$resul = Nivelestructurales::findFirstById($this->request->getPost('id'));
			$resul->orden = $this->request->getPost('orden');
			$resul->nivel_estructural = $this->request->getPost('nivel_estructural');
			$resul->observacion = "";
			if ($resul->save()) {
				$this->flashSession->success("Exito: Registro guardado correctamente...");
			}else{
				$this->flashSession->error("Error: no se guardo el registro...");
			}
			
			$this->response->redirect('/nivelestructurales');
		}
		$this->view->setVar('nivelestructural', $resul);		
		//echo $this->view->render('../nivelestructuras/add', array('nivelestructura' => 'hola'));
	}

	public function deleteAction($id)
	{
		$resul = Nivelestructurales::findFirstById($id);
		$resul->baja_logica = 0;
		if ($resul->save()) {
				$this->flashSession->success("Exito: Elimino correctamente el registro...");
			}else{
				$this->flashSession->error("Error: no se elimino ningun registro...");
		}
		$this->response->redirect('/nivelestructurales');
	}

	/*public function cargarAction()
	{
		for ($i=0; $i < 1000; $i++) { 
			$resul = new Nivelestructurales();
			$resul->nivelestructura = "nivelestructura".$i;
			$resul->descripcion = "descripcion".$i;
			$resul->activo = true;
			$resul->save();
		}
		
	}
	*/

}
?>