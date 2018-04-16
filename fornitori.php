<?php
/* Database connection settings */
include("header.php");






/* Your query */
//$result = $mysqli->query("SELECT * FROM invoice") or die($mysqli->error);
echo '<p style="color: red;">INSERIMENTO FORNITORI';
if (isset($_POST) & !empty($_POST)){
$nomeazienda= mysqli_real_escape_string($db, $_POST['nomeazienda']);
$indirizzoazienda= mysqli_real_escape_string($db, $_POST['indirizzoazienda']);
$cap= mysqli_real_escape_string($db, $_POST['cap']);
$citta= mysqli_real_escape_string($db, $_POST['citta']);
$telefono = mysqli_real_escape_string($db, $_POST['telefonoazienda']);
$cellulare = mysqli_real_escape_string($db, $_POST['cellulareazienda']);
$email = mysqli_real_escape_string($db, $_POST['emailazienda']);
$piva=mysqli_real_escape_string($db, $_POST['partitaivaazienda']);
//$banca= mysqli_real_escape_string($conn, $_POST['banca']);

$queryfornitore= "INSERT INTO `fornitore` (ragionesociale, indirizzo, cap, citta, telefono, cellulare, email, partitaiva)"
        . " VALUES ('$nomeazienda', '$indirizzoazienda','$cap','$citta','$telefono','$cellulare','$email','$piva' )";
$resultqueryfornitore = mysqli_query($db, $queryfornitore);
    if($resultqueryfornitore){
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
<div id="myDIV" class="myDIV">
<form method="POST">
            <label class="sr-only">Nome Company: </label>
            <input type="text" name="nomeazienda" class="form-control" placeholder="nome azienda" required>
            <label class="sr-only">Indirizzo Azienda: </label>
            <input type="text" name="indirizzoazienda" class="form-control" placeholder="indirizzo azienda" required>
            <label class="sr-only">CAP: </label>
            <input type="number" name="cap" class="form-control" placeholder="CAP" required>
            <label class="sr-only">Citta Azienda: </label>
            <input type="text" name="citta" class="form-control" placeholder="citta" required>
            <label class="sr-only">Telefono: </label>
            <input type="number" name="telefonoazienda" class="form-control" placeholder="telefono azienda">
            <label class="sr-only">Cellulare: </label>
            <input type="number" name="cellulareazienda" class="form-control" placeholder="cellulare azienda" required>
            <label class="sr-only">Email:</label>
            <input type="text" name="emailazienda" class="form-control" placeholder="email azienda" required>
            <label class="sr-only">Partita Iva:</label>
            <input type="number" name="partitaivaazienda" class="form-control" placeholder="partita iva azienda" required>
            <label class="sr-only">Banca</label>
            <input type="text" name="banca" class="form-control" placeholder="Coordinate Bancarie" >
            <input type="submit" value="submit">
        </form>

</div>
            
            
        </div>
    </body>
</html>
<?php
include("footer.php");
?>
