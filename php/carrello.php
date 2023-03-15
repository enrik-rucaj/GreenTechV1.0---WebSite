<?php
require_once "connessione.php";
require_once "session.php";

function creaCarrello(&$paginaHTML,$connessione)
{
        $queryResult=mysqli_query($connessione->getConnection(),"SELECT P.modello,C.quantita,P.costo,P.immagine,P.alt FROM carrello AS C, prodotto AS P, utente AS U WHERE C.prodotto=P.id AND C.utente=U.email AND U.email='".$_SESSION['utente']."'");
        $totale=0;
        $insert = "";
        if(mysqli_affected_rows($connessione->getConnection())>0)
        {
            while ($rows = mysqli_fetch_assoc($queryResult))
            {
                $insert .= "<div class='general_container'>";
                $insert .= "<h3>" . $rows['modello'] . "</h3>";
                $insert .= "<img src='".$rows['immagine']."' alt='".$rows['alt']."' />";
                $insert .= "<dl><dt>quantità: </dt><dd>".$rows['quantita']."</dd><dt>costo: </dt><dd>".($rows['quantita']*$rows['costo'])."<abbr title='euro'>&euro;</abbr></dd></dl><form action='../php/carrello.php' method='post'><input type='hidden' name='elimina' value='".$rows['modello']."'/><input type='submit' class='delete_button' title='rimuovi ".$rows['modello']."' value='rimuovi'/></form></div>";
                $totale += $rows['quantita'] * $rows['costo'];
            }
        }
        else
        {
            $insert = "<div>Nessun prodotto inserito nel carrello</div>";
        }
        $paginaHTML = str_replace('<strong id="inserisciTotale"></strong>','<strong id="inserisciTotale">'.$totale.'<abbr title="euro">&euro;</abbr></strong>',$paginaHTML);
        $_SESSION['totale'] = $totale;
        $paginaHTML = str_replace('<p id="inserisciProdotti"></p>', $insert, $paginaHTML);
}

$paginaHTML = file_get_contents("..".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."carrello.html");
$connessione = new connection();
if($connessione->isConnected())
{
    if(isset($_SESSION['utente'])&&isset($_SESSION['connect'])&&($_SESSION['utente']!=""&&$_SESSION['connect']!=false))
    {
        if(isset($_POST['submit'])&&isset($_SESSION['totale']))
        {
            if($_SESSION['totale']>"0")
            {
                $connessione->closeConnection();
                header('location:../php/pagamento.php');
                exit();
            }
            else
            {
                $paginaHTML = str_replace('<p id="nessun_prodotto"></p>','<p id="nessun_prodotto">Aggiungi dei prodotti al carrello</p>', $paginaHTML);
            }
        }

        if(isset($_POST['elimina']))
        {
            $queryResult=mysqli_query($connessione->getConnection(),"DELETE C.* FROM carrello AS C, utente As U , prodotto AS P WHERE C.utente=U.email AND C.prodotto=P.id AND P.modello='".$_POST['elimina']."' AND U.email='".$_SESSION['utente']."' ");
            if(mysqli_affected_rows($connessione->getConnection())!=0)
            {
                creaCarrello($paginaHTML, $connessione);
                echo $paginaHTML;
            }
        }
        else
        {
            creaCarrello($paginaHTML, $connessione);
            echo $paginaHTML;
        }
    }
    else
    {
        header('location:./login.php?id=1');
    }
   
}
?>