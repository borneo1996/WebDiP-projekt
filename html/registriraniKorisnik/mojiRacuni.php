<?php
require '../../php/baza.class.php';
require '../../php/session.php';

$veza = new Baza();
$veza->spojiDB();
$id = $_SESSION['korisnik_ID'];
$upit = "SELECT r.račun_id, r.vrijeme_izdavanja, r.rok_plaćanja, r.plaćen, z.iznos_obrade, z.cijena_pošiljke, z.ukupna_cijena, p.korisnik_ID FROM račun as r 
INNER JOIN zahtjevi_za_izdavanjem_računa as z ON z.zahtjev_id=r.zahtjev_id 
INNER JOIN pošiljka as p on p.pošiljka_id=z.pošiljka_id 
WHERE p.korisnik_ID={$id}";

$rezultat = $veza->selectDB($upit);
$polje = array();
while($var=$rezultat->fetch_array()){
    array_push($polje, $var);
}
$veza->zatvoriDB();
echo json_encode($polje);
?>