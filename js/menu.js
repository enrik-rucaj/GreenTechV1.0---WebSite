function caricamentoProdotti(){
  document.addEventListener('click',controllaDialogo)
    var uls=document.querySelectorAll(".products");
    Array.prototype.slice.call(uls).forEach(function(ul){
        ul.addEventListener('click',aggiungiCarrello)
      });

      var apriDescs=document.querySelectorAll(".apri_descrizione");
      Array.prototype.slice.call(apriDescs).forEach(function(aD){
        aD.addEventListener('click',apriDescrizione)
      });
  }

  function controllaDialogo(evt){
    if(!(evt.target.className=='apri_descrizione' || evt.target.className=='popUp' || evt.target.parentNode.className=='popUp') || evt.target.value=="Chiudi"){
      var dialogs=document.querySelectorAll(".popUp");
      Array.prototype.slice.call(dialogs).forEach(function(dialog){
        if(! dialog.classList.contains('nascosto')){
          dialog.classList.add('nascosto');
        }
    })
    }
    
  }

  function apriDescrizione(evt){
    if(evt.target.nodeName=="IMG")
      var idProdotto=evt.target.parentNode.nextElementSibling.value;
    else{
      var idProdotto=evt.target.nextElementSibling.value;
    }
    dialogToOpen=document.getElementById("dettagli"+idProdotto);
    dialogToOpen.classList.remove('nascosto');  
    var dialogs=document.querySelectorAll(".popUp");
    Array.prototype.slice.call(dialogs).forEach(function(dialog){
        if(dialog.id!=dialogToOpen.id)
        if(! dialog.classList.contains('nascosto')){
          dialog.classList.add('nascosto');
        }
    })
    
  }
function aggiungiCarrello(evt){
    if(evt.target.defaultValue=="Aggiungi al carrello"){
        var pre=evt.target.previousElementSibling;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            confermaAggiunta=document.getElementById("conferma_aggiunta_carrello");
            scrittaConferma=document.getElementById("scritta_conferma");
            scrittaConferma.innerHTML=this.responseText;
            confermaAggiunta.classList.remove("nascosto");
          }
        };
        xmlhttp.open("GET","inserisciCarrello.php?id="+pre.value);
        xmlhttp.send();
      }
}

function caricamentoPagamento(){
  var buttons=document.getElementsByTagName("input");
  for(let i=0;i<buttons.length;i++){
    var button=buttons.item(i);
   if(button.type=="radio") {
    if(button.className=="metodo_pagamento")
      button.addEventListener('click',sceltaPagamento);
    else if(button.classList.contains("radio_indirizzo_spedizioni")){
      button.addEventListener('click',sceltaMetodoSpedizione);
    }
   }
  } 
  for(var key in nuovo_indirizzo){
    var input = document.getElementById(key);
    campoDefault(input);
    input.onfocus = function(){campoPerInput(this);};
    input.onblur = function(){validaCampoNuovoIndirizzo(this);};
  }
}

function controllaPagamento(){
  var indirizzoUtenteRadioChecked=document.getElementById("info_spedizione1").checked;
  var indirizzoNuovoRadioChecked=document.getElementById("info_spedizione2").checked;
  if(!indirizzoUtenteRadioChecked && !indirizzoNuovoRadioChecked){
    var Indirizzo_spedizione_errore=document.getElementById("Indirizzo_spedizione_errore");
    Indirizzo_spedizione_errore.classList.remove("nascosto");
    Indirizzo_spedizione_errore.classList.add("visibile");
    return false;
  }
  if(indirizzoNuovoRadioChecked){
    if(!validaNuovoIndirizzo())
      return false;
  }
  var cartaCreditoRadioChecked=document.getElementById("carta_credito").checked;
  var contrassegnoRadioChecked=document.getElementById("contrassegno").checked;
  if(!cartaCreditoRadioChecked && !contrassegnoRadioChecked){
    var sceltaPagamentoErrore=document.getElementById("Scelta_pagamento_errore");
    sceltaPagamentoErrore.classList.remove("nascosto");
    sceltaPagamentoErrore.classList.add("visibile");
    return false;
  }
  if(cartaCreditoRadioChecked){
    var carteUtente= document.querySelectorAll(".card_option");
    var nuovaCarta=document.getElementById("pagamento_registra_carta");
    var cartaSelezionata=false;
    Array.prototype.slice.call(carteUtente).forEach(function(cartaUtente){
      if(cartaUtente.checked)
        cartaSelezionata=true;
  })
  if(!cartaSelezionata && !nuovaCarta.checked){
    return false;
  }
  if(nuovaCarta.checked)
    if(!validaCarta())
      return false;
  }
  
  return true;
}

function campoDefault(input){
  if(input){
    input.className = "defaulttext";
    input.value = nuovo_indirizzo[input.id][0];
  }
  
}
function campoPerInput(input){
  if(input.value == nuovo_indirizzo[input.id][0]) {
    input.value = "";
    input.className= "";
  }
}

var nuovo_indirizzo={
  "nome" : ["Nome del destinatario",/^[a-zA-Z]{1,20}$/,"Inserire un nome di lunghezza almeno 2 e non contenente numeri"],
  "cognome" : ["Cognome del destinatario",/^[a-zA-Z]{1,20}$/,"Inserire un cognome di lunghezza almeno 2 e non contenente numeri"],
  "Via" : ["Via del destinatario",/^[a-zA-Z0-9 ]{1,30}$/,"Inserire via"],
  "civico" : ["Civico",/^[0-9]{1,3}([a-z]?)$/,"Inserire civico valido"],
  "Cap":["CAP",/^[0-9]{5}$/,"Inserire CAP valido"],
}
function validaNuovoIndirizzo(){
for(var key in nuovo_indirizzo){
var input = document.getElementById(key);
if(!validaCampoNuovoIndirizzo(input)){
  input.focus();
  return false;
}
}
return true;
}

function validaCampoNuovoIndirizzo(input){
if(input.nextElementSibling)
if(input.nextElementSibling.id==(input.id+"Error")){
  var errore=document.getElementById(input.id+"Error");
  errore.remove();
  input.removeAttribute("aria-describedby");
  input.className = "";
}
var regex = nuovo_indirizzo[input.id][1];
var text = input.value;
if ((text == nuovo_indirizzo[input.id][0] || text.search(regex) != 0)){
mostraErroreNuovoIndirizzo(input);
input.className = "nonvalido";
return false;
}
input.setAttribute("aria-invalid",false);
input.className = "valido"
return true;
}

function mostraErroreNuovoIndirizzo(input){
  if(!document.getElementById(input.id+"Error")){
    var e = document.createElement("strong");
    e.className = "error_suggestion";
    e.id=input.id+"Error";
    e.appendChild(document.createTextNode(nuovo_indirizzo[input.id][2]));
    input.insertAdjacentElement("afterend",e);
    input.setAttribute("aria-describedby",e.id);
    input.setAttribute("aria-invalid",true);
    }
}


function sceltaPagamento(evt){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("aggiungi_carte").innerHTML = this.responseText;
      for(var key in carte_form){
        var input = document.getElementById(key);
        if(input)
          input.onblur = function(){validaCampo(this);};
      }
      var carteRadio=document.querySelectorAll(".card_option");
      Array.prototype.slice.call(carteRadio).forEach(function(cartaRadio){
        if(cartaRadio.name="carta_registrata"){
          cartaRadio.onchange=function(){if(cartaRadio.checked){
            for(var key in carte_form){
              var input = document.getElementById(key);
              input.value="";
              input.removeAttribute("aria-describedby");
              input.setAttribute("aria-invalid",false);
              input.className="";
              if(document.getElementById(input.id+"Error")){
                errore=document.getElementById(input.id+"Error");
                errore.remove();
              }
            }
            document.getElementById("nuova_carta").className="nascosto"
          }};
        }
      })
      if(document.getElementById("pagamento_registra_carta")){
        document.getElementById("pagamento_registra_carta").onchange=
      function(){
        if(document.getElementById("pagamento_registra_carta").checked)
          document.getElementById("nuova_carta").className="visibile";
              ;};
      }
      
    }
  };
  if(evt.target.id=='carta_credito')
  {
    document.getElementById("aggiungi_carte").className="visibile";
    document.getElementById("tariffa").innerHTML="";
    xmlhttp.open("GET","gestionePagamento.php?pagamento="+evt.target.id);
    xmlhttp.send();
    document.getElementById("tariffa").classList.add("nascosto");
    document.getElementById("tariffa").classList.remove("visibile");
  }
  else if(evt.target.id=='contrassegno')
  {
    document.getElementById("aggiungi_carte").className="nascosto";
    document.getElementById("tariffa").classList.remove("nascosto")
    document.getElementById("tariffa").classList.add("visibile");
    document.getElementById("tariffa").innerHTML = "Il pagamento con contrassegno prevede l'aggiunta di una tarfiffa supplementare di <strong>3&euro;</strong>";
    document.getElementById("aggiungi_carte").innerHTML = "";
  }
}

function sceltaMetodoSpedizione(evt){
  var nuovoIndirizzo=document.getElementById("nuovo_indirizzo");
    
  if(evt.target.id=="info_spedizione2"){
    nuovoIndirizzo.classList.add("visibile"); 
    nuovoIndirizzo.classList.remove("nascosto");   
  }else{
    for(var key in nuovo_indirizzo){
      var input = document.getElementById(key);
      campoDefault(input);
      if(document.getElementById(input.id+"Error")){
        errore=document.getElementById(input.id+"Error");
        errore.remove();
        input.removeAttribute("aria-describedby");
        input.setAttribute("aria-invalid",false);
      }
    }
    
    nuovoIndirizzo.classList.add("nascosto"); 
    nuovoIndirizzo.classList.remove("visibile");   
  }
}

var carte_form={
  "titolare" : [/^[a-zA-Z ]{1,40}$/,"Inserire un nome di lunghezza almeno 2 e non contenente numeri"],
  "numeroCarta" : [/^(?:4[0-9]{12}(?:[0-9]{3})?|(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12})$/,"Inserire un numero di carta esistente"], //regex per carte visa o mastercard
  "dataCarta" : [/\d{4}\-\d{2}/,"Inserire data di scadenza valida"],
  "cvv" : [/^[0-9]{3,4}$/,"Inserire cvv valido"],
}


function  caricamentoCarte(){
  var eliminaButtons = document.getElementsByName("eliminaCarta");
  Array.prototype.slice.call(eliminaButtons).forEach(function(eliminaButton){
    eliminaButton.addEventListener('click',eliminaCarta);
  });
  for(var key in carte_form){
    var input = document.getElementById(key);
    input.onblur = function(){validaCampo(this);};
  }
  var registraNuovaCartaButton=document.getElementById("registra_nuova_carta_button");
  registraNuovaCartaButton.onclick=function(){mostraFormRegistraNuovaCarta()};
  var annullaNuovaCarta=document.getElementById("annulla_nuova_carta");
  annullaNuovaCarta.onclick=function(){nascondiFormRegistraNuovaCarta()}
}

function mostraFormRegistraNuovaCarta(){
  var formNuovaCarta=document.getElementById("registra_carta");
  formNuovaCarta.className="visibile";
  var registraNuovaCartaButton=document.getElementById("registra_nuova_carta_button");
  registraNuovaCartaButton.classList.add("nascosto");
  registraNuovaCartaButton.classList.remove("visibile");
}

function nascondiFormRegistraNuovaCarta(){
  for(var key in carte_form){
    var input = document.getElementById(key);
    input.value="";
    input.removeAttribute("aria-describedby");
    input.setAttribute("aria-invalid",false);
    input.className="";
    if(document.getElementById(input.id+"Error")){
      errore=document.getElementById(input.id+"Error");
      errore.remove();
    }
  }
  var formNuovaCarta=document.getElementById("registra_carta");
  formNuovaCarta.className="nascosto";
  var registraNuovaCartaButton=document.getElementById("registra_nuova_carta_button");
  registraNuovaCartaButton.classList.add("visibile");
  registraNuovaCartaButton.classList.remove("nascosto");
}

function eliminaCarta(evt){
  var numeroCarta=evt.target.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.innerHTML;
  window.alert(numeroCarta);
}


function validaCampo(input){
  if(input.nextElementSibling)
    if(input.nextElementSibling.id==(input.id+"Error")){
      var errore=document.getElementById(input.id+"Error");
      errore.remove();
      input.removeAttribute("aria-describedby");
      input.className = "";
    }
  var regex = carte_form[input.id][0];
  var text = input.value;
  if (input.id == "numeroCarta"){
    text = text.replace(/\s+/g, '');
  }
  if ((text.search(regex) != 0)){
    mostraErrore(input);
    input.className = "nonvalido";
    return false;
  }
  input.setAttribute("aria-invalid",false);
  input.className = "valido"
  return true;
}

function mostraErrore(input){
  if(!document.getElementById(input.id+"Error")){
  var e = document.createElement("strong");
  e.className = "error_suggestion";
  e.id=input.id+"Error";
  e.appendChild(document.createTextNode(carte_form[input.id][1]));
  input.insertAdjacentElement("afterend",e);
  input.setAttribute("aria-describedby",e.id);
  input.setAttribute("aria-invalid",true);
  }
}

function validaCarta(){
  for(var key in carte_form){
    var input = document.getElementById(key);
    if(!validaCampo(input)){
      input.focus();
      return false;
    }
  }
  if(document.getElementById("registra_carta")&&document.getElementById("registra_nuova_carta_button")){
    var formNuovaCarta=document.getElementById("registra_carta");
    formNuovaCarta.className="nascosto";
    var registraNuovaCartaButton=document.getElementById("registra_nuova_carta_button");
    registraNuovaCartaButton.className="visibile";
  }
  return true;
  
}

function addSpaces(input) {
  const result = input.value.match(/\d{1,4}/g);
  input.value = result.join(' ');
}

function onlyNumbers(input) {
  input.value = input.value.replace(/[^0-9]/, '');
}

function onlyLetters(input) {
  input.value = input.value.replace(/[^a-zA-Z ]/, '');
}
