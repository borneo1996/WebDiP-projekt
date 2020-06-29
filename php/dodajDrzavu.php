<?php
require './baza.class.php';
require_once '../php/session.php';
$veza = new Baza();
$veza->spojiDB();

if(isset($_POST['novadrzava'])){
    $naziv = $_POST['naziv'];
    $veza = new Baza();
    $veza->spojiDB();
    $upit = "INSERT INTO država (naziv_drzave) VALUES ('$naziv');";
    $veza->updateDB($upit, "../html/administrator/drzave.php");
    $veza->zatvoriDB();
}

$veza->zatvoriDB();
?>