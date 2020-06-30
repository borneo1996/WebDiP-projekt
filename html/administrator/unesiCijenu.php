<?php
require '../../php/baza.class.php';
require '../../php/session.php';

$veza = new Baza();
$veza->spojiDB();
if(isset($_POST['dodajcijenu'])){
    $idposiljke = $_POST['pošiljkaID'];
    $cijena = $_POST['cijena'];
}


$upit = "UPDATE pošiljka SET cijena_po_kg='{$cijena}' WHERE pošiljka_id='{$idposiljke}'";
$veza->updateDB($upit, "upravljanje_posiljkama.php");

$veza->zatvoriDB();
?>