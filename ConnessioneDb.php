<?php

// Classe che consente la connessione al db mySQL

class ConnessioneDb extends MySQLi{
    function __construct() {
        parent::__construct('localhost','root','','myinvoicedb2');
        if ($this->connect_error){
            die('Connessione fallita: '.$this->connect_error);
        }
    }
    //metodo che esegue una query SQL e termina in caso di errore
    //visualizzando messaggio di errore  e testo query
    //function query($query) {
    //    $ris=parent::query($query);
     //   if ($this->error){
      //      die("Query fallita: {$this->error} query=$query");
       // }
       // return $ris;
    //}
}
?>
