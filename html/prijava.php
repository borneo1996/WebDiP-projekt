<?php
error_reporting(0);
require '../php/session.php';
require '../php/baza.class.php';
require '../php/https.php';

if($_SESSION['aktiviran']=='0'){
    header("Refresh: 0; url=aktivacija.php");
}
if($_SESSION['ulogiraniKorisnik'] == null){
    $veza = new Baza();
    $veza->spojiDB();
    $korisnickoIme = $_GET['username'];
    $lozinka = $_GET['password'];
    $pamtime = $_GET['zapamtime'];
    $auth = null;
    $upit = "SELECT * FROM korisnik WHERE korisnicko_ime='{$korisnickoIme}' AND lozinka='{$lozinka}';";
    $upit_korisnik = "SELECT * FROM korisnik WHERE korisnicko_ime='{$korisnickoIme}';";
    $dohvaceni_korisnik = $veza->selectDB($upit_korisnik);
    $rezultat = $veza->selectDB($upit);
    if($rezultat){
        $naden = true;
    } else {
        $naden = false;
        $poruka = "Krivo unešeni podaci!";
    }
    while($redak = mysqli_fetch_array($rezultat)){
        if($redak){
            if($redak['blokiran_do']){
                $auth = false;
                $poruka = "Račun je blokiran do ".$redak['blokiran_do'];
            } else {
                $auth = true;
                if($pamtime){
                    setcookie("username", $korisnickoIme, false, '/', false);
                }
                if($redak['aktiviran']=='1'){
                    $aktiviran = true;
                } else {
                    $aktiviran = false;
                }
                $_SESSION['aktiviran'] = $aktiviran;
                $email = $redak['email'];
                $username = $redak['korisnicko_ime'];
                $_SESSION['ulogiraniKorisnik'] = $redak['korisnicko_ime'];
                $password = $redak['lozinka'];
                $uloga = $redak['uloga_uloga_id'];
                $_SESSION['uloga'] = $redak['uloga_uloga_id'];
            }
        } 
    }
    if($auth){
        setcookie("auth", $korisnickoIme, false, '/', false);
        setcookie("uloga", $uloga, false, '/', false);
        session_start();
        if(!$aktiviran){
            header("Refresh:0; url=aktivacija.php");
        } else {
            header("Refresh:0; url=../index.php");
        }
    } else if ($auth == false){
    }

    $veza->zatvoriDB();
    if(!isset($_COOKIE['uloga'])){
        $_COOKIE['uloga'] = 1;
    }
    $_SESSION['uloga'] = $_COOKIE['uloga'];
}
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
            <?php
                if($_SESSION['uloga'] < 2 ){
                    echo '
                    <div class="navigation-bar">
                        <a href="../index.php" class="link-buttons">Početna</a>
                        <a href="prijava.php" class="link-active">Prijava</a>
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
                } else if ($_SESSION['uloga'] < 3 ){
                    echo '
                        <div class="navigation-bar">
                        <a href="../index.php" class="link-buttons">Početna</a>
                        <a href="prijava.php" class="link-active">Prijava</a>
                        <a href="registracija.php" class="link-buttons">Registracija</a>
                        <a href="o_autoru.html" class="link-buttons">Autor</a>
                        <div class="hover-links">
                            <button class="dropdownBtn">Popis &darr;</button>
                            <div class="dropdown-linkovi">
                                <a href="upravljanje_posiljkama.php" class="link-buttons">Upravljanje pošiljkama</a>
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
                        <a href="prijava.php" class="link-active">Prijava</a>
                        <a href="registracija.php" class="link-buttons">Registracija</a>
                        <a href="o_autoru.html" class="link-buttons">Autor</a>
                        <div class="hover-links">
                            <button class="dropdownBtn">Popis &darr;</button>
                            <div class="dropdown-linkovi">
                                <a href="upravljanje_posiljkama.php" class="link-buttons">Upravljanje pošiljkama</a>
                                <a href="postanski-uredi.php" class="link-buttons">Poštanski uredi</a>
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
                        <a href="prijava.php" class="link-active">Prijava</a>
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
            <p><strong>Prijava</strong></p>
        </div>
        <?php
        if($_SESSION['ulogiraniKorisnik'] == null) {
            echo 
                '<div class="prijava-div">
                    <div class="universal-form">
                        <form action="" novalidate name="prijava" method="get" id="prijava">
                            <label for="formusername" class="form-label">Korisničko ime</label><br>
                            <input type="text" id="formusername" name="username"'; if($_COOKIE['username'] != null){
                                echo 'placeholder="" value="'.$_COOKIE['username'].'"';
                            } else {
                                echo 'placeholder="Korisničko ime" value=""';
                            }
                            echo '"><br><br>
                            <label for="formpassword" class="form-label">Lozinka</label><br>
                            <input type="password" id="formpassword" name="password" placeholder="Lozinka"><br><br>
                            <input type="checkbox" id="zapamtime" name="zapamtime" class="zapamtime">
                            <label for="zapamtime" class="label-zapamti">Zapamti me</label><br>
                            <a href="registracija.php" class="no-account-link">Nemaš račun? Klikni ovdje.</a><br>
                            <a href="zaboravljenaLozinka.php" class="no-account-link" style="color:#028090;">Zaboravljena lozinka?</a><br>
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
                            <input type="text" id="formusername" name="username" placeholder="'. $_SESSION['ulogiraniKorisnik'] .'" disabled><br><br>
                            <label for="formpassword" class="form-label">Lozinka</label><br>
                            <input type="password" id="formpassword" name="password" placeholder="" disabled><br><br>
                            <p class="poruka">'. $_SESSION['ulogiraniKorisnik'] .', ulogiran/a si!</p>
                            <input id="logout" type="submit" name="logout" value="Odjava">
                        </form>
                    </div>
                </div>';
        }
        ?>
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