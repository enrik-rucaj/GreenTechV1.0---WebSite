<?php
require_once "session.php";
require_once "connessione.php";
require_once "nuovo_utente.php";
if ((isset($_SESSION['connect'])&&isset($_SESSION['utente']))&&($_SESSION['connect'] == true&&$_SESSION['utente']!='')) //utente loggato
{
        $connessione = new connection();
        if ($connessione->isConnected()) 
        {
            $email = $_SESSION['utente'];
            $utente = utente::getNewUtente($email, $connessione);
            if ($utente) 
            {
                $paginaHTML=file_get_contents("..".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."myOrdini.html");
                $query = "SELECT O.data,O.numberTracking,O.totale,DP.metodoPagamento,DP.numero FROM ordine AS O, datipagamento AS DP WHERE O.numberTracking=DP.ordineTracking AND O.utente='".$utente->getEmail()."' ORDER BY O.numberTracking DESC";
                $queryResult = mysqli_query($connessione->getConnection(),$query);
                $insert = "";
                if (mysqli_affected_rows($connessione->getConnection()) > 0)
                {
                    while ($rows = mysqli_fetch_assoc($queryResult)) 
                    {
                        $insert .= '<div class="general_container">';
                        $query = "SELECT P.modello,C.quantita,P.costo FROM prodotto AS P, contiene AS C  WHERE P.id=C.idProdotto AND C.numberTracking=". $rows['numberTracking'];
                        $queryResult2 = mysqli_query($connessione->getConnection(), $query);
                        if (mysqli_affected_rows($connessione->getConnection()) > 0) 
                        {
                        $insert .= '<table class="tabellaStyle" summary="tabella contenente i dettagli del tuo ordine">
                                        <caption><h3>Numero Ordini: '.$rows['numberTracking'].'</h3></caption>
                                        <thead>
                                            <tr>
                                                <th scope="col">MODELLO</th>
                                                <th scope="col">QUANTITA</th>
                                                <th scope="col">COSTO</th>
                                            </tr>
                                        </thead><tbody>';
                            while ($rows2 = mysqli_fetch_assoc($queryResult2)) 
                            {
                                $insert .= '<tr>
                                                <th scope="row">'.$rows2['modello'] .'</th>
                                                <td>'.$rows2['quantita'] .'</td>
                                                <td>'.$rows2['costo'].'<abbr title="euro">&euro;</abbr></td>
                                            </tr>';
                            }
                            $insert .= '</tbody></table>';
                        } 
                        else 
                        {
                            $insert .= 'Dettagli ordine non disponibili';
                        }
                        $insert .= '<dl class="info_spedizioni">
                                        <div>
                                            <dt>Data:</dt>
                                            <dd>'.$rows['data'].'</dd>
                                        </div>
                                        <div>
                                            <dt>Numero Tracking:</dt>
                                            <dd>'.$rows['numberTracking'].'</dd>
                                        </div>
                                        <div>
                                            <dt>Totale:</dt>
                                            <dd>'.$rows['totale'].'<abbr title="euro">&euro;</abbr></dd>
                                        </div>
                                        <div>
                                            <dt>Metodo di Pagamento:</dt>
                                            <dd>'.$rows['metodoPagamento'].'</dd>
                                        </div>
                                        <div>
                                            <dt>Numero Carta:</dt>
                                            <dd>'. ($rows['numero'] ? '&lowast;&lowast;&lowast;&lowast; &lowast;&lowast;&lowast;&lowast; &lowast;&lowast;&lowast;&lowast; '.substr($rows['numero'], -4) : 'nessuna informazione').'</dd>
                                        </div>
                                    </dl>';
                        $query = 'SELECT D.nome,D.cognome,D.via,D.civico,C.nomeComune,C.provincia FROM datispedizione AS D, comune AS C WHERE C.istat=D.comune AND D.ordineTracking=' . $rows['numberTracking'];
                        $queryResult2 = mysqli_query($connessione->getConnection(), $query);
                        if (mysqli_affected_rows($connessione->getConnection()) > 0) 
                        {
                        $insert .= '<dl class="indirizzo_spedizioni delivery">';
                        $rows = mysqli_fetch_assoc($queryResult2);
                        $insert .= '<dt>Indirizzo di spedizione:</dt>
                        <dd>'.ucwords($rows['via']).' '.$rows['civico'].' , '.ucwords($rows['nomeComune']).' '.strtoupper($rows['provincia']).'</dd>
                        </dl>';
                        } 
                        else 
                        {
                            $insert .= 'indirizzo di spedizione non disponibile';
                        }
                        $insert .= '</div>';
                    }
                }
                else
                {
                    $insert = "<div>nessun ordine effettuato</div>";
                } 
                $paginaHTML = str_replace('<div class="general_container"></div>', $insert, $paginaHTML);
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