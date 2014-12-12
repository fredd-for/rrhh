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
		$this->assets
                    ->addCss('/js/datatables/dataTables.bootstrap.css')
                    ->addCss('/js/jqwidgets/styles/jqx.base.css')
                    ->addCss('/js/jqwidgets/styles/jqx.blackberry.css')
                    ->addCss('/js/jqwidgets/styles/jqx.windowsphone.css')
                    ->addCss('/js/jqwidgets/styles/jqx.blackberry.css')
                    ->addCss('/js/jqwidgets/styles/jqx.mobile.css')
                    ->addCss('/js/jqwidgets/styles/jqx.android.css');

        $this->assets
                    ->addJs('/js/jqwidgets/simulator.js')
                    ->addJs('/js/jqwidgets/jqxcore.js')
                    ->addJs('/js/jqwidgets/jqxdata.js')
                    ->addJs('/js/jqwidgets/jqxbuttons.js')
                    ->addJs('/js/jqwidgets/jqxscrollbar.js')
                    ->addJs('/js/jqwidgets/jqxdatatable.js')
                    ->addJs('/js/jqwidgets/jqxlistbox.js')
                    ->addJs('/js/jqwidgets/jqxdropdownlist.js')
                    ->addJs('/js/jqwidgets/jqxpanel.js')
                    ->addJs('/js/jqwidgets/jqxradiobutton.js')
                    ->addJs('/js/jqwidgets/jqxinput.js')
                    ->addJs('/js/datepicker/bootstrap-datepicker.js')
                    ->addJs('/js/datatables/dataTables.bootstrap.js')

                    ->addJs('/js/jqwidgets/jqxmenu.js')
                    ->addJs('/js/jqwidgets/jqxgrid.js')
                    ->addJs('/js/jqwidgets/jqxgrid.filter.js')
                    ->addJs('/js/jqwidgets/jqxgrid.sort.js')
                    ->addJs('/js/jqwidgets/jqxtabs.js')
                    ->addJs('/js/jqwidgets/jqxgrid.selection.js')
                    ->addJs('/js/jqwidgets/jqxcalendar.js')
                    ->addJs('/js/jqwidgets/jqxdatetimeinput.js')
                    ->addJs('/js/jqwidgets/jqxcheckbox.js')
                    ->addJs('/js/jqwidgets/jqxgrid.grouping.js')
                    ->addJs('/js/jqwidgets/jqxgrid.pager.js')
                    ->addJs('/js/jqwidgets/jqxnumberinput.js')
                    ->addJs('/js/jqwidgets/jqxwindow.js')
                    ->addJs('/js/jqwidgets/globalization/globalize.js')
                    ->addJs('/js/jqwidgets/jqxcombobox.js')
                    ->addJs('/js/jqwidgets/jqxexpander.js')
                    ->addJs('/js/jqwidgets/globalization/globalize.js')
                    ->addJs('/js/jqwidgets/jqxvalidator.js')
                    ->addJs('/js/jqwidgets/jqxmaskedinput.js')
                    ->addJs('/js/jqwidgets/jqxchart.js')
                    ->addJs('/js/jqwidgets/jqxgrid.columnsresize.js')
                    ->addJs('/js/jqwidgets/jqxsplitter.js')
                    ->addJs('/js/jqwidgets/jqxtree.js')
                    ->addJs('/js/jqwidgets/jqxdata.export.js')
                    ->addJs('/js/jqwidgets/jqxgrid.export.js')
                    ->addJs('/js/jqwidgets/jqxgrid.edit.js')
                    ->addJs('/js/jqwidgets/jqxnotification.js')
                    ->addJs('/js/jqwidgets/jqxbuttongroup.js')
                    ->addJs('/js/bootbox.js');

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
				'sueldo' => $v->sueldo,
				'fecha_ini' => $v->fecha_ini,
				'fecha_ini_v' => date("d-m-Y",strtotime($v->fecha_ini)),
				'fecha_fin' => $v->fecha_fin,
				'activo' => $v->activo,
				'activo1' => $v->activo1,
				'nivelsalarial_id_existente' => $v->nivelsalarial_id_existente,
				//'fecha_ini' => date("Y-m-d",strtotime($v->fecha_ini))
				);
		}
		echo json_encode($customers);
	}

	public function saveAction()
	{
		if (isset($_POST['id'])) {
			//$date = new DateTime($_POST['fecha_ini']);
			$fecha_ini=date("Y-m-d",strtotime($_POST['fecha_ini']));
			$activo=0;
			if($_POST['activo']=="true"){
				$activo=1;
			}

			if($_POST['nivelsalarial_id_existente']!=''){
			$fecha = strtotime ('-1 day' , strtotime ($fecha_ini));
			$fecha = date ('Y-m-d', $fecha); 
			$resul = new Nivelsalariales();
			$r = $resul->updateFecha($_POST['nivel'],$_POST['nivelsalarial_id_existente'],$fecha);
			}
			
			if($_POST['activo']=="true"){
            $resul = new Nivelsalariales();
			$r = $resul->updateActivos($_POST['nivel']);
			}

			if ($_POST['id']>0) {
				$resul = Nivelsalariales::findFirstById($_POST['id']);
				$resul->resolucion_id = $_POST['resolucion_id'];
				$resul->categoria = $_POST['categoria'];
				$resul->clase = $_POST['clase'];
				$resul->nivel = $_POST['nivel'];
				$resul->denominacion = $_POST['denominacion'];
				$resul->sueldo = $_POST['sueldo'];
				$resul->fecha_ini = $fecha_ini;
				$resul->activo = $activo;
				$resul->save();
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
				$resul->fecha_ini = $fecha_ini;
				$resul->estado = 1;
				$resul->baja_logica = 1;
				$resul->activo = $activo;
				$resul->save();
				
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

public function getCargosPerfilesAction()
{	$customers = array();
	if (isset($_POST['id'])) {
		$resul=Cargosperfiles::find(array('baja_logica=1 and nivelsalarial_id='.$_POST['id'],'order' => 'id ASC'));
        
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
	$this->view->disable();
	echo json_encode($customers);	
}

public function getNivelActivoAction()
{
	$resul=Nivelsalariales::find(array('baja_logica=1 and nivel='.$_POST['nivel']. ' and activo=1'));
	$customers=array();
	foreach ($resul as $v) {
		$customers[]= array(
			'id'=>$v->id,
			'categoria'=>$v->categoria,
			'clase'=>$v->clase,
			'nivel'=>$v->nivel,
			'denominacion'=>$v->denominacion,
			'sueldo'=>$v->sueldo,
			'fecha_ini'=>$v->fecha_ini,
			'activo'=>$v->activo,
		);
	}
	$this->view->disable();
	echo json_encode($customers);
}

}
?>