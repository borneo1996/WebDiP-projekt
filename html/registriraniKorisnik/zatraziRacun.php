<?php
require '../../php/baza.class.php';

$veza = new Baza();
$veza->spojiDB();
if(isset($_POST['zatraziracun'])){
    $id = $_POST['id_pošiljka'];
}

$dohvatiKilazuUpit = "SELECT kilaža FROM pošiljka WHERE pošiljka_id='{$id}'";
$kilaza = $veza->selectDB($dohvatiKilazuUpit);
$var=$kilaza->fetch_array();
$kile = intval($var[0]);

$dohvatiCijenuUpit = "SELECT cijena_po_kg FROM pošiljka WHERE pošiljka_id='{$id}'";
$rezultat = $veza->selectDB($dohvatiCijenuUpit);
$var=$rezultat->fetch_array();
$cijenakile = intval($var[0]);

$cijenaposiljke = $kile * $cijenakile;

$upit = "UPDATE pošiljka SET račun_zatražen = 1 WHERE POŠILJKA_ID = '$id'";
$upit2 = "INSERT INTO zahtjevi_za_izdavanjem_računa (pošiljka_id, cijena_pošiljke) VALUES ('$id', '$cijenaposiljke')";

$veza->selectDB($upit);
$veza->updateDB($upit2, "upravljanje_posiljkama.php");
$veza->zatvoriDB();
?>