<?php 
/**
* 
*/

class NivelsalarialesController extends ControllerBase
{
	public function initialize() {
        parent::initialize();
    }

	public function indexAction()
	{
		$resul = Nivelsalariales::find(array('baja_logica=:activo1:','bind'=>array('activo1'=>'1'),'order' => 'id ASC'));
		$this->view->setVar('nivelsalarial', $resul);	
	}

	public function addAction()
	{
		if ($this->request->isPost()) {
			$resul = new Nivelsalariales();
			$resul->resolucion_id = $this->request->getPost('resolucion_id');
			$resul->gestion = date("Y");
			$resul->categoria = $this->request->getPost('categoria');
			$resul->clase = $this->request->getPost('clase');
			$resul->nivel = $this->request->getPost('nivel');
			$resul->sub_nivel_salarial = 0;
			$resul->denominacion = $this->request->getPost('denominacion');
			$resul->sueldo = $this->request->getPost('sueldo');
			//$resul->fecha_ini = date("Y-m-d");
			//$resul->fecha_fin = date("Y-m-d");
			$resul->estado = 1;
			$resul->baja_logica = 1;
			if ($resul->save()) {
				$this->flashSession->success("Exito: Registro guardado correctamente...");
			}else{
				$this->flashSession->error("Error: no se guardo el registro...");
			}
			$this->response->redirect('/nivelsalariales');
		}

		$resolucion = $this->tag->select(
			array(
				'resolucion_id',
				Resoluciones::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "tipo_resolucion"),
				'useEmpty' => false,
				'emptyText' => '(Seleccionar)',
				'emptyValue' => '',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('resolucion',$resolucion);

	}

	public function editAction($id)
	{
		$resul = Nivelsalariales::findFirstById($id);
		if ($this->request->isPost()) {
			$resul = Nivelsalariales::findFirstById($this->request->getPost('id'));
			$resul->resolucion_id = $this->request->getPost('resolucion_id');
			$resul->categoria = $this->request->getPost('categoria');
			$resul->clase = $this->request->getPost('clase');
			$resul->nivel = $this->request->getPost('nivel');
			$resul->denominacion = $this->request->getPost('denominacion');
			$resul->sueldo = $this->request->getPost('sueldo');
			if ($resul->save()) {
				$this->flashSession->success("Exito: Registro guardado correctamente...");
			}else{
				$this->flashSession->error("Error: no se guardo el registro...");
			}
			
			$this->response->redirect('/nivelsalariales');
		}
		$this->view->setVar('nivelsalarial', $resul);		
		
		$this->tag->setDefault("resolucion_id", $resul->resolucion_id);
		$resolucion = $this->tag->select(
			array(
				'resolucion_id',
				Resoluciones::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "tipo_resolucion"),
				'useEmpty' => false,
				'emptyText' => '(Seleccionar)',
				'emptyValue' => '',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('resolucion',$resolucion);
	}

	public function deleteAction($id)
	{
		$resul = Nivelsalariales::findFirstById($id);
		$resul->baja_logica = 0;
		if ($resul->save()) {
				$this->flashSession->success("Exito: Elimino correctamente el registro...");
			}else{
				$this->flashSession->error("Error: no se elimino ningun registro...");
		}
		$this->response->redirect('/nivelsalariales');
	}

}
?>