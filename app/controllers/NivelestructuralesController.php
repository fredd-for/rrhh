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
	}

	public function listAction()
	{
		$resul = Nivelestructurales::find(array('baja_logica=:activo1:','bind'=>array('activo1'=>'1'),'order' => 'id ASC'));
		$this->view->disable();
		foreach ($resul as $v) {
			$customers[] = array(
				'id' => $v->id,
				'orden' => $v->orden,
				'nivel_estructural' => $v->nivel_estructural,
				);
		}
		echo json_encode($customers);
	}

	public function saveAction()
	{
		if (isset($_POST['id'])) {
			if ($_POST['id']>0) {
				$resul = Nivelestructurales::findFirstById($_POST['id']);
				$resul->orden= $_POST['orden'];
				$resul->nivel_estructural = $_POST['nivel_estructural'];
				$resul->save();
			}
			else{
				$resul = new Nivelestructurales();
				$resul->orden= $_POST['orden'];
				$resul->nivel_estructural = $_POST['nivel_estructural'];
				$resul->estado = 1;
				$resul->visible = 1;
				$resul->baja_logica = 1;
				//$resul->save();
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

public function deleteAction(){
	$resul = Nivelestructurales::findFirstById($_POST['id']);
	$resul->baja_logica = 0;
	$resul->save();
	$this->view->disable();
	echo json_encode();
}

}
?>