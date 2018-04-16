<?php
include("header.php");
$resultprodotti = $db->query("SELECT * FROM prodotti") or die($mysqli->error);
$resultclient = $db->query("SELECT * FROM clienti") or die($mysqli->error);
$row2 = mysqli_fetch_array($resultprodotti);
?>

<head>
    <title>Crea Fattura</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        function showUser(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "ajax.php?codice=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
    <link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<script src="//code.jquery.com/jquery-1.12.0.min.js">
</script>  
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js">
</script>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

<body>


    <form action="invoice-db.php" method="POST">
        <div class="box box-primary">  
            <div class="box-header">  
                <h3 class="box-title">Invoice </h3>  
            </div>
            <p style="color: greenyellow;">select Client:

                <select name="client">
                    <option value="Select Client" name="client">Select Client</option>
                    <?php
                    while ($row = mysqli_fetch_array($resultclient)) {
                        echo "<option value='" . $row['ragionesociale'] . "'>" . $row['ragionesociale'] . "</option>";
                    }
                    ?>        
                </select>
            <div class="box-body">  
                <div class="form-group">  
                    Numero Fattura  
                    <input type="number" name="numfattura" class="form-control" placeholder="Numero Fattura" required="">  
                </div>  
                <div class="form-group">  
                    Data Fattura  
                    <input type="date" name="datafattura" class="form-control" placeholder="data Fattura" required="">  
                </div>  
            </div>  
            <input type="submit" class="btnbtn-primary" name="save" value="Save Record">  
        </div><br/>  
        <table class="table table-bordered table-hover">  
            <thead>  
            <th>No</th>  
            <th>Codice Prodotto</th>
            <th>Product Name</th>  
            <th>Quantity</th>  
            <th>Price</th>  
            <th>Discount</th>  
            <th>Iva</th>
            <th>Amount</th>  
            <th><input type="button" value="+" id="add" class="btnbtn-primary"></th>  
            </thead>  
            <tbody class="detail">  
                <tr>  
                    <td class="no">1</td>  
                    <td><input type="text" class="form-control productname" name="codiceprodotto[]"></td>
                    <td><select name="productname[]" onchange="showUser(this.value)">
                            <option value="Select product" name="productname[]">Select product</option>
                            <?php
                            $yunus[][] = null;
                            $i = 0;
                            while ($row2 = mysqli_fetch_array($resultprodotti)) {
                                $yunus[$i]['codice'] = $row2['codice'];
                                $yunus[$i]['descrizione'] = $row2['descrizione'];
                                echo "<option value='" . $yunus[$i]['codice'] . "'>" . $yunus[$i]['descrizione'] . "</option>";
                                $i++;
                            }
                            ?>        
                        </select></td>  
                    <td><input type="text" class="form-control quantity" name="quantity[]"></td>  
                    <td><input type="text" class="form-control price" name="price[]"></td>  
                    <td><input type="text" class="form-control discount" name="discount[]"></td>
                    <td><select name="iva[]">
                            <option value="4">4</option>
                            <option value="10">10</option>
                            <option value="22">22</option>
                        </select></td>
                  <!--  <td><input type="text" class="form-control iva" name="iva[]"></td>-->
                    <td><input type="text" class="form-control amount" name="amount[]"></td>  
                    <td><a href="#" class="remove">Delete</td>  
                </tr>  
            </tbody>  
            <tfoot>  
            <th></th>  
            <th></th>  
            <th></th>  
            <th></th>  
            <th></th>  
            <th></th>
            <th></th>
            <th></th>
            <th style="text-align:center;" class="total">0<b></b></th>  
            </tfoot>  

        </table>   
    </form>  



    <br>
    <div id="txtHint"><b>Person info will be listed here...</b></div>


</body>
</html>





<script type="text/javascript">
    $(function ()
    {
        $('#add').click(function ()
        {
            addnewrow();
        });

    });
    function addnewrow()
    {
        var n = ($('.detail tr').length - 0) + 1;
        var tr = '<tr>' +
                '<td class="no">' + n + '</td>' +
                '<td><input type="text" class="form-control productname" name="codiceprodotto[]"></td>' +
                '<td><select name="productname[]" onchange="showUser(this.value)"><option value="Select product" name="productname[]">Select product</option><?php
                            while ($row2 = mysqli_fetch_array($resultprodotti)) {
                                echo "<option value='" . $yunus[$i]['codice'] . "'>" . $yunus[$i]['descrizione'] . "</option>";
                            }
                            ?>//</select></td>' +
//                '<td><input type="text" class="form-control quantity" name="quantity[]"></td>' +
                '<td><input type="text" class="form-control price" name="price[]"></td>' +
                '<td><input type="text" class="form-control discount" name="discount[]"></td>' +
                '<td><select name="iva[]"><option value="4">4</option><option value="10">10</option><option value="22">22</option></select></td>' +
                '<td><input type="text" class="form-control amount" name="amount[]"></td>' +
                '<td><a href="#" class="remove">Delete</td>' +
                '</tr>';
        $('.detail').append(tr);
    }
</script>
<?php
include("footer.php");
?>