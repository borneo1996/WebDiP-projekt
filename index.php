<?php
error_reporting(0);
require_once 'php/session.php';
if(!isset($_COOKIE['uloga'])){
    $_COOKIE['uloga'] = 1;
}
$_SESSION['uloga'] = $_COOKIE['uloga'];
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Početna</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="date" content="03-06-2020">
    <meta name="description" content="Internetska stranica pošte.">
    <meta name="keywords" content="pošta, pošiljka, poštanski ured">
    <meta name="author" content="Borneo Culović">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="javascript/script.js"></script>
</head>

<body>
    <header>
        <div class="header-div">
            <div class="logo-div">
                <a href="#" class="logo-ico">
                    <img src="images/posta_logo.png" class="icon" alt="posta_logo" title="Početna">
                </a>
            </div>
            <?php
                if($_SESSION['uloga'] < 2 ){
                    echo '
                    <div class="navigation-bar">
                        <a href="#" class="link-active">Početna</a>
                        <a href="html/prijava.php" class="link-buttons">Prijava</a>
                        <a href="html/registracija.php" class="link-buttons">Registracija</a>
                        <a href="html/o_autoru.html" class="link-buttons">Autor</a>
                        <div class="hover-links">
                            <button class="dropdownBtn">Popis &darr;</button>
                            <div class="dropdown-linkovi">
                                <a href="html/postanski-uredi.php" class="link-buttons">Poštanski uredi</a>
                            </div>
                        </div>
                    </div>
                    ';
                } else if ($_SESSION['uloga'] < 3 ){
                    echo '
                        <div class="navigation-bar">
                        <a href="#" class="link-active">Početna</a>
                        <a href="html/prijava.php" class="link-buttons">Prijava</a>
                        <a href="html/registracija.php" class="link-buttons">Registracija</a>
                        <a href="html/o_autoru.html" class="link-buttons">Autor</a>
                        <div class="hover-links">
                            <button class="dropdownBtn">Popis &darr;</button>
                            <div class="dropdown-linkovi">
                                <a href="html/upravljanje_posiljkama.php" class="link-buttons">Upravljanje pošiljkama</a>
                                <a href="html/postanski-uredi.php" class="link-buttons">Poštanski uredi</a>
                                <a href="html/izdani-racuni.php" class="link-buttons">Izdani računi</a>
                            </div>
                        </div>
                    </div>
                    <div class="logout-div">
                        <a href="php/odjava.php" class="logout-button">Odjava</a>
                    </div>
                    ';
                } else if ($_SESSION['uloga'] < 4 ){
                    echo '
                        <div class="navigation-bar">
                        <a href="#" class="link-active">Početna</a>
                        <a href="html/prijava.php" class="link-buttons">Prijava</a>
                        <a href="html/registracija.php" class="link-buttons">Registracija</a>
                        <a href="html/o_autoru.html" class="link-buttons">Autor</a>
                        <div class="hover-links">
                            <button class="dropdownBtn">Popis &darr;</button>
                            <div class="dropdown-linkovi">
                                <a href="html/upravljanje_posiljkama.php" class="link-buttons">Upravljanje pošiljkama</a>
                                <a href="html/postanski-uredi.php" class="link-buttons">Poštanski uredi</a>
                                <a href="html/izdani-racuni.php" class="link-buttons">Izdani računi</a>
                                <a href="html/korisnici.php" class="link-buttons">Popis korisnika</a>
                            </div>
                        </div>
                    </div>
                    <div class="logout-div">
                        <a href="php/odjava.php" class="logout-button">Odjava</a>
                    </div>
                    ';
                } else if ($_SESSION['uloga'] < 5 ){
                    echo '
                        <div class="navigation-bar">
                        <a href="#" class="link-active">Početna</a>
                        <a href="html/prijava.php" class="link-buttons">Prijava</a>
                        <a href="html/registracija.php" class="link-buttons">Registracija</a>
                        <a href="html/o_autoru.html" class="link-buttons">Autor</a>
                        <div class="hover-links">
                            <button class="dropdownBtn">Popis &darr;</button>
                            <div class="dropdown-linkovi">
                                <a href="html/upravljanje_posiljkama.php" class="link-buttons">Upravljanje pošiljkama</a>
                                <a href="html/postanski-uredi.php" class="link-buttons">Poštanski uredi</a>
                                <a href="html/izdani-racuni.php" class="link-buttons">Izdani računi</a>
                                <a href="html/korisnici.php" class="link-buttons">Popis korisnika</a>
                                <a href="html/drzave.php" class="link-buttons">Države</a>
                            </div>
                        </div>
                    </div>
                    <div class="logout-div">
                        <a href="php/odjava.php" class="logout-button">Odjava</a>
                    </div>
                    ';
                }
            ?>
        </div>
    </header>

    <div class="main-content">
        <div class="page-title">
            <p><strong>Početna</strong></p>
        </div>
        <div class="pocetna-sadrzaj">
            <div class="sadrzaj-div-1">
                <div class="sadrzaj">
                    <p><strong>Popis poštanskih ureda</strong></p>
                    <p>Pretražite poštanske urede <a href="html/postanski-uredi.php">ovdje</a>.</p>
                </div>
                <div class="sadrzaj-img">
                    <img class="pocetna-sadrzaj-img" src="images/posta_logo.png" alt="Pošta">
                </div>
            </div>
            <div class="sadrzaj-div-2">
                <div class="sadrzaj">
                    <p><strong>Registracija</strong></p>
                    <p>Registrirajte se <a href="html/registracija.php">ovdje</a><br> i upravljajte svojim pošiljkama.</p>
                </div>
                <div class="sadrzaj-img">
                    <img class="pocetna-sadrzaj-img" src="images/register.png" alt="Register-img">
                </div>
            </div>
            <div class="sadrzaj-div-3">
                <div class="sadrzaj">
                    <p><strong>Prijava</strong></p>
                    <p>Imate račun? Prijavite se <a href="html/prijava.php">ovdje</a>.</p>
                </div>
                <div class="sadrzaj-img">
                    <img class="pocetna-sadrzaj-img" src="images/login.png" alt="Pošta">
                </div>
            </div>
            <div class="sadrzaj-div-4">
                <div class="sadrzaj">
                    <p><strong>Upravljanje pošiljka</strong></p>
                    <?php
                        if($_SESSION['uloga'] < 2){
                            echo '<p>Upravljajte pošiljkama  <a href="html/prijava.php">ovdje</a>.</p>';
                        } else {
                            echo '<p>Upravljajte pošiljkama  <a href="html/upravljanje_posiljkama.php">ovdje</a>.</p>';
                        }
                    ?>
                    
                </div>
                <div class="sadrzaj-img">
                    <img class="pocetna-sadrzaj-img" src="images/box.png" alt="Pošta">
                </div>
            </div>
            <div class="sadrzaj-div-5">
                <div class="sadrzaj">
                    <p><strong>Autor</strong></p>
                    <p>Pogledajte osnovne informacije o  <a href="html/o_autoru.html">autoru</a>.</p>
                </div>
                <div class="sadrzaj-img">
                    <img class="pocetna-sadrzaj-img" src="images/copyright.png" alt="Pošta">
                </div>
            </div>
            <?php
                if($_SESSION['uloga'] >= 3){
                    echo '
                    <div class="sadrzaj-div-6">
                        <div class="sadrzaj">
                            <p><strong>Izdani računi</strong></p>
                            <p>Pregledajte izdane račune <a href="html/izdani-racuni.php">ovdje</a>.</p>
                        </div>
                        <div class="sadrzaj-img">
                            <img class="pocetna-sadrzaj-img" src="images/racun.png" alt="Pošta">
                        </div>
                    </div>
                    <div class="sadrzaj-div-7">
                        <div class="sadrzaj">
                            <p><strong>Popis korisnika</strong></p>
                            <p>Pretražite korisnike <a href="html/korisnici.php">ovdje</a>.</p>
                        </div>
                        <div class="sadrzaj-img">
                            <img class="pocetna-sadrzaj-img" src="images/user.png" alt="Pošta">
                        </div>
                    </div>';
                }
            ?>
        </div>
    </div>

    <div class="footer">
        <div class="copyright-div">
            <p class="footer-ime">Borneo Culović &copy;2020</p>
            <a href="mailto:bculovic@foi.hr" class="footer-email">
                <p>bculovic@foi.hr</p>
            </a>
        </div>
    </div>

</body>

</html>