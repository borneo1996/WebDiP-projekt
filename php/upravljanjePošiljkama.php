<?php
require './baza.class.php';

$veza = new Baza();
$veza->spojiDB();

$upit = "SELECT p.pošiljka_id, p.cijena_po_kg, p.kilaža, p.isporuka, p.dostavljena, p.sljedeci_ured, k.ime, k.prezime, pp.poštanski_ured_iduci_id, pp.poštanski_ured_zadnji_id, pu.naziv 
FROM pošiljka AS p 
INNER JOIN korisnik AS k ON p.korisnik_ID=k.korisnik_ID 
INNER JOIN popis_pošiljki AS pp ON p.pošiljka_id=pp.pošiljka_id
INNER JOIN poštanski_ured AS pu ON pp.poštanski_ured_zadnji_id=pu.ured_id OR pp.poštanski_ured_iduci_id=pu.ured_id";

$rezultat = $veza->selectDB($upit);
$polje = array();
while($var=$rezultat->fetch_array()){
    array_push($polje, $var);
}
echo json_encode($polje);
?>