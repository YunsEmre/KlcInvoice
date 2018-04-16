<?php
require_once ('fpdf/fpdf.php');
require_once('header.php');
//include('fattura.php');
class PDF extends FPDF
{
  function Header()
    {
      $this->Image('logo.png',10,8,33);
      $this->SetFont('Helvetica','B',15);
      $this->SetXY(50, 10);
      $this->Cell(0,10,'This is a header',1,0,'C');
     }

  function Footer()
    {
      $this->SetXY(100,-15);
      $this->SetFont('Helvetica','I',10);
      $this->Write (5, 'This is a footer');
    }
}





$client = $_REQUEST["client"];
$client2=$_REQUEST["client"];
//$iva= $_REQUEST["iva"];
//$prodotto = $_REQUEST["prodotti"];
$fatturanumero = $_REQUEST["numfattura"];
$datafattura = $_REQUEST["datafattura"];

//$query2 = $db->query("select codicecliente from clienti  where ragionesociale= '$client'");//selezione del cliente
$query2 = $db->query("select * from clienti  where ragionesociale= '$client2'");//selezione del cliente



$cliente2= mysqli_fetch_array($query2);//compilazione luogo destinazione e dettagi clienti
$coddcliente=$cliente2['codicecliente'];

if(isset($_POST['save']))  
{  
//$name=$_POST['name'];  
//$location=$_POST['location'];  
//mysqli_query($cn,"insert into tbl_order(name,location) VALUES ('$name','$location')");  
//$id=mysqli_insert_id();  
for($i = 0; $i<count($_POST['productname']); $i++)  
{  
mysqli_query($db,"INSERT INTO prodotti  
SET  
codice = '{$_POST['codiceprodotto'][$i]}',
invoiceID = '{$fatturanumero}',
descrizione = '{$_POST['productname'][$i]}',  
clientID = '$coddcliente', 
prezzo = '{$_POST['price'][$i]}',
iva = '{$_POST['iva'][$i]}',  
quantita = '{$_POST['quantity'][$i]}',
totale = '{$_POST['amount'][$i]}'");   
}  
} 







//$quantita= $_REQUEST["quantita"];
//$queryquantita=$db->query("update prodotti set quantita='$quantita' where descrizione='$prodotto'");



//$descrizione= mysqli_real_escape_string($db, $_POST['descrizione']);
//$codice= mysqli_real_escape_string($db, $_POST['codice']);
//$prezzo= mysqli_real_escape_string($db, $_POST['prezzo']);
//$iva = mysqli_real_escape_string($db, $_POST['Iva']);
//$quantita = mysqli_real_escape_string($db, $_POST['quantita']);




//INSERT INTO `prodotti`(`codice`, `invoiceID`, `descrizione`, `clientID`, `prezzo`, `iva`, `quantita`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])











/*$queryprodotto= "INSERT INTO `prodotti` (codice,invoiceID, descrizione, clientID, prezzo, iva,quantita) VALUES "
        . "('$codice',fatturanumero, '$descrizione','$clientID','$prezzo','$iva','$quantita')";
$resultqueryprodotto = mysqli_query($db, $queryprodotto);*/





//$ragionesociale = mysqli_real_escape_string($connect, $_POST['ragionesociale']);
//get invoices data

$query2= $db->query("select * from fornitori");//seleziona tutti i fornitori
$query = $db->query("select * from clienti  where ragionesociale= '$client'");//selezione del cliente



$cliente= mysqli_fetch_array($query);//compilazione luogo destinazione e dettagi clienti
$miaazienda= mysqli_fetch_array($query2); //compilazione dati mittente della fattura



$pdf= new FPDF('P','mm', 'A4');//caratteristiche della pagina pdf "P" Orientamento della pagina "mm" dimensione pagina in millimetri "A4" tipo foglio
$pdf->SetAutoPageBreak(true);
$pdf -> addpage();//Aggiunta di una pagina
$pdf ->setfont('Arial', 'B',14);	//tipo di font,carattere e dimensione

//compilazione dei dati del mittente e destinatario

$pdf->Cell(120, 5, $miaazienda['ragionesociale'], 'LRT',0);//dal database prende la ragione sociale del fornitore
$pdf ->setfont('Arial', 'B',10);

$pdf->Cell(70, 5, 'Spettabile','LRT',1);//end of line 70-> lunghezza della riga 5-> Altezza della riga 'Stringa'->Testo da scrivere, 'LRT'->Bordo a LEFT;RIGHT;TOP; 1-> indica fine della riga
$pdf->setFont('Arial','',10);

$pdf->Cell(120,5,$miaazienda['indirizzo'],'LR',0);
$pdf->Cell(70,5,$cliente['ragionesociale'],'LR',1);

$pdf->Cell(120,5,$miaazienda['cap'].$miaazienda['citta'],'LR',0);
$pdf->Cell(70,5,$cliente['indirizzo'],'LR',1);


$pdf->Cell(120,5,'Tel. : '.$miaazienda['telefono'],'LR',0);
$pdf->Cell(70,5,$cliente['cap']." ".$cliente['citta'],'LR',1);


$pdf->Cell(120,5,'Cell.: '.$miaazienda['citta'],'LR',0);
$pdf ->setfont('Arial', 'B',10);
$pdf->Cell(70, 5, 'Luogo di Destinazione:','LRT',1);//end of file
$pdf->setFont('Arial','',10);


$pdf->Cell(120,5,'email: '.$miaazienda['cellulare'],'LR',0);
$pdf->Cell(70,5,$cliente['ragionesociale'],'LR',1);

$pdf->Cell(120,5,'Partita IVA: '.$miaazienda['partitaiva'],'LR',0);
$pdf->Cell(70,5,$cliente['indirizzo'],'LR',1);

$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(70,5,$cliente['cap'].$cliente['citta'],'LR',1);
$pdf->Cell(120,1,'','LRB',0);
$pdf->Cell(70,1,'','LRB',1);


$pdf->Cell(60, 4, 'tipo documento','LR',0);
$pdf->Cell(60, 4, 'causale documento','R',0);
$pdf->Cell(35, 4, 'N. Documento','R',0);
$pdf->Cell(35, 4, 'Data Documento','R',1);


$pdf->Cell(60, 4, '','LRB',0,'R');
$pdf->Cell(60, 4, '','B',0,'R');
$pdf->Cell(35, 4, $fatturanumero,'LRB',0,'R');
$pdf->Cell(35, 4, $datafattura,'BR',1,'R');


$pdf->Cell(60, 4, 'Condizioni Pagamento','LR',0);
$pdf->Cell(60, 4, 'Nostra Banca','R',0);
$pdf->Cell(70, 4, 'Banca Cliente','R',1);


$pdf->Cell(60, 4, '','LR',0,'R');
$pdf->Cell(60, 4, '','B',0,'R');
$pdf->Cell(70, 4, $cliente['banca'],'LR',1,'R');//End of Line


$pdf->Cell(30, 4, 'Codice Cliente','LRT',0);
$pdf->Cell(30, 4, 'P.IVA','TR',0);
$pdf->Cell(60, 4, 'Codice Fiscale','R',0);
$pdf->Cell(70, 4, 'Agente','TR',1);


$pdf->Cell(30, 4, $cliente['codicecliente'],'LRB',0,'R');
$pdf->Cell(30, 4, $cliente['partitaiva'],'BR',0,'R');
$pdf->Cell(60, 4, $cliente['codicefiscale'],'B',0,'R');
$pdf->Cell(70, 4, '01','LBR',1,'R');


$pdf->Cell(30, 4, 'Codice','LRTB',0);
$pdf->Cell(70, 4, 'Descrizione','TRB',0);
$pdf->Cell(20, 4, 'Q.TA','RB',0);
$pdf->Cell(20, 4, 'Prezzo','LRTB',0);
$pdf->Cell(20, 4, 'Sconto','TRB',0);
$pdf->Cell(20, 4, 'Importo','RB',0);
$pdf->Cell(10, 4, 'IVA','TRB',1);




$codicecliente2 = $_REQUEST["client"];

//$queryclient = $db->query("select * from prodotti where clientID = (select codicecliente from clienti where ragionesociale = '$client') and invoiceID = $fatturanumero");
$queryclient = $db->query("select * from prodotti where clientID = '$coddcliente' and invoiceID='$fatturanumero' ");
$querycount=$db->query("select count(*) as total from prodotti where clientID = '$coddcliente' and invoiceID='$fatturanumero'");
//for ($i=0;$i<29;$i++){
$ii= mysqli_fetch_assoc($querycount);
$cc=$ii['total'];

for($i = 0; $i<$cc; $i++)  
{  
    $item = mysqli_fetch_array($queryclient);
    $pdf->Cell(30, 4,$item['codice'],'',0);
    $pdf->Cell(70,4,$item['descrizione'],'',0);
    $pdf->Cell(20,4,$item['quantita'],'',0);
    $pdf->Cell(20,4,$item['prezzo'],'',0);
    $pdf->Cell(20,4,'','',0);
    $pdf->Cell(20,4,$item['totale'],'',0);
    $pdf->Cell(10,4,$item['iva'],'',1);
    
//    if( $cc<29){
//        $aa=15-$cc;
//        for($j=0;$j<$aa;$j++){
//    $pdf->Cell(30, 4,'','LR',0);
//    $pdf->Cell(70,4,'','R',0);
//    $pdf->Cell(20,4,'','R',0);
//    $pdf->Cell(20,4,'','R',0);
//    $pdf->Cell(20,4,'','R',0);
//    $pdf->Cell(20,4,'','R',0);
//    $pdf->Cell(10,4,'','R',1);
//        }
//        }

//            for($j=0;$j<29;$j++){
//        $item = mysqli_fetch_array($queryclient);
//    $pdf->Cell(30, 4,'','LR',0);
//    $pdf->Cell(70,4,'','R',0);
//    $pdf->Cell(20,4,'','R',0);
//    $pdf->Cell(20,4,'','R',0);
//    $pdf->Cell(20,4,'','R',0);
//    $pdf->Cell(20,4,'','R',0);
//    $pdf->Cell(10,4,'','R',1);
//    
        
//    }
    }


//    $pdf->Cell(30, 4,$item['codice'],'LR',0);
//    $pdf->Cell(70,4,$item['descrizione'],'R',0);
//    $pdf->Cell(20,4,$item['quantita'],'R',0);
//    $pdf->Cell(20,4,$item['prezzo'],'R',0);
//    $pdf->Cell(20,4,'','R',0);
//    $pdf->Cell(20,4,$item['totale'],'R',0);
//    $pdf->Cell(10,4,$item['iva'],'R',1);

    

    
    
    
    







//$pdf->setFont('Arial','',10);
//$pdf->Cell(190, 4,'Note','LRT',1);
//$pdf->Cell(190, 10,'','LRB',1);
//
//
//$pdf->Cell(30, 4, '-->','LRT',0);
//$pdf->Cell(30, 4, '','TR',0);
//$pdf->Cell(30, 4, 'Imporsta','R',0);
//$pdf->Cell(30, 4, 'Imponibile','R',0);
//$pdf->Cell(70, 4, 'TOTALE','TR',1);
//
//$pdf->Cell(30, 4, '','LR',0);
//$pdf->Cell(30, 4, '','R',0);
//$pdf->Cell(30, 4, '4%','R',0);
//$pdf->Cell(30, 4, '','R',0);
//$pdf->Cell(70, 4, '','R',1);
//
//$pdf->Cell(30, 4, '','LR',0);
//$pdf->Cell(30, 4, '','R',0);
//$pdf->Cell(30, 4, '10%','R',0);
//$pdf->Cell(30, 4, '','R',0);
//$pdf->Cell(70, 4, '','R',1);
//
//$pdf->Cell(30, 4, '','LR',0);
//$pdf->Cell(30, 4, '','R',0);
//$pdf->Cell(30, 4, '22%','R',0);
//$pdf->Cell(30, 4, '','R',0);
//$pdf->Cell(70, 4, '','R',1);
//
//$pdf->Cell(30, 4, '','LRB',0);
//$pdf->Cell(30, 4, '','RB',0);
//$pdf->Cell(30, 4, '','RB',0);
//$pdf->Cell(30, 4, '','RB',0);
//$pdf->Cell(70, 4, '','RB',1);

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

/*$pdf->Cell(30, 4, 'N.Colli','LRT',0);
$pdf->Cell(30, 4, 'Peso Lordo','TR',0);
$pdf->Cell(30, 4, 'Peso Netto','R',0);
$pdf->Cell(30, 4, 'Porto','R',0);
$pdf->Cell(70, 4, 'Firma Destinatario','TR',1);


$pdf->Cell(30, 6, '','LB',0,'R');
$pdf->Cell(30, 6, '','LRB',0,'R');
$pdf->Cell(30, 6, '','RB',0,'R');
$pdf->Cell(30, 6, '','B',0,'R');
$pdf->Cell(70, 6, '','LRB',1,'R');

$pdf->Cell(60, 4, 'Aspetto esteriore dei beni','LR',0);
$pdf->Cell(60, 4, 'Trasporto a Cura Del','R',0);
$pdf->Cell(70, 4, 'Firma Conducente','R',1);


$pdf->Cell(60, 6, '','LB',0,'R');
$pdf->Cell(60, 6, '','LRB',0,'R');
$pdf->Cell(70, 6, '','LRB',1,'R');

$pdf->Cell(60, 4, 'Data/ora Trasporto','LR',0);
$pdf->Cell(60, 4, 'Data/Ora Ritiro','R',0);
$pdf->Cell(70, 4, 'Firma Vettore','R',1);


$pdf->Cell(60, 6, '','LRB',0,'R');
$pdf->Cell(60, 6, '','LRB',0,'R');
$pdf->Cell(70, 6, '','LRB',1,'R');

$pdf->Cell(190, 4, 'Descrizione Vettore','LR',1);
$pdf->Cell(190, 4, '','LRB',1,'R');


$pdf->Cell(90, 4, '','LR',0);
$pdf->Cell(30, 4, 'Spese Trasporto','R',0);
$pdf->Cell(25, 4, 'Spese Imballo','LR',0);
$pdf->Cell(25, 4, 'Spese Varie','R',0);
$pdf->Cell(20, 4, 'Extra Sconto','R',1);

$pdf->Cell(90, 6, '','LRB',0,'R');
$pdf->Cell(30, 6, '€'.'0','LRB',0,'R');
$pdf->Cell(25, 6, '€'.'0','LRB',0,'R');
$pdf->Cell(25, 6, '€'.'0','LRB',0,'R');
$pdf->Cell(20, 6, '€'.'0','LRB',1,'R');


$pdf->Cell(60, 3, 'Descrizione codice IVA','LR',0);
$pdf->Cell(60, 3, 'Imponibile','LR',0);
$pdf->Cell(35, 3, 'Imposta','R',0);
$pdf->Cell(35, 3, 'omaggio','R',1);

$pdf->Cell(60, 9, '0','LRB',0,'R');
$pdf->Cell(60, 9, '0','LRB',0,'R');
$pdf->Cell(35, 9, '0','LRB',0,'R');
$pdf->Cell(35, 3, '0','LR',1,'R');


$pdf->Cell(60, 12, '','',0);
$pdf->Cell(60, 12, '','',0,'R');
$pdf->Cell(35, 12, '','',0,'R');
$pdf->Cell(35, 3, 'acconto','TR',1);

$pdf->Cell(60, 12, '','',0,'R');
$pdf->Cell(60, 12, '','',0,'R');
$pdf->Cell(35, 12, '','',0,'R');
$pdf->Cell(35, 3, '0','BR',1,'R');

$pdf->Cell(60, 3, 'Scadenze e Importi Calcolati dal','LR',0);
$pdf->Cell(60, 3, 'Tot. Esente','LR',0);
$pdf->Cell(35, 3, 'Tot. Imponibile','R',0);
$pdf->Cell(35, 3, 'Totale Documento','R',1);

$pdf->Cell(60, 3, '€'.'0','LR',0,'R');
$pdf->Cell(60, 3, '€'.'0','LRB',0,'R');
$pdf->Cell(35, 3, '€'.'0','LRB',0,'R');
$pdf->Cell(35, 3, '0','LR',1,'R');


$pdf->Cell(60, 3, '','L',0);
$pdf->Cell(60, 3, 'Abbuono','LR',0);
$pdf->Cell(35, 3, 'Tot. Imposta','R',0);
$pdf->Cell(35, 3, '','R',1);

$pdf->Cell(60, 3, '','LRB',0,'R');
$pdf->Cell(60, 3, 'non presente','LRB',0,'R');
$pdf->Cell(35, 3, '','RB',0,'R');
$pdf->Cell(35, 3, '','RB',1,'R');

$pdf->Cell(190, 5, 'Vi preghiamo di controllare i Vostri dati anagrafici la partita IVA e il Codice Fiscale. Non ci riteniamo responsabili ',"LR",1);
$pdf->Cell(190, 5, ' di eventuali errori.I vostri dati indicati saranno trattati nel rispetto della legge sulla privacy DLSGS n. 196/2003.',"LRB",1);
*/
ob_clean();
$pdf->output();
$db->close;
?>