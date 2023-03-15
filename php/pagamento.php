<?php
require_once "connessione.php";
require_once "session.php";
require_once "nuovo_utente.php";
require_once "nuovo_ordine.php";
require_once "controlla_input.php";
function creaSelection(&$paginaHTML,$connessione)
{
    $insert="<select id='comune' name='comune' title='inserisci il comune' required='required'>";
    if($connessione->isConnected())
    {
        $queryResult = mysqli_query($connessione->getConnection(),"SELECT nomeComune FROM comune ORDER BY nomeComune");
        if(mysqli_affected_rows($connessione->getConnection())>0)
        {
            while($rows=$queryResult->fetch_assoc()){
                $insert .="<option>".$rows['nomeComune']."</option>";
            }
            $insert .="</select>";
            $paginaHTML = str_replace("<select id='comune' name='comune' title='inserisci il comune' required='required'></select>", $insert, $paginaHTML);
        }
    }
}

if((isset($_SESSION["utente"])&&isset($_SESSION["connect"])&&($_SESSION['connect']!=false&&$_SESSION['utente']!="")&&isset($_SESSION['totale'])))
{
    $connessione = new connection();
    if($connessione->isConnected())
    {
            $paginaHTML = file_get_contents("..".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."pagamento.html");
            $procedi = true;
            if(isset($_POST["submit"])&&isset($_SESSION['totale'])&&isset($_POST['info_spedizione'])&&isset($_POST['metodo_pagamento']))
            {
                $utente = utente::getNewUtente($_SESSION['utente'],$connessione);
                $ordine = new nuovo_ordine($_SESSION['utente']);
                if(($_POST['info_spedizione']=="nuovo_indirizzo"&&isset($_POST['nome'])&&isset($_POST['cognome'])&&isset($_POST['civico'])&&isset($_POST['cap'])&&isset($_POST['comune'])))
                {
                    if(controllaNome($_POST['nome'])&&controllaCognome($_POST['cognome'])&&controllaVia($_POST['via'])&&controllaCivico($_POST['civico'])&&controllaCap($_POST['cap']))
                    {
                        $ordine->setNome(sanitize($_POST['nome']));
                        $ordine->setCognome(sanitize($_POST['cognome']));
                        $ordine->setVia(sanitize($_POST['via']));
                        $ordine->setCivico(sanitize($_POST['civico']));
                        $ordine->setCap(sanitize($_POST['cap']));
                        $ordine->setComune(utente::getIstat($connessione,$_POST['comune']));
                    }
                    else
                    {
                        $paginaHTML = str_replace('<p id="errore_indirizzo"></p>','<p id="errore_indirizzo">Campi inseriti non validi</p>', $paginaHTML);
                        $procedi = false;
                    }
                }
                
                if($_POST['info_spedizione']=="dafault")
                {
                    $ordine->setNome($utente->getNome());
                    $ordine->setCognome($utente->getCognome());
                    $ordine->setVia($utente->getVia());
                    $ordine->setCivico($utente->getCivico());
                    $ordine->setCap($utente->getCap());
                    $ordine->setComune($utente->getIstatComune());
                }

                if($_POST['metodo_pagamento']=="carta_credito")
                {
                    if((isset($_POST['carta_registrata'])&&($_POST['carta_registrata'])=="registra_nuova_carta")&&(isset($_POST['titolare'])&&isset($_POST['numeroCarta'])&&isset($_POST['dataCarta'])&&isset($_POST['cvv'])))
                    {
                        $numeroCarta =preg_replace('/\s+/', '',$_POST['numeroCarta']);
                        if(controllaTitolareCarta($_POST['titolare'])&&controllaNumerocarta($numeroCarta)&&controllaCvv($_POST['cvv']))
                        {
                            $ordine->setMetodoDiPagamento("nuova_carta");
                            $ordine->setTitolareCarta(sanitize($_POST['titolare']));
                            $ordine->setNumeroCarta(sanitize($numeroCarta));
                            $ordine->setScadenzaCarta($_POST['dataCarta']."-01");
                            $ordine->setCvv(sanitize($_POST['cvv']));
                        }
                        else
                        {
                            $paginaHTML = str_replace('<p id="campi_non_validi></p>','<p id="campi_non_validi>Campi inseriti non validi</p>', $paginaHTML);
                            $procedi = false;
                        }
                      
                    }

                    if(isset($_POST['carta_registrata'])&&($_POST['carta_registrata']!="registra_nuova_carta"))
                    {
                        $ordine->setMetodoDiPagamento("carta_registrata");
                        $ordine->setNumeroCarta($_POST['carta_registrata']);
                    }
                    $ordine->setTotale($_SESSION['totale']);
                }
                else 
                {
                    $ordine->setMetodoDiPagamento("contrassegno");
                    $ordine->setTotale($_SESSION['totale'] + 3);
                }
                if($procedi)
                {
                    if($ordine->aggiungiOrdine($connessione))
                    {
                        $connessione->closeConnection();
                        unset($_SESSION['totale']);
                        header('location:../html/thankYouPage.html');

                        exit();
                    }
                    else
                    {
                        $paginaHTML = str_replace("<p id='errore'></p>","<p id='errore'>Qualcosa non è andato a buon fine nell'elaborazione del tuo ordine , controlla i campi inseriti</p>", $paginaHTML);
                    }
                }  
            } 

            creaSelection($paginaHTML, $connessione);
            $insert = "<dl class='general_container visibile'><dt class='user'>Utente :</dt>";
            $utente = utente::getNewUtente($_SESSION["utente"], $connessione);
            if ($utente)
            {
                $insert .= "<dd>".ucwords($utente->getNome())." ".ucwords($utente->getCognome())."</dd><dt class='delivery'>Indirrizzo di spedizione: </dt><dd class='clear_float'><dl><dt>Via :</dt><dd>".$utente->getVia().", ".$utente->getCivico()."</dd><dt>Cap :</dt><dd id='cap'>".$utente->getCap()."</dd> <dt>Comune :</dt><dd>".ucwords($utente->getNomeComune($connessione))."</dd></dl></dd>";
            }
            else
            {
                $insert .= '<div>Nessun dato disponibile</div>';
            }
            $paginaHTML = str_replace("<dl class='general_container'>", $insert, $paginaHTML);
            
            $queryResult = mysqli_query($connessione->getConnection(), "SELECT P.modello,C.quantita,P.costo FROM carrello AS C, prodotto AS P, utente AS U WHERE C.prodotto=P.id AND C.utente=U.email AND U.email='" .$utente->getEmail(). "'");
            if (mysqli_affected_rows($connessione->getConnection()) > 0) 
            {
                $insert = " <table class='tabellaStyle' summary='tabella del riepilogo del tuo ordine suddivisa in colonne per : tipo prodotto , quantit&agrave; e costo'>
                <caption>Riepilogo del tuo ordine</caption>
                <thead>
                    <tr>
                        <th scope='col'>prodotto</th>
                        <th scope='col'>quantita'</th>
                        <th scope='col'>costo</th>
                    </tr>
                </thead>";
                $insert .= '<tbody>';
                while ($rows = mysqli_fetch_assoc($queryResult)) {

                    $insert .= '<tr>
                                    <th scope="row">'.$rows['modello'].'</th>
                                    <td>'.$rows['quantita'].'</td>
                                    <td>'.($rows['quantita'] * $rows['costo']).'<abbr title="euro">&euro;</abbr></td>
                                </tr>';
                }
                $insert .= '</tbody></table>';
            }
            else
            {
                $insert .= '<div>Nessun dato disponibile</div>';
            }
            $paginaHTML = str_replace("<table class='tabellaStyle'></table>", $insert, $paginaHTML);
            $paginaHTML = str_replace("<strong id='inserisciTotale'><abbr title='euro'>0&euro;</abbr>", "<strong id='inserisciTotale'>".$_SESSION['totale']."<abbr title='euro'>&euro;</abbr></strong>", $paginaHTML);
            echo $paginaHTML;
    }
}
else
{
    header('location:../html/index.html');
    exit();
}
?>