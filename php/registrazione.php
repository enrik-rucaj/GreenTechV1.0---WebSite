<?php
require_once "session.php";
require_once "connessione.php";
require_once "nuovo_utente.php";
require_once "controlla_input.php";

function creaSelection($paginaHTML,$connessione)
{
    $insert="<select id='comune' name='comune' title='inserisci il comune'>";
    if($connessione->isConnected())
    {
        $queryResult = mysqli_query($connessione->getConnection(),"SELECT nomeComune FROM comune ORDER BY nomeComune");
        if(mysqli_affected_rows($connessione->getConnection())>0)
        {
            while($rows=$queryResult->fetch_assoc()){
                $insert .="<option>".$rows['nomeComune']."</option>";
            }
            $insert .="</select>";
            $paginaHTML = str_replace('<select id="comune"></select>', $insert, $paginaHTML);
            echo $paginaHTML;
        }
    }
}

$paginaHTML = file_get_contents("..".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."FormRegistrazione.html");
$connessione = new connection();
if(isset($_POST['submit']))
{
    if($connessione->isConnected())
    {
        if(($_POST['password']==$_POST['ripeti_password'])&&(controllaCf($_POST['cf'])&&controllaDataNascita($_POST['data_nascita'])&&controllaEmail($_POST['email'])&&controllaCivico($_POST['civico'])&&controllaNome($_POST['nome'])&&controllaCognome($_POST['cognome'])&&controllaVia($_POST['via'])&&controllaPassword($_POST['password'])&&controllaCap($_POST['cap'])))
        {
            $istat = utente::getIstat($connessione, $_POST['comune']);
            $utente = new utente(strtoupper(sanitize($_POST['cf'])),sanitize($_POST['data_nascita']),sanitize($_POST['email']),sanitize($_POST['civico']),strtolower(sanitize($_POST['nome'])),strtolower(sanitize($_POST['cognome'])),sanitize($_POST['via']),sanitize($_POST['password']),sanitize($istat),sanitize($_POST['cap']),false);
            $res=$utente->inserisciUtente($connessione);
            if($res==0){ //utente inserito
                $_SESSION['connect'] = true;
                $_SESSION['utente'] = sanitize($_POST['email']);
                $connessione->closeConnection();
                header('location:area_riservata.php');
                exit();
            }
            else if($res==1) //utente gia presente nel db
            {
                $errore='<p id="errore">Utente già presente</p>';
                $paginaHTML = str_replace('<p id="errore"></p>', $errore, $paginaHTML);
                creaSelection($paginaHTML,$connessione);
            }
        }
        else
        {
            $errore='<p id="errore">Campi non validi , ricontrolla i campi inseiriti </p>';
            $paginaHTML = str_replace('<p id="errore"></p>', $errore, $paginaHTML);
            creaSelection($paginaHTML,$connessione);
        }
       
    }
}
else //non è stata eseguita la submit
{
    if($connessione->isConnected()) creaSelection($paginaHTML,$connessione);
}
?>