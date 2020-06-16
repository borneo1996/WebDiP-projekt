<?php
error_reporting(0);
require_once '../php/session.php';

if(!isset($_COOKIE['uloga'])){
    $_COOKIE['uloga'] = 1;
}
if(isset($_SESSION['aktiviran'])){
    if($_SESSION['aktiviran']==0){
        $_SESSION['uloga']=1;
        $akt = false;
    } else {
        $_SESSION['uloga'] = $_COOKIE['uloga'];
        $akt = true;
    }
}

$user = $_SESSION['ulogiraniKorisnik'];
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Poštanski uredi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="date" content="03-06-2020">
    <meta name="description" content="Internetska stranica pošte.">
    <meta name="keywords" content="pošta, pošiljka, poštanski ured">
    <meta name="author" content="Borneo Culović">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/stylemobile.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
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
            <?php
                if($_SESSION['uloga'] < 2 ){
                    if(!$akt && $user != null){
                        echo '
                        <div class="navigation-bar">
                            <a href="../index.php" class="link-buttons">Početna</a>
                            <a href="prijava.php" class="link-buttons">Prijava</a>
                            <a href="registracija.php" class="link-buttons">Registracija</a>
                            <a href="o_autoru.html" class="link-buttons">Autor</a>
                            <div class="hover-links">
                                <button class="dropdownBtn">Popis &darr;</button>
                                <div class="dropdown-linkovi">
                                    <a href="postanski-uredi.php" class="link-buttons">Poštanski uredi</a>
                                </div>
                            </div>
                        </div>
                        <div class="ulogiraniKorisnik">
                            <a href="aktivacija.php">Aktiviraj račun</a>
                            <p>'. $_SESSION['ulogiraniKorisnik']. '</p></div>
                            <div class="logout-div">
                                <a href="../php/odjava.php" class="logout-button">Odjava</a>
                            </div>
                        ';
                    } else {
                        echo '
                        <div class="navigation-bar">
                            <a href="../index.php" class="link-buttons">Početna</a>
                            <a href="prijava.php" class="link-buttons">Prijava</a>
                            <a href="registracija.php" class="link-buttons">Registracija</a>
                            <a href="o_autoru.html" class="link-buttons">Autor</a>
                            <div class="hover-links">
                                <button class="dropdownBtn">Popis &darr;</button>
                                <div class="dropdown-linkovi">
                                    <a href="postanski-uredi.php" class="link-buttons">Poštanski uredi</a>
                                </div>
                            </div>
                        </div>
                        
                        ';
                    }
                } else if ($_SESSION['uloga'] < 3 ){
                    echo '
                        <div class="navigation-bar">
                        <a href="../index.php" class="link-buttons">Početna</a>
                        <a href="prijava.php" class="link-buttons">Prijava</a>
                        <a href="registracija.php" class="link-buttons">Registracija</a>
                        <a href="o_autoru.html" class="link-buttons">Autor</a>
                        <div class="hover-links">
                            <button class="dropdownBtn-active">Popis &darr;</button>
                            <div class="dropdown-linkovi">
                                <a href="upravljanje_posiljkama.php" class="link-active">Upravljanje pošiljkama</a>
                                <a href="postanski-uredi.php" class="link-buttons">Poštanski uredi</a>
                                <a href="izdani-racuni.php" class="link-buttons">Izdani računi</a>
                            </div>
                        </div>
                    </div>';
                    if($_SESSION['blokiran'] == false || $_SESSION['blokiran'] == null){
                        echo '
                            <div class="ulogiraniKorisnik"><p>'. $_SESSION['ulogiraniKorisnik'] . '</p></div>
                            <div class="logout-div">
                                <a href="../php/odjava.php" class="logout-button">Odjava</a>
                            </div>
                        ';
                    }
                } else if ($_SESSION['uloga'] < 4 ){
                    echo '
                        <div class="navigation-bar">
                        <a href="../index.php" class="link-buttons">Početna</a>
                        <a href="prijava.php" class="link-buttons">Prijava</a>
                        <a href="registracija.php" class="link-buttons">Registracija</a>
                        <a href="o_autoru.html" class="link-buttons">Autor</a>
                        <div class="hover-links">
                            <button class="dropdownBtn-active">Popis &darr;</button>
                            <div class="dropdown-linkovi">
                                <a href="upravljanje_posiljkama.php" class="link-buttons">Upravljanje pošiljkama</a>
                                <a href="postanski-uredi.php" class="link-active">Poštanski uredi</a>
                                <a href="izdani-racuni.php" class="link-buttons">Izdani računi</a>
                                <a href="korisnici.php" class="link-buttons">Popis korisnika</a>
                            </div>
                        </div>
                    </div>';
                    if($_SESSION['blokiran'] == false || $_SESSION['blokiran'] == null){
                        echo '
                            <div class="ulogiraniKorisnik"><p>'. $_SESSION['ulogiraniKorisnik'] . '</p></div>
                            <div class="logout-div">
                                <a href="../php/odjava.php" class="logout-button">Odjava</a>
                            </div>
                        ';
                    }
                } else if ($_SESSION['uloga'] < 5 ){
                    echo '
                        <div class="navigation-bar">
                        <a href="../index.php" class="link-buttons">Početna</a>
                        <a href="prijava.php" class="link-buttons">Prijava</a>
                        <a href="registracija.php" class="link-buttons">Registracija</a>
                        <a href="o_autoru.html" class="link-buttons">Autor</a>
                        <div class="hover-links">
                            <button class="dropdownBtn-active">Popis &darr;</button>
                            <div class="dropdown-linkovi">
                                <a href="upravljanje_posiljkama.php" class="link-buttons">Upravljanje pošiljkama</a>
                                <a href="postanski-uredi.php" class="link-active">Poštanski uredi</a>
                                <a href="izdani-racuni.php" class="link-buttons">Izdani računi</a>
                                <a href="korisnici.php" class="link-buttons">Popis korisnika</a>
                                <a href="drzave.php" class="link-buttons">Države</a>
                            </div>
                        </div>
                    </div>';
                    if($_SESSION['blokiran'] == false || $_SESSION['blokiran'] == null){
                        echo '
                            <div class="ulogiraniKorisnik"><p>'. $_SESSION['ulogiraniKorisnik'] . '</p></div>
                            <div class="logout-div">
                                <a href="../php/odjava.php" class="logout-button">Odjava</a>
                            </div>
                        ';
                    }
                }
            ?>
        </div>
    </header>

    <div class="main-content">
        <div class="page-title">
            <p><strong>Poštanski uredi</strong></p>
        </div>
        <div class="div-table">
            <table id="tablicaUreda" class="tablica">
                <thead id="tHead">
                    <tr>
                        <th>ID</th>
                        <th>Naziv</th>
                        <th>Adresa</th>
                        <th>Grad</th>
                        <th>Država</th>
                        <th>Moderator</th>
                        <th>Broj primljenih pošiljki</th>
                        <th>Broj poslanih pošiljki</th>
                    </tr>
                </thead>
                <tbody id="tBody">
    
                </tbody>
                
            </table>
    
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