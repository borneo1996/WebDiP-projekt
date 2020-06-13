<?php
require './baza.class.php';

$veza = new Baza();
$veza->spojiDB();

$upit = "SELECT r.račun_id, k.ime, k.prezime, r.vrijeme_izdavanja, r.rok_plaćanja, r.plaćen, z.iznos_obrade, z.cijena_pošiljke, z.ukupna_cijena FROM račun as r 
INNER JOIN korisnik as k ON r.izdao=k.korisnik_ID 
INNER JOIN zahtjevi_za_izdavanjem_računa as z ON r.zahtjev_id=z.zahtjev_id";

$rezultat = $veza->selectDB($upit);
$polje = array();
while($var=$rezultat->fetch_array()){
    array_push($polje, $var);
}
echo json_encode($polje);
?>