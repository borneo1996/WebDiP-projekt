<?php
require './baza.class.php';

$veza = new Baza();
$veza->spojiDB();

$upit = " SELECT p.pošiljka_id, p.cijena_po_kg, p.kilaža, p.isporuka, p.dostavljena, p.sljedeci_ured, k.ime, k.prezime, pu1.naziv AS polazni, pu2.naziv AS zadnji, pu3.naziv AS sljedeci FROM poštanski_ured AS pu1, poštanski_ured AS pu2, poštanski_ured AS pu3, popis_pošiljki AS pp, pošiljka  AS p, korisnik AS k
WHERE pp.poštanski_ured_polazni_id = pu1.ured_id AND pp.poštanski_ured_zadnji_id = pu2.ured_id AND pp.poštanski_ured_iduci_id = pu3.ured_id AND pp.pošiljka_id = p.pošiljka_id AND p.korisnik_ID = k.korisnik_ID";

$rezultat = $veza->selectDB($upit);
$polje = array();
while($var=$rezultat->fetch_array()){
    array_push($polje, $var);
}
$veza->zatvoriDB();
echo json_encode($polje);
?>