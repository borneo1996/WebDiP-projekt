<?php
require './baza.class.php';

$veza = new Baza();
$veza->spojiDB();

$upit = "SELECT p.ured_id, p.naziv, p.adresa, p.grad, država.naziv_drzave, p.broj_primljenih_pošiljki, p.broj_poslanih_pošiljki FROM poštanski_ured AS p INNER JOIN država ON p.država_drzava_id=država.drzava_id ";
$rezultat = $veza->selectDB($upit);
$polje = array();
while($var=$rezultat->fetch_array()){
    array_push($polje, $var);
}
echo json_encode($polje);
?>