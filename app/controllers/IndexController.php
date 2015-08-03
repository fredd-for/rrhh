<?php

class IndexController extends ControllerBase
{

    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        $this->view->setVar('usuario', $this->_user);
        /**
         * Cantidad de Personal
         */
        $relaborales = Relaborales::find("estado>=1 AND finpartida_id IN (1,4,7)");
        $this->view->setVar('permanentes', $relaborales->count());

        $relaborales = Relaborales::find("estado>=1 AND finpartida_id IN (2,5,8)");
        $this->view->setVar('eventuales', $relaborales->count());

        $relaborales = Relaborales::find("estado>=1 AND finpartida_id IN (3,6,9)");
        $this->view->setVar('consultores', $relaborales->count());

        /**
         * Procesos Pendientes de Conclusión
         */
        $hoy = date("d-m-Y");
        $procesos_pendientes = Procesoscontrataciones::find("fecha_concl>='".$hoy."' AND normativamod_id IN (1,2,5,6) AND tipoconvocatoria_id=1");
        $this->view->setVar('procesos_pendientes', $procesos_pendientes->count());

        $idUsuario = $this->_user->id;
        $usuario = Usuarios::findFirstById($idUsuario);
        $ci_usuario = $usuario->cedula_identidad;
        $ruta = "";
        $rutaImagenesCredenciales = "/images/personal/";
        $extencionImagenesCredenciales = ".jpg";
        $num_complemento = "";
        /*if (isset($_POST["num_complemento"])) {
            $num_complemento = $_POST["num_complemento"];
        }*/
        if (isset($ci_usuario)) {
            $ruta = "";
            $nombreImagenArchivo = $rutaImagenesCredenciales . trim($ci_usuario);
            if ($num_complemento != "") $nombreImagenArchivo = $nombreImagenArchivo . trim($num_complemento);
            $ruta = $nombreImagenArchivo . $extencionImagenesCredenciales;
            if (!file_exists(getcwd() . $ruta))$ruta = '/images/perfil-profesional.jpg';
            $this->view->setVar('ruta', $ruta);
        }
    }
}