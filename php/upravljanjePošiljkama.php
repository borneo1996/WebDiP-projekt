<?php
require './baza.class.php';

$veza = new Baza();
$veza->spojiDB();

$upit = "SELECT p.pošiljka_id, p.cijena_po_kg, p.kilaža, p.isporuka, p.dostavljena, k1.ime AS prviime, k1.prezime AS prviprezime, k2.ime AS drugiime, k2.prezime as drugiprezime, pu1.naziv as pocetni, pu2.naziv as sljedeci, pu3.naziv as zadnji from pošiljka p inner join popis_pošiljki pp on pp.pošiljka_id = p.pošiljka_id inner join korisnik k1 on k1.korisnik_ID = p.korisnik_ID INNER join korisnik k2 on k2.korisnik_ID = p.korisniku INNER join poštanski_ured pu1 on pu1.ured_id = pp.poštanski_ured_polazni_id inner JOIN poštanski_ured pu2 on pu2.ured_id = pp.poštanski_ured_iduci_id inner join poštanski_ured pu3 on pu3.ured_id = pp.poštanski_ured_zadnji_id";


$rezultat = $veza->selectDB($upit);
$polje = array();
while($var=$rezultat->fetch_array()){
    array_push($polje, $var);
}
$veza->zatvoriDB();
echo json_encode($polje);
?>