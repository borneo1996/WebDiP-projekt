<?php
require 'baza.class.php';
require 'session.php';

$veza = new Baza();
$veza->spojiDB();
$unique_username = true;
$ime = isset($_POST['ime']) ? $_POST['ime'] : '';
$prezime = isset($_POST['prezime']) ? $_POST['prezime'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$upit_provjere = "SELECT * FROM korisnik WHERE korisnicko_ime='$username'";



$email = isset($_POST['email']) ? $_POST['email'] : '';
$lozinka = isset($_POST['password']) ? $_POST['password'] : '';
$lozinkasha = isset($_POST['password']) ? sha1($_POST['password']) : '';
$kod = "";
for($i=1;$i<=7; $i++){
    $kod .= strval(rand(0,9));
}
$aktiviran = "0";
$aktivan = "1";
$uloga = "2";

$upit = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, lozinka_sha1, email, aktiviran, aktivacijski_kod, aktivan, blokiran_do, uloga_uloga_id) 
VALUES ('$ime', '$prezime', '$username', '$lozinka', '$lozinkasha', '$email', '$aktiviran', '$kod', '$aktivan', null, '$uloga')";
$upittest = "INSERT INTO korisnik (ime, prezime) VALUES ('test', 'testic')";
if($ime && $prezime && $email && $lozinka && $unique_username){
    $veza->updateDB($upit, '');
    $subject = "Pošta - Aktivacijski kod";
    $tekst = "Ovo je vaš aktivacijski kod: " . $kod;
    $headers = "FROM: bculovic@foi.hr";
    mail($email, $subject, $tekst, $headers);
    echo 'Registracija uspješna! Provjerite email radi aktivacijskog koda!';
    echo '<br><br><button><a href="../index.php">Prijava</a></button>';
} else {
    if(!$unique_username){
        echo 'Korisnik sa tim korisničkim imenom već postoji!';
        echo '<br><br><button href="../index.php">Natrag na početnu</button>';
    }
    echo 'Nešto ne valja sa unosom u formu.';
}
$veza->zatvoriDB();
?>