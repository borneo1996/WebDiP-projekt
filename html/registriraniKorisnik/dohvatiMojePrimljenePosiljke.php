<?php
require '../../php/baza.class.php';

$veza = new Baza();
$veza->spojiDB();
$id = $_COOKIE['identifikator'];
$upit = "SELECT p.pošiljka_id, p.cijena_po_kg, p.kilaža, p.isporuka, p.dostavljena, p.račun_zatražen, p.sljedeci_ured, p.korisniku, k.ime, k.prezime FROM pošiljka AS p INNER JOIN korisnik as k ON k.korisnik_ID=p.korisnik_ID WHERE p.korisniku={$id}";

$rezultat = $veza->selectDB($upit);
$polje = array();
while($var=$rezultat->fetch_array()){
    array_push($polje, $var);
}
$veza->zatvoriDB();
echo json_encode($polje);
?>