<?php
require_once "connessione.php";

function CreaBox($rows)
{
    $insert = '<li>
    <img src="'.$rows['immagine'].'" alt="'.$rows['alt'].'" width="250" height="170" />
    <form action="../php/carrello.php" method="post">
        <h3>'.$rows['modello'].'</h3><p class="general_container">'.$rows['costo'].'<abbr title="euro">&euro;</abbr></p>
        <button type="button" title="Apri descrizione '.$rows['modello'].'" class="apri_descrizione"><img class="apri_descrizione" src="../Immagini/contenuto/show_details.png" alt="Mostra dettagli" /></button>
        <input type="hidden" value="'.$rows['id'].'" />
        <input type="button" title="Aggiungi al carrello '.$rows['modello'].'" class="add_product" value="Aggiungi al carrello" />
        <input type="submit" aria-label="Vai al carrello tramite il box del prodotto '.$rows['modello'].'" title="Vai al carrello" class="buy_product" value="Vai al carrello" />
    </form>';
    $insert .= '<div class="popUp nascosto" id="dettagli'.$rows['id'].'">
        <img src="'.$rows['immagine'].'" alt="'.trim($rows['alt']).'" width="250" height="170" />
        <p class="title_product">'.$rows['modello'].'</p>
        <p>'.$rows['descrizione'].'</p>
            <input type="button" class="delete_button" title="Chiudi'.$rows['modello'].'" value="Chiudi" />
            <input type="hidden" value="'.$rows['id'].'" />
    </div> </li>';
    return $insert;
}

$paginaHTML = file_get_contents("..".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."prodotti.html");
$connessione = new connection();
if($connessione->isConnected())
{
    $queryResult=mysqli_query($connessione->getConnection(),"SELECT * FROM prodotto ORDER BY categoria");
    $categoria = '';
    $insert = '';
    if(mysqli_affected_rows($connessione->getConnection())>0)
    {
        $ul = true;
        while($rows=$queryResult->fetch_assoc())
        {
            if($rows['categoria']!=$categoria)
            {
                if(!$ul)//ul aperto
                {
                    $insert .= '</ul>';//chiude ul
                    
                }
                $categoria = $rows['categoria'];
                $insert .= ' <h2 id="'.str_replace(' ','',$categoria).'">'.$categoria.'</h2><ul class="products">';
                $ul = false;//ul aperto
                $insert .= CreaBox($rows);
                
            }
            else
            {
                $insert .= CreaBox($rows);
            }
           
        }
        $insert .= '</ul>';
        $paginaHTML = str_replace('<h2></h2>', $insert, $paginaHTML);
        echo $paginaHTML;
    }
}

?>