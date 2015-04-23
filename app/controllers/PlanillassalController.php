<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  22-04-2015
*/
class PlanillassalController  extends ControllerBase{
    public function initialize()
    {
        parent::initialize();
    }
    /**
     * Función para la carga de la página de gestión de excepciones.
     * Se cargan los combos necesarios.
     */
    public function indexAction()
    {
        $this->assets->addCss('/assets/css/bootstrap-switch.css');
        $this->assets->addJs('/js/switch/bootstrap-switch.js');
        $this->assets->addCss('/assets/css/oasis.principal.css');
        $this->assets->addCss('/assets/css/jquery-ui.css');
        $this->assets->addCss('/css/oasis.grillas.css');
        $this->assets->addJs('/js/numeric/jquery.numeric.js');

        $this->assets->addJs('/js/colorpicker-master/js/evol.colorpicker.min.js');
        $this->assets->addCss('/js/colorpicker-master/css/evol.colorpicker.css');

        $this->assets->addJs('/js/planillassal/oasis.planillassal.tab.js');
        $this->assets->addJs('/js/planillassal/oasis.planillassal.index.js');
        $this->assets->addJs('/js/planillassal/oasis.planillassal.new.edit.js');
        $this->assets->addJs('/js/planillassal/oasis.planillassal.approve.js');
        $this->assets->addJs('/js/planillassal/oasis.planillassal.export.js');
        $this->assets->addJs('/js/planillassal/oasis.planillassal.down.js');
    }
} 