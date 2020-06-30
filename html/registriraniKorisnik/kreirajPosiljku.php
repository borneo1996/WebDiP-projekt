<?php
require '../../php/baza.class.php';
require '../../php/session.php';

$veza = new Baza();
$veza->spojiDB();
if(isset($_POST['kreirajposiljku'])){
    $mojid = $_COOKIE['identifikator'];
    $id = $_POST['korisnik'];
    $tezina = $_POST['tezina'];
}
$upit = "INSERT INTO pošiljka (kilaža, korisnik_ID, korisniku) VALUES ('$tezina', '$mojid', '$id')";
$veza->updateDB($upit, "upravljanje_posiljkama.php");
$veza->zatvoriDB();
?>