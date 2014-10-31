<?php 
/**
* 
*/

class OrganigramasController extends ControllerBase
{
	public function initialize() {
		parent::initialize();
	}

	public function indexAction()
	{
		//$resul = Organigramas::find(array('baja_logica=:activo1:','bind'=>array('activo1'=>'1'),'order' => 'id ASC'));
		//$this->view->setVar('organigrama', $resul);
		//$this->assets->addCss('/js/jorgchart/jquery.jorgchart.css');	
        //$this->assets
        //			->addJs('../../js/datatables/dataTables.bootstrap.js');
        $padre = $this->tag->select(
			array(
				'padre_id',
				Organigramas::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "unidad_administrativa"),
				'useEmpty' => false,
				'emptyText' => 'Mi Teleferico',
				'emptyValue' => '0',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('padre',$padre);

		$nivelestructural = $this->tag->select(
			array(
				'nivel_estructural_id',
				Nivelestructurales::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "nivel_estructural"),
				'useEmpty' => true,
				'emptyText' => '(Seleccionar)',
				'emptyValue' => '',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('nivelestructural',$nivelestructural);

		$da = $this->tag->select(
			array(
				'da_id',
				Das::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "direccion_administrativa"),
				'useEmpty' => false,
				'emptyText' => 'Mi Teleferico',
				'emptyValue' => '0',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('da',$da);


	}

	public function addAction()
	{
		if ($this->request->isPost()) {
			$resul = new Organigramas();
			$resul->padre_id = $this->request->getPost('padre_id');
			$resul->gestion = date("Y");
			$resul->da_id = $this->request->getPost('da_id');
			$resul->regional_id = 1;
			$resul->unidad_administrativa = $this->request->getPost('unidad_administrativa');
			$resul->nivel_estructural_id = $this->request->getPost('nivel_estructural_id');
			$resul->sigla = $this->request->getPost('sigla');
			$resul->fecha_ini = $this->request->getPost('fecha_ini');
			if ($this->request->getPost('fecha_fin')) {
				$resul->fecha_fin = $this->request->getPost('fecha_fin');
			}
			$resul->codigo = 0;
			$resul->observacion = "";
			$resul->estado = 1;
			$resul->baja_logica = 1;
			$resul->user_reg_id = 1;
			$resul->fecha_reg = date("Y-m-d H:i:s");
			$resul->user_mod_id = 1;
			$resul->fecha_mod = date("Y-m-d H:i:s");

			if ($resul->save()) {
				$this->flashSession->success("Exito: Registro guardado correctamente...");
			}else{
				$this->flashSession->error("Error: no se guardo el registro...");
			}
			$this->response->redirect('/organigramas');
		}

		
		$padre = $this->tag->select(
			array(
				'padre_id',
				Organigramas::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "unidad_administrativa"),
				'useEmpty' => true,
				'emptyText' => 'Mi Teleferico',
				'emptyValue' => '0',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('padre',$padre);

		$nivelestructural = $this->tag->select(
			array(
				'nivel_estructural_id',
				Nivelestructurales::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "nivel_estructural"),
				'useEmpty' => true,
				'emptyText' => '(Seleccionar)',
				'emptyValue' => '',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('nivelestructural',$nivelestructural);

		$da = $this->tag->select(
			array(
				'da_id',
				Das::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "direccion_administrativa"),
				'useEmpty' => false,
				'emptyText' => 'Mi Teleferico',
				'emptyValue' => '0',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('da',$da);

	}

	public function editAction($id)
	{
		$resul = Organigramas::findFirstById($id);
		if ($this->request->isPost()) {
			$resul = Organigramas::findFirstById($this->request->getPost('id'));
			$resul->padre_id = $this->request->getPost('padre_id');
			$resul->da_id = $this->request->getPost('da_id');
			$resul->unidad_administrativa = $this->request->getPost('unidad_administrativa');
			$resul->nivel_estructural_id = $this->request->getPost('nivel_estructural_id');
			$resul->sigla = $this->request->getPost('sigla');
			$resul->fecha_ini = $this->request->getPost('fecha_ini');
			if ($this->request->getPost('fecha_fin')) {
				$resul->fecha_fin = $this->request->getPost('fecha_fin');
			}
			$resul->user_mod_id = 1;
			$resul->fecha_mod = date("Y-m-d H:i:s");
			if ($resul->save()) {
				$this->flashSession->success("Exito: Registro guardado correctamente...");
			}else{
				$this->flashSession->error("Error: no se guardo el registro...");
			}
			
			$this->response->redirect('/organigramas');
		}
		$this->view->setVar('organigrama', $resul);		

		$this->tag->setDefault("padre_id", $resul->padre_id);
		$padre = $this->tag->select(
			array(
				'padre_id',
				Organigramas::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "unidad_administrativa"),
				'useEmpty' => true,
				'emptyText' => 'Mi Teleferico',
				'emptyValue' => '0',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('padre',$padre);

		$this->tag->setDefault("nivel_estructural_id", $resul->nivel_estructural_id);
		$nivelestructural = $this->tag->select(
			array(
				'nivel_estructural_id',
				Nivelestructurales::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "nivel_estructural"),
				'useEmpty' => true,
				'emptyText' => '(Seleccionar)',
				'emptyValue' => '',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('nivelestructural',$nivelestructural);

		$this->tag->setDefault("da_id", $resul->da_id);
		$da = $this->tag->select(
			array(
				'da_id',
				Das::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "direccion_administrativa"),
				'useEmpty' => false,
				'emptyText' => 'Mi Teleferico',
				'emptyValue' => '0',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('da',$da);

	}

	/*public function deleteAction($id)
	{
		$resul = Organigramas::findFirstById($id);
		$resul->baja_logica = 0;
		if ($resul->save()) {
			$this->flashSession->success("Exito: Elimino correctamente el registro...");
		}else{
			$this->flashSession->error("Error: no se elimino ningun registro...");
		}
		$this->response->redirect('/organigramas');
	}
*/
	public function listAction()
	{
		$resul = Organigramas::find(array('baja_logica=:activo1:','bind'=>array('activo1'=>'1'),'order' => 'id ASC'));
		$this->view->disable();
		foreach ($resul as $v) {
			$customers[] = array(
			'id' => $v->id,
        	'unidad_administrativa' => $v->unidad_administrativa,
        	'sigla' => $v->sigla
        	);
		}
		echo json_encode($customers);
	}

	public function saveAction()
	{
		if (isset($_POST['id'])) {
			if ($_POST['id']>0) {
				$resul = Organigramas::findFirstById($_POST['id']);
			$resul->padre_id = $_POST['padre_id'];
			$resul->da_id = 1;
			$resul->unidad_administrativa = $_POST['unidad_administrativa'];
			$resul->nivel_estructural_id = 1;
			$resul->sigla = $_POST['sigla'];
			$resul->fecha_ini = date("Y-m-d");
			$resul->user_mod_id = 1;
			$resul->fecha_mod = date("Y-m-d H:i:s");
			$resul->save()
			/*if ($resul->save()) {
				$this->flashSession->success("Exito: Registro guardado correctamente...");
			}else{
				$this->flashSession->error("Error: no se guardo el registro...");
			}*/	
			}
			else{
				$date = new DateTime($_POST['fecha_ini']);
				$fecha_ini = $date->format('Y-m-d');
				//$date = new DateTime($_POST['fecha_fin']);
				//$fecha_fin = $date->format('Y-m-d');

			$resul = new Organigramas();
			$resul->padre_id = $_POST['padre_id'];
			$resul->gestion = date("Y");
			$resul->da_id = $_POST['da_id'];;
			$resul->regional_id = 1;
			$resul->unidad_administrativa = $_POST['unidad_administrativa'];
			$resul->nivel_estructural_id = $_POST['nivel_estructural_id'];;
			$resul->sigla = $_POST['sigla'];
			$resul->fecha_ini = $fecha_ini;//date("Y-m-d H:i:s");
			$resul->codigo = 0;
			$resul->estado = 1;
			$resul->baja_logica = 1;
			$resul->user_reg_id = 1;
			$resul->fecha_reg = date("Y-m-d H:i:s");
			$resul->user_mod_id = 1;
			$resul->fecha_mod = date("Y-m-d H:i:s");
			$resul->save()
			/*if ($resul->save()) {
				$this->flashSession->success("Exito: Registro guardado correctamente...");
			}else{
				$this->flashSession->error("Error: no se guardo el registro...");
			}
			*/
		}	
		}
		
		$this->view->disable();
		echo json_encode();
	}

	public function deleteAction(){
		$resul = Organigramas::findFirstById($_POST['id']);
			$resul->baja_logica = 0;
			$resul->save();
			/*if ($resul->save()) {
				$this->flashSession->success("Exito: Registro eliminado correctamente...");
			}else{
				$this->flashSession->error("Error: no se guardo el registro...");
			}*/
		$this->view->disable();
		echo json_encode();
	}
	
}
?>