<?php
/* Database connection settings */
include("header.php");


if (isset($_POST) & !empty($_POST)){
    $codicecliente = mysqli_real_escape_string($db, $_POST['codicecliente']);
    $ragionesociale= mysqli_real_escape_string($db, $_POST['ragionesociale']);
    $indirizzo = mysqli_real_escape_string($db, $_POST['indirizzo']);
    $cap = mysqli_real_escape_string($db, $_POST['cap']);
    $citta = mysqli_real_escape_string($db, $_POST['citta']);
    $partitaiva = mysqli_real_escape_string($db, $_POST['partitaiva']);
    $codicefiscale = mysqli_real_escape_string($db, $_POST['codicefiscale']);
    $banca = mysqli_real_escape_string($db, $_POST['banca']);

    $sql = "INSERT INTO `clienti` (codicecliente, ragionesociale, indirizzo, cap, citta, partitaiva, codicefiscale, banca) VALUES ('$codicecliente', '$ragionesociale', '$indirizzo','$cap','$citta','$partitaiva', '$codicefiscale', '$banca' )";
    $result = mysqli_query($db, $sql);
    if($result){
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
            $query="SELECT * FROM clienti";
            $results = mysqli_query($db, $query);

echo '<table border="1" class="intro">';
    echo '<tr>';
        echo '<th>Codice Prodotto </th>';
        echo '<th>Marca</th>';
        echo '<th>Tipo</th>';
        echo '<th>Quantita</th>';
        echo '<th>Categoria</th>';
    echo '</tr>';

    while($orderData = mysqli_fetch_array($results)){
        echo '<form action="index.php" method="POST">';
        echo '<tr>';
            echo '<td>'.$orderData['codicecliente'].'</td>';
            echo '<td>'.$orderData['ragionesociale'].'</td>';
            echo '<td>'.$orderData['indirizzo'].'</td>';
            echo '<td>'.$orderData['cap'].'</td>';
            echo '<td>'.$orderData['citta'].'</td>';
            echo '<td>'.$orderData['partitaiva'].'</td>';
            echo '<td>'.$orderData['codicefiscale'].'</td>';
            echo '<td>'.$orderData['banca'].'</td>';
        echo '</tr>';
        echo '</form>';
    }
echo '</table>';
            
?>

<div id="myDIV" class="myDIV">
    <form method="POST">
                <label for="codicecliente" class="sr-only">Codice Cliente</label>
                <input type="number" name="codicecliente" class="form-control" placeholder="Codice Prodotto" required>
                <label for="ragionesociale" class="sr-only">Ragione Sociale</label>
                <input type="text" name="ragionesociale" class="form-control" placeholder="Marca Prodotto" required>
                <label for="indirizzo" class="sr-only">Indirizzo</label>
                <input type="text" name="indirizzo" class="form-control" placeholder="Tipo Prodotto" required>
                <label for="cap" class="sr-only">CAP</label>
                <input type="number" name="cap" class="form-control" placeholder="CAP" required>
                <label for="citta" class="sr-only">Citta</label>
                <input type="text" name="citta" class="form-control" placeholder="Citta" required>
                <label for="partitaiva" class="sr-only">Partita IVA</label>
                <input type="number" name="partitaiva" class="form-control" placeholder="Partita IVA" required>
                <label for="codicefiscale" class="sr-only">Codice Fiscale</label>
                <input type="text" name="codicefiscale" class="form-control" placeholder="Codice Fiscale" required>
                <label for="Banca" class="sr-only">Banca</label>
                <input type="text" name="banca" class="form-control" placeholder="Banca" required>
                <button type="submit">Aggiungi</button>
            </form>

</div>
            
            
        </div>
    </body>
</html>
<?php
include("footer.php");
?>

