<?php
require_once "connessione.php";
class utente
{
   private $cf;
   private $data_nascita;
   private $email;
   private $civico;
   private $nome;
   private $cognome;
   private $cap;
   private $via;
   private $password;
   private $comune;
   private $isHashed;

    public function __construct($cf,$data_nascita,$email,$civico,$nome,$cognome,$via,$password,$comune,$cap,$isHashed){
        $this->cf=$cf;
        $this->data_nascita=$data_nascita;
        $this->email=$email;
        $this->civico=$civico;
        $this->nome=$nome;
        $this->cognome=$cognome;
        $this->cap=$cap;
        $this->via=$via;
        $this->password=$password;
        $this->comune=$comune;
        $this->isHashed = $isHashed;
    }
    public function inserisciUtente(connection $db)
    {
        //controllo non sia un utente già registrato
        $queryResult = mysqli_query($db->getConnection(),"SELECT cf FROM utente WHERE cf=\"$this->cf\"");
        if(mysqli_affected_rows($db->getConnection())==0)
        {
            $queryResult= $queryResult=mysqli_query($db->getConnection(),"SELECT email FROM utente WHERE email=\"$this->email\"");
            if(mysqli_affected_rows($db->getConnection())==0)
            {
                //nuovo utente
                $hashPassword = "";
                if(!$this->isHashed)
                {
                    $hashPassword = password_hash($this->password, PASSWORD_DEFAULT);
                    $this->isHashed = true;
                }
                else
                {
                    $hashPassword = $this->password;
                }    
                $queryResult = mysqli_query($db->getConnection(),"INSERT INTO utente(cf,dataNascita,email,civico,nome,cognome,cap,via,password,comune) VALUES (\"$this->cf\",\"$this->data_nascita\",\"$this->email\",\"$this->civico\",\"$this->nome\",\"$this->cognome\",\"$this->cap\",\"$this->via\",\"$hashPassword\",\"$this->comune\")");
                if(mysqli_affected_rows($db->getConnection())==1) return 0; //inserimento andato a buon fine
                else return 2; //inserimento non riusito
            } 
            else return 1; //utente gia presente nel db
           
        }
        else return 1; //utente gia presente nel db
    }

    public static function getNewUtente($email, connection $db){
        $queryResult = mysqli_query($db->getConnection(),"SELECT cf,dataNascita,email,civico,nome,cognome,via,password,comune,cap FROM utente WHERE email=\"$email\"");
        if(mysqli_affected_rows($db->getConnection())==1) //utente trovato
        {
            $rows= $queryResult->fetch_assoc();
            return new utente($rows['cf'], $rows['dataNascita'], $rows['email'], $rows['civico'], $rows['nome'], $rows['cognome'], $rows['via'], $rows['password'], $rows['comune'], $rows['cap'],true);
        }
        else return null;
    }

    public function getCf(){
        return $this->cf;
    }
    
    public function setCf($cf , connection $db){
        $res = true;
        if($cf != $this->cf)
        {
            $queryResult = mysqli_query($db->getConnection(),"UPDATE utente SET cf=\"$cf\" WHERE  email=\"$this->email\"");

            if(mysqli_affected_rows($db->getConnection())==0) $res = false; 
        }
        return $res;
    }
    
    public function getDataNascita(){
        return $this->data_nascita;
    }
    public function setDataNascita($data_nascita , connection $db){
        $res = true;
        if($data_nascita != $this->data_nascita)
        {
            $queryResult = mysqli_query($db->getConnection(),"UPDATE utente SET dataNascita=\"$data_nascita\" WHERE  email=\"$this->email\"");
            if (mysqli_affected_rows($db->getConnection()) != 0) $this->data_nascita = $data_nascita;
            else $res = false; 
        }
        return $res;
    }
    public function getEmail(){
        return $this->email;
    }
    /*
    public function setEmail($email, connection $db){
        $res = true;
        if($email != $this->email)
        {
            $queryResult = mysqli_query($db->getConnection(),'UPDATE utente SET email=\'$email\' WHERE  email=\'$this->email\'');

            if (mysqli_affected_rows($db->getConnection()) != 0) $this->email = $email;
            else $res = false; 
        }
        return $res;
    }
    */
    public function getCivico(){
        return $this->civico;
    }
    public function setCivico($civico , connection $db ){
        $res = true;
        if($civico != $this->civico)
        {
            $queryResult = mysqli_query($db->getConnection(),"UPDATE utente SET civico=\"$civico\" WHERE  email=\"$this->email\"");

            if (mysqli_affected_rows($db->getConnection()) != 0) $this->civico = $civico;
            else $res = false; 
        }
        return $res;
    }
    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome , connection $db ){
        $res = true;
        if($nome != $this->nome)
        {
            $queryResult = mysqli_query($db->getConnection(),"UPDATE utente SET nome=\"$nome\" WHERE  email=\"$this->email\"");

            if (mysqli_affected_rows($db->getConnection()) != 0) $this->nome = $nome;
            else $res = false; 
        }
        return $res;
    }

    public function getCognome(){
        return $this->cognome;
    }

    public function setCognome($cognome , connection $db ){
        $res = true;
        if($cognome != $this->cognome)
        {
            $queryResult = mysqli_query($db->getConnection(),"UPDATE utente SET cognome=\"$cognome\" WHERE  email=\"$this->email\"");

            if (mysqli_affected_rows($db->getConnection()) != 0) $this->cognome = $cognome;
            else $res = false; 
        }
        return $res;
    }

    public function getCap(){
        return $this->cap;
    }

    public function setCap($cap , connection $db ){
        $res = true;
        if($cap != $this->cap)
        {
            $queryResult = mysqli_query($db->getConnection(),"UPDATE utente SET cap=\"$cap\" WHERE  email=\"$this->email\"");

            if (mysqli_affected_rows($db->getConnection()) != 0) $this->cap = $cap;
            else $res = false; 
        }
        return $res;
    }

    public function getVia(){
        return $this->via;
    }

    public function setVia($via , connection $db ){
        $res = true;
        if($via != $this->via)
        {
            $queryResult = mysqli_query($db->getConnection(),"UPDATE utente SET via=\"$via\" WHERE  email=\"$this->email\"");

            if (mysqli_affected_rows($db->getConnection()) != 0) $this->via = $via;
            else $res = false; 
        }
        return $res;
    }
    public function getIstatComune(){
        return $this->comune;
    }
    public function setComune_byIstat($istat,connection $db)
    {
        $res = true;
        if($istat != $this->comune)
        {
            $queryResult = mysqli_query($db->getConnection(),"UPDATE utente SET comune=\"$istat\" WHERE  email=\"$this->email\"");

            if (mysqli_affected_rows($db->getConnection()) != 0) $this->comune = $istat;
            else $res = false; 
        }
        return $res;
    }
    public function getNomeComune(connection $db)
    {
        $queryResult = mysqli_query($db->getConnection(),"SELECT nomeComune FROM comune WHERE istat=\"$this->comune\"");
        if(mysqli_affected_rows($db->getConnection())==1) 
        {
            $rows=$queryResult->fetch_assoc();
            return $rows['nomeComune'];
        }
        else return null; 
    }

    public function setComune_byNomeComune($nomeComune,connection $db)
    {
        $res = true;
        $queryResult = mysqli_query($db->getConnection(),"SELECT istat FROM comune WHERE nomeComune=\"$nomeComune\"");
        if(mysqli_affected_rows($db->getConnection())==1)
        {
            $rows=$queryResult->fetch_assoc();
            if($this->comune!=$rows['istat'])
            {
                $queryResult = mysqli_query($db->getConnection(),"UPDATE utente SET comune='".$rows['istat']."' WHERE  email=\"$this->email\"");

                if (mysqli_affected_rows($db->getConnection()) != 0) $this->comune=$rows['istat'];
                else $res = false;
            } 
        } else $res = false;

        return $res;      
    }
    public function setPassword($vecchiaPassword , $nuovaPassword , connection $db )
    {
        $res = true;
        if($this->isHashed)
        {
            if(password_verify($vecchiaPassword, $this->password))
            {
                $hashPassword = password_hash($nuovaPassword, PASSWORD_DEFAULT);
                $queryResult = mysqli_query($db->getConnection(),"UPDATE utente SET password=\"$hashPassword\" WHERE  email=\"$this->email\"");
                if(mysqli_affected_rows($db->getConnection())!=0)
                {
                    $this->password = $hashPassword;

                } else $res = false;
            } else $res = false;
        }
        else
        {
            if($this->password==$vecchiaPassword)
            {
                if($this->password!=$nuovaPassword)
                {
                    $hashPassword = password_hash($nuovaPassword, PASSWORD_DEFAULT);
                    $queryResult = mysqli_query($db->getConnection(),"UPDATE utente SET password=\"$hashPassword\" WHERE  email=\"$this->email\"");
                    if(mysqli_affected_rows($db->getConnection())!=0)
                    {
                        $this->password = $hashPassword;
                        $this->isHashed = true;
                    } else $res = false;
                }
            } else $res = false;
        }

        return $res;   
    }
    
    public function getProvincia(connection $db)
    {
        $queryResult = mysqli_query($db->getConnection(),"SELECT provincia FROM comune WHERE istat=\"$this->comune\"");
        if(mysqli_affected_rows($db->getConnection())!=0)
        {
            $rows=$queryResult->fetch_assoc();
            return $rows['provincia'];
        } 
        else return null;
    }

    public function eliminaCarta($numeroCarta,connection $db)
    {
        $res = false;
        $queryResult = mysqli_query($db->getConnection(),"DELETE C,R FROM carta AS C , registra AS R WHERE C.numero=R.carta AND R.utente=\"$this->email\" AND C.numero=\"$numeroCarta\"");
        if (mysqli_affected_rows($db->getConnection()) != 0) 
        {
            $res = true;
        }
        return $res;
    }
    public function aggiungiCarta($titolare,$numeroCarta,$dataScadenza,$cvv,connection $db)
    {
        $res = false;
        $queryResult = mysqli_query($db->getConnection(),"INSERT INTO carta(dataScadenza,numero,titolare,cvv) VALUES (\"$dataScadenza\",\"$numeroCarta\",\"$titolare\",\"$cvv\")");
        if (mysqli_affected_rows($db->getConnection()) != 0) 
        {
            $queryResult = mysqli_query($db->getConnection(),"INSERT INTO registra(utente,carta) VALUES (\"$this->email\",\"$numeroCarta\")");
            if (mysqli_affected_rows($db->getConnection()) != 0)
            {
                $res = false;
            }
        }
        return $res;
    }

    public static function getIstat(connection $db,$nomeComune)
    {
        $queryResult = mysqli_query($db->getConnection(),"SELECT istat FROM comune WHERE nomeComune=\"$nomeComune\"");
        if(mysqli_affected_rows($db->getConnection())!=0)
        {
            $rows=$queryResult->fetch_assoc();
            return $rows['istat'];
        } else
            return null;
    }
}
?>