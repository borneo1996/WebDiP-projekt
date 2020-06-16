<?php
error_reporting(0);
require '../php/session.php';
require '../php/baza.class.php';
require '../php/https.php';

$veza = new Baza();
$veza->spojiDB();
$email = $_GET['email'];
$user = $_SESSION['ulogiraniKorisnik'];
$upit = "SELECT * FROM korisnik WHERE email='{$email}';";
$rezultat = $veza->selectDB($upit);
while($redak = mysqli_fetch_array($rezultat)){
    $id = $redak['korisnik_ID'];
    $znakovi = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $broj = strlen($znakovi);
    $lozinka = "";
    for($i=0;$i<10; $i++){
        $lozinka .= $znakovi[rand(1,$broj)];
    }
    $lozinkas = sha1($lozinka);
    $subject = "Zaboravljena lozinka";
    $tekst = "Ovo je nova lozinka: " . $lozinka;
    $headers = "FROM: noreply@foi.hr";
    mail($email, $subject, $tekst, $headers);
    $updateLozinka = "UPDATE korisnik SET lozinka='{$lozinka}', lozinka_sha1='{$lozinkas}' WHERE korisnik_ID='{$id}';";
    $veza->updateDB($updateLozinka, "prijava.php");
}
$veza->zatvoriDB();

?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Zaboravljena lozinka</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="date" content="03-06-2020">
    <meta name="description" content="Internetska stranica pošte.">
    <meta name="keywords" content="pošta, pošiljka, poštanski ured">
    <meta name="author" content="Borneo Culović">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/stylemobile.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../javascript/bculovic_jquery.js"></script>
    <script type="text/javascript" src="../javascript/bculovic.js"></script>
</head>

<body>
    <header>
        <div class="header-div">
            <div class="logo-div">
                <a href="../index.php" class="logo-ico">
                    <img src="../images/posta_logo.png" class="icon" alt="posta_logo" title="Početna">
                </a>
            </div>
            <div class="navigation-bar">
                        <a href="o_autoru.html" class="link-buttons">Autor</a>
            </div>
        </div>
    </header>
    <div class="main-content">
        <div class="page-title">
            <p><strong>Lozinka</strong></p>
        </div>
        <div class="prijava-div">
                    <div class="universal-form">
                        <form action="zaboravljenaLozinka.php" novalidate name="dobaviLozinku" method="get" id="dobaviLozinku">
                            <label for="email" class="form-label">Email</label><br>
                            <input type="text" id="email" name="email" placeholder="Email"><br><br>
                            <p class="poruka">Unesite vašu email adresu.</p>
                            <input id="zaboravljenaLozinka" type="submit" name="zaboravljenaLozinka" value="Pošalji">
                        </form>
                    </div>
                </div>
    </div>

    <div class="footer">
         <div class="dokumentacija-div">
            <a href="dokumentacija.html" class="link-buttons">Dokumentacija</a>
        </div>
        <div class="copyright-div">
            <p class="footer-ime">Borneo Culović &copy;2020</p>
            <a href="mailto:bculovic@foi.hr" class="footer-email"><p>bculovic@foi.hr</p></a>
        </div>
    </div>


</body>

</html>