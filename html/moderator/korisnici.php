<?php
error_reporting(0);
require_once '../../php/session.php';
require '../../php/https.php';

?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Korisnici</title>
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
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../../javascript/bculovic_jquery.js"></script>
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
            <a href="moderator.php" class="link-buttons">Početna</a>
            <a href="../o_autoru.html" class="link-buttons">Autor</a>
            <div class="hover-links">
                <button class="dropdownBtn-active">Popis &darr;</button>
                <div class="dropdown-linkovi">
                    <a href="upravljanje_posiljkama.php" class="link-buttons">Upravljanje pošiljkama</a>
                    <a href="postanski-uredi.php" class="link-buttons">Poštanski uredi</a>
                    <a href="racuni.php" class="link-buttons">Računi</a>
                    <a href="korisnici.php" class="link-active">Popis korisnika</a>
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
            <p><strong>Korisnici</strong></p>
        </div>
        <div class="div-table">
            <table id="tablicaKorisnici" class="tablica">
                <thead id="tHead">
                    <tr>
                        <th>ID</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Korisničko ime</th>
                        <th>Lozinka</th>
                        <th>Hash-lozinka</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Blokiran do</th>
                        <th>Uloga</th>
                    </tr>
                </thead>
                <tbody id="tBody">
    
                </tbody>
                
            </table>
    
        </div>
        <div class="upravljanjeDiv">
            <form method="POST" action="../dohvaceniKorisnik.php">
                <label for="identifikator" class="form-label">Unesi ID korisnika</label>
                <input type="text" name="identifikator" id="identifikator" placeholder="ID korisnika"></input><br>
                <input type="submit" name="konfigurirajID" id="konfigurirajID" value="Izmjeni"><br><br>
            </form>
            <br><br>
        </div><br><br><hr><br>
    </div>        
    <div class="footer">
        <div class="copyright-div">
            <p class="footer-ime">Borneo Culović &copy;2020</p>
            <a href="mailto:bculovic@foi.hr" class="footer-email"><p>bculovic@foi.hr</p></a>
        </div>
    </div>

</body>

</html>