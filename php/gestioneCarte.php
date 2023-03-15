<?php
require_once "session.php";
require_once "connessione.php";
require_once "nuovo_utente.php";

function creaTabella(&$connessione,$email){
    $utente = utente::getNewUtente($email, $connessione);
    if ($utente) 
    {
        $query = 'SELECT C.titolare,C.numero,C.dataScadenza,C.cvv  FROM carta AS C , registra AS R , utente AS U WHERE U.cf=R.utente and C.numero=R.carta and U.email="' . $utente->getEmail() . '"';
        $queryResult = mysqli_query($connessione->getConnection(), $query);
        $insert = '<p id="inserisci_tabella">';
        if (mysqli_affected_rows($connessione->getConnection()) > 0) //carte presenti
        {
            $insert .= "<table class='tabellaStyle' summary='tabella contenente le tue carte registrate'><thead><tr><th scope='col'>TITOLARE</th><th scope='col'>NUMERO</th><th scope='col'>DATA DI SCADENZA</th><th scope='col'>CVV</th><th scope='col'>AZIONE</th></tr></thead><tbody>";
            while ($rows = mysqli_fetch_assoc($queryResult)) {
                $insert .= '<tr><td scope="row" data-title="titolare">' . $rows['titolare'] . '</td><td scope="row" data-title="numero carta">' . $rows['numero'] . '</td><td scope="row" data-title="data di scadenza">' . substr($rows['dataScadenza'], 0, 7) . '</td><td scope="row" data-title="cvv">' . $rows['cvv'] . '</td><td scope="row" data-title="pulsante per eliminare la carta"><input type="button" name="eliminaCarta" id="eliminaCarta" value="elimina"></tr>';
            }
            $insert .= '</tbody></table>';

        } else $insert = "<div>nessuna carta registrata</div>";
        $insert .= '</p>';
        return $insert;
    }
}

if(isset($_SESSION['connect'])&&isset($_SESSION['utente'])&&($_SESSION['connect']!=false&&$_SESSION['utente']!=""))
{
    $connessione = new connection();
    if($connessione->isConnected())
    {
        if(isset($_POST['inserisci_carta']))
        {   
            if(isset($_POST['titolare'])&&isset($_POST['numero'])&&isset($_POST['data_scadenza'])&&isset($_POST['cvv']))
            {
                $queryResult = mysqli_query($connessione->getConnection(),'INSERT INTO carta(dataScadenza,numero,titolare,cvv) VALUES ('.$_POST['data_scadenza'].','.$_POST['numero'].','.$_POST['titolare'].','.$_POST['cvv'].')');
                if (mysqli_affected_rows($connessione->getConnection())!=0){
                    
                }
            }
        }
        if(isset($_GET['carta']))
        {
            $res = null;
            $queryResult = mysqli_query($connessione->getConnection(),'DELETE C,R FROM carta AS C, registra AS R, utente AS U WHERE C.numero=R.carta AND R.utente=U.cf AND C.numero="'.$_GET['carta'].'" AND U.email="'.$_SESSION['utente'].'"');
            if (mysqli_affected_rows($connessione->getConnection())!=0)  $res= creaTabella($connessione, $_SESSION['utente']);
            echo $res;
        }
        else
        {
            
            $paginaHTML=file_get_contents("..".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."myCarte.html");
            $insert = creaTabella($connessione, $_SESSION['utente']);
            $paginaHTML = str_replace('<p id="inserisci_tabella"></p>', $insert, $paginaHTML);
            echo $paginaHTML;
        } 
    }
}
else
{
    header('location:../html/index.html');
    exit();
}

?>