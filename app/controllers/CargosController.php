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
		/*$this->tag->setDefault("organigrama_id", 3);
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

		$finpartida = $this->tag->select(
			array(
				'fin_partida_id',
				Finpartidas::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "denominacion"),
				'useEmpty' => true,
				'emptyText' => '(Selecionar)',
				'emptyValue' => '0',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('finpartida',$finpartida);
*/
		/*$nivelsalarial = $this->tag->select(
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
$nivelsalarial = Nivelsalariales::find(array('baja_logica=1','order' => 'id ASC'));
$this->view->setVar('nivelsalarial',$nivelsalarial);
*/
$cargoestado=Cargosestados::find(array('baja_logica=1','order' => 'id ASC'));
$this->view->setVar('cargoestado',$cargoestado);

}

public function listAction()
{
		//$resul = Cargos::find(array('baja_logica=:activo1:','bind'=>array('activo1'=>'1'),'order' => 'id ASC'));
	$model = new Cargos();
	$resul = $model->lista();
	$this->view->disable();
	foreach ($resul as $v) {
		$customers[] = array(
			'nro' => $v->nro,
			'id' => $v->id,
			'unidad_administrativa' => $v->unidad_administrativa,
			'organigrama_id' => $v->organigrama_id,
			'nivelsalarial_id' => $v->nivelsalarial_id,
			'codigo' => $v->codigo,
			'cargo' => $v->cargo,
			'denominacion' => $v->denominacion,
			'sueldo' => $v->sueldo,
			'depende_id' => $v->depende_id,
			'estado' => $v->estado1,
			'cargo_estado_id' => $v->cargo_estado_id,
			'condicion' => $v->estado,
			'fin_partida_id' => $v->fin_partida_id
			);
	}
	echo json_encode($customers);
}

public function listorganigramaAction()
{
		$resul=Organigramas::find(array('baja_logica=1','order' => 'id ASC'));
		foreach ($resul as $v) {
			$customers[] = array(
				'id' => $v->id,
				'unidad_administrativa' => $v->unidad_administrativa,
				'sigla' => $v->sigla
				);
		}
		$this->view->disable();
	echo json_encode($customers);
}

public function listnivelsalarialAction()
{
		$resul=Nivelsalariales::find(array('baja_logica=1','order' => 'id ASC'));
		foreach ($resul as $v) {
			$customers[] = array(
				'id' => $v->id,
				'denominacion' => $v->denominacion,
				'sueldo' => $v->sueldo
				);
		}
		$this->view->disable();
	echo json_encode($customers);
}

public function getSueldoAction()
{
		$resul=Nivelsalariales::findFirstById($_POST['id']);
		
		$this->view->disable();
	echo json_encode(floatval($resul->sueldo));
}

public function saveAction()
{
	if (isset($_POST['id'])) {

		if ($_POST['id']>0) {
			$resul = Cargos::findFirstById($_POST['id']);
			$resul->organigrama_id = $_POST['organigrama_id'];
			if ($_POST['depende_id']!="") {
				$resul->depende_id = $_POST['depende_id'];
			}else{
				$resul->depende_id = 0;
			}
		
			$resul->codigo = $_POST['codigo'];
			$resul->cargo = $_POST['cargo'];
			$resul->nivelsalarial_id = $_POST['nivelsalarial_id'];
			$resul->cargo_estado_id = $_POST['cargo_estado_id'];
			$resul->fin_partida_id=$_POST['cargo_estado_id'];
			$resul->user_mod_id = $user->id;
			$resul->fecha_mod = date("Y-m-d");
			$resul->save();
		}
		else{
			/*	//$this->_registerSession($user);
			$finpartida=Finpartidas::findFirstById($_POST['fin_partida_id']);
			if ($finpartida != false)
			{

				$finpartida->contador=$finpartida->contador+1;            
				$finpartida->save();
				$codigo = $finpartida->codigo.'.'.substr('0000'.$finpartida->contador,-5);
			}
			else{
					$msm = array('msm' => 'Error: Generacion de codigo' );	
				}
				*/
				$resul = new Cargos();
				$resul->organigrama_id = $_POST['organigrama_id'];
				if ($_POST['depende_id']!="") {
				$resul->depende_id = $_POST['depende_id'];
			}else{
				$resul->depende_id = 0;
			}
		
				$resul->ejecutora_id = 1;
					$resul->codigo = $_POST['codigo']; //generar
					$resul->cargo = $_POST['cargo'];
					$resul->nivelsalarial_id = $_POST['nivelsalarial_id'];
					$resul->cargo_estado_id = $_POST['cargo_estado_id'];
					$resul->estado = 0;
					$resul->baja_logica = 1;
					$resul->user_reg_id = 1;
					$resul->fecha_reg = date("Y-m-d");
					$resul->fin_partida_id=$_POST['cargo_estado_id'];//$_POST['fin_partida_id'];
					$resul->poa_id=1;
				//$resul->save();
					if ($resul->save()) {
						$msm = array('msm' => 'Exito: Se guardo correctamente' );
					}else{
						$msm = array('msm' => 'Error: No se guardo el registro' );
					}
			}	
		}
		$this->view->disable();
		echo json_encode();
	}

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
			'nro' => $v->nro,
			'id' => $v->id,
			'unidad_administrativa' => $v->unidad_administrativa,
			'cargo' => $v->cargo,
			'gestion' => $v->gestion,
			'estado' => $v->estado1,
			'fecha_ini' => date("d-m-Y",strtotime($v->fecha_ini)),
			'fecha_fin' => date("d-m-Y",strtotime($v->fecha_fin))
			);
	}
	echo json_encode($customers);
}
public function listdependeAction()
{
    if (isset($_GET['organigrama_id'])){
	    $resul = Cargos::find(array('baja_logica=1 and organigrama_id='.$_GET['organigrama_id'],'order' => 'id ASC'));
		$this->view->disable();
		foreach ($resul as $v) {
			$customers[] = array(
				'id' => $v->id,
				'organigrama' => $v->organigrama_id,
				'codigo' => $v->codigo,
				'cargo' => $v->cargo
				);
		}
    }
        
	echo json_encode($customers);
}

public function listPersonalAction()
{
    if (isset($_GET['organigrama_id'])){
	    $model = new Cargos();
	    $resul = $model->getPersonalOrganigrama($_GET['organigrama_id']);
		$this->view->disable();
		foreach ($resul as $v) {
			$customers[] = array(
				'id' => $v->id,
				'nombre' => $v->nombre,
				'cargo' => $v->cargo
				);
		}
    }
        
	echo json_encode($customers);
}

public function delete_pacAction(){
	$resul = Pacs::findFirstById($_POST['id']);
	$resul->baja_logica = 0;
	$resul->save();
	$this->view->disable();
	echo json_encode();
}

public function getEstadoSeguimientoAction()
{
	$model = new Cargos();
	$resul = $model->getEstadoSeguimiento($_POST['cargo_id']);
	$this->view->disable();
	$estado = null;
	foreach ($resul as $v) {
		$estado=$v->seguimiento_estado_id;
	}
	echo json_encode($estado);
}


}
?>