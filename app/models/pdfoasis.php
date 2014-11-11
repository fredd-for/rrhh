<?php
class pdfoasis extends fpdf{
    public $title_rpt = "Reporte";
    public $style_header_table = "";
    public $style_footer_table = "";
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

    function Header()
    {
        // Logo
        $this->Image('../public/images/logoMT.jpg',10,8,20,20);
        // Arial bold 12
        $this->SetFont('Arial','B',10);
        $w = $this->GetStringWidth($this->title_rpt)+6;
        $this->SetX((190-$w)/2);
        //$this->SetDrawColor(0,80,80);
        $this->SetDrawColor(247,249,251);
        //$this->SetFillColor(0,153,153);
        //$this->SetFillColor(28,141,247);
        $this->SetFillColor(247,249,251);
        $this->SetTextColor(28,141,247);
        // Ancho del borde (1 mm)
        //$this->SetLineWidth(0);
        // Título
        $this->Cell($w+15,9,$this->title_rpt,1,1,'C',true);
        $this->Ln();
        $this->SetFont('Arial','',10);
        // Color de fondo
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0);
        // Título
        //$this->Cell(0,6,"Filtrado por:",0,1,'L',true);
    }
    function DefineColorHeaderTable(){
        $this->SetFont('Arial', 'B', 8);
        $this->SetDrawColor(28,141,247);
        $this->SetFillColor(2,157,116);//Fondo verde de celda
        $this->SetTextColor(53,182,74);//Letras verdes
        $this->SetLineWidth(.3);
    }
    function DefineColorBodyTable(){
        $this->SetFont('Arial', '', 7);
        $this->SetDrawColor(0,0,0);
        $this->SetFillColor(255,255,255);//Fondo blanco
        $this->SetTextColor(0,0,0);//Letras negras
    }
// Pie de página
    function Footer()
    {
        //Posici�n: a 1,5 cm del final
        $this->SetY(-15);

        //Arial italic 8
        $this->SetTextColor(0);
        $this->SetFont('Arial','I',8);
        //N�mero de p�gina
        $this->Cell(0,10,' Pagina '.$this->PageNo().' de {nb}'.$this->AliasNbPages(),0,0,'C');
        $this->SetY(-15);
        $this->SetX(-50);
        //Arial italic 8
        $this->SetTextColor(0);
        $this->SetFont('Arial','I',8);
        //N�mero de p�gina
        //$this->Cell(0,10,"Reporte al ".date("d-m-Y h:i:s"),0,0,'C');
        /*if($this->FechaHoraReporte!="")$this->Cell(0,10,"Reporte al ".$this->FechaHoraReporte,0,0,'C');
        if($this->FechaHoraCreacion!=""){
            $this->SetY(-15);
            $this->SetX(-55);
            $this->Cell(0,1,"Creado el ".$this->FechaHoraCreacion,0,0,'C');
        }*/
        //if($this->ShowLeftFooter==true)$this->DatesLeftFooter();
        //elseif($this->ShowNumeralLeftFooter==true)$this->NumeralLeftFooter();
        $this->DatesFooter();
    }
    /**
     * Funci�n para desplegar en el pie del documento la fecha de despliegue.
     */
    function DatesFooter()
    {	$this->SetY(-15);
        $this->SetX(-50);
        //Arial italic 8
        $this->SetTextColor(0);
        $this->SetFont('Arial','I',8);
        //N�mero de p�gina
        if($this->FechaHoraReporte!="")$this->Cell(0,10,"Reporte al ".$this->FechaHoraReporte,0,0,'C');
        if($this->FechaHoraCreacion!=""){
            $this->SetY(-15);
            $this->SetX(-50);
            $this->Cell(0,1,"Creado el ".$this->FechaHoraCreacion,0,0,'C');
        }
        //$this->Cell(0,10,"Reporte al ".date("d-m-Y h:i:s"),0,0,'C');
    }
    /*function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'C');
    }*/


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
            $this->MultiCell($w, 5, $data[$i], 0, $a);
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
    #endregion nuevas funciones


}