<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  01-04-2015
*/

class MarcacionesController extends ControllerBase
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
        $this->assets->addCss('/assets/css/bootstrap-switch.css');
        $this->assets->addJs('/js/switch/bootstrap-switch.js');
        $this->assets->addCss('/assets/css/oasis.principal.css');
        $this->assets->addCss('/assets/css/jquery-ui.css');
        $this->assets->addCss('/css/oasis.grillas.css');
        $this->assets->addJs('/js/numeric/jquery.numeric.js');
        $this->assets->addJs('/js/jquery.PrintArea.js');
        $this->assets->addCss('/assets/css/PrintArea.css');

        $this->assets->addCss('/assets/css/clockpicker.css');
        $this->assets->addJs('/js/clockpicker/clockpicker.js');

        $this->assets->addJs('/js/marcaciones/oasis.marcaciones.tab.js');
        $this->assets->addJs('/js/marcaciones/oasis.marcaciones.index.js');
        $this->assets->addJs('/js/marcaciones/oasis.marcaciones.list.js');
        $this->assets->addJs('/js/marcaciones/oasis.marcaciones.approve.js');
        $this->assets->addJs('/js/marcaciones/oasis.marcaciones.download.js');
        $this->assets->addJs('/js/marcaciones/oasis.marcaciones.new.edit.js');
        $this->assets->addJs('/js/marcaciones/oasis.marcaciones.turns.excepts.js');
        $this->assets->addJs('/js/marcaciones/oasis.marcaciones.down.js');
        $this->assets->addJs('/js/marcaciones/oasis.marcaciones.move.js');
        $this->assets->addJs('/js/marcaciones/oasis.marcaciones.view.js');
        $this->assets->addJs('/js/marcaciones/oasis.marcaciones.export.marc.js');
        $this->assets->addJs('/js/marcaciones/oasis.marcaciones.export.calc.js');
        $this->assets->addJs('/js/marcaciones/oasis.marcaciones.view.splitter.js');
    }

    /**
     * Función para la obtención del listado de marcaciones descargados en el sistema OASIS
     * desde la base de datos del sistema de control de personal.
     */
    public function listAction()
    {
        $this->view->disable();
        $obj = new FMarcaciones();

        $where = "";
        if(isset($_GET["opcion"])&&$_GET["opcion"]==0){
            /**
             * Se realiza este filtrado a objeto de no mostrar ningún registro, ya que considerando el tiempo de carga
             */
            $where = "id_persona=0";
        }
        $resul = $obj->getAll($where);
        $marcacion = Array();
        //comprobamos si hay filas
        if ($resul->count() > 0) {
            foreach ($resul as $v) {
                $marcacion[] = array(
                    'nro_row' => 0,
                    'id_persona'=>$v->id_persona,
                    'nombres'=>$v->nombres,
                    'ci'=>$v->ci,
                    'expd'=>$v->expd,
                    'estado'=>$v->estado,
                    'estado_descripcion'=>$v->estado_descripcion,
                    'gestion'=>$v->gestion,
                    'mes'=>$v->mes,
                    'mes_nombre'=>$v->mes_nombre,
                    'fecha'=>$v->fecha != "" ? date("d-m-Y", strtotime($v->fecha)) : "",
                    'hora'=>$v->hora,
                    'id_maquina'=>$v->id_maquina,
                    'maquina'=>$v->maquina,
                    'user_reg_id'=>$v->user_reg_id,
                    'fecha_reg'=>$v->fecha_reg != "" ? date("d-m-Y", strtotime($v->fecha_reg)) : "",
                    'fecha_ini_rango'=>$v->fecha_ini_rango != "" ? date("d-m-Y", strtotime($v->fecha_ini_rango)) : "",
                    'fecha_fin_rango'=>$v->fecha_fin_rango != "" ? date("d-m-Y", strtotime($v->fecha_fin_rango)) : ""
                );
            }
        }
        echo json_encode($marcacion);
    }
    /**
     * Función para la conexión con SQL Server
     * @return false|resource
     */
    function ConexionMSql(){

        $MSQLSERVER = "192.168.10.40";$MSQLUSER = "sa";$MSQLPSW = "Sistemas2015";$MSSQLDB = "asistencia";
        /* Array asociativo con la información de la conexion */
        $connectionInfo = array( "UID"=>$MSQLUSER,"PWD"=>$MSQLPSW,"Database"=>$MSSQLDB);

        /* Nos conectamos mediante la autenticación de SQL Server . */
        $conn = sqlsrv_connect( $MSQLSERVER, $connectionInfo);
        if( $conn === false )
        {
            die ( "Falla en la conexion..." );
            die( print_r( sqlsrv_errors(), true));
        }
        return $conn;
    }

    /**
     * Función para la conexión con la base de datos del sistema OASIS de manera auxiliar.
     * @return resource
     */
    function ConexionAuxiliarPostgreSql(){

        $user = 'user_rrhh';
        $passwd = 'pass_rrhh';
        $db = 'bd_rrhh_publicado';
        $port = 5432;
        $host = 'localhost';
        $strCnx = "host=$host port=$port dbname=$db user=$user password=$passwd";
        $cnx = pg_connect($strCnx) or die ("Error de conexion. ". pg_last_error());
        if( $cnx === false )
        {
            die ( "Falla en la conexion..." );
            die( print_r( sqlsrv_errors(), true));
        }
        return $cnx;
    }
    /**
     * Disables FOREIGN_KEY_CHECKS and truncates database table
     * @param string $table table name
     * @return bool result of truncate operation
     */
    public function truncateTable($table)
    {
        $db = $this->getDI()->get('db');
        $success = $db->execute("TRUNCATE TABLE $table, $table RESTART IDENTITY");
        return $success;
    }

    /**
     * Función para el borrado de los registros de acuerdo al rango de fechas establecidas.
     * @param $fechaIni
     * @param $fechaFin
     * @return mixed
     */
    public function borrarRangoEnTabla($fechaIni,$fechaFin)
    {
        $db = $this->getDI()->get('db');
        $success = $db->execute("DELETE FROM marcaciones where fecha BETWEEN '$fechaIni' AND '$fechaIni'");
        return $success;
    }
    /**
     * Funci�n para listar todos los cargos de todas las certificaciones de la gesti�n 2011 (dato modificable).
     */
    function showallmarcacionesAction() {
        $this->view->disable();
        $msql = $this->ConexionMSql();
        $tsql = "[SP_RPT_MARCACIONES_BIOMETRICOS]0,0,0,'21-01-2015','22-01-2015'";
        $stmt = sqlsrv_query( $msql, $tsql);
        if( $stmt === false )
        {
            echo "Error al ejecutar consulta.</br>";
            die( print_r( sqlsrv_errors(), true));
        }
        $con = 1;
        $vocales = array ("Á", "É", "Í", "Ó", "Ú", "Ñ" );
        $vocales2 = array ("A", "E", "I", "O", "U", "N" );
        echo "<table><tr><td>Nro.</td><td>UBICACION</td><td>NOMBRES</td><td>CI</td><td>CARGO</td><td>FECHA</td><td>HORA</td><td>CODIGO MAQUINA</td><td>ESTACION</td>";
        while ( $result = sqlsrv_fetch_array ($stmt) ) {
            echo "<tr><td class='opcion'>" . $con . "</td>";
            echo "<td class='opcion'>" . $result ["UBICACION"] ."</td>";
            echo "<td class='opcion'>" . $result ["NOMBRES"] . "</td>";
            echo "<td class='opcion'>" . $result ["CI"] . "</td>";
            echo "<td class='opcion'>" . str_replace ( $vocales, $vocales2, strtoupper ( $result ['CARGO'] ) ) ."</td>";
            echo "<td class='opcion'>" . $result ["MARCACION_FECHA"] . "</td>";
            echo "<td class='opcion'>" . $result ["MARCACION_HORA"] . "</td>";
            echo "<td class='opcion'>" . $result ["CODIGO_MAQUINA"] . "</td>";
            echo "<td class='opcion'>" . $result ["ESTACION"] . "</td>";
            echo "</td></tr>";
            $con ++;
        }
        echo "</tr></table>";
        sqlsrv_free_stmt( $stmt);
        sqlsrv_close( $msql);
    }

    /**
     * Función para la descarga de los registros almacenados en la base de datos correspondiente a marcaciones de equipos biométricos.
     */
    public function downloadAction(){
        $ok=true;
        $auth = $this->session->get('auth');
        $user_reg_id = $user_mod_id = $auth['id'];
        $msj = Array();
        $hoy = date("Y-m-d H:i:s");
        $this->view->disable();
        $vocales = array ("Á", "É", "Í", "Ó", "Ú", "Ñ" );
        $vocales2 = array ("A", "E", "I", "O", "U", "N" );
        $this->view->disable();
        if(isset($_POST["fecha_ini"])&&isset($_POST["fecha_fin"])){
            $fechaIni = $_POST["fecha_ini"];
            $fechaFin = $_POST["fecha_fin"];
            $msql = $this->ConexionMSql();
            $tsql = "[SP_RPT_MARCACIONES_BIOMETRICOS]0,0,0,'".$fechaIni."','".$fechaFin."'";
            $stmt = sqlsrv_query( $msql, $tsql);
            if( $stmt === false )
            {
                $msj = array('result' => -1, 'msj' => 'Error cr&iacute;tico: No se guardaron los registros de marcaciones.');
            }else{
                $errores = 0;
                $tot = 0;
                $good = 0;
                $this->borrarRangoEnTabla($fechaIni,$fechaFin);
                $err = array();
                $pg = $this->ConexionAuxiliarPostgreSql();
                $sql = "INSERT INTO marcaciones(id, persona_id, maquina_id, fecha, hora, observacion, estado,baja_logica, agrupador, user_reg_id, fecha_reg, fecha_ini_rango, fecha_fin_rango) VALUES ";
                while ( $result = sqlsrv_fetch_array ($stmt) ) {
                    $tot++;
                    $persona = Personas::findFirst(array("ci LIKE '".trim($result ["CI"])."'"));
                    $maquina = Maquinas::findFirst(array("num_serie LIKE '".trim($result ["CODIGO_MAQUINA"])."'"));
                    $idPersona=$idMaquina=0;
                    if($persona){$idPersona = $persona->id;}
                    if($maquina){$idMaquina = $maquina->id;}
                    if($idPersona!=null&&$idPersona>0&&$maquina!=null&&$idMaquina>0){
                        $good++;
                        $sql .= "(default,$idPersona,$idMaquina,'".$result ["MARCACION_FECHA"]."','".$result ["MARCACION_HORA"]."',NULL,1,1,0,$user_reg_id,'$hoy','$fechaIni','$fechaFin'),";
                    }else{
                        $err[]= array('ci'=>$result ["CI"],'id_persona'=>$idPersona,'codigo_maquina'=>$result ["CODIGO_MAQUINA"],'id_maquina'=>$idMaquina);
                        $ok=false;
                        $errores ++;
                    }
                }
                if($good>0){
                    $sql .=",";
                    $sql = str_replace(",,","",$sql);
                    $ok = pg_query($pg, $sql);
                }
                if($ok) $msj = array('result' => 1, 'msj' => '&Eacute;xito: Se realizaron las descargas para el rango solicitado de modo satisfactorio.','total'=>$tot,'correctas'=>$good,'errores'=>$errores);
                else  {

                    $msj = array('result' => 0, 'msj' => 'Se realizaron las descargas para el rango solicitado. Sin embargo, hubieron '.$errores." marcaciones que no se descargaron por inconsistencia de datos.",'cant_total'=>$tot,'cant_correctas'=>$good,'cant_errores'=>$errores,'errores'=>$err);
                }
            }
            sqlsrv_free_stmt( $stmt);
            sqlsrv_close( $msql);
        }
        echo json_encode($msj);
    }

} 