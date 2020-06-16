<?php
require 'baza.class.php';
require 'session.php';

$veza = new Baza();
$veza->spojiDB();

$ime = $_COOKIE['REGISTER_ime'];
$prezime = $_COOKIE['REGISTER_prezime'];
$username = $_COOKIE['REGISTER_username'];
$email = $_COOKIE['REGISTER_email'];
$lozinka = $_COOKIE['REGISTER_lozinka'];
$lozinkasha = $_COOKIE['REGISTER_lozinkasha'];
$kod = $_COOKIE['REGISTER aktivacijski_kod'];
$aktiviran = $_COOKIE['REGISTER aktiviran'];
$aktivan = $_COOKIE['REGISTER aktivan'];
$uloga = $_COOKIE['REGISTER uloga'];

$upit = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, lozinka_sha1, email, aktiviran, aktivacijski_kod, aktivan, blokiran_do, uloga_uloga_id) 
VALUES ($ime, $prezime, $username, $lozinka, $lozinkasha, $email, $aktiviran, $kod, $aktivan, null, $uloga)";
$upittest = "INSERT INTO korisnik (ime, prezime) VALUES ('test', 'testic')";
$rezultat = $veza->updateDB($upit, '');
$veza->zatvoriDB();
?>