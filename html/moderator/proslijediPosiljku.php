<?php
require '../../php/baza.class.php';
require '../../php/session.php';

$veza = new Baza();
$veza->spojiDB();

$idmod = $_COOKIE["identifikator"];
$posiljkaid = $_POST['idposiljke2'];
$idured = $_POST['ured'];
$upit = "UPDATE pošiljka SET sljedeci_ured='{$idured}' WHERE pošiljka_id='{$posiljkaid}'";
$veza->selectDB($upit);

$upit = "UPDATE popis_pošiljki SET poštanski_ured_iduci_id='{$idured}' WHERE pošiljka_id='{$posiljkaid}'";
$veza->updateDB($upit, "upravljanje_posiljkama.php");
$veza->zatvoriDB();
?>