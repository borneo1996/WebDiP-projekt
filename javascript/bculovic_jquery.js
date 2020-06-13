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
                    var moderator = p_uredi[i].ime + " " + p_uredi[i].prezime;
                    var promljene_posiljke = p_uredi[i].broj_primljenih_pošiljki;
                    var poslane_posiljke = p_uredi[i].broj_poslanih_pošiljki;

                    var redak = $('<tr>').append(
                        $('<td>').text(id),
                        $('<td>').text(naziv),
                        $('<td>').text(adresa),
                        $('<td>').text(grad),
                        $('<td>').text(drzava),
                        $('<td>').text(moderator),
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
    if (naslov == "Izdani računi") {
        $.ajax({
            url: 'http://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/izdaniRacuni.php',
            type: 'GET',
            dataType: 'json',
            success: function (rezultat) {
                const racuni = $(rezultat);
                const tablica = $('#tablicaRacuni');
                var i = 0;
                var count = racuni.length;
                for(i;i<count;i++){
                    var id = racuni[i].račun_id;
                    var izdao = racuni[i].ime + " " + racuni[i].prezime;
                    var vr_izdavanja = racuni[i].vrijeme_izdavanja;
                    var rok_placanja = racuni[i].rok_plaćanja;
                    var placen = racuni[i].plaćen;
                    if(placen == 1){
                        placen = "DA";
                    } else {
                        placen = "NE";
                    }
                    var i_obrade = racuni[i].iznos_obrade;
                    var cijena_posiljke = racuni[i].cijena_pošiljke;
                    var uk_cijena = racuni[i].ukupna_cijena;

                    var redak = $('<tr>').append(
                        $('<td>').text(id),
                        $('<td>').text(izdao),
                        $('<td>').text(vr_izdavanja),
                        $('<td>').text(rok_placanja),
                        $('<td>').text(placen),
                        $('<td>').text(i_obrade),
                        $('<td>').text(cijena_posiljke),
                        $('<td>').text(uk_cijena)
                    );
                    tablica.append(redak);
                }
                $("#tablicaRacuni").dataTable();
            },
            error : function() {
                console.log("Error");
            } 
        });
    }
    if (naslov == "Upravljanje pošiljkama") {
        $.ajax({
            url: 'http://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/upravljanjePošiljkama.php',
            type: 'GET',
            dataType: 'json',
            success: function (rezultat) {
                const posiljke = $(rezultat);
                const tablica = $('#tablicaPosiljke');
                var i = 0;
                var count = posiljke.length;
                for(i;i<count;i++){
                    var id = posiljke[i].pošiljka_id;
                    var cijenapkg = posiljke[i].cijena_po_kg;
                    var kilaza = posiljke[i].kilaža;
                    var isporuka = posiljke[i].isporuka;
                    var dostavljen = posiljke[i].dostavljena;
                    var next = posiljke[i].naziv;
                    var last = posiljke[i].naziv;
                    var za = posiljke[i].ime + " " + posiljke[i].prezime;

                    if(isporuka == 1){
                        isporuka = "DA";
                    } else {
                        isporuka = "NE";
                    }

                    if(dostavljen == 1){
                        dostavljen = "DA";
                    } else {
                        dostavljen = "NE";
                    }

                    var redak = $('<tr>').append(
                        $('<td>').text(id),
                        $('<td>').text(cijenapkg),
                        $('<td>').text(kilaza),
                        $('<td>').text(isporuka),
                        $('<td>').text(dostavljen),
                        $('<td>').text(next),
                        $('<td>').text(last),
                        $('<td>').text(za)
                    );
                    tablica.append(redak);
                }
                $("#tablicaPosiljke").dataTable();
            },
            error : function() {
                console.log("Error");
            } 
        });
    }
})