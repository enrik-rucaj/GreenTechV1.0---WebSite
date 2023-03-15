<?php
require_once "session.php";
require_once "connessione.php";
require_once "nuovo_utente.php";
require_once "controlla_input.php";
if ((isset($_SESSION['connect'])&&isset($_SESSION['utente']))&&($_SESSION['connect']==true&&$_SESSION['utente']))
{
        $connessione = new connection();
        if ($connessione->isConnected()) 
        {
            $email = $_SESSION['utente'];
            $utente = utente::getNewUtente($email, $connessione);
            if ($utente) 
            {
                $paginaHTML=file_get_contents("..".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."myCarte.html");
                if(isset($_POST['elimina'])&&isset($_POST['cartaEliminata']))
                {
                     $utente->eliminaCarta($_POST['cartaEliminata'], $connessione);
                }
                
                if((isset($_POST['submit'])&&isset($_POST['titolare'])&&isset($_POST['numeroCarta'])&&isset($_POST['dataCarta'])&&isset($_POST['cvv'])))
                {
                    $numeroCarta =preg_replace('/\s+/', '',$_POST['numeroCarta']);
                    if(controllaTitolareCarta($_POST['titolare'])&&controllaNumerocarta($numeroCarta)&&controllaCvv($_POST['cvv'])) $utente->aggiungiCarta($_POST['titolare'], $numeroCarta, str_replace('/', '-', $_POST['dataCarta']) . "-00", $_POST['cvv'], $connessione);
                    else $paginaHTML = str_replace('<p id="errore"></p>','<p id="errore">Campi inseriti non validi</p>', $paginaHTML);
                }

                $query = 'SELECT C.titolare,C.numero,C.dataScadenza,C.cvv  FROM carta AS C , registra AS R , utente AS U WHERE U.email=R.utente and C.numero=R.carta and U.email="'.$utente->getEmail().'"';
                $queryResult = mysqli_query($connessione->getConnection(),$query);
                if (mysqli_affected_rows($connessione->getConnection()) > 0) 
                {
                    $insert = '';
                    $insert .= '<ul>';
                    while($rows=mysqli_fetch_assoc($queryResult))
                    {
                        $insert .= '<li>';
                        $insert .= '<div class="general_container"><div class="cash_card" aria-hidden="true"><p class="title_card">La tua carta</p>';
                        $insert .= '<p class="number_card">&lowast;&lowast;&lowast;&lowast; &lowast;&lowast;&lowast;&lowast; &lowast;&lowast;&lowast;&lowast;'.substr( $rows['numero'],12,4).'</p>';
                        $insert .= '<p class="holder_card">'. $rows['titolare'].'</p>';
                        $insert .= '<p class="expire_date_card">'.str_replace('-','/',substr($rows['dataScadenza'],0,7)).'</p>';
                        $insert .= '</div><div class="other_card">
                                        <p>Carta di '.$rows['titolare'].' che termina con il numero : '.substr( $rows['numero'],12,4).' e scade il : '.str_replace('-','/',substr($rows['dataScadenza'],0,7)).'</p>
                                        <form action="../php/myCarte.php" method="post">
                                            <input type="hidden" id="cartaEliminata" name="cartaEliminata" value='. $rows['numero'].' />
                                            <input type="submit" aria-label="elimina carta che termina con '.substr( $rows['numero'],12,4).'" name="elimina" class="delete_button" value="elimina" />
                                        </form>
                                    </div></div>';
                        $insert .= '</li>';

                    }
                    $insert .= '</ul>';
                }
                else  $insert = "<div>nessuna carta registrata</div>";
                $paginaHTML = str_replace('<p id="inserisci carte"></p>', $insert, $paginaHTML);
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