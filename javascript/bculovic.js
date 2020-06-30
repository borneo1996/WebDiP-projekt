
var znakovi = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
var brojZnakova = znakovi.length;
var uvjetiKoristenja = getCookie("prihvaceniUvjeti");
if(uvjetiKoristenja == ""){
    if(confirm("Prihvatite uvjete korištenja i bilježenja kolačića.")){
        console.log("Prihvaceno");
        var age = 2*60*60*24;
        var maxage = "max-age="+age;
        var kolac = "prihvaceniUvjeti";
        document.cookie = kolac+"=true;"+maxage+";path=/";
    }
}
onLoad();
var imeProvjera = false;
var prezimeProvjera = false;
var emailProvjera = false;
var passwordProvjera = false;
var korisnickoimeProvjera = false;
var captchaProvjera = false;

var brojevi = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];


function onLoad() {
    if (document.title === "Registracija") {
        disable_registrirajBtn();
        document.getElementById("formname").addEventListener("input", provjeraImena);
        document.getElementById("formpname").addEventListener("input", provjeraPrezimena);
        document.getElementById("formusername").addEventListener("input", provjeraKorisnickogImena);
        document.getElementById("formmail").addEventListener("input", provjeraMaila);
        document.getElementById("formpassword").addEventListener("input", provjeraPassworda);
        document.getElementById("formpassword2").addEventListener("input", provjeraPassworda);
        document.getElementById("captcha").addEventListener("input", provjeraCaptcha);
        setCaptcha();
    } else if (document.title === "Početna - ADMIN") {
        
    }

}

function brisiKolacicUvjeta(){
    document.cookie = "prihvaceniUvjeti= ; expires = Thu, 01 Jan 2000 00:00:00 GMT; path=/";
    console.log("Obrisan");

}

function getCookie(cookieName) {
    var name = cookieName + "=";
    var cookiePolje = document.cookie.split(';');
    for(var i = 0; i < cookiePolje.length; i++) {
      var cook = cookiePolje[i];
      while (cook.charAt(0) == ' ') {
        cook = cook.substring(1);
      }
      if (cook.indexOf(name) == 0) {
        return cook.substring(name.length, cook.length);
      }
    }
    return "";
  }



function provjeraImena() {
    var unos = document.getElementById("formname").value;
    if (unos.length < 3) {
        document.getElementById("formname").style.borderColor = "red";
        imeProvjera = false;
        document.getElementById("porukica").innerHTML = "Ime je prekratko.";
    } else {
        document.getElementById("formname").style.borderColor = null;
        imeProvjera = true;
        document.getElementById("porukica").innerHTML = "";
    }
    var duzinaUnosa = unos.length;
    for (var i = 0; i < duzinaUnosa; i++) {
        if (isNaN(unos[i])) {
            document.getElementById("porukica").innerHTML = "";
        } else {
            document.getElementById("formname").style.borderColor = "red";
            imeProvjera = false;
            document.getElementById("porukica").innerHTML = "Ime ne može sadržavati brojeve.";
        }
    }

    provjeraForme();
}

function provjeraPrezimena() {
    var unos = document.getElementById("formpname").value;
    if (unos.length < 3) {
        document.getElementById("formpname").style.borderColor = "red";
        prezimeProvjera = false;
        document.getElementById("porukica").innerHTML = "Prezime je prekratko.";
        
    } else {
        document.getElementById("formpname").style.borderColor = null;
        prezimeProvjera = true;
        document.getElementById("porukica").innerHTML = "";
    }

    var duzinaUnosa = unos.length;
    for (var i = 0; i < duzinaUnosa; i++) {
        if (isNaN(unos[i])) {
            document.getElementById("porukica").innerHTML = "";
        } else {
            document.getElementById("formpname").style.borderColor = "red";
            prezimeProvjera = false;
            console.log("Prezime ne može sadržavati brojeve.");
            document.getElementById("porukica").innerHTML = "Prezime ne može sadržavati brojeve!";
        }
    }
    provjeraForme();
}

function provjeraKorisnickogImena() {
    var unos = document.getElementById("formusername").value;
    if (unos.length < 6) {
        document.getElementById("formusername").style.borderColor = "red";
        korisnickoimeProvjera = false;
        document.getElementById("porukica").innerHTML = "Korisničko ime je prekratko.";
    } else {
        document.getElementById("formusername").style.borderColor = null;
        korisnickoimeProvjera = true;
        document.getElementById("porukica").innerHTML = "";
    }
    var duzinaUnosa = unos.length;
    var brojUUseru = broj_u_stringu(unos);
    if (!brojUUseru) {
        korisnickoimeProvjera = false;
        document.getElementById("formusername").style.borderColor = "red";
        document.getElementById("porukica").innerHTML = "Korisničko ime mora sadržavati barem jedan broj.";
    } else {
        document.getElementById("porukica").innerHTML = "";
    }

    if (duzinaUnosa < 6) {
        document.getElementById("porukica").innerHTML = "Korisničko ime je prekratko.";
        korisnickoimeProvjera = false;
        document.getElementById("formusername").style.borderColor = "red";
    }else {
        document.getElementById("porukica").innerHTML = "";
    }

    provjeraForme();
}

function provjeraMaila() {
    var unos = document.getElementById("formmail").value;
    document.getElementById("formmail").style.borderColor = null;
    emailProvjera = true;
    if (unos[0] == ".") {
        document.getElementById("formmail").style.borderColor = "red";
        emailProvjera = false;
        document.getElementById("porukica").innerHTML = "Točka ne može stajati na prvom mjestu!";
    }else {
        document.getElementById("porukica").innerHTML = "";
    }
    var duzinaUnosa = unos.length;

    for (var i = 0; i < duzinaUnosa; i++) {
        if (unos[i] === ".") {
            if (unos[i + 1] === ".") {
                document.getElementById("formmail").style.borderColor = "red";
                emailProvjera = false;
                document.getElementById("porukica").innerHTML ="Dvije točke ne mogu biti uzastopne u mailu.";
            }
            else {
                document.getElementById("porukica").innerHTML = "";
            }
        }
    }

    var mjestoMonkeya = unos.indexOf("@");
    var brojMonkeya = unos.split("@").length - 1;
    if (mjestoMonkeya === -1) {
        document.getElementById("porukica").innerHTML = "Fali @!";
        document.getElementById("formmail").style.borderColor = "red";
        emailProvjera = false;
    } else if (mjestoMonkeya < 4) {
        document.getElementById("porukica").innerHTML = "Znak @ mora biti na barem 5. mjestu.";
        document.getElementById("formmail").style.borderColor = "red";
        emailProvjera = false;
    } else {
        document.getElementById("porukica").innerHTML = "";
    }

    if (brojMonkeya !== 1) {
        document.getElementById("porukica").innerHTML = "Znak @ mora biti na samo jednom mjestu u adresi!";
        document.getElementById("formmail").style.borderColor = "red";
        emailProvjera = false;
    } else {
        document.getElementById("porukica").innerHTML = "";
    }
    var hr = unos[duzinaUnosa - 3] + unos[duzinaUnosa - 2] + unos[duzinaUnosa - 1];
    var com = unos[duzinaUnosa - 4] + unos[duzinaUnosa - 3] + unos[duzinaUnosa - 2] + unos[duzinaUnosa - 1];
    console.log(hr);
    console.log(com);
    if (hr == ".hr" || com == ".com") {
        document.getElementById("formmail").style.borderColor = null;
        emailProvjera = true;
        document.getElementById("porukica").innerHTML = "";
    } else {
        document.getElementById("porukica").innerHTML = "Email mora završavati na .hr ili .com";
        document.getElementById("formmail").style.borderColor = "red";
        emailProvjera = false;
    }
    if (emailProvjera) {
        console.log("Dobra");
    }
    provjeraForme();
}

function provjeraPassworda() {
    var unos = document.getElementById("formpassword").value;
    var unos2 = document.getElementById("formpassword2").value;
    passwordProvjera = true;
    document.getElementById("formpassword").style.borderColor = null;
    document.getElementById("formpassword2").style.borderColor = null;
    var duzinaUnosa = unos.length;

    if (duzinaUnosa < 8) {
        passwordProvjera = false;
        document.getElementById("porukica").innerHTML = "Password mora imati barem 8 znamenki.";
        document.getElementById("formpassword").style.borderColor = "red";
    } else if (unos !== unos2) {
        document.getElementById("formpassword").style.borderColor = null;
        document.getElementById("formpassword2").style.borderColor = null;
        passwordProvjera = false;
        document.getElementById("porukica").innerHTML = "Ponovljena lozinka nije ista kao i lozinka.";
        document.getElementById("formpassword").style.borderColor = "red";
        document.getElementById("formpassword2").style.borderColor = "red";
    } else {
        document.getElementById("porukica").innerHTML = "";
    }
    provjeraForme();

}

function provjeraCaptcha() {
    var unos = document.getElementById("captcha").value;
    var captcha = document.getElementById("captcha_text").value;
    document.getElementById("captcha").style.borderColor = null;
    captchaProvjera = true;
    if (unos !== captcha) {
        document.getElementById("captcha").style.borderColor = "red";
        captchaProvjera = false;
    } else {
        document.getElementById("captcha").style.borderColor = "green";
    }

    provjeraForme();
}

function broj_u_stringu(tekst) {
    for (var i = 0; i < tekst.length; i++) {
        if (!isNaN(tekst[i])) {
            return true;
        }
    }
    return false;
}

function provjeraForme() {
    if (prezimeProvjera && imeProvjera && korisnickoimeProvjera && emailProvjera && passwordProvjera && captchaProvjera) {
        enable_registrirajBtn();
    } else {
        disable_registrirajBtn();
    }
}

function setCaptcha() {
    var captcha = "";
    for (var i = 0; i < 7; i++) {
        var randbroj = randomBroj();
        captcha += znakovi[randbroj];
    }
    document.getElementById("captcha_text").value = captcha;
    document.getElementById("captcha_text").disabled = true;

}

function randomBroj() {
    var broj = Math.random() * (brojZnakova);
    return parseInt(broj);
}

function disable_registrirajBtn() {
    var registrirajBtn = document.getElementById("registrirajBtn");
    registrirajBtn.disabled = true;
}

function enable_registrirajBtn() {
    var registrirajBtn = document.getElementById("registrirajBtn");
    registrirajBtn.disabled = false;
}
