<?php
require '../../php/baza.class.php';

$veza = new Baza();
$veza->spojiDB();
if(isset($_POST['zatraziracun'])){
    $id = $_POST['id_pošiljka'];
}
$upit = "UPDATE pošiljka SET račun_zatražen = 1 WHERE POŠILJKA_ID = '$id'";
$upit2 = "INSERT INTO zahtjevi_za_izdavanjem_računa (pošiljka_id) VALUES ('$id')";

$veza->selectDB($upit);
$veza->updateDB($upit2, "upravljanje_posiljkama.php");
$veza->zatvoriDB();
?>