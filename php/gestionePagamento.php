<?php
require_once "connessione.php";
require_once "session.php";
$connessione = new connection();
if($connessione->isConnected())
{
    if((isset($_SESSION['connect'])&&isset($_SESSION['utente']))&&($_SESSION['connect']==true && $_SESSION['utente']!=""))
    {
        if($_GET['pagamento']=='carta_credito')
    {
        $queryResult=mysqli_query($connessione->getConnection(),'SELECT C.* FROM registra AS R, carta AS C, utente AS U WHERE C.numero=R.carta AND R.utente=U.email AND U.email="'.$_SESSION['utente'].'"');
    
        $insert = '<fieldset id="carte_registrate" class="general_container">';
        if(mysqli_affected_rows($connessione->getConnection())>0)
        {
        $count = 1;
        while($rows=$queryResult->fetch_assoc())
        {
            $insert .= '<label for="carta_registrata'.$count.'" class="card_option scelta_carta">Carta di <em>'.$rows['titolare'].'</em> che termina per <em>'.substr($rows['numero'],11,15).'</em></label>
            <input type="radio" id="carta_registrata'.$count.'" class="card_option scelta_carta" name="carta_registrata" value="'.$rows['numero'].'" />';
            $count++;
        }
        }
        $insert .= '<label for="pagamento_registra_carta">Registra una nuova carta</label>
        <input type="radio" id="pagamento_registra_carta" name="carta_registrata" value="registra_nuova_carta" class="scelta_carta" />
        <fieldset id="nuova_carta" class="nascosto">
            <label for="titolare">Titolare:</label>
            <input type="text" id="titolare" oninput="onlyLetters(this)" name="titolare" title="inserisci il nome del titolare" autocomplete="off"  maxlength="30"/>
            <label for="numeroCarta">Numero carta:</label>
            <input type="text" id="numeroCarta" name="numeroCarta" oninput="addSpaces(this)" title="inserisci il numero della carta" autocomplete="off" placeholder="xxxx xxxx xxxx xxxx" maxlength="19" />
            <label for="dataCarta">Data di scadenza:</label>
            <input type="month" id="dataCarta" name="dataCarta" value="" />
            <label for="cvv">CVV:</label>
            <input type="text" name="cvv" id="cvv" oninput="onlyNumbers(this)" placeholder="XXX" maxlength="4">
            <p id="campi_non_validi></p>
        </fieldset></fieldset>';
        echo $insert;
    }
    }
    else
    {
        header('location:../html/index.html');
        exit();
    }
}
?>