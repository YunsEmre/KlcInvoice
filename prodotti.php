<?php
include("header.php");

//$clientID = mysqli_real_escape_string($db, $_POST['client2']);
$clientID =$_POST["client"];


/* Your query */
//$result = $mysqli->query("SELECT * FROM invoice") or die($mysqli->error);
echo '<p style="color: red;">INSERIMENTO PRODOTTI';
if (isset($_POST) & !empty($_POST)){

$descrizione= mysqli_real_escape_string($db, $_POST['descrizione']);
$codice= mysqli_real_escape_string($db, $_POST['codice']);
$prezzo= mysqli_real_escape_string($db, $_POST['prezzo']);
$iva = mysqli_real_escape_string($db, $_POST['iva']);
//$banca= mysqli_real_escape_string($conn, $_POST['banca']);

$queryprodotto= "INSERT INTO `prodotti` (codice, descrizione, clientID, prezzo, iva) VALUES "
        . "('$codice', '$descrizione','$clientID','$prezzo','$iva')";
$resultqueryprodotto = mysqli_query($db, $queryprodotto);
    if($resultqueryprodotto){
        $smsg =  "Prodotto aggiunto correttamente";
    }else{
        $fmsg =  "Impossibile aggiungere il Prodotto";
    }
}

?>
<html>
    <head>
        <title>
            Depo-KlcFoods
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
        <link href="style.css" rel="stylesheet" type="text/css"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        
        <div class="container">
            <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"><?php echo $smsg; ?></div>
            <?php } ?>
            <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"><?php echo $fmsg; ?></div>
            <?php } ?>
            <?php

            
?>


<div id="myDIV" class="myDIV">
<form method="POST">
           <!-- <label class="sr-only">Client ID: </label>
            <input type="number" name="clientid" class="form-control" placeholder="Codice Cliente" required>-->
            <label class="sr-only">Descrizione: </label>
            <input type="text" name="descrizione" class="form-control" placeholder="Descrizione Prodotto" required>
            <label class="sr-only">Codice:  </label>
            <input type="number" name="codice" class="form-control" placeholder="Codice Prodotto" required>
            <label class="sr-only">Prezzo:  </label>
            <input type="text" name="prezzo" class="form-control" placeholder="Prezzo Prodotto" required>
            <label class="sr-only">Iva: </label>
            <input type="number" name="iva" class="form-control" placeholder="Iva Prodotto" required="">
            <input type="submit" value="submit">
        </form>

</div>
            
            
        </div>
    </body>
</html>