<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 11/12/2014
 * Time: 8:58
 */
require_once('../app/libs/phpexcel180/PHPExcel.php');
require_once('../app/libs/phpexcel180/PHPExcel/IOFactory.php');

class exceloasis extends PHPExcel{
    public $title_rpt = '';
    public $header_title_estado_rpt = 'Estado Plurinacional de Bolivia';
    public $header_title_empresa_rpt = 'Empresa Estatal de Transporte por Cable "Mi Teleferico"';
    public $style_header_table = '';
    public $style_footer_table = '';
    var $debug;              //Valor de seguimiento 1: Hacer debug; 0: No hacer debug
    var $widths;             //Array de anchuras
    var $aligns;             //Array de alineaciones
    var $pageWidth;          //Ancho de la hoja (Sea si esta vertical u horizontal)
    var $tableWidth;         //Ancho de la tabla
    var $FechaHoraReporte;	 //Fecha y hora del reporte
    var $FechaHoraCreacion;	 //Fecha y hora de creación
    var $IdUsrPrint;	 	 //Identificador del usuario impresor
    var $ContadorFilas;		 //Contador de filas
    var $PrimerNumero;	 	 //Primer número de la lista en la página
    var $UltimoNumero;	 	 //Último número de la lista en la página
    var $TotalNumeros;	 	 //Total de números de la lista
    var $ShowLeftFooter;	 //Opción para mostrar el pie de página izquierdo.
    var $ShowNumeralLeftFooter;	//Opción para mostrar el pie de página izquierdo (Numeral).
    var $Condicion;			//Opción para conocer que tipo de condición tiene un determinado formulario
    var $angle;             //Angulo
    var $generalConfigForAllColumns;    //Array multidimencional con todas las configuraciones necesarias para el despliegue de valores
    var $widthsSelecteds;       //Anchuras seleccionadas
    //var $colTitleSelecteds;     //Titulos de las columnas seleccionadas
    var $alignSelecteds;        //Alineaciones de la columnas seleccionadas
    var $columnasExcel=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE");
                                //Array con las letras de las columnas del archivo excel. Se calcula este numero máximo de columnas a usarse.
    var $ultimaLetraCabeceraTabla; //Ultima letra que coincide con la última columna del reporte.
    var $penultimaLetraCabeceraTabla; //penúltima letra que coincide con la última columna del reporte.
    var $numFilaCabeceraTabla;  //Número de fila que corresponde a la cabecera de la tabla del reporte.
    var $primeraLetraCabeceraTabla; //Primera letra que corresponde donde empieza la tabla del reporte.
    var $segundaLetraCabeceraTabla; //Segunda letra que corresponde donde empieza la tabla del reporte.
    var $celdaInicial;             //Representación de la celda donde empieza el reporte: [LETRA_COLUMNA][NUMERO_FILA]
    var $celdaFinal;            //Representación de la celda donde termina el reporte: [LETRA_COLUMNA][NUMERO_FILA]
    var $celdaFinalDiagonalTabla;//Celda final diagonal
    const ALINEACION='';


    /**
     * Función para establecer la cabecera del reporte.
     */
    function Header()
    {
        $this->getProperties()->setCreator("Javier Loza")
            ->setLastModifiedBy("Javier Loza")
            ->setTitle("Reporte exportado en formato Excel")
            ->setSubject("Reporte exportado en formato Excel")
            ->setDescription("documento para la exportacion de Office 2007 XLSX, generado usando clases PHP.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Archivo resultado");


        // Creación de la primera página
        $this->setActiveSheetIndex(0);

        $this->getActiveSheet()->setCellValue('B1', 'Estado Plurinacional de Bolivia');
        $this->getActiveSheet()->setCellValue('B2', 'Empresa Estatal de Transporte Por Cable "Mi Teleférico"');
        $this->getActiveSheet()->setCellValue('B3', 'Reporte Relación Laboral');
        //$this->getActiveSheet()->setCellValue('D1', PHPExcel_Shared_Date::PHPToExcel( gmmktime(0,0,0,date('m'),date('d'),date('Y')) ));
        //$this->getActiveSheet()->getStyle('D1')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX15);
        //$this->getActiveSheet()->setCellValue('E1', '#12566');
        $this->getActiveSheet()->getStyle('B1:B3')->getFont()->setName('Arial');
        $this->getActiveSheet()->getStyle('B1')->getFont()->setSize(14);
        $this->getActiveSheet()->getStyle('B2:B3')->getFont()->setSize(12);
        $this->getActiveSheet()->getStyle('B1:B3')->getFont()->setBold(true);
        $this->getActiveSheet()->getStyle('B1:B3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUEMITELEFERICO);

        #region Combinación de celdas para la cabecera (3 primeras filas)
        $this->getActiveSheet()->mergeCells($this->segundaLetraCabeceraTabla.'1:'.$this->penultimaLetraCabeceraTabla.'1');
        $this->getActiveSheet()->mergeCells($this->segundaLetraCabeceraTabla.'2:'.$this->penultimaLetraCabeceraTabla.'2');
        $this->getActiveSheet()->mergeCells($this->segundaLetraCabeceraTabla.'3:'.$this->penultimaLetraCabeceraTabla.'3');
        #endregion Combinación de celdas para la cabecera (3 primeras filas)

        #region Centrando los dos líneas que corresponden a las cabeceras.
        $this->getActiveSheet()->getStyle('B1:B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        #endregion Centrando los dos líneas que corresponden a las cabeceras.

        #region Estableciendo el lugar de los logotipos (Imágenes)
        // Add a drawing to the worksheet
        //echo date('H:i:s') , " Add a drawing to the worksheet" , EOL;
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Escudo');
        $objDrawing->setDescription('Escudo de Bolivia');
        $objDrawing->setPath('./images/escudo.jpg');
        $objDrawing->setOffsetX(5);
        $objDrawing->setHeight(50);
        $objDrawing->setWorksheet($this->getActiveSheet());

        // Add a drawing to the worksheet
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo Mi Teleferico');
        $objDrawing->setPath('./images/logoMT.jpg');
        $objDrawing->setCoordinates($this->ultimaLetraCabeceraTabla.'1');
        $objDrawing->setOffsetX(5);
        $objDrawing->setHeight(50);
        $objDrawing->setWorksheet($this->getActiveSheet());
        #endregion Estableciendo el lugar de los logotipos (Imágenes)

        #region para el establecimiento de las cabeceras y pie de páginas del documento
        $this->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BReporte Relación laboral&RImpreso el &D');
        $this->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $this->getProperties()->getTitle() . '&RPagina &P de &N');
        #endregion para el establecimiento de las cabeceras y pie de páginas del documento

        // Nombrando la primera pestaña
        $this->getActiveSheet()->setTitle('Reporte');
    }

    /**
     * Función para establecer la orientación del documento.
     * @param $orientation
     */
    public function defineOrientation($orientation){

        switch($orientation){
            case 'H':$this->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);break;
            case 'V':$this->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);break;
            default:$this->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_DEFAULT);break;
        }
    }

    /**
     * Función para definir el tamaño del documento
     * @param $size
     */
    public function defineSize($size){

        switch($size){
            case 'C':$this->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);break;
            case 'O':$this->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);break;
            default:$this->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_A4);break;
        }
    }
    /**
     * Función para definir el borde por grupo de datos
     * @param $celdaInicial
     * @param $celdaFinalDiagonalTabla
     * @throws PHPExcel_Exception
     */
    public function borderGroup($celdaInicial,$celdaFinalDiagonalTabla){
        $styleThinBlackBorderOutline = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '4F81BD'),
                ),
            ),
        );
        $this->getActiveSheet()->getStyle($celdaInicial.':'.$celdaFinalDiagonalTabla)->applyFromArray($styleThinBlackBorderOutline);
    }

    /**
     * Función para crear una hoja adicional al establecido
     * @throws PHPExcel_Exception
     */
    public function secondPage()
    {

        // Creando una nueva página en la cual se establece recomendaciones
        $this->createSheet();

        $recomendaciones = 'El documento que acaba de exportar tiene información importante.';

        $this->setActiveSheetIndex(1);
        $this->getActiveSheet()->setCellValue('A1', 'Recomendaciones');
        $this->getActiveSheet()->setCellValue('A3', $recomendaciones);

        $this->getActiveSheet()->getTabColor()->setARGB('FF0094FF');;

    }
    /**
     * Función para el despliegue de un registro correspondiente.
     * @param $data Array con el listado de datos a desplegarse.
     * @param $alignSelecteds Array con el listado de alineaciones correspondientes por columna.
     * @param $formatTypes Array con el listado de typos de datos que se almacenan en cada columna.
     * @param $fila Número de fila
     */
    function Row($data,$alignSelecteds,$formatTypes,$fila)
    {
        for($i=0;$i<=count($data);$i++){
            if(isset($data[$i])&&isset($this->columnasExcel[$i])){
                $dato = $data[$i];
                /*if($formatTypes[$i]=='date'){
                    $dato = str_replace("-","/",$dato);
                }*/
                $this->getActiveSheet()->setCellValue($this->columnasExcel[$i].$fila, $dato);
                switch($alignSelecteds[$i]){
                    case 'C':
                        $this->getActiveSheet()->getStyle($this->columnasExcel[$i].$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        break;
                    case 'R':
                        $this->getActiveSheet()->getStyle($this->columnasExcel[$i].$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                        break;
                    case 'L':
                        $this->getActiveSheet()->getStyle($this->columnasExcel[$i].$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                        break;
                    case 'J':
                        $this->getActiveSheet()->getStyle($this->columnasExcel[$i].$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
                        break;
                }
                switch($formatTypes[$i]){
                    case 'int4':
                        $this->getActiveSheet()->getStyle($this->columnasExcel[$i].$fila)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
                        break;
                    case 'varchar':
                    case 'bpchar':
                        $this->getActiveSheet()->getStyle($this->columnasExcel[$i].$fila)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                        break;
                    case 'date':
                        $this->getActiveSheet()->getStyle($this->columnasExcel[$i].$fila)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
                        break;
                }

            }
        }
    }

    /**
     * Función para el despliegue de la fila con un agrupador
     * @param $data
     * @param $fila
     * @throws PHPExcel_Exception
     */
    function Agrupador($data,&$fila)
    {   if(count($data)>0){

        for($i=0;$i<count($data);$i++){
            if(isset($data[$i])&&isset($this->columnasExcel[$i])){
                if($this->debug==1){
                    echo "<p>>".$i." con valor--->".$data[$i];
                }
                $this->getActiveSheet()->setCellValue('A'.$fila, $data[$i]);
                $this->getActiveSheet()->mergeCells('A'.$fila.':'.$this->ultimaLetraCabeceraTabla.$fila);
                $this->getActiveSheet()->getStyle('A'.$fila.':'.$this->ultimaLetraCabeceraTabla.$fila)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUEMITELEFERICO);
                #region Definiendo el estilo de la celda de cabecera del reporte
                $this->getActiveSheet()->getStyle('A'.$fila.':'.$this->ultimaLetraCabeceraTabla.$fila)->applyFromArray(
                    array(
                        'font'    => array(
                            'bold'      => true
                        ),
                        'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                        ),
                        'borders' => array(
                            'top'     => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN
                            )
                        ),
                        'fill' => array(
                            'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                            'rotation'   => 90,
                            'startcolor' => array(
                                'argb' => '4F81BD'
                            ),
                            'endcolor'   => array(
                                'argb' => '4F81BD'
                            )
                        )
                    )
                );
                $this->getActiveSheet()->getStyle('A'.$fila.':'.$this->ultimaLetraCabeceraTabla.$fila)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
                #endregion Definiendo el estilo de la celda de cabecera del reporte
            }else{
                if($this->debug==1){
                    echo "<p>>".$i." sin valor--->".$data[$i];
                }

                    $this->getActiveSheet()->setCellValue('A'.$fila, '');
                    $this->getActiveSheet()->mergeCells('A'.$fila.':'.$this->ultimaLetraCabeceraTabla.$fila);
                    $this->getActiveSheet()->getStyle('A'.$fila.':'.$this->ultimaLetraCabeceraTabla.$fila)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUEMITELEFERICO);
                    #region Definiendo el estilo de la celda de cabecera del reporte
                    $this->getActiveSheet()->getStyle('A'.$fila.':'.$this->ultimaLetraCabeceraTabla.$fila)->applyFromArray(
                        array(
                            'font'    => array(
                                'bold'      => true
                            ),
                            'alignment' => array(
                                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                            ),
                            'borders' => array(
                                'top'     => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN
                                )
                            ),
                            'fill' => array(
                                'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                                'rotation'   => 90,
                                'startcolor' => array(
                                    'argb' => '4F81BD'
                                ),
                                'endcolor'   => array(
                                    'argb' => '4F81BD'
                                )
                            )
                        )
                    );
                    $this->getActiveSheet()->getStyle('A'.$fila.':'.$this->ultimaLetraCabeceraTabla.$fila)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
                    #endregion Definiendo el estilo de la celda de cabecera del reporte



            }
            $fila++;
        }
       }
    }
    /**
     * Función para definir la fila de títulos de la tabla
     * @param array $data
     * @version 17-02-2012
     */
    function RowTitle($colTitleSelecteds,&$fila)
    {

        for($i=0;$i<=count($colTitleSelecteds);$i++){
            if(isset($colTitleSelecteds[$i])&&isset($this->columnasExcel[$i]))
                $this->getActiveSheet()->setCellValue($this->columnasExcel[$i].$fila, $colTitleSelecteds[$i]);
            $this->getActiveSheet()->getStyle('A'.$fila.':'.$this->ultimaLetraCabeceraTabla.$fila)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUEMITELEFERICO);
            #region Definiendo el estilo de la celda de cabecera del reporte
            $this->getActiveSheet()->getStyle('A'.$fila.':'.$this->ultimaLetraCabeceraTabla.$fila)->applyFromArray(
                array(
                    'font'    => array(
                        'bold'      => true
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    ),
                    'borders' => array(
                        'top'     => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    ),
                    'fill' => array(
                        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                        'rotation'   => 90,
                        'startcolor' => array(
                            'argb' => '4F81BD'
                        ),
                        'endcolor'   => array(
                            'argb' => '4F81BD'
                        )
                    )
                )
            );
            $this->getActiveSheet()->getStyle('A'.$fila.':'.$this->ultimaLetraCabeceraTabla.$fila)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
            #endregion Definiendo el estilo de la celda de cabecera del reporte
        }
        $fila++;
    }
    #region nuevas funciones
    function tablaHorizontal($cabeceraHorizontal, $datosHorizontal)
    {
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
    }

    /**
     * Función para definir las columnas a mostrarse.
     * @param $widthAlignAll
     * @param $columns
     * @return array
     */
    function DefineCols($widthAlignAll,$columns,$exclude=array()){
        $arrRes = Array();
        $arrRes[]="nro_row";
        foreach($columns as $key => $val){
            if(isset($widthAlignAll[$key])){
                if(!isset($val['hidden'])||$val['hidden']!=true){
                    if(!in_array($key,$exclude)||count($exclude)==0)
                        $arrRes[]=$key;
                }
            }
        }
        return $arrRes;
    }

    /*
     * Función para la definición de los contenidos de la cabecera.
     * @param $widthAlignAll
     * @param $columns
     * @return array
     */
    function DefineTitleCols($widthAlignAll,$columns,$exclude=array()){
        $arrRes = Array();
        $arrRes[]="Nro.";
        foreach($columns as $key => $val){
            if(isset($widthAlignAll[$key])){
                if(!isset($val['hidden'])||$val['hidden']!=true){
                    if(!in_array($key,$exclude)||count($exclude)==0){
                        $arrRes[]=$widthAlignAll[$key]['title'];
                    }
                }
            }
        }
        return $arrRes;
    }

    /**
     * Función para definir el tipo de datos para cada columna
     * @param $widthAlignAll
     * @param $columns
     * @param array $exclude
     * @return array
     */
    function DefineTypeCols($widthAlignAll,$columns,$exclude=array()){
        $arrRes = Array();
        $arrRes[]="int4";
        foreach($columns as $key => $val){
            if(isset($widthAlignAll[$key])){
                if(!isset($val['hidden'])||$val['hidden']!=true){
                    if(!in_array($key,$exclude)||count($exclude)==0){
                        $arrRes[]=$widthAlignAll[$key]['type'];
                    }
                }
            }
        }
        return $arrRes;
    }

    /**
     * Función para definir las columnas a mostrarse, de acuerdo a que hayan sido designados para un grupo en particular, en ese caso no se los considera.
     * @param $widthAlignAll
     * @param $dondeCambio
     * @param $queCambio
     * @return array
     */
    function DefineTitleColsByGroups($widthAlignAll,$dondeCambio,$queCambio){
        $arrRes = Array();
        foreach($dondeCambio as $val){
            if(isset($widthAlignAll[$val]['title'])){
                $arrRes[]=$queCambio[$val];
            }
        }

        return $arrRes;
    }

    /**
     * Función para la definición de las alignaciones de las cabeceras de la tabla.
     * @param $numCols
     * @return array
     */
    function DefineTitleAligns($numCols){
        $arrRes = Array();
        for($i=0;$i<=$numCols;$i++){
            $arrRes[]="C";
        }
        return $arrRes;
    }
    /**
     * Función para definir el contenido de la fila a mostrarse.
     * @param int $numRow
     * @param $rowRelaboral
     * @param $colSelecteds
     * @return array
     */
    function DefineRows($numRow=0,$rowRelaboral,$colSelecteds){
        $arrRes = Array();
        $arrRes[]=$numRow;
        foreach($colSelecteds as $val){
            if (array_key_exists($val, $rowRelaboral)) {
                $arrRes[] = $rowRelaboral[$val];
            }
        }
        return $arrRes;
    }
    /*
     * Función para la generación del array con las alineaciones de columna en el cuerpo de la tabla.
     * @param $generalWiths Array de los anchos y alineaciones de columnas disponibles.
     * @param $columns Array de las columnas con las propiedades de oculto (hidden:1) y visible (hidden:null).
     * @return array Array con el listado de alineaciones a desplegarse.
     */
    function DefineAligns($widthAlignAll,$columns,$exclude=array()){
        $arrRes = Array();
        $arrRes[]='C';
        foreach($columns as $key => $val){
            if(isset($widthAlignAll[$key])){
                if(!isset($val['hidden'])||$val['hidden']!=true){
                    if(!in_array($key,$exclude)||count($exclude)==0)
                        $arrRes[]=$widthAlignAll[$key]['align'];
                }
            }
        }
        return $arrRes;
    }

    /**
     * Función para establecer los valores por defecto (Vacios) para los grupos seleccionados.
     * @param $groups
     * @return array
     */
    function DefineDefaultValuesForGroups($groups){
        $arrRes = Array();
        if($groups!=""){
            $gr = explode(",",$groups);
            if(count($gr)>0){
                foreach($gr as $val){
                    $arrRes[$val]=array("valor"=>"");
                }
            }
        }
        return $arrRes;
    }
    /**
     * Función para la obtención del listado de columnas a mostrarse descontando los que se han solicitado en agrupador.
     * @param $colTitleSelecteds
     * @param $agrupadores
     * @return array
     */
    function defineListadoSinColumnasEnAgrupador($colTitleSelecteds,$agrupadores){
        $arrRes = Array();
        if(count($colTitleSelecteds)>0&&count($agrupadores)>0) {
            foreach($colTitleSelecteds as $val){
                if(!in_array($val,$agrupadores)){
                    $arrRes[]=$val;
                }
            }
        }else $arrRes =$colTitleSelecteds;

        return $arrRes;
    }

    /**
     * Función para el despliegue del reporte.
     * @param $nombreArchivo
     * @param $alineacion
     */
    function display($nombreArchivo,$alineacion){
        $callStartTime = microtime(true);
        $objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel2007');
        //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        //$objWriter->save(str_replace('.php', '.xlsx', $nombreArchivo));
        $objWriter->save($nombreArchivo);
        $callEndTime = microtime(true);
        $callTime = $callEndTime - $callStartTime;
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="reporte_excel.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
    #endregion nuevas funciones
}