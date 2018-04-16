<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = $_GET['codice'];

$con = mysqli_connect('localhost','root','','myinvoicedb2');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM prodotti WHERE codice = '".$q."'";
$result = mysqli_query($con,$sql);
  

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['codice'] . "</td>";
    echo "<td>" . $row['descrizione'] . "</td>";
    echo "<td>" . $row['prezzo'] . "</td>";
    echo "<td>" . $row['iva'] . "</td>";
    echo "</tr>";
}?>
</body>
</html>