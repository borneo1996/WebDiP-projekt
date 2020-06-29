<?php

function odjava(){
    if(isset($_SESSION['ulogiraniKorisnik'])){
        session_unset($_SESSION['ulogiraniKorisnik']);
    }
    if(isset($_SESSION['blokiran'])){
        session_unset($_SESSION['blokiran']);
    }
    if(isset($_SESSION['uloga'])){
        session_unset($_SESSION['uloga']);
    }

    if(isset($_COOKIE['auth'])){
        unset($_COOKIE['auth']);
        setcookie('auth', null, -1, '/');
    
    }
    if(isset($_COOKIE['uloga'])){
        unset($_COOKIE['uloga']);
        setcookie('uloga', null, -1, '/');
    }
    $_COOKIE['uloga'] = 1;
    session_start();
    session_destroy();
    $_SESSION = array();
}

odjava();
header("Refresh:0; url=../index.php");
?>