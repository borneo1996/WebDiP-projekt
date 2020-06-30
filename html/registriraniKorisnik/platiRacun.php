<?php
require '../../php/baza.class.php';
require '../../php/session.php';

$veza = new Baza();
$veza->spojiDB();
if(isset($_POST['platiracun'])){
    $id = $_POST['racuni'];
}
$upit = "UPDATE račun SET plaćen = 1 WHERE račun_id = {$id};";

$veza->updateDB($upit, "izdani-racuni.php");
$veza->zatvoriDB();
?>