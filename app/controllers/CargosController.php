<?php 
/**
* 
*/

class CargosController extends ControllerBase
{
	public function initialize() {
		parent::initialize();
	}

	public function indexAction()
	{
		$organigrama = $this->tag->select(
			array(
				'organigrama_id',
				Organigramas::find(array('baja_logica=1','order' => 'unidad_administrativa ASC')),
				'using' => array('id', "unidad_administrativa"),
				'useEmpty' => true,
				'emptyText' => '(Selecionar)',
				'emptyValue' => '0',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('organigrama',$organigrama);

/*		$ejecutora = $this->tag->select(
			array(
				'ejecutora_id',
				Ejecutoras::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "unidad_ejecutora"),
				'useEmpty' => false,
				'emptyText' => '(Selecionar)',
				'emptyValue' => '0',
				'class' => 'form-control'
				)
			);
$this->view->setVar('ejecutora',$ejecutora);*/

$nivelsalarial = $this->tag->select(
	array(
		'nivelsalarial_id',
		Nivelsalariales::find(array('baja_logica=1','order' => 'id ASC')),
		'using' => array('id', "denominacion"),
		'useEmpty' => tue,
		'emptyText' => '(Selecionar)',
		'emptyValue' => '0',
		'class' => 'form-control'
		)
	);
$this->view->setVar('nivelsalarial',$nivelsalarial);


}

public function listAction()
{
		//$resul = Cargos::find(array('baja_logica=:activo1:','bind'=>array('activo1'=>'1'),'order' => 'id ASC'));
	$model = new Cargos();
	$resul = $model->lista();
	$this->view->disable();
	foreach ($resul as $v) {
		$customers[] = array(
			'id' => $v->id,
			'unidad_administrativa' => $v->unidad_administrativa,
				//'unidad_ejecutora' => $v->unidad_ejecutora,
			'codigo' => $v->codigo,
			'cargo' => $v->cargo,
			'denominacion' => $v->denominacion,
			'sueldo' => $v->sueldo,
			'estado' => $v->estado
			);
	}
	echo json_encode($customers);
}

public function saveAction()
{
	if (isset($_POST['id'])) {

		if ($_POST['id']>0) {
			$resul = Cargos::findFirstById($_POST['id']);
			$resul->organigrama_id = $_POST['organigrama_id'];
				//$resul->ejecutora_id = 1;
			$resul->codigo = $_POST['codigo'];
			$resul->cargo = $_POST['cargo'];
			$resul->nivelsalarial_id = $_POST['nivelsalarial_id'];
				//$resul->cargo_estado_id = 1;  //default acefalia
			$resul->user_mod_id = $user->id;
			$resul->fecha_mod = date("Y-m-d");
			$resul->save();
		}
		else{
				//$this->_registerSession($user);

			$resul = new Cargos();
			$resul->organigrama_id = $_POST['organigrama_id'];
			$resul->ejecutora_id = 1;
			$resul->codigo = $_POST['codigo'];
			$resul->cargo = $_POST['cargo'];
			$resul->nivelsalarial_id = $_POST['nivelsalarial_id'];
			$resul->cargo_estado_id = 1;
			$resul->baja_logica = 1;
			$resul->user_reg_id = 1;
			$resul->fecha_reg = date("Y-m-d");
			$resul->save();
				/*if ($resul->save()) {
					$msm = array('msm' => 'Exito: Se guardo correctamente' );
				}else{
					$msm = array('msm' => 'Error: No se guardo el registro' );
				}*/
				
				
			}	
		}
		$this->view->disable();
		echo json_encode();
	}

<<<<<<< HEAD
public function save_pacAction()
{
	if (isset($_POST['cargo_id_pac'])) {
		$date = new DateTime($_POST['fecha_ini']);
		$fecha_ini = $date->format('Y-m-d');
		$date = new DateTime($_POST['fecha_fin']);
		$fecha_fin = $date->format('Y-m-d');

		if ($_POST['cargo_id_pac']>0) {
				$resul = new Pacs();
				$resul->cargo_id = $_POST['cargo_id_pac'];
				$resul->gestion = $_POST['gestion'];
				$resul->fecha_ini = $fecha_ini;
				$resul->fecha_fin = $fecha_fin; //generar
				$resul->unidad_sol_id = 1;
				$resul->usuario_sol_id = 1;
				//$resul->fecha_apr=date('Y-m-d');
				//$resul->usuario_apr_id=1;
				$resul->estado = 1;
				$resul->baja_logica = 1;
				if ($resul->save()) {
					$msm = 'Exito: Se guardo correctamente';
				}else{
					$msm = 'Error: No se guardo el registro';
				}
		}	
	}
		$this->view->disable();
		echo json_encode($msm);
}	

public function deleteAction(){
	$resul = Cargos::findFirstById($_POST['id']);
	$resul->baja_logica = 0;
	$resul->save();
	$this->view->disable();
	echo json_encode();
}


public function listpacAction()
{
		//$resul = Cargos::find(array('baja_logica=:activo1:','bind'=>array('activo1'=>'1'),'order' => 'id ASC'));
	$model = new Cargos();
	$resul = $model->listapac();
	$this->view->disable();
	foreach ($resul as $v) {
		$customers[] = array(
			'id' => $v->id,
			'unidad_administrativa' => $v->unidad_administrativa,
			'cargo' => $v->cargo,
			'gestion' => $v->gestion,
			'fecha_ini' => $v->fecha_ini,
			'fecha_fin' => $v->fecha_fin
			);
=======
	public function deleteAction(){
		$resul = Cargos::findFirstById($_POST['id']);
		$resul->baja_logica = 0;
		$resul->save();
		$this->view->disable();
		echo json_encode();
>>>>>>> 48dd1b907aba39908576049bccde40250bbcc78b
	}

	
}
?>