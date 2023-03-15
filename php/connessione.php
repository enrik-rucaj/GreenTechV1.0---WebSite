<?php 
    class connection{
        //varibili di connessione
        private  $HOST = 'localhost';
        private  $USERNAME = 'ylovato'; 
        private  $PASSWORD = 'eeThoirahGeiB0ku';
        private  $DATABASE = 'ylovato';
        private $connessione;
        //connessione al database
        public function __construct(){
            $this->connessione = mysqli_connect($this->HOST,$this->USERNAME,
                $this->PASSWORD,$this->DATABASE);
                if ($this->connessione->connect_errno) 
                {
                    echo "Connessione fallita (".$this->connessione->connect_errno."): ".$this->connessione->connect_error;
                    exit();
                }
                else
                {
                    //echo "connessione riuscita";
                }
        }
        
        public function getConnection(){
            return $this->connessione;
        }
        public function closeConnection(){
            $this->connessione->close();
        }
        public function isConnected(){
            if($this->connessione->connect_errno){
                return false;
            }
            else{
                return true;
            }
        }
 }
