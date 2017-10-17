 <?php
$_SESSION['nav']="";
 $id = $_GET['id'];
include ("db.php");
$q = $DBH->prepare("SELECT * FROM orders WHERE o_id= :pid"); 
$q->bindValue(':pid', $id);
$q->execute();
$row = $q->fetch(PDO::FETCH_ASSOC);



require('invoice.php');

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addSociete( "BS Building Supplies",
                  "3 St Vincent Avenue\n" .
                  "Woodquay\n".
                  "Galway, Ireland\n" );
$pdf->fact_dev( "ORDER ", $row["o_id"] );
$pdf->temporaire( " " );
$pdf->addDate($row["u_username"]);
$pdf->addClient( date("d/m/y",time()));
$pdf->addPageNumber("1");
$pdf->addClientAdresse($row["o_details"]);
$pdf->addReglement($row['o_status']);
//$pdf->addEcheance("03/12/2003");
//$pdf->addNumTVA("FR888777666");
//$pdf->addReference("Devis ... du ....");
$cols=array( "ID ORDER"    => 23,
             "DESCRIPTION"  => 78,
             "STATUS"     => 22,
             "P"      => 26,
             "TOTAL" => 30,
             "T"          => 11 );
$pdf->addCols( $cols);
$cols=array( "ID ORDER"    => "L",
             "DESCRIPTION"  => "L",
             "STATUS"     => "C",
             "P"      => "R",
             "TOTAL" => "R",
             "T"          => "C" );
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);

$y    = 109;
$line = array( "ID ORDER"    => $row['o_id'],
               "DESCRIPTION"  => $row['o_items'],
               "STATUS"     => $row['o_status'],
               "P"      => ".",
               "TOTAL" => $row['o_total'],
               "T"          => "1" );
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;


//$pdf->addCadreTVAs();
        
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
/*$tot_prods = array( array ( "px_unit" => 600, "qte" => 1, "tva" => 1 ),
                    array ( "px_unit" =>  10, "qte" => 1, "tva" => 1 ));
$tab_tva = array( "1"       => 19.6,
                  "2"       => 5.5);
$params  = array( "RemiseGlobale" => 1,
                      "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
                      "remise"         => 0,       // {montant de la remise}
                      "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
                  "FraisPort"     => 1,
                      "portTTC"        => 10,      // montant des frais de ports TTC
                                                   // par defaut la TVA = 19.6 %
                      "portHT"         => 0,       // montant des frais de ports HT
                      "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
                  "AccompteExige" => 1,
                      "accompte"         => 0,     // montant de l'acompte (TTC)
                      "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
                  "Remarque" => "Avec un acompte, svp..." );

$pdf->addTVAs( $params, $tab_tva, $tot_prods);
*///$pdf->addCadreEurosFrancs();

$pdf->Output('orderslip.pdf','d');



include ('meta.html');
include ('header.php');


$download = "<input type='button' data-inline='true' onclick='window.location.reload(true)'' data-theme='b' value='Download PDF' />";

echo "<h3>Order ID <br>".$id ."<br></h3> <a href='../Index.php?menu=2' data-role='button' name='mainmenu' data-inline='true' data-transition='flow' >back </a>". $download;

include ('footer.php');
?>
