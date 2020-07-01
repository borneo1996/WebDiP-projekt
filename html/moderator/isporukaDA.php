<?php
require '../../php/baza.class.php';
require '../../php/session.php';

$veza = new Baza();
$veza->spojiDB();

$idmod = $_COOKIE["identifikator"];
$posiljkaid = $_POST['idposiljke'];

$upit = "UPDATE pošiljka SET isporuka=1 WHERE pošiljka_id='{$posiljkaid}'";

$veza->updateDB($upit, "upravljanje_posiljkama.php");
$veza->zatvoriDB();
?>