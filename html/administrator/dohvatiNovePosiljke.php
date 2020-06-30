<?php
require '../../php/baza.class.php';
require '../../php/session.php';

$veza = new Baza();
$veza->spojiDB();
$upit = "SELECT pp.zapis_id, p.pošiljka_id, pp.vrijeme_slanja, pp.suglasnost, pp.poštanski_ured_polazni_id, pp.poštanski_ured_zadnji_id FROM popis_pošiljki as pp INNER JOIN pošiljka AS p ON p.pošiljka_id=pp.pošiljka_id";

$rezultat = $veza->selectDB($upit);
$polje = array();
while($var=$rezultat->fetch_array()){
    array_push($polje, $var);
}
$veza->zatvoriDB();
echo json_encode($polje);
?>