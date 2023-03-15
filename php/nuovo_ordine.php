<?php
require_once "connessione.php";
class nuovo_ordine{

    private $email;
    private $nome;
    private $cognome;
    private $via;
    private $civico;
    private $cap;
    private $comune;
    private $totale;
    private $metodoDiPagamento;
    private $titolareCarta;
    private $numeroCarta;
    private $scadenzaCarta;
    private $cvv;
   
    public function __construct($email=null,$nome=null, $cognome=null,$via=null,$civico=null,$cap=null,$comune=null,$totale=null,$metodoDiPagamento=null,$titolareCarta=null,$numeroCarta=null,$scadenzaCarta=null,$cvv=null)
    {
        $this->email = $email;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->via = $via;
        $this->civico = $civico;
        $this->cap = $cap;
        $this->comune = $comune;
        $this->totale = $totale;
        $this->metodoDiPagamento = $metodoDiPagamento;
        $this->titolareCarta = $titolareCarta;
        $this->numeroCarta = $numeroCarta;
        $this->scadenzaCarta = $scadenzaCarta;
        $this->cvv = $cvv;
    }

    public function aggiungiOrdine(connection $db)
    {
        $res = true;
        if($this->metodoDiPagamento=="carta_registrata")
        {
            $queryResult = mysqli_query($db->getConnection(),"SELECT C.* FROM carta AS C WHERE numero=\"$this->numeroCarta\"");
            if (mysqli_affected_rows($db->getConnection()) != 0) 
            {
                $rows=$queryResult->fetch_assoc();
                $this->titolareCarta = $rows['titolare'];
                $this->scadenzaCarta = $rows['dataScadenza'];
                $this->cvv = $rows['cvv'];
            } else
                $res = false;
        }             
        $data = date("Y-m-d");
        $queryResult = mysqli_query($db->getConnection(),"INSERT INTO ordine(data, totale, utente) VALUES (\"$data\",\"$this->totale\",\"$this->email\")");
        if (mysqli_affected_rows($db->getConnection()) != 0) 
        {
            $queryResult = mysqli_query($db->getConnection(),"SELECT MAX(numberTracking)AS id FROM ordine");
            if (mysqli_affected_rows($db->getConnection()) != 0)
            {
                $rows = mysqli_fetch_assoc($queryResult);
                $id=$rows['id'];
                $queryResult = mysqli_query($db->getConnection(),"INSERT INTO datispedizione(ordineTracking,nome,cognome,via,civico,cap,comune) VALUES (\"$id\",\"$this->nome\",\"$this->cognome\",\"$this->via\",\"$this->civico\",\"$this->cap\",\"$this->comune\")");
                if (mysqli_affected_rows($db->getConnection()) != 0)
                {
                    $query = "INSERT INTO datipagamento(ordineTracking,cvv,numero,titolare,dataScadenza,metodoPagamento) VALUES (\"$id\",\"$this->cvv\",\"$this->numeroCarta\",\"$this->titolareCarta\",\"$this->scadenzaCarta\",'prepagata')";
                    if ($this->metodoDiPagamento == "contrassegno")
                        $query = "INSERT INTO datipagamento(ordineTracking,metodoPagamento) VALUES (\"$id\",'contrassegno')";
                    $queryResult = mysqli_query($db->getConnection(),$query);
                    if (mysqli_affected_rows($db->getConnection()) != 0)
                    {
                        $queryResult = mysqli_query($db->getConnection(),"SELECT prodotto,quantita FROM carrello WHERE utente=\"$this->email\"");
                        if (mysqli_affected_rows($db->getConnection()) != 0)
                        {
                            while($rows = mysqli_fetch_assoc($queryResult))
                            {
                                $prodotto = $rows['prodotto'];
                                $quantita = $rows['quantita'];
                                $queryResult2 = mysqli_query($db->getConnection(),"INSERT INTO contiene(quantita, idProdotto, numberTracking) VALUES (\"$quantita\",\"$prodotto\",\"$id\")");
                                if (mysqli_affected_rows($db->getConnection()) == 0)
                                    $res = false;
                            }
                            if($res)
                            {
                                $queryResult = mysqli_query($db->getConnection(),"DELETE FROM carrello WHERE utente=\"$this->email\"");
                            }

                        } else
                            $res = false;
                    } else
                        $res = false;
                } else
                    $res = false;
            } else
                $res = false;
        } else
            $res = false;

        return $res;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }

    public function setVia($via)
    {
        $this->via = $via;
    }

    public function setCivico($civico)
    {
        $this->civico = $civico;
    }

    public function setCap($cap)
    {
        $this->cap = $cap;
    }

    public function setComune($comune)
    {
        $this->comune = $comune;
    }

    public function setTotale($totale)
    {
        $this->totale = $totale;
    }

    public function setMetodoDiPagamento($metodoDiPagamento)
    {
        $this->metodoDiPagamento = $metodoDiPagamento;
    }

    public function setTitolareCarta($titolareCarta)
    {
        $this->titolareCarta = $titolareCarta;
    }

    public function setNumeroCarta($numeroCarta)
    {
        $this->numeroCarta = $numeroCarta;
    }

    public function setScadenzaCarta($scadenzaCarta)
    {
        $this->scadenzaCarta = $scadenzaCarta;
    }

    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }
}
?>