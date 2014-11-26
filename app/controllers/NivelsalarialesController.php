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
				Resoluciones::find(array('baja_logica=1',"order"=>"tipo_resolucion","columns" => "id,CONCAT(tipo_resolucion, ' - ', numero_res) as fullname")),
				'using' => array('id', "fullname"),
				'useEmpty' => true,
				'emptyText' => '(Selecionar)',
				'emptyValue' => '',
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
				'resolucion_id' => $v->resolucion_id,
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
				$resul->resolucion_id = $_POST['resolucion_id'];
				$resul->categoria = $_POST['categoria'];
				$resul->clase = $_POST['clase'];
				$resul->nivel = $_POST['nivel'];
				$resul->denominacion = $_POST['denominacion'];
				$resul->sueldo = $_POST['sueldo'];
				$resul->activo = 1;
				$resul->save();
				if ($resul->save()) {
					$msm = array('msm' => 'Exito: Se guardo correctamente' );
				}else{
					$msm = array('msm' => 'Error: No se guardo el registro' );
				}
			}
			else{
				$resul = new Nivelsalariales();
				$resul->resolucion_id = $_POST['resolucion_id'];
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
				$resul->activo = 0;
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


public function savePerfilAction()
	{
		if (isset($_POST['perfil_id'])) {
			if ($_POST['perfil_id']>0) {
				$resul = Cargosperfiles::findFirstById($_POST['perfil_id']);
				$resul->nivelsalarial_id = $_POST['nivelsalarial_id'];
				$resul->formacion_academica0 =$_POST['formacion_academica0'];
				$resul->exp_general_lic0 = $_POST['exp_general_lic0'];
				$resul->exp_general_tec0 = $_POST['exp_general_tec0'];
				$resul->exp_profesional_lic0 = $_POST['exp_profesional_lic0'];
				$resul->exp_profesional_tec0 = $_POST['exp_profesional_tec0'];
				$resul->exp_relacionado_lic0 = $_POST['exp_relacionado_lic0'];
				$resul->exp_relacionado_tec0 = $_POST['exp_relacionado_tec0'];
				$resul->formacion_academica =$_POST['formacion_academica'];
				$resul->exp_general_lic = $_POST['exp_general_lic'];
				$resul->exp_general_tec = $_POST['exp_general_tec'];
				$resul->exp_profesional_lic = $_POST['exp_profesional_lic'];
				$resul->exp_profesional_tec = $_POST['exp_profesional_tec'];
				$resul->exp_relacionado_lic = $_POST['exp_relacionado_lic'];
				$resul->exp_relacionado_tec = $_POST['exp_relacionado_tec'];
				if ($resul->save()) {
					$msm = 'Exito: Se guardo correctamente';
				}else{
					$msm = 'Error: No se guardo el registro';
				}
			}
			else{
				$resul = new Cargosperfiles();
				$resul->nivelsalarial_id = $_POST['nivelsalarial_id'];
				$resul->formacion_academica0 =$_POST['formacion_academica0'];
				$resul->exp_general_lic0 = $_POST['exp_general_lic0'];
				$resul->exp_general_tec0 = $_POST['exp_general_tec0'];
				$resul->exp_profesional_lic0 = $_POST['exp_profesional_lic0'];
				$resul->exp_profesional_tec0 = $_POST['exp_profesional_tec0'];
				$resul->exp_relacionado_lic0 = $_POST['exp_relacionado_lic0'];
				$resul->exp_relacionado_tec0 = $_POST['exp_relacionado_tec0'];
				$resul->formacion_academica =$_POST['formacion_academica'];
				$resul->exp_general_lic = $_POST['exp_general_lic'];
				$resul->exp_general_tec = $_POST['exp_general_tec'];
				$resul->exp_profesional_lic = $_POST['exp_profesional_lic'];
				$resul->exp_profesional_tec = $_POST['exp_profesional_tec'];
				$resul->exp_relacionado_lic = $_POST['exp_relacionado_lic'];
				$resul->exp_relacionado_tec = $_POST['exp_relacionado_tec'];
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

public function setCargosPerfilesAction()
{	$customers = array();
	if (isset($_POST['id'])) {
		$resul=Cargosperfiles::find(array('baja_logica=1 and nivelsalarial_id='.$_POST['id'],'order' => 'id ASC'));
        $this->view->disable();
		$customers=array();
		foreach ($resul as $v) {
			$customers[] = array(
				'id' => $v->id,
				'nivelsalarial_id' => $v->nivelsalarial_id,
				'formacion_academica' => $v->formacion_academica,
				'exp_general_lic' => $v->exp_general_lic,
				'exp_general_tec' => $v->exp_general_tec,
				'exp_profesional_lic' => $v->exp_profesional_lic,
				'exp_profesional_tec' => $v->exp_profesional_tec,
				'exp_relacionado_lic' => $v->exp_relacionado_lic,
				'exp_relacionado_tec' => $v->exp_relacionado_tec,
				'formacion_academica0' => $v->formacion_academica0,
				'exp_general_lic0' => $v->exp_general_lic0,
				'exp_general_tec0' => $v->exp_general_tec0,
				'exp_profesional_lic0' => $v->exp_profesional_lic0,
				'exp_profesional_tec0' => $v->exp_profesional_tec0,
				'exp_relacionado_lic0' => $v->exp_relacionado_lic0,
				'exp_relacionado_tec0' => $v->exp_relacionado_tec0
				);
		}
		
	}
	echo json_encode($customers);	
}

}
?>