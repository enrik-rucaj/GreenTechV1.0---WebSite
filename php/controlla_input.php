<?php
function sanitize($nonSanificato){
    $sanificato = htmlentities($nonSanificato, ENT_QUOTES, "UTF-8");
    $sanificato = trim($sanificato);
    $sanificato = strip_tags($sanificato);
    return $sanificato;
}

function controllaNome($nome)

{ 
   return preg_match('/^[a-zA-Z]{1,20}$/', sanitize($nome)); 

} 

function controllaCognome($cognome)
{
    return preg_match('/^[a-zA-Z]{1,20}$/', sanitize($cognome));

}

function controllaVia($via)
{
    return preg_match('/^[a-zA-Z0-9 ]{1,30}$/', sanitize($via));  
}

function controllaCivico($civico)
{

    return preg_match('/^[a-zA-Z0-9\-]{1,6}$/', sanitize($civico));
}

function controllaCap($cap)
{
    return preg_match('/^[0-9]{5}$/', sanitize($cap));
}

/*function controllaComune($comune)
{

    return preg_match('/^[a-zA-Z]$/', sanitize($comune));
}
*/

function controllaDataNascita($data)
{
    return preg_match('/^\d{4}\-\d{2}\-\d{2}$/', sanitize($data));
}

function controllaCf($cf)
{
    return preg_match('/^(?:[A-Z][AEIOU][AEIOUX]|[AEIOU]X{2}|[B-DF-HJ-NP-TV-Z]{2}[A-Z]){2}(?:[\dLMNP-V]{2}(?:[A-EHLMPR-T](?:[04LQ][1-9MNP-V]|[15MR][\dLMNP-V]|[26NS][0-8LMNP-U])|[DHPS][37PT][0L]|[ACELMRT][37PT][01LM]|[AC-EHLMPR-T][26NS][9V])|(?:[02468LNQSU][048LQU]|[13579MPRTV][26NS])B[26NS][9V])(?:[A-MZ][1-9MNP-V][\dLMNP-V]{2}|[A-M][0L](?:[1-9MNP-V][\dLMNP-V]|[0L][1-9MNP-V]))[A-Z]$/i', sanitize($cf));
}

function controllaEmail($email)
{
    return preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', sanitize($email));
}

function controllaPassword($psw)
{
    return preg_match('/.{1,10}$/', sanitize($psw));
}

function controllaTitolareCarta($titolare)
{
    return preg_match('/[a-zA-Z ]{1,30}$/', sanitize($titolare));
}

function controllaCvv($cvv)
{
    return preg_match('/[0-9]{3,4}$/', sanitize($cvv));
}

function controllaDataCarta($data)
{
    return preg_match('/^\d{4}\-\d{2}$/', sanitize($data));
}

function controllaNumerocarta($numero)
{
    return preg_match('/^(?:4[0-9]{12}(?:[0-9]{3})?|(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12})$/', sanitize($numero));
}
?>