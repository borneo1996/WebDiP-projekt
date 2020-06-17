<?php
error_reporting(0);
require '../php/session.php';
require '../php/baza.class.php';
require '../php/https.php';

$veza = new Baza();
$veza->spojiDB();
$kod = $_GET['activation_code'];
$user = $_SESSION['ulogiraniKorisnik'];
$upit = "SELECT * FROM korisnik WHERE korisnicko_ime='{$user}';";
$rezultat = $veza->selectDB($upit);
while($redak = mysqli_fetch_array($rezultat)){
    $id = $redak['korisnik_ID'];
    $aktkod = $redak['aktivacijski_kod'];
    if($aktkod == $kod){
        $upit = "UPDATE korisnik SET aktiviran='1' WHERE korisnik_ID='{$id}';";
        $veza->updateDB($upit, "../php/reget.php");
    }
}
$veza->zatvoriDB();

?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Prijava</title>
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
            <p><strong>Aktivacija</strong></p>
        </div>
        <div class="prijava-div">
                    <div class="universal-form">
                        <form action="aktivacija.php" novalidate name="aktivacija" method="get" id="aktivacija">
                            <label for="activation_code" class="form-label">Aktivacijski kod</label><br>
                            <input type="text" id="activation_code" name="activation_code" placeholder="Kod"><br><br>
                            <p class="poruka">Aktivacijski kod je poslan na email.</p>
                            <input id="activate" type="submit" name="activate" value="Aktiviraj">
                        </form>
                    </div>
                </div>
    </div>

    <div class="footer">
        <div class="copyright-div">
            <p class="footer-ime">Borneo Culović &copy;2020</p>
            <a href="mailto:bculovic@foi.hr" class="footer-email"><p>bculovic@foi.hr</p></a>
        </div>
    </div>


</body>

</html>