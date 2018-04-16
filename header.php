<?php
//questo file contiene tutte le istruzioni che devono essere eseguite
//in ogni pagina
//session start deve essere la prima istruzione, prima di fare qualsiasi echo
session_start();
require_once ('ConnessioneDb.php');
$db= new ConnessioneDb();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  
  </head>  
  <body>
<?php
// se e' impostata la variabile di sessione utente, il login e' gia' stato fatto
// e viene visualizzato in alto a destra il saluto
// altrimenti visualizza il link per la pagina di login
if (isset($_SESSION['username'])){
    $utente=$_SESSION['username'];
    echo "<p class='utente_collegato'>Utente collegato:<a href='logout.php'> $utente </a> ";
}
else {
   die ("Per accedere a questo sito occorre essere autenticati. Vai alla pagina di <a href='login.php'>login</a>");
 }

?>
