<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  03-02-2015
*/
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
class Relaboralesperfiles extends \Phalcon\Mvc\Model {
    private $_db;
    public function initialize() {
        $this->_db = new Relaboralesperfiles();
        //   parent::initialize();
    }

    /**
     * Función para la verificación de la existencia de sobre posición de asignación de perfiles laborales.
     * @param $idRelaboralPerfil
     * @param $idRelaboral
     * @param $idUbicacion
     * @param $fechaIni
     * @param $fechaFin
     * @return Resultset
     */
    public function verificaSobrePosicionPerfiles($idRelaboralPerfil,$idRelaboral,$idPerfilLaboral,$idUbicacion,$fechaIni,$fechaFin){
        if($idRelaboral>0&&$idUbicacion>0&&$fechaIni!=''&&$fechaFin!=''){
            $sql = "SELECT * FROM f_tiene_sobreposicion_perfil(".$idRelaboralPerfil.",".$idRelaboral.",".$idPerfilLaboral.",".$idUbicacion.",'".$fechaIni."','".$fechaFin."')";
            return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
        }
    }

    /**
     * Función para la obtención del listado de relaciones laborales registradas en un determinado perfil laboral.
     * @param $idPerfilLaboral
     * @return Resultset
     */
    public function getListRelaboralesByPerfil($idPerfilLaboral){
        if($idPerfilLaboral>0){
            $sql = "select * from f_relaborales_asignados_a_perfil(".$idPerfilLaboral.", 0, null, null)";
            return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql));
        }
    }
} 