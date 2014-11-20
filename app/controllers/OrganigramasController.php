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
		$organigrama=  Organigramas::findFirst("padre_id = '0'");
		$this->listar($organigrama->id,$organigrama->unidad_administrativa, $organigrama->sigla);
		$this->lista.='</ul>';
		$config = array();

		$this->assets
		->addCss('/js/jorgchart/jquery.jOrgChart.css')
		->addCss('/js/jorgchart/custom.css')
		;
		$this->assets->addJs('/js/jorgchart/jquery.jOrgChart.js');

		$this->view->setVar('lista', $this->lista);
	}

	public function addAction($id='')
	{
		if ($this->request->isPost()) {
			$resul = new Organigramas();
			$resul->padre_id = $this->request->getPost('padre_id');
			$resul->gestion = date("Y");
			$resul->da_id = 1;
			$resul->regional_id = 1;
			$resul->unidad_administrativa = $this->request->getPost('unidad_administrativa');
			$resul->nivel_estructural_id = $this->request->getPost('nivel_estructural_id');
			$resul->sigla = $this->request->getPost('sigla');
			$resul->fecha_ini = date("Y-m-d",strtotime($_POST['fecha_ini']));
			$resul->codigo = 0;
			$resul->estado = 1;
			$resul->baja_logica = 1;
			$resul->user_reg_id = 1;
			$resul->visible = 1;
			$resul->fecha_reg = date("Y-m-d H:i:s");
			$resul->area_sustantiva = $this->request->getPost('area_sustantiva');
			if ($resul->save()) {
				$this->flashSession->success("Exito: Registro guardado correctamente...");
			}else{
				$this->flashSession->error("Error: no se guardo el registro...");
			}
			$this->response->redirect('/organigramas');
		}

		$resul = Organigramas::findFirstById($id);
		$this->view->setVar('sigla',$resul->sigla);		
		$this->tag->setDefault("padre_id", $id);
		$padre = $this->tag->select(
			array(
				'padre_id',
				Organigramas::find(array('baja_logica=1','order' => 'unidad_administrativa ASC')),
				'using' => array('id', "unidad_administrativa"),
				'useEmpty' => true,
				'emptyText' => 'Seleccionar',
				'emptyValue' => '0',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('padre',$padre);

		$nivelestructural= $this->tag->select(
			array(
				'nivel_estructural_id',
				Nivelestructurales::find(array('baja_logica=1','order' => 'id ASC')),
				'using' => array('id', "nivel_estructural"),
				'useEmpty' => false,
				'emptyText' => 'Mi Teleferico',
				'emptyValue' => '0',
				'class' => 'form-control'
				)
			);
		$this->view->setVar('nivelestructural',$nivelestructural);		
	}

	public function editAction($id='')
	{
		$resul = Organigramas::findFirstById($id);
		if ($this->request->isPost()) {
			$resul = Organigramas::findFirstById($this->request->getPost('id'));
			$resul->padre_id = $this->request->getPost('padre_id');
			$resul->unidad_administrativa = $this->request->getPost('unidad_administrativa');
			$resul->nivel_estructural_id = $this->request->getPost('nivel_estructural_id');
			$resul->sigla = $this->request->getPost('sigla');
			$resul->fecha_ini = date("Y-m-d",strtotime($this->request->getPost('fecha_ini')));
			$resul->user_mod_id = 1;
			$resul->fecha_mod = date("Y-m-d H:i:s");
			$resul->area_sustantiva = $this->request->getPost('area_sustantiva');
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

	}

	public function listar($id, $oficina, $sigla) {
		$h=  organigramas::count("padre_id='$id'");        
		$this->lista.='<li id="org" style="display:none">
		<a href="/organigramas/add/'.$id.'" title="adicionar"><i class="fa fa-plus-circle fa-lg"></i></a>
		<a href="/organigramas/edit/'.$id.'" title="editar"><i class="fa fa-pencil fa-lg"></i></a>
		<a href="/organigramas/delete/'.$id.'" title="eliminar"><i class="fa fa-minus-circle fa-lg"></i></a>
		<br>
		<a href="/organigramas/personal/'.$id.'" title="Ver Personigrama" style="color:#f2f2f2">'.$oficina.'</a>';
		if ($h > 0) {
            //echo '<ul>';
			$this->lista.='<ul>';
			$hijos=  Organigramas::find(array("padre_id='$id' and baja_logica=1 and visible=1"));
            //$hijos = ORM::factory('oficinas')->where('padre', '=', $id)->find_all();
			foreach ($hijos as $hijo) {
				$oficina = $hijo->unidad_administrativa;
				$this->listar($hijo->id, $oficina, $hijo->sigla);
			}
			$this->lista.='</ul>';
            // echo '</ul>';
		} else {
			$this->lista.='</li>';
            //   echo '</li>';
		}
	}


	public function listAction()
	{
		//$resul = Organigramas::find(array('baja_logica=:activo1:','bind'=>array('activo1'=>'1'),'order' => 'id ASC'));
		$model = new Organigramas();
		$resul = $model->lista();

		$this->view->disable();
		foreach ($resul as $v) {
			$customers[] = array(
				'id' => $v->id,
				'padre_id' => $v->padre_id,
				'padre' => $v->padre,
				//'direccion_administrativa' => $v->direccion_administrativa,
				'unidad_administrativa' => $v->unidad_administrativa,
				'nivel_estructural_id' => $v->nivel_estructural_id,
				'sigla' => $v->sigla,
				);
		}
		echo json_encode($customers);
	}

	public function saveAction()
	{
		if (isset($_POST['id'])) {
			$date = new DateTime($_POST['fecha_ini']);
			$fecha_ini = $date->format('Y-m-d');

			if ($_POST['id']>0) {
				$resul = Organigramas::findFirstById($_POST['id']);
				$resul->padre_id = $_POST['padre_id'];
				$resul->da_id = $_POST['da_id'];
				$resul->unidad_administrativa = $_POST['unidad_administrativa'];
				$resul->nivel_estructural_id = $_POST['nivel_estructural_id'];
				$resul->sigla = $_POST['sigla'];
				$resul->fecha_ini = $fecha_ini;
				$resul->save();
				
			}
			else{
				$resul = new Organigramas();
				$resul->padre_id = $_POST['padre_id'];
				$resul->gestion = date("Y");
				$resul->da_id = 1;
				$resul->regional_id = 1;
				$resul->unidad_administrativa = $_POST['unidad_administrativa'];
				$resul->nivel_estructural_id = $_POST['nivel_estructural_id'];
				$resul->sigla = $_POST['sigla'];
				$resul->fecha_ini = $fecha_ini;
				$resul->estado = 1;
				$resul->baja_logica = 1;
				$resul->user_reg_id = 1;
				$resul->fecha_reg = date("Y-m-d H:i:s");
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

	public function deleteAction($id)
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

	/*public function deleteAction(){
		$resul = Organigramas::findFirstById($_POST['id']);
		$resul->baja_logica = 0;
		$resul->save();
		$this->view->disable();
		echo json_encode();
	}
*/


	public function personalAction($organigrama_id)
	{
		//$model=  Cargos::findFirst(array("organigrama_id='$organigrama_id' and depende_id='0' and baja_logica='1'" ));
		$model=  new Cargos();
		$cargo = $model->listPersonal($organigrama_id,0);
		$cont = count($cargo);
		if ($cont>0) {
			foreach ($cargo as $v) {
			$this->listarPersonal($v->id,$v->cargo, $v->codigo,$v->estado1);
			$this->lista.='</ul>';
			$config = array();
			}
		}else{
			$this->lista.='<h3>No existe cargos dentro la oficina..</h3>';
		}
		$this->assets
		->addCss('/js/jorgchart/jquery.jOrgChartPersonal.css')
		->addCss('/js/jorgchart/customPersonal.css')
		;
		$this->assets->addJs('/js/jorgchart/jquery.jOrgChart.js');

		$this->view->setVar('lista', $this->lista);
	}

	public function listarPersonal($id, $cargo, $codigo,$estado) {
		$h=  Cargos::count("depende_id='$id'");
		$datos_usuario="";
		$nombre="";
		if($estado>0){
			$ci_activo='1';
			$cargo_ci=new Cargos();
			$ci=$cargo_ci->getCI($id);
			foreach ($ci as $v) {
				$ci_activo = $v->ci;
				$nombre = $v->p_nombre.', '.$v->p_apellido.' '.$v->s_apellido;
			}
			$ruta="./images/personal/".$ci_activo.".jpg";
			if (file_exists($ruta)) {
				$datos_usuario = ' <img src="/images/personal/'.$ci_activo.'.jpg" height="50" width="50">';	
			} else {
				$datos_usuario = ' <img src="/images/personal/imagen_comodin.png" title="Adjudicado" height="50" width="50">';	
			}
			$datos_usuario.="<br>".$nombre;

		}else{
			$datos_usuario = ' <img src="/images/personal/imagen_acefalo.jpg" title="ACEFALO" height="50" width="50"><br>ACEFALO';
		}        
		$this->lista.='<li id="org" style="display:none"><span>'.$codigo.'</span><br>'.$cargo.'<br>'.$datos_usuario;
		if ($h > 0) {
            //echo '<ul>';
			$this->lista.='<ul>';
			//$hijos=  Cargos::find(array("depende_id='$id' and baja_logica=1"));
            $model=  new Cargos();
            $hijos = $model->listPersonal(0,$id);
			foreach ($hijos as $hijo) {
				$cargo = $hijo->cargo;
				$this->listarPersonal($hijo->id, $cargo, $hijo->codigo,$hijo->estado1);
			}
			$this->lista.='</ul>';
            // echo '</ul>';
		} else {
			$this->lista.='</li>';
            //   echo '</li>';
		}
	}

	
}
?>