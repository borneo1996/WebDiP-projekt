
var znakovi = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
var brojZnakova = znakovi.length;
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
        document.getElementById("formname").addEventListener("change", provjeraImena);
        document.getElementById("formpname").addEventListener("change", provjeraPrezimena);
        document.getElementById("formusername").addEventListener("change", provjeraKorisnickogImena);
        document.getElementById("formmail").addEventListener("change", provjeraMaila);
        document.getElementById("formpassword").addEventListener("change", provjeraPassworda);
        document.getElementById("formpassword2").addEventListener("change", provjeraPassworda);
        document.getElementById("captcha").addEventListener("change", provjeraCaptcha);
        setCaptcha();
    }
}

function provjeraImena() {
    var unos = document.getElementById("formname").value;
    if (unos.length < 3) {
        document.getElementById("formname").style.borderColor = "red";
        imeProvjera = false;
        console.log("Ime je prekratko.");
    } else {
        document.getElementById("formname").style.borderColor = null;
        imeProvjera = true;

    }
    var duzinaUnosa = unos.length;
    for (var i = 0; i < duzinaUnosa; i++) {
        if (isNaN(unos[i])) {

        } else {
            document.getElementById("formname").style.borderColor = "red";
            imeProvjera = false;
            console.log("Ime ne može sadržavati brojeve.");
        }
    }

    provjeraForme();
}

function provjeraPrezimena() {
    var unos = document.getElementById("formpname").value;
    if (unos.length < 3) {
        document.getElementById("formpname").style.borderColor = "red";
        prezimeProvjera = false;
        console.log("Prezime je prekratko.");
    } else {
        document.getElementById("formpname").style.borderColor = null;
        prezimeProvjera = true;
    }

    var duzinaUnosa = unos.length;
    for (var i = 0; i < duzinaUnosa; i++) {
        if (isNaN(unos[i])) {

        } else {
            document.getElementById("formpname").style.borderColor = "red";
            prezimeProvjera = false;
            console.log("Prezime ne može sadržavati brojeve.");
        }
    }
    provjeraForme();
}

function provjeraKorisnickogImena() {
    var unos = document.getElementById("formusername").value;
    if (unos.length < 8) {
        document.getElementById("formusername").style.borderColor = "red";
        korisnickoimeProvjera = false;
    } else {
        document.getElementById("formusername").style.borderColor = null;
        korisnickoimeProvjera = true;
    }
    var duzinaUnosa = unos.length;
    var brojUUseru = broj_u_stringu(unos);
    if (!brojUUseru) {
        korisnickoimeProvjera = false;
        document.getElementById("formusername").style.borderColor = "red";
    }

    if (duzinaUnosa < 8) {
        console.log("Korisničko ime je prekratko.");
        korisnickoimeProvjera = false;
        document.getElementById("formusername").style.borderColor = "red";
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
        console.log("Točka ne može stajati na prvom mjestu!");
    }
    var duzinaUnosa = unos.length;

    for (var i = 0; i < duzinaUnosa; i++) {
        if (unos[i] === ".") {
            if (unos[i + 1] === ".") {
                document.getElementById("formmail").style.borderColor = "red";
                emailProvjera = false;
                console.log("Dvije točke ne mogu biti uzastopne");
            }
        }
    }

    var mjestoMonkeya = unos.indexOf("@");
    var brojMonkeya = unos.split("@").length - 1;
    if (mjestoMonkeya === -1) {
        console.log("Fali @!");
        document.getElementById("formmail").style.borderColor = "red";
        emailProvjera = false;
    } else if (mjestoMonkeya < 4) {
        console.log("Znak @ mora biti na barem 5. mjestu.");
        document.getElementById("formmail").style.borderColor = "red";
        emailProvjera = false;
    }

    if (brojMonkeya !== 1) {
        console.log("Znak @ mora biti na samo jednom mjestu u adresi!");
        document.getElementById("formmail").style.borderColor = "red";
        emailProvjera = false;
    }

    if (unos[duzinaUnosa - 1] !== "r" || unos[duzinaUnosa - 2] !== "h" || unos[duzinaUnosa - 3] !== ".") {
        console.log("Email mora završavati na .hr");
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
        console.log("Password mora imati barem 8 znamenki.");
        document.getElementById("formpassword").style.borderColor = "red";
    } else if (unos !== unos2) {
        document.getElementById("formpassword").style.borderColor = null;
        document.getElementById("formpassword2").style.borderColor = null;
        passwordProvjera = false;
        console.log("Ponovljena lozinka nije ista kao i lozinka.");
        document.getElementById("formpassword").style.borderColor = "red";
        document.getElementById("formpassword2").style.borderColor = "red";
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
