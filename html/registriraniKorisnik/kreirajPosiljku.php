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

$upitDohvatID = "SELECT * FROM pošiljka WHERE kilaža={$tezina} AND korisnik_ID={$mojid} AND korisniku={$id}";
$rezultat = $veza->selectDB($upitDohvatID);
$polje = array();
$var=$rezultat->fetch_array();
$idPosiljke = intval($var[0]);
$upitPopisPosiljka = "INSERT INTO popis_pošiljki (pošiljka_id) VALUES ('$idPosiljke')";
$veza->updateDB($upitPopisPosiljka, "upravljanje_posiljkama.php");
$veza->zatvoriDB();
?>