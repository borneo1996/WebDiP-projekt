<?php
error_reporting(0);
require_once '../php/session.php';


?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Početna - ADMIN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="date" content="03-06-2020">
    <meta name="description" content="Internetska stranica pošte.">
    <meta name="keywords" content="pošta, pošiljka, poštanski ured">
    <meta name="author" content="Borneo Culović">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/stylemobile.css">
    <script type="text/javascript" src="../javascript/bculovic.js"></script>
</head>

<body>
    <header>
        <div class="header-div">
            <div class="logo-div">
                <a href="administrator.php" class="logo-ico">
                    <img src="../images/posta_logo.png" class="icon" alt="posta_logo" title="Početna">
                </a>
            </div>
            <div class="navigation-bar">
                <a href="#" class="link-active">Početna</a>
                <a href="prijava.php" class="link-buttons">Prijava</a>
                <a href="registracija.php" class="link-buttons">Registracija</a>
                <a href="o_autoru.html" class="link-buttons">Autor</a>
                <div class="hover-links">
                    <button class="dropdownBtn">Popis &darr;</button>
                    <div class="dropdown-linkovi">
                        <a href="upravljanje_posiljkama.php" class="link-buttons">Upravljanje pošiljkama</a>
                        <a href="postanski-uredi.php" class="link-buttons">Poštanski uredi</a>
                        <a href="izdani-racuni.php" class="link-buttons">Izdani računi</a>
                        <a href="korisnici.php" class="link-buttons">Popis korisnika</a>
                        <a href="drzave.php" class="link-buttons">Države</a>
                    </div>
                </div>
            </div>
            <?php echo'<div class="ulogiraniKorisnik"><p>'. $_SESSION['ulogiraniKorisnik'] . '</p></div>';?>
            <div class="logout-div">
                <a href="../php/odjava.php" class="logout-button">Odjava</a>
            </div>
        </div>
    </header>

    <div class="main-content">
        <div class="page-title">
            <p><strong>Administrator</strong></p>
        </div>
        <div class="pocetna-sadrzaj">
            <form method="post" action="../php/dodajDrzavu.php">
                <input type="submit" id="novadrzava" name="novadrzava" value="Dodaj novu državu">
            </form><br><br>
            <form method="post" action="../php/dodajUred.php">
                <br><br><input type="submit" id="noviured" name="noviured" value="Dodaj novi poštanski ured">
            </form><br><br>
            <button id="killCookie" onclick=brisiKolacicUvjeta() style="width: 3rem; height:2rem;">Kolacic</button>
        </div>
        
    </div>
    
    <div class="footer">
        <div class="dokumentacija-div">
            <a href="html/dokumentacija.html" class="link-buttons">Dokumentacija</a>
        </div>
        <div class="copyright-div">
            <p class="footer-ime">Borneo Culović &copy;2020</p>
            <a href="mailto:bculovic@foi.hr" class="footer-email">
                <p>bculovic@foi.hr</p>
            </a>
        </div>
    </div>


</body>

</html>