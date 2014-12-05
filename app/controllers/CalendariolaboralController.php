<?php

/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  04-12-2014
*/

class CalendariolaboralController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
    }
    /**
     * Función para la carga de la página de gestión de relaciones laborales.
     * Se cargan los combos necesarios.
     */
    public function indexAction()
    {   $this->assets->addJs('/js/calendariolaboral/oasis.calendariolaboral.index.js');
        $this->assets->addJs('/js/calendariolaboral/compCalendar.js');
        /*
        /*$this->assets->addJs('/js/calendariolaboral/oasis.calendariolaboral.tab.js');
        $this->assets->addJs('/js/calendariolaboral/oasis.calendariolaboral.list.js');
        $this->assets->addJs('/js/calendariolaboral/oasis.calendariolaboral.approve.js');
        $this->assets->addJs('/js/calendariolaboral/oasis.calendariolaboral.new.js');
        $this->assets->addJs('/js/calendariolaboral/oasis.calendariolaboral.edit.js');
        $this->assets->addJs('/js/calendariolaboral/oasis.calendariolaboral.down.js');
        $this->assets->addJs('/js/calendariolaboral/oasis.calendariolaboral.move.js');
        $this->assets->addJs('/js/calendariolaboral/oasis.calendariolaboral.view.js');
        $this->assets->addJs('/js/calendariolaboral/oasis.calendariolaboral.print.js');
        $this->assets->addJs('/js/calendariolaboral/oasis.calendariolaboral.view.splitter.js');
        $this->assets->addJs('/js/calendariolaboral/oasis.localizacion.js');
        $this->assets->addCss('/assets/css/oasis.principal.css');
        $ubicaciones = $this->tag->select(
            array(
                'lstUbicaciones',
                Ubicaciones::find(array('baja_logica=1', 'order' => 'id ASC')),
                'using' => array('id', "ubicacion"),
                'useEmpty' => true,
                'emptyText' => 'Seleccionar..',
                'emptyValue' => '',
                'class' => 'form-control new-relab'
            )
        );
        $this->view->setVar('ubicaciones', $ubicaciones);

        $categorias = $this->tag->select(
            array(
                'lstCategorias',
                Categorias::find(array('order' => 'id ASC')),
                'using' => array('id', "categoria"),
                'useEmpty' => true,
                'emptyText' => 'Seleccionar..',
                'emptyValue' => '',
                'class' => 'form-control new-relab'
            )
        );
        $this->view->setVar('categorias', $categorias);*/
    }

}