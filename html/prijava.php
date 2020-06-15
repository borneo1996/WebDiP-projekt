<?php
error_reporting(0);
require '../php/session.php';
require '../php/baza.class.php';
if($_SESSION['ulogiraniKorisnik'] == null){
    $veza = new Baza();
    $veza->spojiDB();
    $korisnickoIme = $_GET['username'];
    $lozinka = $_GET['password'];
    $auth = null;

    $upit = "SELECT * FROM korisnik WHERE korisnicko_ime='{$korisnickoIme}' AND lozinka='{$lozinka}';";
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
        setcookie("pass", $lozinka, false, '/', false);
        setcookie("uloga", $uloga, false, '/', false);
        header("Refresh:0; url=../index.php");
    } else if ($auth == false){
        setcookie("poruka", $poruka, false, '/', false);
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
            <div class="navigation-bar">
                <a href="../index.php" class="link-buttons">Početna</a>
                <a href="#" class="link-active">Prijava</a>
                <a href="registracija.php" class="link-buttons">Registracija</a>
                <a href="o_autoru.html" class="link-buttons">Autor</a>
                <div class="hover-links">
                    <button class="dropdownBtn">Popis &darr;</button>
                    <div class="dropdown-linkovi">
                        <a href="upravljanje_posiljkama.php" class="link-buttons">Upravljanje pošiljkama</a>
                        <a href="postanski-uredi.php" class="link-buttons" >Poštanski uredi</a>
                        <a href="izdani-racuni.php" class="link-buttons">Izdani računi</a>
                        <a href="korisnici.php" class="link-buttons">Popis korisnika</a>
                        <a href="drzave.php" class="link-buttons">Države</a>
                    </div>
                </div>
            </div>
            <?php
                if($_SESSION['uloga'] >= 2){
                    echo '
                        <div class="logout-div">
                            <a href="../odjava.php" class="logout-button">Odjava</a>
                        </div>
                    ';
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
                            <input type="text" id="formusername" name="username" placeholder="Korisničko ime"><br><br>
                            <label for="formpassword" class="form-label">Lozinka</label><br>
                            <input type="password" id="formpassword" name="password" placeholder="Lozinka"><br><br>
                            <a href="registracija.php" class="no-account-link"><p>Nemaš račun? Klikni ovdje.</p></a>
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
                            <p class="poruka">'. $_SESSION['ulogiraniKorisnik'] .', ulogiran si!</p>
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