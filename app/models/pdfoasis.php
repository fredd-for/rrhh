<?php
/*
*   Oasis - Sistema de Gestión para Recursos Humanos
*   Empresa Estatal de Transporte por Cable "Mi Teleférico"
*   Versión:  1.0.0
*   Usuario Creador: Lic. Javier Loza
*   Fecha Creación:  01-12-2014
*/

class pdfoasis extends fpdf{
    public $title_rpt = '';
    public $header_title_estado_rpt = 'Estado Plurinacional de Bolivia';
    public $header_title_empresa_rpt = 'Empresa Estatal de Transporte por Cable "Mi Teleferico"';
    public $style_header_table = '';
    public $style_footer_table = '';
    var $debug;              //Valor de seguimiento 1: Hacer debug; 0: No hacer debug
    var $widths;             //Array de anchuras
    var $totalWidths;             //Array de anchuras
    var $aligns;             //Array de alineaciones
    var $totalAligns;             //Array de alineaciones
    var $pageWidth;          //Ancho de la hoja (Sea si esta vertical u horizontal)
    var $totalPageWidth;          //Ancho de la hoja (Sea si esta vertical u horizontal)
    var $tableWidth;         //Ancho de la tabla
    var $totalTableWidth;         //Ancho de la tabla
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
    var $totalWidthsSelecteds;  //Anchuras seleccionadas para la grilla de totales
    var $colTitleSelecteds;     //Titulos de las columnas seleccionadas
    var $totalColTitleSelecteds;  //Titulos de las columnas seleccionadas para la grilla de totales
    var $alignSelecteds;        //Alineaciones de la columnas seleccionadas
    var $totalAlignSelecteds;   //Alineaciones de la columnas seleccionadas para la grilla de totales


    /**
     * Función para establecer la cabecera del reporte.
     */
    function Header()
    {   $this->Image('../public/images/escudo.jpg',10,6,20,0);
        $x_segunda_imagen = $this->pageWidth-25;
        $this->Image('../public/images/logoMT.jpg',$x_segunda_imagen,6,15,0);
        $this->SetFont('Arial','B',10);
        $west = $this->GetStringWidth($this->header_title_estado_rpt)+6;
        $wemp = $this->GetStringWidth($this->header_title_empresa_rpt)+6;
        $this->SetX(($this->pageWidth-$west)/2);
        $this->SetDrawColor(247,249,251);
        $this->SetFillColor(247,249,251);
        $this->SetTextColor(79,129,189);
        $this->SetFont('Arial','',13);
        $this->Cell($west+15,5,$this->header_title_estado_rpt,1,1,'C');
        $this->SetX(($this->pageWidth-$wemp)/2);
        $this->SetFont('Arial','',9);
        $this->Cell($wemp+15,5,$this->header_title_empresa_rpt,1,1,'C');
        /**
         * Espacio para definir la línea en el encabezado
         */
        $this->SetFillColor(79,129,189);
        $this->SetLineWidth(1);
        $this->SetX(($this->pageWidth-$wemp)/2);
        $this->Cell($wemp+15,2,"",1,1,'C',1);

        if($this->title_rpt!=""){
            $w = $this->GetStringWidth($this->title_rpt)+6;
            $this->SetX(($this->pageWidth-$w)/2);
            $this->Cell($w+15,5,$this->title_rpt,1,1,'C');
        }

        $this->Ln();

        $this->SetFont('Arial','',10);
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0);
        /**
         * Añadido
         */
        $this->SetY(30);
        if(($this->pageWidth-$this->tableWidth)>0)$this->SetX(($this->pageWidth-$this->tableWidth)/2);
        $this->SetWidths($this->widthsSelecteds);
        $this->DefineColorHeaderTable();
        $this->SetAligns($this->alignTitleSelecteds);
        $this->RowTitle($this->colTitleSelecteds);
        if(($this->pageWidth-$this->tableWidth)>0)$this->SetX(($this->pageWidth-$this->tableWidth)/2);

    }
    function HeaderTotal()
    {   $this->Image('../public/images/escudo.jpg',10,6,20,0);
        $x_segunda_imagen = $this->pageWidth-25;
        $this->Image('../public/images/logoMT.jpg',$x_segunda_imagen,6,15,0);
        $this->SetFont('Arial','B',10);
        $west = $this->GetStringWidth($this->header_title_estado_rpt)+6;
        $wemp = $this->GetStringWidth($this->header_title_empresa_rpt)+6;
        $this->SetX(($this->pageWidth-$west)/2);
        $this->SetDrawColor(247,249,251);
        $this->SetFillColor(247,249,251);
        $this->SetTextColor(79,129,189);
        $this->SetFont('Arial','',13);
        $this->Cell($west+15,5,$this->header_title_estado_rpt,1,1,'C');
        $this->SetX(($this->pageWidth-$wemp)/2);
        $this->SetFont('Arial','',9);
        $this->Cell($wemp+15,5,$this->header_title_empresa_rpt,1,1,'C');
        /**
         * Espacio para definir la línea en el encabezado
         */
        $this->SetFillColor(79,129,189);
        $this->SetLineWidth(1);
        $this->SetX(($this->pageWidth-$wemp)/2);
        $this->Cell($wemp+15,2,"",1,1,'C',1);

        if($this->title_total_rpt!=""){
            $w = $this->GetStringWidth($this->title_total_rpt)+6;
            $this->SetX(($this->pageWidth-$w)/2);
            $this->Cell($w+15,5,$this->title_total_rpt,1,1,'C');
        }

        $this->Ln();

        $this->SetFont('Arial','',10);
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0);
        /**
         * Añadido
         */
        $this->SetY(30);
    }
    /**
     * Función para definir el color de las celdas en la cabecera de la tabla.
     */
    function DefineColorHeaderTable(){
        $this->SetFont('Arial', 'B', 8);
        $this->SetDrawColor(0);
        $this->SetFillColor(52,152,219);//Fondo celeste
        $this->SetTextColor(255,255,255);//Letras blancas
        $this->SetLineWidth(.3);
    }
    /**
     * Función para definir el color de las celdas en el cuerpo de la tabla.
     */
    function DefineColorBodyTable(){
        $this->SetFont('Arial', '', 7);
        $this->SetDrawColor(0,0,0);
        $this->SetFillColor(255,255,255);//Fondo blanco
        $this->SetTextColor(0,0,0);//Letras negras
    }

    /*
     *  Función para definir el pie del reporte
     */
    function Footer()
    {
        //Posición: a 1,5 cm del final
        $this->SetY(-15);
        $this->SetTextColor(0);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,' Pagina '.$this->PageNo().' de {nb}'.$this->AliasNbPages(),0,0,'C');
        $this->SetY(-15);
        $this->SetX(-50);
        $this->SetTextColor(0);
        $this->DatesFooter();
    }
    /**
     * Función para desplegar en el pie del documento la fecha de despliegue.
     */
    function DatesFooter()
    {	$this->SetY(-15);
        $this->SetX(-50);
        //Arial italic 8
        $this->SetTextColor(0);
        $this->SetFont('Arial','I',8);
        //Numero de página
        if($this->FechaHoraReporte!="")
            $this->Cell(0,10,"Reporte al ".$this->FechaHoraReporte,0,0,'C');
        if($this->FechaHoraCreacion!=""){
            $this->SetY(-15);
            $this->SetX(-50);
            $this->Cell(0,1,"Creado el ".$this->FechaHoraCreacion,0,0,'C');
        }
        //$this->Cell(0,10,"Reporte al ".date("d-m-Y h:i:s"),0,0,'C');
    }
    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    function fill($f)
    {
        //juego de arreglos de relleno
        $this->fill=$f;
    }

    /**
     * Función para el despliegue del registro dentro del cuerpo de la grilla principal.
     * @param $data
     * @return mixed
     */
    function Row($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h=5*$nb;
        //Se verifica que se ha añadido una nueva página, por lo cual se ha establecido la cabecera con un
        //conjunto de alineaciones de cabecerá que hay que reestablecer para el cuerpo de la grilla.
        $ok = $this->CheckPageBreak($h);
        if($ok){
            $this->aligns=$this->alignSelecteds;
        }
        $aligns = $this->aligns;
        //Trazando la celda de la fila
        for($i=0;$i<count($data);$i++)
        {   $w=$this->widths[$i];
            $a=isset($aligns[$i]) ? $aligns[$i] : 'L';
            //Guardando la posición actual
            $x=$this->GetX();
            $y=$this->GetY();
            //Trazando el borde
            $this->Rect($x, $y, $w, $h);
            //Imprimiendo el texto
            $this->MultiCell($w, 5, utf8_decode($data[$i]), 0, $a);
            //Ubicando la posición de la linea derecha de la celda
            $this->SetXY($x+$w, $y);
        }
        //Saltando a la siguiente línea
        $this->Ln($h);
        return $w;
    }

    /**
     * Función para el despliegue del registro dentro del cuerpo de la grilla de totales
     * @param $data
     * @return mixed
     */
    function RowTotal($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb, $this->NbLines($this->totalWidths[$i], $data[$i]));
        $h=5*$nb;
        $this->DefineColorBodyTable();
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        if(($this->pageWidth-$this->totalTableWidth)>0)$this->SetX(($this->pageWidth-$this->totalTableWidth)/2);
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->totalWidths[$i];
            $a=isset($this->totalAligns[$i]) ? $this->totalAligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 5, utf8_decode($data[$i]), 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w, $y);
        }
        //Go to the next line
        $this->Ln($h);
        return $w;
    }
    function Agrupador($data)
    {   if(count($data)>0){
            $ancho = 0;
            foreach($this->widthsSelecteds as $w){
                $ancho  =$ancho+   $w;
            }
            $nb=0;
            for($i=0;$i<count($data);$i++)
                $nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
            $h=5*$nb;
            //Issue a page break first if needed
            $this->CheckPageBreak($h);
            for($i=0;$i<count($data);$i++)
            {   if(($this->pageWidth-$this->tableWidth)>0)$this->SetX(($this->pageWidth-$this->tableWidth)/2);
                $this->Cell($ancho,5,$data[$i],1,1,'L',true);
            }
        }

        //Go to the next line
        //$this->Ln($h);
    }
    /**
     * Función para definir la fila de títulos de la tabla
     * @param array $data
     * @version 17-02-2012
     */
    function RowTitle($data,$sw=0)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h=5*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        if(($this->pageWidth-$this->tableWidth)>0)$this->SetX(($this->pageWidth-$this->tableWidth)/2);
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 5, utf8_decode($data[$i]), 0, $a,true);
            //Put the position to the right of the cell
            $this->SetXY($x+$w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    /**
     * Función para mostrar la primera fila cabecera de la grilla de totales.
     * @param $data
     * @param int $sw
     */
    function RowTotalTitle($data,$sw=0)
    {
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb, $this->NbLines($this->totalWidths[$i], $data[$i]));
        $h=5*$nb;
        $this->DefineColorHeaderTable();
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        if(($this->pageWidth-$this->totalTableWidth)>0)$this->SetX(($this->pageWidth-$this->totalTableWidth)/2);
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->totalWidths[$i];
            //$a=isset($this->totalAlignSelecteds[$i]) ? $this->totalAlignSelecteds[$i] : 'L';
            $a='C';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 5, utf8_decode($data[$i]), 0, $a,true);
            //Put the position to the right of the cell
            $this->SetXY($x+$w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }
    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
        {$this->AddPage($this->CurOrientation);
            return true;
        } return false;
    }

    function NbLines($w,$txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }
    #region nuevas funciones
    function cabeceraHorizontal($cabecera)
    {
        $this->SetXY(10, 40);
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(2,157,116);//Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro true rellena la celda con el color elegido
            $this->Cell(24,7, utf8_decode($fila),1, 0 , 'L', true);
        }
    }

    function datosHorizontal($datos)
    {
        $this->SetXY(10,47);
        $this->SetFont('Arial','',10);
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //El parámetro badera dentro de Cell: true o false
            //true: Llena  la celda con el fondo elegido
            //false: No rellena la celda
            $this->Cell(24,7, utf8_decode($fila['nombre']),1, 0 , 'L', $bandera );
            $this->Cell(24,7, utf8_decode($fila['apellido']),1, 0 , 'L', $bandera );
            $this->Cell(24,7, utf8_decode($fila['matricula']),1, 0 , 'L', $bandera );
            $this->Ln();//Salto de línea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
    }

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
    /**
     * Función para obtener las columnas establecidas para el cálculo de totales y seleccionadas para aparecer.
     * @param $generalConfigForAllColumns
     * @param $columns
     * @param array $exclude
     * @return array
     */
    function DefineSelectedTotalColsWithExclude($widthAlignAll,$columns,$exclude=array()){
        $arrRes = Array();
        foreach($columns as $key => $val){
            if(isset($widthAlignAll[$key])){
                if((!isset($val['hidden'])||$val['hidden']!=true)&&$widthAlignAll[$key]["totales"]===true){
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
     * Función para definir las columnas a considerarse dentro de la grilla de totales
     * @param $widthAlignAll
     * @param $columns
     * @param array $exclude
     * @return array
     */
    function DefineTotalTitleCols($widthAlignAll,$totalCols){
        $arrRes = Array();
        foreach($totalCols as $key => $val){
            if(array_key_exists($val,$widthAlignAll)){
                $arrRes[]=$widthAlignAll[$val]['title'];
            }
        }
        return $arrRes;
    }
    /**
     * Función para la obtención de la fila que contiene los totales
     * @param $colSelecteds
     * @param $colTotalSelecteds
     * @param $arrTodosTotales
     * @return array
     */
    public function generaFilaTotales($colSelecteds,$colTotalSelecteds,$arrTodosTotales){
        $arrTotales = array();
        $sw = 0;
        $clave = -1;
        if(count($colSelecteds)>0&&count($colTotalSelecteds)>0){
            foreach($colSelecteds as $val){
                if(in_array($val,$colTotalSelecteds)){
                    //echo "$val<------>".$colTotalSelecteds[$val]."&&".in_array($val,$colTotalSelecteds);
                    $arrTotales [] = $arrTodosTotales[$val];
                    $sw=1;
                }else{
                    $arrTotales [] = '';
                }
                if($sw==0){
                    $clave++;
                }
            }
            if($sw==1){
                if($clave>=0){
                    $arrTotales[$clave]="Totales:";
                }
            }else{
                $arrTotales = array();
            }
        }
        return $arrTotales;
    }
    /**
     * Función para conocer el listado de columnas para el resumen de totales
     * @param $generalConfigForAllColumns
     * @return array
     */
    function DefineSelectedTotalCols($generalConfigForAllColumns){
        $arrRes = Array();
        $arrRes[]="nro_row";
        foreach($generalConfigForAllColumns as $key => $val){
            if($val['totales']===true){
                $arrRes[]=$key;
            }
        }
        return $arrRes;
    }
    /**
     * Función para definir el listado de columnas para mostrarse, considerando que se estén usando agrupadores
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
     * Función para la obtención del listado de alineaciones de los campos considerados dentro de la grilla de totales.
     * @param $widthAlignAll
     * @param $totalCols
     * @return array
     */
    function DefineAlignsForTotals($widthAlignAll,$totalCols){
        $arrRes = Array();
        foreach($totalCols as $key => $val){
            if(array_key_exists($val,$widthAlignAll)){
                $arrRes[]=$widthAlignAll[$val]['align'];
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
    #endregion nuevas funciones
    /*
     * Función para obtener la cantidad de veces que se considera una misma columna en el filtrado.
     * @param $columna
     * @param $array
     * @return int
     */
    function obtieneCantidadVecesConsideracionPorColumnaEnFiltros($columna, $array)
    {
        $cont = 0;
        if (count($array) >= 1) {
            foreach ($array as $key => $val) {
                if (in_array($columna, $val)) {
                    $cont++;
                }
            }
        }
        return $cont;
    }

    /**
     * Función para la obtención de los valores considerados en el filtro enviado.
     * @param $columna Nombre de la columna
     * @param $array Array con los registro de busquedas.
     * @return array Array con los valores considerados en el filtrado enviado.
     */
    function obtieneValoresConsideradosPorColumnaEnFiltros($columna, $array)
    {
        $arr_col = array();
        $cont = 0;
        if (count($array) >= 1) {
            foreach ($array as $key => $val) {
                if (in_array($columna, $val)) {
                    $arr_col[] = $val["valor"];
                }
            }
        }
        return $arr_col;
    }

    /**
     * Función para la agregación de la grilla correspondiente a los totales del reporte.
     * @param array $arrListado
     * @param int $totalAtrasos
     * @param int $totalFaltas
     * @param int $totalAbandono
     * @param int $totalOmision
     * @param int $totalLsgh
     * @param int $totalCompensacion
     */
    function agregarPaginaTotales($arrListado=array(),$totalAtrasos=0,$totalFaltas=0,$totalAbandono=0,$totalOmision=0,$totalLsgh=0,$totalAgrupador=0,$totalCompensacion=0){
        $this->AddTotalPage();
        $this->RowTotalTitle($this->totalColTitleSelecteds);
        $cc=0;
                foreach ($arrListado as $clave2=>$valor2) {
                    foreach ($valor2 as $clave1 => $valor1) {
                        foreach ($valor1 as $clave => $valor) {
                            $cc++;
                            $arrMostrable=array($cc,$valor["nombres"],$valor["ci"],$valor["expd"],$valor["gerencia_administrativa"],$valor["departamento_administrativo"],$valor["area"],$valor["cargo"],str_replace(".00","",$valor["sueldo"]),$valor["gestion"],$valor["mes_nombre"],$valor["atrasos"],$valor["faltas"],$valor["abandono"],$valor["omision"],$valor["lsgh"],$valor["agrupador"]);
                            $this->RowTotal($arrMostrable);
                        }
                    }
                }
                if($cc>0){
                    $this->DefineColorHeaderTable();
                    $arrMostrable=array("","","","","","","","","","","Totales:",$totalAtrasos,$totalFaltas,$totalAbandono,$totalOmision,$totalLsgh,$totalAgrupador);
                    $this->RowTotal($arrMostrable);
                }
    }
}