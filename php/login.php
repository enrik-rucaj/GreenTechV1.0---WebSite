<?php
	require_once "session.php";
    require_once "connessione.php";
	require_once "controlla_input.php";
    if((isset($_SESSION['connect'])&&$_SESSION['utente'])&&($_SESSION['connect']!=false&&$_SESSION['utente']!=""))
	{ 
	//se già loggato l'utente viene reindirizzato all'area personale
        header('location:area_riservata.php');
        exit();
    }

    $paginaHTML = file_get_contents("..".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."login.html");
	if (isset($_POST['submit'])) //l'utente ha premuto il bottone per loggarsi
	{
		$connessione = new connection();
		if($connessione->isConnected())
		{
			//rimovo i tag html e inserisco il nome utente e password in due variabili
			$utente=sanitize($_POST['utente']);
			$userPassword=sanitize($_POST['password']);
			$errore="";
			$queryResult = mysqli_query($connessione->getConnection(), "SELECT password FROM utente WHERE email=\"$utente\"");
			if(mysqli_affected_rows($connessione->getConnection())==1)
			{
				$hashedPassword = $queryResult->fetch_assoc();
				if(password_verify($userPassword, $hashedPassword['password'])) //verfico che la password inserita sia corretta
				{
					$_SESSION['connect'] = true;
					$_SESSION['utente'] = $utente;
					$connessione->closeConnection();
					if(isset($_POST['carrello'])) 
					{
						//L'utente da non loggato ha cercato di accedere al carrello , quindi una volta loggato lo rimando al suo carrello
						header('location:carrello.php');
						exit();
					}
					else
					{
						 //altrimenti accede alla sua area personale
						header('location:area_riservata.php');
						exit();
					}
				}
				else
				{
					//Se la password non è corretta visualizzo un messaggio di errore
					$errore .= "<p id='errore' class='errore'>password non valida</p>";
					$paginaHTML = str_replace("<p id='errore' class='errore'></p>", $errore, $paginaHTML);
				}
	
			}
			else
            {
				//Se la password non è corretta visualizzo un messaggio di errore
				$errore .= "<p id='errore' class='errore'>email non valida</p>";
				$paginaHTML = str_replace("<p id='errore' class='errore'></p>", $errore, $paginaHTML);
			} 
		}
		$connessione->closeConnection();
	}
	else 
	{
		if(isset($_GET['id'])&&($_GET['id']==1)) //Se id==1 vuol dire che l'utente sta cercando di accedere al carrello da non loggato
		{
			$paginaHTML = str_replace("<p id='errore' class='errore'></p>", "<p id='errore' class='errore'>Effettua il login per accedere al carrello</p><input type='hidden' name='carrello'/>", $paginaHTML);
		}
	}
	echo $paginaHTML;

?>
