<?php
require '../../php/baza.class.php';
require '../../php/session.php';

$veza = new Baza();
$veza->spojiDB();
if(isset($_POST['izdajRacun'])){
    $idzahtjev = $_POST['idzahtjev'];
    $iznosobrade = $_POST['iznosobrade'];
    $idmoda = $_COOKIE['identifikator'];
}

$upitDohvatiCijenu = "SELECT cijena_pošiljke FROM zahtjevi_za_izdavanjem_računa WHERE zahtjev_id={$idzahtjev}";
$rezultat = $veza->selectDB($upitDohvatiCijenu);
$polje = array();
$var=$rezultat->fetch_array();
$cijenaposiljke = intval($var[0]);
$ukcijena = $cijenaposiljke + $iznosobrade;

$upitZahtjev = "UPDATE zahtjevi_za_izdavanjem_računa SET iznos_obrade='{$iznosobrade}', ukupna_cijena='{$ukcijena}', prihvaćen=1";
$veza->selectDB($upitZahtjev);

$upit = "INSERT INTO račun (izdao, iznos_obrade, cijena_pošiljke, ukupni_iznos, zahtjev_id) VALUES ('{$idmoda}','{$iznosobrade}','{$cijenaposiljke}','{$ukcijena}','{$idzahtjev}')";
$veza->updateDB($upit, "zahtjevi.php");
$veza->zatvoriDB();
?>