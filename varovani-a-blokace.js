// JavaScript Document
function Jmeno_Varovani() {
  var Hodnota = document.Forum.jmeno.value;
  if  (Hodnota == "")
    alert("Své jméno uveďte.");    
}

function Zprava_Varovani() {
  var Hodnota = document.Forum.zprava.value;
  if  (Hodnota == "")
    alert("Nenapsali jste žádnou zprávu.");    
}

function Email_Varovani() {
  var HodnotaEmailu = document.Forum.email.value;
  var Vzor = /^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/;
  
  if  (HodnotaEmailu == "")
    alert("Svůj e-mail uveďte.");
  else {   
    if ((Vzor.test(HodnotaEmailu)) == 0) 
      alert("Zadali jste špatně svůj email.");
  }    
}

function Email_Blokace()
{
  var HodnotaEmailu = document.Forum.email.value;
  var Vzor = /^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/;
  
  if  (HodnotaEmailu == "") {
    alert("Pro zápis do fóra, musíte nejprve zadat Vaši e-mailovou adresu.");
    document.Forum.email.focus();
  } 
  else {
    if ((Vzor.test(HodnotaEmailu)) == 0) {
      alert("Vaši e-mailovou adresu jste zadal s chybou. Prosím, zkontroluje si ji.");
      document.Forum.email.focus();
    }
  }
}   
