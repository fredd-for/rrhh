<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  13-02-2015
*/

class ExcepcionesController extends ControllerBase
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
    {
        $this->assets->addCss('/assets/css/oasis.principal.css');
        $this->assets->addCss('/css/oasis.grillas.css');
        $this->assets->addJs('/js/excepciones/oasis.excepciones.tab.js');
        $this->assets->addJs('/js/excepciones/oasis.excepciones.index.js');
        $this->assets->addJs('/js/excepciones/oasis.excepciones.new.edit.js');
        $this->assets->addJs('/js/excepciones/oasis.excepciones.approve.js');
        $this->assets->addJs('/js/excepciones/oasis.excepciones.export.js');
        $this->assets->addJs('/js/excepciones/oasis.excepciones.down.js');
    }


} 