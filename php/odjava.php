<?php
if(isset($_COOKIE['auth'])){
    unset($_COOKIE['auth']);
    setcookie('auth', null, -1, '/');

}
if(isset($_COOKIE['uloga'])){
    unset($_COOKIE['uloga']);
    setcookie('uloga', null, -1, '/');
}

header("Refresh:0; url=../html/prijava.php");
?>