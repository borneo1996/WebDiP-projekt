<?php
require '../php/baza.class.php';

$veza = new Baza();
$veza->spojiDB();
error_reporting(0);
$korisnickoIme = $_GET['username'];
$lozinka = $_GET['password'];
$auth = null;

$upit = "SELECT * FROM korisnik WHERE korisnicko_ime='{$korisnickoIme}' AND lozinka='{$lozinka}';";
$rezultat = $veza->selectDB($upit);
while($redak = mysqli_fetch_array($rezultat)){
    if($redak){
        $auth = true;
        $email = $redak['email'];
        $username = $redak['korisnicko_ime'];
        $password = $redak['lozinka'];
        if($redak['blokiran_do']){
            $blokiran = true;
        }
        $uloga = $redak['uloga_uloga_id'];
    }
}
if($auth){
    $poruka = "Uspješna prijava!";
    setcookie("auth", $korisnickoIme, false, '/', false);
    setcookie("pass", $lozinka, false, '/', false);
    setcookie("uloga", $uloga, false, '/', false);
} else if ($auth == false){
    $poruka = "Neuspješna prijava!";
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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../javascript/bculovic_jquery.js"></script>
    <script type="text/javascript" src="../javascript/bculovic.js"></script>
</head>

<body>
    <header>
        <div class="header-div">
            <div class="logo-div">
                <a href="../index.html" class="logo-ico">
                    <img src="../images/posta_logo.png" class="icon" alt="posta_logo" title="Početna">
                </a>
            </div>
            <div class="navigation-bar">
                <a href="../index.html" class="link-buttons">Početna</a>
                <a href="#" class="link-active">Prijava</a>
                <a href="registracija.html" class="link-buttons">Registracija</a>
                <a href="o_autoru.html" class="link-buttons">Autor</a>
                <div class="hover-links">
                    <button class="dropdownBtn">Popis &darr;</button>
                    <div class="dropdown-linkovi">
                        <a href="upravljanje_posiljkama.html" class="link-buttons">Upravljanje pošiljkama</a>
                        <a href="postanski-uredi.html" class="link-buttons" >Poštanski uredi</a>
                        <a href="izdani-racuni.html" class="link-buttons">Izdani računi</a>
                        <a href="korisnici.html" class="link-buttons">Popis korisnika</a>
                        <a href="drzave.html" class="link-buttons">Države</a>
                    </div>
                </div>
            </div>
            <div class="logout-div">
                <a href="index.html" class="logout-button">Odjava</a>
            </div>
        </div>
    </header>

    <div class="main-content">
        <div class="page-title">
            <p><strong>Prijava</strong></p>
        </div>
        <?php
        if(!isset($_COOKIE['auth'])) {
            echo 
                '<div class="prijava-div">
                    <div class="universal-form">
                        <form action="prijava.php" novalidate name="prijava" method="get" id="prijava">
                            <label for="formusername" class="form-label">Korisničko ime</label><br>
                            <input type="text" id="formusername" name="username" placeholder="Korisničko ime"><br><br>
                            <label for="formpassword" class="form-label">Lozinka</label><br>
                            <input type="password" id="formpassword" name="password" placeholder="Lozinka"><br><br>
                            <a href="registracija.html" class="no-account-link"><p>Nemaš račun? Klikni ovdje.</p></a>
                            <input id="submit" type="submit" name="submit" value="Prijava">
                        </form>
                    </div>
                </div>';
        } else {
            echo 
                '<div class="prijava-div">
                    <div class="universal-form">
                        <form action="../php/odjava.php" novalidate name="prijava" method="get" id="prijava">
                            <label for="formusername" class="form-label">Korisničko ime</label><br>
                            <input type="text" id="formusername" name="username" placeholder="'. $_COOKIE['auth'] .'" disabled><br><br>
                            <label for="formpassword" class="form-label">Lozinka</label><br>
                            <input type="password" id="formpassword" name="password" placeholder="" disabled><br><br>
                            <p class="poruka">Ulogiran si!</p>
                            <input id="logout" type="submit" name="logout" value="Odjava">
                        </form>
                    </div>
                </div>';
        }
        ?>
    </div>

    <div class="footer">
        <div class="copyright-div">
            <p class="footer-ime">Borneo Culović &copy;2020</p>
            <a href="mailto:bculovic@foi.hr" class="footer-email"><p>bculovic@foi.hr</p></a>
        </div>
    </div>


</body>

</html>