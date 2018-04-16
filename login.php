<?php
session_start();
//se e' il primo accesso alla pagina visualizza il form di inserimento
//nome utente e password
if (!isset($_REQUEST['txtaccesso'])){
  echo "<h2>Gestione magazzino</h2>";
  echo "<form name=frmInserisci method=get action=login.php>";
  echo "<input type=hidden name=txtaccesso value=1>";
  echo "<table>";
  echo "<tr>";
  echo "<td>Nome utente: </td><td><input type=text name=txtusername ></td>";
  echo "</tr><tr>";
  echo "<td>Password: </td><td><input type=password name=txtpassword ></td>";
  echo "</tr><tr>";
  echo "<td align =center><input type=submit value=Login></td>";
  echo "</tr></table>";
  echo "</form>";
}
else
{ //altrimenti controlla se nome utente e password sono corretti
    require_once('ConnessioneDb.php');
     $db=new ConnessioneDb();
     //trim toglie gli spazi bianchi doppi o tripli ed evita problemi di SQL INJECTION
     $usr=$db->real_escape_string(trim($_REQUEST["txtusername"]));
     $pwd=$db->real_escape_string(trim($_REQUEST["txtpassword"]));
     //controlla correttezza username e pwd
     $sql="select * from login where username='$usr'and password='$pwd'";
     $result = $db->query($sql);
     if($result->num_rows == 0){
          echo("Username o password errati <a href=login.php>Ritenta</a>");
     }
     else
     {
        $riga = $result->fetch_array();
        $_SESSION['username']=$riga['username'];
        $_SESSION['tipo']=$riga['tipo'];
        $result->close();
        //richiama la pagina index.php
       header("location: index.php");
     }
}

?>

