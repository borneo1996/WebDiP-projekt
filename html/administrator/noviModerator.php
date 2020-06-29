<?php
require '../../php/baza.class.php';


if(!isset($_SESSION['uloga'])){
    $_SESSION['uloga'] = $_COOKIE['uloga'];
}
if(!isset($_SESSION['ulogiraniKorisnik'])){
    $_SESSION['ulogiraniKorisnik'] = $_COOKIE['username'];
}


if(isset($_POST['dodajga'])){
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $lozinka = $_POST['adminlozinka'];
    $hashloz = sha1($lozinka);

    $veza = new Baza();
    $veza->spojiDB();
    $upit = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, lozinka_sha1, email, aktiviran, aktivacijski_kod, aktivan, uloga_uloga_id) 
    VALUES ('$ime', '$prezime', '$username', '$lozinka', '$hashloz', '$email', '1', 'moderator', '1', '3');";
    $veza->updateDB($upit, "korisnici.php");
    $veza->zatvoriDB();
}

?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Novi moderator</title>
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
                <a href="administrator.php" class="logo-ico">
                    <img src="../../images/posta_logo.png" class="icon" alt="posta_logo" title="Početna">
                </a>
            </div>
            <div class="navigation-bar">
            <a href="administrator.php" class="link-buttons">Početna</a>
            <a href="o_autoru.html" class="link-buttons">Autor</a>
            <div class="hover-links">
                <button class="dropdownBtn-active">Popis &darr;</button>
                <div class="dropdown-linkovi">
                    <a href="upravljanje_posiljkama.php" class="link-buttons">Upravljanje pošiljkama</a>
                    <a href="postanski-uredi.php" class="link-buttons">Poštanski uredi</a>
                    <a href="izdani-racuni.php" class="link-buttons">Izdani računi</a>
                    <a href="korisnici.php" class="link-active">Popis korisnika</a>
                    <a href="drzave.php" class="link-buttons">Države</a>
                </div>
            </div>
        </div><?php echo '
        <div class="ulogiraniKorisnik"><p>'. $_SESSION['ulogiraniKorisnik'] . '</p></div>';
        ?>
                <div class="logout-div">
                    <a href="../../php/odjava.php" class="logout-button">Odjava</a>
                </div>
            </div>
    </header>

    <div class="main-content">
        <div class="page-title">
            <p><strong>Novi moderator</strong></p>
        </div>
        <div class="registracija-div">
            <div class="universal-form">
                <form action="" method="post" class="forma">
                    <legend>Moderator</legend><br><br>
                    <label for="adminime" class="form-label">Ime</label>
                    <input type="text" class="form-input" id="adminime" name="ime" placeholder="Vaše ime"><br><br>
                    <label for="adminprezime" class="form-label">Prezime</label>
                    <input type="text" class="form-input" id="adminprezime" name="prezime" placeholder="Vaše prezime"><br><br>
                    <label for="adminusername" class="form-label">Korisničko ime</label>
                    <input type="text" class="form-input" id="adminusername" name="username" placeholder="Korisničko ime"><br><br>
                    <label for="adminmail" class="form-label">E-mail</label>
                    <input type="email" class="form-input" id="adminmail" name="email" placeholder="Vaš e-mail"><br><br>
                    <label for="adminlozinka" class="form-label">Lozinka</label>
                    <input type="text" class="form-input" id="adminlozinka" name="adminlozinka" placeholder="Lozinka"><br><br>
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