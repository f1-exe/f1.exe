<?php
// (c) Xavier Nicolay
// Exemple de g�n�ration de devis/facture PDF
include '../funciones_admin/funciones.php';

//encabezado de cotizacion
$row  = listarEncabezadoCotizacionPorId($_GET["id"]);
//detalle de cotizacion
$detalleCotizacion =  listarDetalleCotizacion($_GET["id"]);

//datos del cliente
$row_cliente = listarClientesPorId($row["cliente"]);

require('f1puntoexe.php');

//transformaciones
$boleta = "";

if($row["boleta"] == 0){
    $boleta = 'Si';
}else{
    $boleta = 'No';
}

$pdf = new PDF_F1PUNTOEXE( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->Logo('f1.png');
$pdf->addSociete( $row["prestador_servicio"],
                  "Email: contacto@f1puntoexe.cl\n" .
                  "Tel: +56 9 75144189\n".
                  "Web: www.f1puntoexe.cl\n");
$pdf->fact_dev(utf8_decode("Cotizacion N° ".$row["id"]));
$pdf->temporaire( "F1.EXE" );
$pdf->addDate(date("d-m-Y"));
$pdf->addClient("CL0".$row["cliente"]);
$pdf->addPageNumber("1");
$pdf->addClientAdresse("Sres.\n".$row_cliente["nombre_cliente"]."\n"."Email: ".$row_cliente["email_cliente"]."\n"."Tel: ".$row_cliente["telefono_cliente"]."");
$pdf->addReglement($boleta);
$pdf->addEcheance("17/06/2019");
$pdf->addNumTVA(utf8_decode(getNombreProyecto($row["id_proyecto"])));
$pdf->addReference("Devis ... du ....");
$cols=array( "ITEM"    => 18,
             "FUNCIONALIDAD"  => 42,
             "DESCRIPCION"     => 110,
             "VALOR"      => 20);
$pdf->addCols( $cols);
$cols=array( "ITEM"    => "L",
             "FUNCIONALIDAD"  => "L",
             "DESCRIPCION"     => "L",
             "VALOR"      => "C");
$pdf->addLineFormat($cols);
$pdf->addLineFormat($cols);

$y    = 109;

while($row_detalle =  mysqli_fetch_array($detalleCotizacion)){

    $line = array( "ITEM"    => "REF".$row_detalle["num_funcionalidad"],
               "FUNCIONALIDAD"  => utf8_decode($row_detalle["funcionalidad"]) ,
               "DESCRIPCION"     => utf8_decode($row_detalle["descripcion"]),
               "VALOR"      => "$".$row_detalle["valor"]);
	$size = $pdf->addLine( $y, $line );
	$y   += $size + 5;
  
}

	
	
	
// $pdf->addCadreTVAs();
        
// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte

// $tot_prods = array( array ( "px_unit" => 600, "qte" => 1, "tva" => 1 ),
//                     array ( "px_unit" =>  10, "qte" => 1, "tva" => 1 ));
// $tab_tva = array( "1"       => 19.6,
//                   "2"       => 5.5);
// $params  = array( "RemiseGlobale" => 1,
//                       "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
//                       "remise"         => 0,       // {montant de la remise}
//                       "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
//                   "FraisPort"     => 1,
//                       "portTTC"        => 10,      // montant des frais de ports TTC
//                                                    // par defaut la TVA = 19.6 %
//                       "portHT"         => 0,       // montant des frais de ports HT
//                       "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
//                   "AccompteExige" => 1,
//                       "accompte"         => 0,     // montant de l'acompte (TTC)
//                       "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
//                   "Remarque" => "Avec un acompte, svp..." );


if($row["boleta"] == 0){
    $pdf->addCadreEurosFrancs2($row["sub_total"],$row["total"]);
}else{
    $pdf->addCadreEurosFrancs3(0,$row["total_sin_boleta"]);
}

$pdf->Output();
?>
