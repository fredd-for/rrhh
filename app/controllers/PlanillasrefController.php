<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  02-06-2015
*/

class PlanillasrefController extends ControllerBase{
    public function initialize()
    {
        parent::initialize();
    }
    public function indexAction()
    {
        $this->assets->addCss('/assets/css/bootstrap-switch.css');
        $this->assets->addJs('/js/switch/bootstrap-switch.js');
        $this->assets->addCss('/assets/css/oasis.principal.css');
        $this->assets->addCss('/assets/css/jquery-ui.css');
        $this->assets->addCss('/css/oasis.grillas.css');
        $this->assets->addJs('/js/numeric/jquery.numeric.js');
        $this->assets->addJs('/js/jqwidgets/jqxgrid.aggregates.js');

        $this->assets->addJs('/js/colorpicker-master/js/evol.colorpicker.min.js');
        $this->assets->addCss('/js/colorpicker-master/css/evol.colorpicker.css');

        $this->assets->addJs('/js/planillasref/oasis.planillasref.tab.js');
        $this->assets->addJs('/js/planillasref/oasis.planillasref.index.js');
        $this->assets->addJs('/js/planillasref/oasis.planillasref.generate.js');
        $this->assets->addJs('/js/planillasref/oasis.planillasref.edit.js');
        $this->assets->addJs('/js/planillasref/oasis.planillasref.view.js');
        $this->assets->addJs('/js/planillasref/oasis.planillasref.approve.js');
        $this->assets->addJs('/js/planillasref/oasis.planillasref.export.js');
        $this->assets->addJs('/js/planillasref/oasis.planillasref.down.js');
    }

} 