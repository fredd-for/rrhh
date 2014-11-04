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
				'fecha_apr' => $v->fecha_apr,
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
				$resul->save();
				if ($resul->save()) {
					$msm = array('msm' => 'Exito: Se guardo correctamente' );
				}else{
					$msm = array('msm' => 'Error: No se guardo el registro' );
				}
			}
			else{
				$resul = new Resoluciones();
				$resul->tipo_resolucion = $_POST['tipo_resolucion'];
				$resul->numero_res = $_POST['numero_res'];
				$resul->institucion_sector_id = 1;
				$resul->institucion_rectora_id = 2;
				//$resul->instituciones_otras = "otra";
				$resul->gestion_res = date("Y");
				$resul->fecha_emi = $fecha_emi;
				$resul->fecha_apr = $fecha_apr;
				//$resul->fecha_fin = $fecha_emi;
				$resul->estado = 1;
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
	$resul = Resoluciones::findFirstById($_POST['id']);
	$resul->baja_logica = 0;
	$resul->save();
	$this->view->disable();
	echo json_encode();
}

}
?>