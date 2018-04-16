<?php

include("header.php");
/* Your query */
$result = $db->query("SELECT * FROM clienti") or die($mysqli->error);


?>
<html>
    
    <head>
        <title>Invoice Database</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        <p style="color: greenyellow;">select Client:
        <form method="post" action="invoice-db.php">
            <select name="client">
    <option value="Select Client" name="client">Select Client</option>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        echo "<option value='" . $row['ragionesociale'] . "'>" . $row['ragionesociale'] . "</option>";
    }
    ?>
</select>
            <input type="submit" value="generate">
        </form>
    </body>
</html>
<?php
include("footer.php");
?>