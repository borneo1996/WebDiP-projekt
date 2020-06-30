<?php
error_reporting(0);
require_once '../../php/session.php';
require '../../php/baza.class.php';


?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Početna - Moderator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="date" content="03-06-2020">
    <meta name="description" content="Internetska stranica pošte.">
    <meta name="keywords" content="pošta, pošiljka, poštanski ured">
    <meta name="author" content="Borneo Culović">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/stylemobile.css">
    <script type="text/javascript" src="../../javascript/bculovic.js"></script>
</head>

<body>
    <header>
        <div class="header-div">
            <div class="logo-div">
                <a href="moderator.php" class="logo-ico">
                    <img src="../../images/posta_logo.png" class="icon" alt="posta_logo" title="Početna">
                </a>
            </div>
            <div class="navigation-bar">
                <a href="moderator.php" class="link-active">Početna</a>
                <a href="../o_autoru.html" class="link-buttons">Autor</a>
                <div class="hover-links">
                    <button class="dropdownBtn">Popis &darr;</button>
                    <div class="dropdown-linkovi">
                        <a href="upravljanje_posiljkama.php" class="link-buttons">Upravljanje pošiljkama</a>
                        <a href="postanski-uredi.php" class="link-buttons">Poštanski uredi</a>
                        <a href="racuni.php" class="link-buttons">Računi</a>
                        <a href="korisnici.php" class="link-buttons">Popis korisnika</a>
                    </div>
                </div>
            </div>
            <?php echo'<div class="ulogiraniKorisnik"><p>'. $_SESSION['ulogiraniKorisnik'] . '</p></div>';?>
            <div class="logout-div">
                <a href="../../php/odjava.php" class="logout-button">Odjava</a>
            </div>
        </div>
    </header>

    <div class="main-content">
        <div class="page-title">
            <p><strong><?php echo $_SESSION['ulogiraniKorisnik'] ?></strong></p>
        </div>
        <div class="pocetna-sadrzaj">
            <div class="sadrzaj-div-1">
                <div class="sadrzaj">
                <p><strong>Upravljanje pošiljkama</strong></p>
                    <p>Upravljajte pošiljkama  <a href="upravljanje_posiljkama.php">ovdje</a>.</p>
                </div>
                <div class="sadrzaj-img">
                <img class="pocetna-sadrzaj-img" src="../../images/box.png" alt="Pošiljke">
                </div>
            </div>
            <div class="sadrzaj-div-2">
                <div class="sadrzaj">
                    <p><strong>Autor</strong></p>
                    <p>Pogledajte osnovne informacije o  <a href="../o_autoru.html">autoru</a>.</p>
                </div>
                <div class="sadrzaj-img">
                    <img class="pocetna-sadrzaj-img" src="../../images/copyright.png" alt="Pošta">
                </div>
            </div>
            <div class="sadrzaj-div-3">
                <div class="sadrzaj">
                    <p><strong>Popis poštanskih ureda</strong></p>
                    <p>Pretražite poštanske urede <a href="postanski-uredi.php">ovdje</a>.</p>
                </div>
                <div class="sadrzaj-img">
                    <img class="pocetna-sadrzaj-img" src="../../images/posta_logo.png" alt="Pošta">
                </div>
            </div>
            <div class="sadrzaj-div-4">
                <div class="sadrzaj">
                    <p><strong>Izdani računi</strong></p>
                    <p>Pregledajte izdane račune <a href="racuni.php">ovdje</a>.</p>
                </div>
                <div class="sadrzaj-img">
                    <img class="pocetna-sadrzaj-img" src="../../images/racun.png" alt="Računi">
                </div>
            </div>
            <div class="sadrzaj-div-5">
                <div class="sadrzaj">
                    <p><strong>Popis korisnika</strong></p>
                    <p>Pretražite korisnike <a href="korisnici.php">ovdje</a>.</p>
                </div>
                <div class="sadrzaj-img">
                    <img class="pocetna-sadrzaj-img" src="../../images/user.png" alt="Pošta">
                </div>
            </div>
            
        </div>
        
    </div>
    
    <div class="footer">
        <div class="dokumentacija-div">
            <a href="../../dokumentacija.html" class="link-buttons">Dokumentacija</a>
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