<?php
class pdfoasis extends fpdf{
    public $title_rpt = "Reporte";
    public $style_header_table = "";
    public $style_footer_table = "";
    var $debug;
    var $widths;
    var $aligns;
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
    var $angle;
    var $widthAlignAll;
    var $widthsSelecteds;
    var $colTitleSelecteds;
    var $alignSelecteds;

    /**
     * Función para establecer la cabecera del reporte.
     */
    function Header()
    {   $this->Image('../public/images/logoMT.jpg',10,8,20,20);
        $this->SetFont('Arial','B',10);
        $w = $this->GetStringWidth($this->title_rpt)+6;
        $this->SetX((190-$w)/2);
        $this->SetDrawColor(247,249,251);
        $this->SetFillColor(247,249,251);
        $this->SetTextColor(28,141,247);
        $this->Cell($w+15,9,$this->title_rpt,1,1,'C',true);
        $this->Ln();
        $this->SetFont('Arial','',10);
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0);
        /**
         * Añadido
         */
        $this->SetY(30);
        $this->SetWidths($this->widthsSelecteds);
        $this->DefineColorHeaderTable();
        $this->SetAligns($this->alignTitleSelecteds);
        $this->RowTitle($this->colTitleSelecteds);
    }
    /**
     * Función para definir el color de las celdas en la cabecera de la tabla.
     */
    function DefineColorHeaderTable(){
        $this->SetFont('Arial', 'B', 8);
        $this->SetDrawColor(0);
        $this->SetFillColor(2,157,116);//Fondo verde de celda
        $this->SetTextColor(255,255,255);//Letras verdes
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
    function Row($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h=5*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
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
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w, $y);
        }
        //Go to the next line
        $this->Ln($h);
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
            $this->MultiCell($w, 5, $data[$i], 0, $a,true);
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
            $this->AddPage($this->CurOrientation);
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
        $this->SetXY(10, 10);
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
        $this->SetXY(10,17);
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
    function DefineCols($widthAlignAll,$columns){
        $arrRes = Array();
        $arrRes[]="nro_row";
        foreach($columns as $key => $val){
            if(isset($widthAlignAll[$key])){
                if(!isset($val['hidden'])||$val['hidden']!=true){
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
    function DefineTitleCols($widthAlignAll,$columns){
        $arrRes = Array();
        $arrRes[]="Nro.";
        foreach($columns as $key => $val){
            if(isset($widthAlignAll[$key])){
                if(!isset($val['hidden'])||$val['hidden']!=true){
                    $arrRes[]=$widthAlignAll[$key]['title'];
                }
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
    /**
     * Función para la generación del array con los anchos de columna definido, en consideración a las columnas mostradas.
     * @param $generalWiths Array de los anchos y alineaciones de columnas disponibles.
     * @param $columns Array de las columnas con las propiedades de oculto (hidden:1) y visible (hidden:null).
     * @return array Array con el listado de anchos por columna a desplegarse.
     */
    function DefineWidths($widthAlignAll,$columns){
        $arrRes = Array();
        $arrRes[]=8;
        foreach($columns as $key => $val){
           if(isset($widthAlignAll[$key])){
               if(!isset($val['hidden'])||$val['hidden']!=true){
                 $arrRes[]=$widthAlignAll[$key]['width'];
               }
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
    function DefineAligns($widthAlignAll,$columns){
        $arrRes = Array();
        $arrRes[]='C';
        foreach($columns as $key => $val){
            if(isset($widthAlignAll[$key])){
                if(!isset($val['hidden'])||$val['hidden']!=true){
                    $arrRes[]=$widthAlignAll[$key]['align'];
                }
            }
        }
        return $arrRes;
    }
    #endregion nuevas funciones


}