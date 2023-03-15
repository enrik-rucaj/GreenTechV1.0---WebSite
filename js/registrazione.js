
    var regexCF=/^(?:[A-Z][AEIOU][AEIOUX]|[AEIOU]X{2}|[B-DF-HJ-NP-TV-Z]{2}[A-Z]){2}(?:[\dLMNP-V]{2}(?:[A-EHLMPR-T](?:[04LQ][1-9MNP-V]|[15MR][\dLMNP-V]|[26NS][0-8LMNP-U])|[DHPS][37PT][0L]|[ACELMRT][37PT][01LM]|[AC-EHLMPR-T][26NS][9V])|(?:[02468LNQSU][048LQU]|[13579MPRTV][26NS])B[26NS][9V])(?:[A-MZ][1-9MNP-V][\dLMNP-V]{2}|[A-M][0L](?:[1-9MNP-V][\dLMNP-V]|[0L][1-9MNP-V]))[A-Z]$/i;
    var campi_form = {
      "nome" : ["Nome dell'utente",/^[a-zA-Z ]{1,20}$/,"Inserire un nome di lunghezza almeno 2 e non contenente numeri"],
      "cognome" : ["Cognome dell'utente",/^[a-zA-Z]{1,20}$/,"Inserire un cognome di lunghezza almeno 2 e non contenente numeri"],
      "cf" : ["Codice fiscale",regexCF,"Inserire un codice fiscale valido"],
      "data_nascita" : ["Data di nascita",/\d{4}\-\d{2}\-\d{2}/,"Devi essere maggiorenne"],
      "via" : ["Via di residenza",/^[a-zA-Z0-9 ]{1,30}$/,"Inserire via"],
      "civico" : ["Civico",/^[0-9]{1,3}([a-zA-Z]?)$/,"Inserire civico valido"],
      //"comune" : ["Comune di residenza",/.{1,}/,"Inserire comune di residenza"],
      "email" : ["esempio@email.com",/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g,"Inserire email valida"],
      "registra_password" : ["",/.{1,10}$/,"Inserire password lunga meno di 10 caratteri"],
      "cap":["CAP",/^[0-9]{5}$/,"Inserire CAP valido"],
      "ripeti_password":["",/.{1,10}$/,"Reinserire la password"]
      };
      function caricamento(){
        for(var key in campi_form){
          var input = document.getElementById(key);
          campoDefault(input);
          input.onfocus = function(){campoPerInput(this);};
          input.onblur = function(){validaCampo(this);};
        }
      }

      function campoDefault(input){
        if(input){
          input.className = "defaulttext";
          input.value = campi_form[input.id][0];
        }
        
      }
      function campoPerInput(input){
        if(input.value == campi_form[input.id][0]) {
          input.value = "";
          input.className= "";
        }
      }

      function validaCampo(input){
        if(input.nextElementSibling)
          if(input.nextElementSibling.id==(input.id+"Error")){
            var errore=document.getElementById(input.id+"Error");
            errore.remove();
            input.removeAttribute("aria-describedby");
            input.className = "";
          }
        var regex = campi_form[input.id][1];
        var text = input.value;
        if(input.id ==="data_nascita" && !(text=="")){
          if(checkDOB(text)==false)
            {
              mostraErrore(input);
              input.className = "nonvalido";
              return false;
            }
        }
        if(input.id === "ripeti_password"){
          if(input.value != document.getElementById("registra_password").value){
            mostraErrore(input);
            input.className = "nonvalido";
            return false;
          }
        }

        if ((text == campi_form[input.id][0] || text.search(regex) != 0)){
          mostraErrore(input);
          input.className = "nonvalido";
          return false;
        }
        input.setAttribute("aria-invalid",false)
        input.className = "valido"
        return true;
      }
function validateForm() {
  for(var key in campi_form){
    var input = document.getElementById(key);
    if(!validaCampo(input)){
      input.focus();
      return false;
    }
    
  }
  return true;
  }

  function mostraErrore(input){
    if(!document.getElementById(input.id+"Error")){
    var e = document.createElement("strong");
    e.className = "error_suggestion";
    e.id=input.id+"Error";
    e.appendChild(document.createTextNode(campi_form[input.id][2]));
    input.insertAdjacentElement("afterend",e);
    input.setAttribute("aria-describedby",e.id);
    input.setAttribute("aria-invalid",true);
    }
  }
  function checkDOB(sd){
    let DOBsplit = sd.split('-');
    let dataCorrente = new Date();
    let anno = parseInt(DOBsplit[0],10);
    let annoCorrente = dataCorrente.getFullYear();
    let meseCorrente = dataCorrente.getMonth()+1;
    let giornoCorrente = dataCorrente.getDate();
    let mese = ( DOBsplit[1][0] === '0') ? parseInt(DOBsplit[1][1], 10) : parseInt(DOBsplit[1], 10);
    let giorno = ( DOBsplit[2][0] === '0') ? parseInt(DOBsplit[2][1], 10) : parseInt(DOBsplit[2], 10);
    if( anno >= annoCorrente) {
        return false;
    }

    if( (annoCorrente - anno) < 18) {
        return false;
    }
    if( (annoCorrente - anno) == 18 ) {
        if( meseCorrente<mese){
            return false;
        }
        if(meseCorrente == mese && giornoCorrente < giorno) {
            return false;
            
        }
    }
    return true;
  }


  function validaLogin(){
    
    var email = document.getElementById("utente");
    var password = document.getElementById("password");
    var loginVuoto=document.getElementById("loginVuoto");
    
    if(email.value == "" || password.value == ""){
      if(!loginVuoto){
        p=email.parentNode;
        var empty=document.createElement("strong");
        empty.className="error_suggestion";
        empty.id="loginVuoto";
        empty.appendChild(document.createTextNode("Campo utente o password vuoti"));
        p.appendChild(empty);
      }
        return false;
    }
    return true;
}

function cancellaErroreLogin(){
  var loginVuoto=document.getElementById("loginVuoto");
  if(loginVuoto)
    document.getElementById("loginVuoto").remove();
}

var dati_utente={
      "nome" : ["Nome dell'utente",/^[a-zA-Z]{1,20}$/,"Inserire un nome di lunghezza almeno 2 e non contenente numeri"],
      "cognome" : ["Cognome dell'utente",/^[a-zA-Z]{1,20}$/,"Inserire un cognome di lunghezza almeno 2 e non contenente numeri"],
      "cf" : ["Codice fiscale",regexCF,"Inserire un codice fiscale valido"],
      "data_nascita" : ["Data di nascita",/\d{4}\-\d{2}\-\d{2}/,"Devi essere maggiorenne"],
      "via" : ["Via di residenza",/^[a-zA-Z0-9 ]{1,30}$/,"Inserire via"],
      "civico" : ["Civico",/^[0-9]{1,3}([a-z]?)$/,"Inserire civico valido"],
      "cap":["CAP",/^[0-9]{5}$/,"Inserire CAP valido"],
      "vecchiaPassword":["",/.{0,10}$/,"Inserire Password vecchia"],
      "nuovaPassword":["",/.{0,10}$/,"Inserire password lunga meno di 11 caratteri"]
      
}

var password={
  
}
function modificaDatiUtente(){
  var datiUtente=document.getElementById("datiUtente");
  datiUtente.className="nascosto";
  var formModifica=document.getElementById("formModifica");
  formModifica.className="visibile";
  for(var key in dati_utente){
    var input = document.getElementById(key);
    var campo = document.getElementById(key+"Utente");
    if(campo)
      input.value=campo.innerHTML;
  }
}

function validaModifica(){
  for(var key in dati_utente){
    var input = document.getElementById(key);
    if(!validaCampoModifica(input)){
      input.focus();
      return false;
    }
  }
  return true;
}
function validaCampoModifica(input){
  if(input.nextElementSibling)
          if(input.nextElementSibling.id==(input.id+"Error")){
            var errore=document.getElementById(input.id+"Error");
            errore.remove();
            input.removeAttribute("aria-describedby");
            input.className = "";
          }
        var regex = dati_utente[input.id][1];
        var text = input.value;
        if(text=="" && input.id!="vecchiaPassword" && input.id!="nuovaPassword")
        {
          input.value=document.getElementById(input.id+"Utente").innerHTML;
        }else{
          if(input.id ==="data_nascita" && !(text=="")){
            if(checkDOB(text)==false)
              {
                mostraErroreModifica(input);
                input.className = "nonvalido";
                return false;
              }
          }
          if(input.id == "vecchiaPassword" || input.id=="nuovaPassword"){
            if(document.getElementById("vecchiaPassword").value=="" && document.getElementById("nuovaPassword").value=="")
              return true;
          }
          if ((text == dati_utente[input.id][0] || text.search(regex) != 0)){
            mostraErroreModifica(input);
            input.className = "nonvalido";
            return false;
          }
        }
        
        input.setAttribute("aria-invalid",false)
        input.className = "valido"
        return true;
}


function mostraErroreModifica(input){
  if(!document.getElementById(input.id+"Error")){
    var e = document.createElement("strong");
    e.className = "error_suggestion";
    e.id=input.id+"Error";
    e.appendChild(document.createTextNode(dati_utente[input.id][2]));
    input.insertAdjacentElement("afterend",e);
    input.setAttribute("aria-describedby",e.id);
    input.setAttribute("aria-invalid",true);
    }
}
function caricamentoModifica(){
  for(var key in dati_utente){
    var input = document.getElementById(key);
    input.onblur = function(){validaCampoModifica(this);};
  }
  
}


function makeUppercase(input) {
  input.value = input.value.toUpperCase();
}


function annullaModifica(){
  var datiUtente=document.getElementById("datiUtente");
  datiUtente.className="visibile";
  var formModifica=document.getElementById("formModifica");
  formModifica.className="nascosto";
  for(var key in dati_utente){
    var input = document.getElementById(key);
    input.className="";
    input.value="";
    input.removeAttribute("aria-describedby");
    input.setAttribute("aria-invalid",false);
    if(document.getElementById(input.id+"Error")){
      errore=document.getElementById(input.id+"Error");
      errore.remove();
    }
  }
}

function onlyNumbers(input) {
  input.value = input.value.replace(/[^0-9]/, '');
}
