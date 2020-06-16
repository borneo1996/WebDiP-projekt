<?php
require './baza.class.php';
require 'session.php';

$veza = new Baza();
$veza->spojiDB();
$user = $_SESSION['ulogiraniKorisnik'];

$upit = "SELECT * FROM korisnik WHERE korisnicko_ime='{$user}';";
$rezultat = $veza->selectDB($upit);
while($redak = mysqli_fetch_array($rezultat)){
    $_SESSION['aktiviran'] = $redak['aktiviran'];
    $_SESSION['uloga'] = $redak['uloga'];
}

header("Refresh:0; url=../index.php");

?>