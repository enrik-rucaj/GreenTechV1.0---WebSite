<?php
require_once "session.php";
require_once "connessione.php";
require_once "nuovo_utente.php";
require_once "controlla_input.php";
function creaSelection(&$paginaHTML,$nomeComune,$connessione)
{
    $insert="<select id='comune' name='comune' title='inserisci il comune'>";
    if($connessione->isConnected())
    {
        $queryResult = mysqli_query($connessione->getConnection(),"SELECT nomeComune FROM comune ORDER BY nomeComune");
        if(mysqli_affected_rows($connessione->getConnection())>0)
        {
            while($rows=$queryResult->fetch_assoc()){
                if ($rows['nomeComune'] == $nomeComune)
                    $insert .= '<option selected="selected">';
                else
                    $insert .= "<option>";
                $insert .=$rows['nomeComune']."</option>";
            }
            $insert .="</select>";
            $paginaHTML = str_replace('<select></select>', $insert, $paginaHTML);
        }
    }

}

function creaPagina(&$paginaHTML,$connessione,$utente){
    $insert = "<dl class='personal_data'><dt>Utente: </dt><dd><span id='nomeUtente'>".$utente->getNome()."</span> <span id='cognomeUtente'>".$utente->getCognome()."</span> </dd><dt>Data di nascita: </dt><dd id='data_nascitaUtente'>".$utente->getDataNascita()."</dd><dt>Codice fiscale: </dt><dd id='cfUtente'>".$utente->getCf()."</dd><dt>E-mail: </dt><dd id='emailUtente'>".$utente->getEmail()."</dd>";
    $paginaHTML = str_replace("<dl class='personal_data'>",$insert , $paginaHTML);
    $insert = "<dl class='shipment_data'><dt>Via: </dt><dd><span id='viaUtente'>".$utente->getVia()."</span> , <span id='civicoUtente'>".$utente->getCivico()."</span></dd><dt>Cap: </dt><dd id='capUtente'>".$utente->getCap()."</dd><dt>Comune: </dt><dd id='comuneUtente'>".$utente->getNomeComune($connessione)."</dd>";
    $paginaHTML = str_replace("<dl class='shipment_data'>",$insert , $paginaHTML);
    creaSelection($paginaHTML,$utente->getNomeComune($connessione),$connessione);
}

if((isset($_SESSION['connect'])&&isset($_SESSION['utente']))&&($_SESSION['connect']==true && $_SESSION['utente']!=""))
{ 
    $connessione = new connection();
    if($connessione->isConnected())
    {
        $email = $_SESSION['utente'];
        $utente = utente::getNewUtente($email,$connessione);
        if($utente)
        {
            $paginaHTML = file_get_contents("..".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."area_riservata.html");
            if(isset($_POST['submit'])) //sono stati modificati dei dati
            {
                $insert = '<p id="erroreInserimento">';
                $datiAggiornati = false;
                if (isset($_POST['via'])&&controllaVia($_POST['via']))
                {
                    if (!$utente->setVia(sanitize($_POST['via']), $connessione))
                    $insert .= 'non è stato possibile modificare la via .';
                    else  $datiAggiornati=true;
                }
                else if(!controllaVia($_POST['via']))  $insert .= 'campo via non valido .';
                        
                if (isset($_POST['civico'])&&controllaCivico($_POST['civico']))
                {
                    if (!$utente->setCivico(sanitize($_POST['civico']), $connessione))
                    $insert .= 'non è stato possibile modificare il civico .';
                    else  $datiAggiornati=true;
                }
                else if(!controllaCivico($_POST['civico'])) $insert .= 'campo civico non valido .';
                        
                if (isset($_POST['comune']))
                {
                    if (!$utente->setComune_byNomeComune($_POST['comune'], $connessione))
                    $insert .= 'non è stato possibile modificare il comune .';
                    else  $datiAggiornati=true;
                }
                       
                if (isset($_POST['cap'])&&controllaCap($_POST['cap']))
                {
                    if (!$utente->setCap(sanitize($_POST['cap']), $connessione))
                    $insert .= 'non è stato possibile modificare il cap .';
                    else  $datiAggiornati=true;
                }
                else if(!controllaCap($_POST['cap']))  $insert .= 'campo cap non valido .';
                       
                if (isset($_POST['nome'])&&controllaNome($_POST['nome']))
                {
                    if (!$utente->setNome(sanitize($_POST['nome']), $connessione))
                    $insert .= 'non è stato possibile modificare il nome .';
                    else  $datiAggiornati=true;
                }
                else if (!controllaNome($_POST['nome'])) $insert .= 'campo nome non valido .';
                        
                if (isset($_POST['cognome'])&&controllaCognome($_POST['cognome']))
                {
                    if (!$utente->setCognome(sanitize($_POST['cognome']), $connessione))
                    $insert .= 'non è stato possibile modificare il cognome .';
                    else  $datiAggiornati=true;
                }
                else if(!controllaCognome($_POST['cognome'])) $insert .= 'campo cognome non valido .';
                      
                if (isset($_POST['data_nascita'])&&$_POST['data_nascita']!='')
                {
                    if (!$utente->setDataNascita($_POST['data_nascita'], $connessione))
                    $insert .= 'non è stato possibile modificare la data di nascita .';
                    else  $datiAggiornati=true;
                }
                        
                if (isset($_POST['cf'])&&controllaCf($_POST['cf']))
                {
                    if (!$utente->setCf(sanitize($_POST['cf']), $connessione))
                    $insert .= 'non è stato possibile modificare il codice fiscale .';
                    else  $datiAggiornati=true;
                }
                else if(!controllaCf($_POST['cf'])) $insert .= 'campo codice fiscale non valido .';
                        
                if ((isset($_POST['vecchiaPassword'])&&isset($_POST['nuovaPassword']))&&controllaPassword($_POST['vecchiaPassword'])&&controllaPassword($_POST['nuovaPassword']))
                {
                    if (!$utente->setPassword(sanitize($_POST['vecchiaPassword']),sanitize($_POST['nuovaPassword']),$connessione))
                    $insert .= 'non è stato possibile modificare la password .';
                    else  $datiAggiornati=true;
                }     
                else if(controllaPassword($_POST['vecchiaPassword'])&&controllaPassword($_POST['nuovaPassword'])) $insert .= 'campo password non valido .';

                $insert='</p>';
                if($insert!='<p id="erroreInserimento"></p>') $paginaHTML = str_replace('<p id="erroreInserimento"></p>',$insert , $paginaHTML);
                if ($datiAggiornati) $paginaHTML = str_replace('<p id="dati_aggiornati"></p>', '<p id="dati_aggiornati">Campi aggiornati</p>', $paginaHTML);
                creaPagina($paginaHTML, $connessione, $utente);
                echo $paginaHTML;
                }
                else
                {
                    creaPagina($paginaHTML, $connessione, $utente);
                    echo $paginaHTML;
                }       
            }    
        }  
}
else //utente non loggato
{
    header('location:../html/index.html');
    exit();
}
?>