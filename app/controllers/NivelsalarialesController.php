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
		$resolucion = $this->tag->select(
			array(
				'resolucion_id',
				Resoluciones::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "tipo_resolucion"),
				'useEmpty' => true,
				'emptyText' => '(Selecionar)',
				'emptyValue' => '0',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('resolucion',$resolucion);
	}

	public function listAction()
	{
		//$resul = Nivelsalariales::find(array('baja_logica=:activo1:','bind'=>array('activo1'=>'1'),'order' => 'id ASC'));
		$model = new Nivelsalariales();
        $resul = $model->lista();

		$this->view->disable();
		foreach ($resul as $v) {
			$customers[] = array(
				'id' => $v->id,
				//'resolucion_id' => $v->tipo_resolucion,
				'categoria' => $v->categoria,
				'clase' => $v->clase,
				'nivel' => $v->nivel,
				'denominacion' => $v->denominacion,
				'sueldo' => $v->sueldo
				//'fecha_ini' => date("Y-m-d",strtotime($v->fecha_ini))
				);
		}
		echo json_encode($customers);
	}

	public function saveAction()
	{
		if (isset($_POST['id'])) {
			//$date = new DateTime($_POST['fecha_ini']);
			//$fecha_ini = $date->format('Y-m-d');
			
			if ($_POST['id']>0) {
				$resul = Nivelsalariales::findFirstById($_POST['id']);
				//$resul->resolucion_id = $_POST['resolucion_id'];
				$resul->categoria = $_POST['categoria'];
				$resul->clase = $_POST['clase'];
				$resul->nivel = $_POST['nivel'];
				$resul->denominacion = $_POST['denominacion'];
				$resul->sueldo = $_POST['sueldo'];
				$resul->save();
				if ($resul->save()) {
					$msm = array('msm' => 'Exito: Se guardo correctamente' );
				}else{
					$msm = array('msm' => 'Error: No se guardo el registro' );
				}
			}
			else{
				$resul = new Nivelsalariales();
				$resul->resolucion_id = 1; //$_POST['resolucion_id'];
				$resul->gestion =date("Y");
				$resul->categoria = $_POST['categoria'];
				$resul->clase = $_POST['clase'];
				$resul->nivel = $_POST['nivel'];
				$resul->sub_nivel_salarial = 0;
				$resul->denominacion = $_POST['denominacion'];
				$resul->sueldo = $_POST['sueldo'];
				//$resul->fecha_ini = $fecha_ini;
				//$resul->fecha_fin = $fecha_emi;
				$resul->estado = 1;
				$resul->baja_logica = 1;
				$resul->save();
				/*if ($resul->save()) {
					$msm = array('msm' => 'Exito: Se guardo correctamente' );
				}else{
					$msm = array('msm' => 'Error: No se guardo el registro' );
				}
				*/
		}	
	}
	$this->view->disable();
	echo json_encode();
}

public function deleteAction(){
	$resul = Nivelsalariales::findFirstById($_POST['id']);
	$resul->baja_logica = 0;
	$resul->save();
	$this->view->disable();
	echo json_encode();
}

}
?>