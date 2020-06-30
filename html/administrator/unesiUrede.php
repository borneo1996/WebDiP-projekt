<?php
require '../../php/baza.class.php';
require '../../php/session.php';

$veza = new Baza();
$veza->spojiDB();
if(isset($_POST['dodajurede'])){
    $idzapisa = $_POST['zapis_id'];
    $polazniured = $_POST['polazni_id'];
    $odredisniured = $_POST['odredisni_id'];
}
$upit = "UPDATE popis_pošiljki SET poštanski_ured_polazni_id='{$polazniured}', poštanski_ured_iduci_id='{$polazniured}', poštanski_ured_zadnji_id='{$odredisniured}' WHERE zapis_id='{$idzapisa}'";
$veza->selectDB($upit);

$upitDohvatiID = "SELECT pošiljka_id FROM popis_pošiljki WHERE zapis_id={$idzapisa}";
$rezultat = $veza->selectDB($upitDohvatiID);
$var=$rezultat->fetch_array();
$idPosiljke = intval($var[0]);
$upitPopisPosiljka = "UPDATE pošiljka SET sljedeci_ured='{$polazniured}' WHERE pošiljka_id='{$idPosiljke}'";

$veza->updateDB($upitPopisPosiljka, "upravljanje_posiljkama_kreirane.php");
$veza->zatvoriDB();
?>