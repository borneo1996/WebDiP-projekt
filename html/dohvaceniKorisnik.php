<?php
require '../php/baza.class.php';

if(isset($_POST['konfigurirajID'])){
    $id = $_POST['identifikator'];
}
if(!isset($_SESSION['uloga'])){
    $_SESSION['uloga'] = $_COOKIE['uloga'];
}
if(!isset($_SESSION['ulogiraniKorisnik'])){
    $_SESSION['ulogiraniKorisnik'] = $_COOKIE['username'];
}

if(isset($_POST['update'])){
    $veza = new Baza();
    $veza->spojiDB();
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $korisnickoime = $_POST['username'];
    $lozinka = $_POST['adminlozinka'];
    $lozinkasha = sha1($lozinka);
    $aktiviran = $_POST['adminaktiviran'];
    $aktivkod = $_POST['adminkod'];
    $aktivan = $_POST['adminaktivan'];
    $blokirando = $_POST['adminblokirando'];
    $identifikat= $_POST['identifikacija'];
    $role = $_POST['adminuloga'];
    $upit = "UPDATE korisnik SET ime='{$ime}', prezime='{$prezime}', korisnicko_ime='{$korisnickoime}', lozinka='{$lozinka}', lozinka_sha1='{$lozinkasha}', email='{$email}', aktiviran='{$aktiviran}', aktivacijski_kod='{$aktivkod}', aktivan='{$aktivan}', blokiran_do='{$blokirando}', uloga_uloga_id='{$role}' WHERE korisnik_ID='{$identifikat}';";  
    if($_SESSION['uloga'] == 3){
        $veza->updateDB($upit, "moderator/korisnici.php");
    }
    if($_SESSION['uloga'] == 4){
        $veza->updateDB($upit, "administrator/korisnici.php");
    }
    $veza->zatvoriDB();

}
if(isset($_POST['obrisi'])){
    $veza = new Baza();
    $veza->spojiDB();
    $identifikat= $_POST['identifikacija'];
    $upit = "DELETE FROM korisnik WHERE korisnik_ID='{$identifikat}'";
    if($_SESSION['uloga'] == 3){
        $veza->updateDB($upit, "moderator/korisnici.php");
    }
    if($_SESSION['uloga'] == 4){
        $veza->updateDB($upit, "administrator/korisnici.php");
    }
    $veza->zatvoriDB();

}


?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Korisnik</title>
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
            <a href="../index.php" class="link-buttons">Početna</a>
            <a href="prijava.php" class="link-buttons">Prijava</a>
            <a href="registracija.php" class="link-buttons">Registracija</a>
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
                    <a href="../php/odjava.php" class="logout-button">Odjava</a>
                </div>
            </div>
    </header>

    <div class="main-content">
        <div class="page-title">
            <p><strong>Korisnik</strong></p>
        </div>
        <div class="registracija-div">
            <div class="universal-form">
                <form action="" method="post" class="forma">
                    <legend>KORISNIK</legend><br><br>
                    <label for="identifikacija" class="form-label">ID</label>
                    <input type="text" class="form-input" id="identifikacija" name="identifikacija" value="<?php echo $id;?>"><br><br>
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
                    <label for="adminlozinkasha" class="form-label">Lozinka (hash)</label>
                    <input type="text" class="form-input" id="adminlozinkasha" name="adminlozinkasha" placeholder="Lozinka"><br><br>
                    <label for="adminaktiviran" class="form-label">Aktiviran</label>
                    <input type="text" class="form-input" id="adminaktiviran" name="adminaktiviran" placeholder="Aktiviran"><br><br>
                    <label for="adminkod" class="form-label">Aktivacijski kod</label>
                    <input type="text" class="form-input" id="adminkod" name="adminkod" placeholder="Aktivacijski kod"><br><br>
                    <label for="adminaktivan" class="form-label">Aktivan</label>
                    <input type="text" class="form-input" id="adminaktivan" name="adminaktivan" placeholder="Aktivan"><br><br>
                    <label for="adminblokirando" class="form-label">Blokiran do</label>
                    <input type="datetime" class="form-input" id="adminblokirando" name="adminblokirando" placeholder="Lozinka"><br><br>
                    <label for="adminuloga" class="form-label">Uloga</label>
                    <input type="text" class="form-input" id="adminuloga" name="adminuloga" placeholder="Uloga"><br><br><br>
                    <input type="submit" id="update" name="update" value="Izmjeni">
                    <input type="submit" id="obrisi" name="obrisi" value="Obriši">
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