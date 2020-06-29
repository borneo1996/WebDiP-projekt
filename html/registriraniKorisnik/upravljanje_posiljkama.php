<?php
//error_reporting(0);
require_once '../../php/session.php';
require '../../php/https.php';


?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Moje pošiljke - poslane</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="date" content="03-06-2020">
    <meta name="description" content="Internetska stranica pošte.">
    <meta name="keywords" content="pošta, pošiljka, poštanski ured">
    <meta name="author" content="Borneo Culović">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/stylemobile.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../../javascript/bculovic_jquery.js"></script>
    <script type="text/javascript" src="../../javascript/bculovic.js"></script>
</head>

<body>
    <header>
        <div class="header-div">
            <div class="logo-div">
                <a href="reg-korisnik.php" class="logo-ico">
                    <img src="../../images/posta_logo.png" class="icon" alt="posta_logo" title="Početna">
                </a>
            </div>
            <div class="navigation-bar">
            <a href="reg-korisnik.php" class="link-buttons">Početna</a>
            <a href="../o_autoru.html" class="link-buttons">Autor</a>
            <div class="hover-links">
                <button class="dropdownBtn-active">Popis &darr;</button>
                <div class="dropdown-linkovi">
                    <a href="upravljanje_posiljkama.php" class="link-active">Upravljanje pošiljkama</a>
                    <a href="postanski-uredi.php" class="link-buttons">Poštanski uredi</a>
                    <a href="izdani-racuni.php" class="link-buttons">Izdani računi</a>
                    <a href="korisnici.php" class="link-buttons">Popis korisnika</a>
                    <a href="drzave.php" class="link-buttons">Države</a>
                </div>
            </div>
        </div>
        <div class="ulogiraniKorisnik"><p><?php echo $_SESSION['ulogiraniKorisnik'] ?></p></div>
            <div class="logout-div">
                <a href="../../php/odjava.php" class="logout-button">Odjava</a>
            </div>
        </div>
    </header>
    <div class="main-content">
        <div class="page-title">
            <p><strong>Moje pošiljke - poslane</strong></p>
        </div>
        <div class="additionalLinks">
            <a href="upravljanje_posiljkama.php" class="link-subbuttons-active">Poslane</a>
            <a href="upravljanje_posiljkama_primljene.php" class="link-subbuttons">Primljene</a>
        </div>
        <div class="div-table">
            <legend class="legende">Poslane</legend><br>
            <table id="tablicaPosiljke" class="tablica">
                <thead id="tHead">
                    <tr>
                        <th>ID</th>
                        <th>Cijena/KG</th>
                        <th>Kilogrami</th>
                        <th>Isporuka</th>
                        <th>Sljedeći ured</th>
                        <th>Dostavljena</th>
                        <th>Račun zatražen</th>
                        <th>Primatelj</th>
                    </tr>
                </thead>
                <tbody id="tBody">
    
                </tbody>
                
            </table><br><hr><br>
            <div class="registracija-div">
                <div class="universal-form">
                    <form action="zatraziRacun.php" method="post" class="forma">
                        <legend>Zatraži račun</legend><br><br>
                        <label for="id" class="form-label">ID pošiljke</label><br>
                        <select type="select" class="form-input" id="id_pošiljka" name="id_pošiljka"></select><br><br>
                        <input type="submit" id="zatraziracun" name="zatraziracun" value="Zatraži račun">
                    </form>
                </div><br><br>
                <div class="universal-form">
                    <form action="kreirajPosiljku.php" method="post" class="forma">
                        <legend>Kreiraj pošiljku</legend><br><br>
                        <label for="tezina" class="form-label">Težina</label><br>
                        <input type="text" class="form-input" id="tezina" name="tezina" placeholder="Težina pošiljke u KG"><br><br>
                        <label for="korisnik" class="form-label">Primatelj</label><br>
                        <select type="select" class="form-input" id="korisnik" name="korisnik"></select><br><br>
                        <input type="submit" id="kreirajposiljku" name="kreirajposiljku" value="Kreiraj pošiljku">
                    </form>
                </div>
            </div>

        </div><br><br>

    <div class="footer">
        <div class="copyright-div">
            <p class="footer-ime">Borneo Culović &copy;2020</p>
            <a href="mailto:bculovic@foi.hr" class="footer-email"><p>bculovic@foi.hr</p></a>
        </div>
    </div>

</body>

</html>

