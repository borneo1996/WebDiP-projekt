<?php
error_reporting(0);
require '../php/session.php';
require '../php/baza.class.php';
require '../php/https.php';
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
    