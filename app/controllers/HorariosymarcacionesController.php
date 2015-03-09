<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  09-03-2015
*/

class HorariosymarcacionesController extends ControllerBase{

    public function initialize()
    {
        parent::initialize();
    }
    /**
     * Función para la carga de la página inicial del registro de relación laboral, turno por mes y gestión determinados.
     * Se cargan los combos necesarios.
     */
    public function indexAction()
    {
        $this->assets->addCss('/assets/css/oasis.principal.css');

        $this->assets->addJs('/js/clockpicker/clockpicker.js');
        $this->assets->addCss('/assets/css/clockpicker.css');
        $this->assets->addCss('/assets/css/oasis.principal.css');
        $this->assets->addCss('/assets/css/jquery-ui.css');
        $this->assets->addCss('/css/oasis.grillas.css');

        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.tab.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.index.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.new.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.approve.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.edit.js');
        $this->assets->addJs('/js/horariosymarcaciones/oasis.horariosymarcaciones.down.js');
    }
} 