<?php
require './baza.class.php';

$veza = new Baza();
$veza->spojiDB();

$upit = " SELECT * FROM država";

$rezultat = $veza->selectDB($upit);
$polje = array();
while($var=$rezultat->fetch_array()){
    array_push($polje, $var);
}
$veza->zatvoriDB();
echo json_encode($polje);
?>