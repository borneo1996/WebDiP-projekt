$(document).ready(function () {
    naslov = $(document).find("title").text();
    console.log(naslov);
    if (naslov == "Korisnici") {
        $.ajax({
            url: 'http://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/korisnici.php',
            type: 'GET',
            dataType: 'json',
            success: function (korisnici) {
                const users = $(korisnici);
                const tablica = $('#tablicaKorisnici');
                var i = 0;
                var count = korisnici.length;
                for(i;i<count;i++){
                    var id = users[i].korisnik_ID;
                    var ime = users[i].ime;
                    var prezime = users[i].prezime;
                    var username = users[i].korisnicko_ime;
                    var lozinka = users[i].lozinka;
                    var lozinkaSha1 = users[i].lozinka_sha1;
                    var email = users[i].email;
                    var status = users[i].status;
                    if(status == 1){
                        status = "Aktivan";
                    } else {
                        status = "Blokiran"
                    };
                    var blok_do = users[i].blokiran_do;
                    if(blok_do == null){
                        blok_do = "/";
                    }
                    var uloga = users[i].uloga_uloga_id;
                    if(uloga == 1){
                        uloga = "Neregistrirani korisnik";
                    } else if(uloga == 2){
                        uloga = "Registrirani korisnik";
                    } else if(uloga == 3){
                        uloga = "Moderator/poštar";
                    } else if(uloga == 4){
                        uloga = "Administrator/upravitelj";
                    }
                    var redak = $('<tr>').append(
                        $('<td>').text(id),
                        $('<td>').text(ime),
                        $('<td>').text(prezime),
                        $('<td>').text(username),
                        $('<td>').text(lozinka),
                        $('<td>').text(lozinkaSha1),
                        $('<td>').text(email),
                        $('<td>').text(status),
                        $('<td>').text(blok_do),
                        $('<td>').text(uloga)
                    );
                    tablica.append(redak);
                }
                $("#tablicaKorisnici").dataTable();
            },
            error : function() {
                console.log("Error");
            } 
        });
    }
    if (naslov == "Poštanski uredi") {
        $.ajax({
            url: 'http://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/postanski_uredi.php',
            type: 'GET',
            dataType: 'json',
            success: function (uredi) {
                const p_uredi = $(uredi);
                const tablica = $('#tablicaUreda');
                var i = 0;
                var count = p_uredi.length;
                for(i;i<count;i++){
                    var id = p_uredi[i].ured_id;
                    var naziv = p_uredi[i].naziv;
                    var adresa = p_uredi[i].adresa;
                    var grad = p_uredi[i].grad;
                    var drzava = p_uredi[i].naziv_drzave;
                    var promljene_posiljke = p_uredi[i].broj_primljenih_pošiljki;
                    var poslane_posiljke = p_uredi[i].broj_poslanih_pošiljki;

                    var redak = $('<tr>').append(
                        $('<td>').text(id),
                        $('<td>').text(naziv),
                        $('<td>').text(adresa),
                        $('<td>').text(grad),
                        $('<td>').text(drzava),
                        $('<td>').text(promljene_posiljke),
                        $('<td>').text(poslane_posiljke)
                    );
                    tablica.append(redak);
                }
                $("#tablicaUreda").dataTable();
            },
            error : function() {
                console.log("Error");
            } 
        });
    }
})