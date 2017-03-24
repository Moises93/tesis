<?php
/**
 * User: Moises
 * Date: 23-03-2017
 * Time: 21:48
 */

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');

// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION,PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('facyt');
$pdf->SetTitle('Contsancia de Pasantia');
$pdf->SetSubject('Coordinacion de Pasantias');
$pdf->SetKeywords('Pasantia, Estudiante, Facyt');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_TOP,PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE,PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------

// set font
$pdf->SetFont('times','BI',20);

// add a page
$pdf->AddPage();
//print_r($info);

    $estudiante = $info['pas_nombre'];
       $apellido= $info['pas_apellido'];
    $empresa= $info['emp_nombre'];
    $uni= $info['orgaca'];
    $escuela= $info['esc_nombre'];
if($uni ==1){
    $uni='Universidad de Carabobo';
}
// set some text to print

$html = '';
$html .= "<style type=text/css>";
$html .= "th{color: #fff; font-weight: bold; background-color: #222}";
$html .= "td{background-color: #AAC7E3; color: #fff}";
$html .= "</style>";
$html .= "<h2>Bachiler:" . $estudiante . "</h2><h4>empresa: " .$empresa . "</h4>";
$html .= "<h2>escuela:" . $escuela . "</h2><h4>Universidad: " .$uni . "</h4>";
$html .= "<img src='".base_url()."/assets/img/menu.png'>";

$txt =<<<EOD
TCPDF Example 002

Default page header and footer are disabled using setPrintHeader() and setPrintFooter() methods.
EOD;

// print a block of text using Write()
//$pdf->Write(0,$txt,'',0,'C',true,0,false,false,0);
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
// ---------------------------------------------------------
ob_clean();
//Close and output PDF document
$pdf->Output('constancia'.$estudiante.'.pdf','I');

//============================================================+
// END OF FILE
//============================================================+