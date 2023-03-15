<?php
    session_start();
    //variabili di sessione
    if(!isset($_SESSION['connect'])){
        $_SESSION['connect']=false;
    }
    if(!isset($_SESSION['utente'])){
        $_SESSION['utente']='';
    }
?>