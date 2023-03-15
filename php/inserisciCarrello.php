<?php
require_once "session.php";
require_once "connessione.php";
require_once "nuovo_utente.php";
$idProdotto = $_GET['id'];
$connessione = new connection();
if($connessione->isConnected())
{
    if((isset($_SESSION['utente'])&&isset($_SESSION['connect']))&&($_SESSION['utente']!=''&&$_SESSION['connect']!=false))
    {
        $utente=$_SESSION['utente'];
        $utente = utente::getNewUtente($utente,$connessione);
        if($utente)
        {
            $queryResult=mysqli_query($connessione->getConnection(),"SELECT * FROM carrello WHERE utente='".$utente->getEmail()."' AND prodotto=".$idProdotto);
            if(mysqli_affected_rows($connessione->getConnection())==1)
            {
                $quantita=$queryResult->fetch_assoc();
                $queryResult=mysqli_query($connessione->getConnection(),"UPDATE carrello SET quantita=" . ($quantita['quantita'] + 1) . " WHERE utente='" . $utente->getEmail() ."' AND prodotto=" . $idProdotto);
                if(mysqli_affected_rows($connessione->getConnection())>0)
                {
                    echo "prodotto aggiunto correttamente nel carrello";
                }
                else
                {
                    echo "impossibile aggiungere il prodotto nel carrello";
                }
            }
            else
            {
                $queryResult=mysqli_query($connessione->getConnection(), "INSERT INTO carrello(utente,prodotto,quantita) VALUES ('".$utente->getEmail()."',".$idProdotto.",1)");
                if(mysqli_affected_rows($connessione->getConnection())>0)
                {
                    echo "prodotto aggiunto nel carrello";
                }
                else
                {
                    echo "impossibile aggiungere il prodotto nel carrello";
                }
            }
        }
    }
    else
    {
        echo "Effettua il login per aggiungere i prodotti nel carrello";
    }
    $connessione->closeConnection();
}
?>