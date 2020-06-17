<?php
require '../php/baza.class.php';
require '../php/session.php';


if(!isset($_SESSION['uloga'])){
    $_SESSION['uloga'] = $_COOKIE['uloga'];
}
if(!isset($_SESSION['ulogiraniKorisnik'])){
    $_SESSION['ulogiraniKorisnik'] = $_COOKIE['username'];
}


if(isset($_POST['dodajga'])){
    $naziv = $_POST['naziv'];
    $adresa = $_POST['adresa'];
    $grad = $_POST['grad'];
    $drzava = $_POST['drzava'];
    $moderator = $_POST['moderator'];
    $primljene = $_POST['primljene'];
    $poslane = $_POST['poslane'];
    echo $adresa;
    $veza = new Baza();
    $veza->spojiDB();
    $upit = "INSERT INTO poštanski_ured (naziv, adresa, grad, država_drzava_id, korisnik_korisnik_ID, broj_primljenih_pošiljki, broj_poslanih_pošiljki) 
    VALUES ('$naziv', '$adresa', '$grad', '$drzava', '$moderator', '$primljene', '$poslane');";
    $veza->updateDB($upit, "postanski-uredi.php");
    $veza->zatvoriDB();
}

?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Novi ured</title>
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
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
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
            <a href="../index.php" class="link-active">Početna</a>
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
        </div><?php echo '
        <div class="ulogiraniKorisnik"><p>'. $_SESSION['ulogiraniKorisnik'] . '</p></div>';
        ?>
                <div class="logout-div">
                    <a href="../php/odjava.php" class="logout-button">Odjava</a>
                </div>
            </div>
    </header>

    <div class="main-content">
        <div class="page-title">
            <p><strong>Novi poštanski ured</strong></p>
        </div>
        <div class="registracija-div">
            <div class="universal-form">
                <form action="" method="post" class="forma">
                    <legend>Poštanski ured</legend><br><br>
                    <label for="naziv" class="form-label">Naziv</label>
                    <input type="text" class="form-input" id="naziv" name="naziv" placeholder="Naziv"><br><br>
                    <label for="adresa" class="form-label">Adresa</label>
                    <input type="text" class="form-input" id="adresa" name="adresa" placeholder="Adresa"><br><br>
                    <label for="grad" class="form-label">Grad</label>
                    <input type="text" class="form-input" id="grad" name="grad" placeholder="Grad"><br><br>
                    <label for="drzava" class="form-label">Drzava_ID</label>
                    <input type="number" class="form-input" id="drzava" name="drzava" placeholder="Država_ID"><br><br>
                    <label for="moderator" class="form-label">Moderator</label>
                    <input type="number" class="form-input" id="moderator" name="moderator" placeholder="Moderator"><br><br>
                    <label for="primljene" class="form-label">Broj primljenih pošiljki</label>
                    <input type="number" class="form-input" id="primljene" name="primljene" placeholder=""><br><br>
                    <label for="poslane" class="form-label">Broj poslanih pošiljki</label>
                    <input type="number" class="form-input" id="poslane" name="poslane" placeholder=""><br><br>
                    <input type="submit" id="dodajga" name="dodajga" value="Dodaj">
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