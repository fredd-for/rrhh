<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  02-03-2015
*/

class asignacionesexcepcionesController  extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
    }
    /**
     * Función para la carga de la página de asignación de excepciones.
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

        $this->assets->addJs('/js/asignacionesexcepciones/oasis.asignacionesexcepciones.tab.js');
        $this->assets->addJs('/js/asignacionesexcepciones/oasis.asignacionesexcepciones.index.js');
        $this->assets->addJs('/js/asignacionesexcepciones/oasis.asignacionesexcepciones.approve.js');
        $this->assets->addJs('/js/asignacionesexcepciones/oasis.asignacionesexcepciones.new.js');
        $this->assets->addJs('/js/asignacionesexcepciones/oasis.asignacionesexcepciones.edit.js');
        $this->assets->addJs('/js/asignacionesexcepciones/oasis.asignacionesexcepciones.down.js');
        $this->assets->addJs('/js/asignacionesexcepciones/oasis.asignacionesexcepciones.move.js');
        $this->assets->addJs('/js/asignacionesexcepciones/oasis.asignacionesexcepciones.view.js');
        $this->assets->addJs('/js/asignacionesexcepciones/oasis.asignacionesexcepciones.export.js');
        $this->assets->addJs('/js/asignacionesexcepciones/oasis.asignacionesexcepciones.export.old.js');
        $this->assets->addJs('/js/asignacionesexcepciones/oasis.asignacionesexcepciones.view.splitter.js');
    }
} 