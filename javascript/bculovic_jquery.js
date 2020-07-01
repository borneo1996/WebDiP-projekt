$(document).ready(function () {
    naslov = $(document).find("title").text();
    
    
    if (naslov == "Novi ured") {
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/korisnici.php',
            type: 'GET',
            dataType: 'json',
            success: function (korisnici) {
                const users = $(korisnici);
                var count = korisnici.length;
                var i = 0;
                var select = document.getElementById('moderator');
                for(i;i<count;i++){
                    if(users[i].uloga_uloga_id == 3){
                        var option = document.createElement('option');
                        option.value = users[i].korisnik_ID;
                        option.innerHTML = users[i].ime + " " + users[i].prezime;
                        select.appendChild(option);
                    }
                }
            },
            error : function() {
                console.log("Error");
            } 
        });
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/drzave.php',
            type: 'GET',
            dataType: 'json',
            success: function (rezultat) {
                const drzave = $(rezultat);
                var i = 0;
                var count = drzave.length;
                var select = document.getElementById('drzava');
                for(i;i<count;i++){
                    var option = document.createElement('option');
                    option.value = drzave[i].drzava_id;
                    option.innerHTML = drzave[i].naziv_drzave;
                    select.appendChild(option);
                }
            },
            error : function() {
                console.log("Error");
            } 
        });
    }

    if (naslov == "Korisnici") {
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/korisnici.php',
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
                    var status = users[i].aktivan;
                    if(status == 1){
                        status = "Aktivan";
                    } else {
                        status = "Blokiran"
                    };
                    var blok_do = users[i].blokiran_do;
                    if(blok_do == null || blok_do == "0000-00-00 00:00:00"){
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
                        $('<td class="tableCell">').text(id),
                        $('<td class="tableCell">').text(ime),
                        $('<td class="tableCell">').text(prezime),
                        $('<td class="tableCell">').text(username),
                        $('<td class="tableCell">').text(lozinka),
                        $('<td class="tableCell">').text(lozinkaSha1),
                        $('<td class="tableCell">').text(email),
                        $('<td class="tableCell">').text(status),
                        $('<td class="tableCell">').text(blok_do),
                        $('<td class="tableCell">').text(uloga)
                    );
                    tablica.append(redak);
                }
                $("#tablicaKorisnici").dataTable({"pageLength": 8});
                $('.tableCell').each(function(){
                    var tekst = $(this).text();
                    if(tekst == 'Blokiran'){
                        $(this).css('background','#ff95a3');
                    }
                })
            },
            error : function() {
                console.log("Error");
            } 
        });
    }
    if (naslov == "Poštanski uredi") {
        var drzavaInput = "";
        var drzavaInputDuljina = drzavaInput.length;
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/postanski_uredi.php',
            type: 'GET',
            dataType: 'json',
            success: function (uredi) {
                const p_uredi = $(uredi);
                const tablica = $('#tablicaUreda');
                var i = 0;
                var count = p_uredi.length;
                $("#tablicaUreda tbody").empty();
                for(i;i<count;i++){
                    var id = p_uredi[i].ured_id;
                    var naziv = p_uredi[i].naziv;
                    var adresa = p_uredi[i].adresa;
                    var grad = p_uredi[i].grad;
                    var drzava = p_uredi[i].naziv_drzave;
                    var moderator = p_uredi[i].ime + " " + p_uredi[i].prezime;
                    var promljene_posiljke = p_uredi[i].broj_primljenih_pošiljki;
                    var poslane_posiljke = p_uredi[i].broj_poslanih_pošiljki;
                    if(drzavaInputDuljina<1){
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
                    }else if(drzavaInput==drzava){
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
                }
            },
            error : function() {
                console.log("Error");
            } 
        });
        $("#pretraga").on('input', function(){
            drzavaInput = document.getElementById("pretraga").value;
            var drzavaInputDuljina = drzavaInput.length;
            $.ajax({
                url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/postanski_uredi.php',
                type: 'GET',
                dataType: 'json',
                success: function (uredi) {
                    const p_uredi = $(uredi);
                    const tablica = $('#tablicaUreda');
                    var i = 0;
                    var count = p_uredi.length;
                    $("#tablicaUreda tBody").empty();
                    for(i;i<count;i++){
                        var id = p_uredi[i].ured_id;
                        var naziv = p_uredi[i].naziv;
                        var adresa = p_uredi[i].adresa;
                        var grad = p_uredi[i].grad;
                        var drzava = p_uredi[i].naziv_drzave;
                        var moderator = p_uredi[i].ime + " " + p_uredi[i].prezime;
                        var promljene_posiljke = p_uredi[i].broj_primljenih_pošiljki;
                        var poslane_posiljke = p_uredi[i].broj_poslanih_pošiljki;
                        if(drzavaInputDuljina<1){
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
                        }else if(drzava.search(drzavaInput) >= 0){
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
                    }
                },
                error : function() {
                    console.log("Error");
                } 
            });
        })
        $("#tablicaUreda").dataTable({"pageLength": 8});

    }

    if (naslov == "Poštanski uredi - Korisnik") {
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/postanski_uredi.php',
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
                $("#tablicaUreda").dataTable({"pageLength": 8});
            },
            error : function() {
                console.log("Error");
            } 
        });

    }

    if (naslov == "Poštanski uredi - Admin") {
        var drzavaInput = "";
        var drzavaInputDuljina = drzavaInput.length;
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/postanski_uredi.php',
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
                $("#tablicaUreda").dataTable({"pageLength": 8});
            },
            error : function() {
                console.log("Error");
            } 
        });
        

    }

    if (naslov == "Izdani računi") {
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/izdaniRacuni.php',
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
                        $('<td class="tableCell">').text(id),
                        $('<td class="tableCell">').text(izdao),
                        $('<td class="tableCell">').text(vr_izdavanja),
                        $('<td class="tableCell">').text(rok_placanja),
                        $('<td class="tableCell">').text(placen),
                        $('<td class="tableCell">').text(i_obrade),
                        $('<td class="tableCell">').text(cijena_posiljke),
                        $('<td class="tableCell">').text(uk_cijena)
                    );
                    tablica.append(redak);
                }
                $("#tablicaRacuni").dataTable({"pageLength": 8});
                $('.tableCell').each(function(){
                    var tekst = $(this).text();
                    if(tekst == 'NE'){
                        $(this).css('background','#ff95a3');
                    } else if (tekst == 'DA'){
                        $(this).css('background','#baffbb');
                    }
                })
            },
            error : function() {
                console.log("Error");
            } 
        });
    }

    if (naslov == "Moji računi - mod") {
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/html/moderator/mojiIzdaniRacuni.php',
            type: 'GET',
            dataType: 'json',
            success: function (rezultat) {
                const racuni = $(rezultat);
                const tablica = $('#tablicaMojiRacuni');
                var i = 0;
                var count = racuni.length;
                for(i;i<count;i++){
                    
                    var id = racuni[i].račun_id;
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
                    var uk_cijena = racuni[i].ukupni_iznos;

                    var redak = $('<tr>').append(
                        $('<td class="tableCell">').text(id),
                        $('<td class="tableCell">').text(vr_izdavanja),
                        $('<td class="tableCell">').text(rok_placanja),
                        $('<td class="tableCell">').text(placen),
                        $('<td class="tableCell">').text(i_obrade),
                        $('<td class="tableCell">').text(cijena_posiljke),
                        $('<td class="tableCell">').text(uk_cijena)
                    );
                    tablica.append(redak);
                }
                $("#tablicaMojiRacuni").dataTable({"pageLength": 8});
                $('.tableCell').each(function(){
                    var tekst = $(this).text();
                    if(tekst == 'NE'){
                        $(this).css('background','#ff95a3');
                    } else if (tekst == 'DA'){
                        $(this).css('background','#baffbb');
                    }
                })
            },
            error : function() {
                console.log("Error");
            } 
        });
    }

    if (naslov == "Upravljanje pošiljkama") {
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/upravljanjePošiljkama.php',
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
                    var starting = posiljke[i].pocetni;
                    var next = posiljke[i].sljedeci;
                    var last = posiljke[i].zadnji;
                    var od = posiljke[i].prviime + " " + posiljke[i].prviprezime;
                    var za = posiljke[i].drugiime + " " + posiljke[i].drugiprezime;

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
                        $('<td class="tableCell">').text(id),
                        $('<td class="tableCell">').text(cijenapkg),
                        $('<td class="tableCell">').text(kilaza),
                        $('<td class="tableCell">').text(isporuka),
                        $('<td class="tableCell">').text(dostavljen),
                        $('<td class="tableCell">').text(starting),
                        $('<td class="tableCell">').text(next),
                        $('<td class="tableCell">').text(last),
                        $('<td class="tableCell">').text(od),
                        $('<td class="tableCell">').text(za)
                    );
                    tablica.append(redak);
                }
                $("#tablicaPosiljke").dataTable({"pageLength": 8});
                $('.tableCell').each(function(){
                    var tekst = $(this).text();
                    if(tekst == 'DA'){
                        $(this).css('background','#baffbb');
                    }else if(tekst == 'NE') {
                        $(this).css('background','#ff95a3');
                    }
                })
            },
            error : function() {
                console.log("Error");
            } 
        });
    }
    if (naslov == "Popis država") {
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/drzave.php',
            type: 'GET',
            dataType: 'json',
            success: function (rezultat) {
                const drzave = $(rezultat);
                const tablica = $('#tablicaDrzave');
                var i = 0;
                var count = drzave.length;
                for(i;i<count;i++){
                    var id = drzave[i].drzava_id;
                    var drzava = drzave[i].naziv_drzave;
                    var redak = $('<tr>').append(
                        $('<td>').text(id),
                        $('<td>').text(drzava)
                    );
                    tablica.append(redak);
                }
                $("#tablicaDrzave").dataTable({"pageLength": 8});
            },
            error : function() {
                console.log("Error");
            } 
        });
    }

    if (naslov == "Registracija") {
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/korisnici.php',
            type: 'GET',
            dataType: 'json',
            success: function (korisnici) {
                const users = $(korisnici);
                var korisnik_ime;
                var i = 0;
                var count = korisnici.length;
                var user_postoji = false;
                var poljeUsera = [];
                for(i;i<count;i++){
                    poljeUsera[i] = users[i].korisnicko_ime;
                }
                $("#formusername").on('change', function(){
                    korisnik_ime = document.getElementById("formusername").value;
                    for(var i = 0; i<poljeUsera.length;i++){
                        if(poljeUsera[i] == korisnik_ime){
                            user_postoji = true;
                            $("#registrirajBtn").prop("disabled",true);
                            $('#porukica').html('Korisničko ime je zauzeto!');
                            $('#captcha').val('');
                            $('#captcha').prop("disabled", true);
                        } else {
                            $('#captcha').prop("disabled", false);
                            $('#porukica').html('');
                        }
                    }
                })
            },
            error : function() {
                console.log("Error");
            } 
        });
    }

    if (naslov == "Korisnik") {
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/korisnici.php',
            type: 'GET',
            dataType: 'json',
            success: function (korisnici) {
                const users = $(korisnici);
                var identifikacija = document.getElementById("identifikacija").value;
                var count = korisnici.length;
                var i = 0;
                for(i;i<count;i++){
                    if(identifikacija == users[i].korisnik_ID){
                        $('#adminime').val(users[i].ime);
                        $('#adminprezime').val(users[i].prezime);
                        $('#adminusername').val(users[i].korisnicko_ime);
                        $('#adminmail').val(users[i].email);
                        $('#adminlozinka').val(users[i].lozinka);
                        $('#adminlozinkasha').val(users[i].lozinka_sha1);
                        $('#adminaktiviran').val(users[i].aktiviran);
                        $('#adminkod').val(users[i].aktivacijski_kod);
                        $('#adminaktivan').val(users[i].aktivan);
                        $('#adminblokirando').val(users[i].blokiran_do);
                        $('#adminuloga').val(users[i].uloga_uloga_id);
                        $("#ident").prop("disabled",true);
                    }
                }

            },
            error : function() {
                console.log("Error");
            } 
        });
    }

    


    if (naslov == "Moje pošiljke - poslane") {
        document.getElementById("kreirajposiljku").disabled = true;
        $("#tezina").on('input', function(){
            var tezina = document.getElementById("tezina").value;
            var duljina = tezina.length;
            var tocanupis = true;
            var i = 0;
            for(i;i<duljina; i++){
                if(isNaN(tezina[i])){
                    document.getElementById("kreirajposiljku").disabled = true;
                    tocanupis = false;
                } else {
                    document.getElementById("kreirajposiljku").disabled = false;
                    tocanupis = true;
                }
                if(!tocanupis){
                    break;
                }
            }
            if(tezina == ""){
                document.getElementById("kreirajposiljku").disabled = true;
                tocanupis = false;
            }
            if(tocanupis){
                document.getElementById("kreirajposiljku").disabled = false;
            } else {
                document.getElementById("kreirajposiljku").disabled = true;
            }
        })
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/html/registriraniKorisnik/dohvatiMojePosiljke.php',
            type: 'GET',
            dataType: 'json',
            success: function (rezultat) {
                const posiljke = $(rezultat);
                const tablica = $('#tablicaPosiljke');
                var i = 0;
                var count = posiljke.length;
                var select = document.getElementById('id_pošiljka');
                for(i;i<count;i++){
                    var id = posiljke[i].pošiljka_id;
                    var cijenapkg = posiljke[i].cijena_po_kg;
                    var kilaza = posiljke[i].kilaža;
                    var isporuka = posiljke[i].isporuka;
                    var dostavljen = posiljke[i].dostavljena;
                    var sljedeciured = posiljke[i].sljedeci_ured;
                    var placena = posiljke[i].račun_zatražen;
                    var primatelj = posiljke[i].ime + " " + posiljke[i].prezime;

                    if(placena == 0 && isporuka == 1){
                        var option = document.createElement('option');
                        option.value = id;
                        option.innerHTML = id;
                        select.appendChild(option);
                    }

                    if(isporuka == 1){
                        isporuka = "DA";
                    } else {
                        isporuka = "NE";
                    }

                    if(placena == 0){
                        placena = "NE";
                    }else if(placena == 1) {
                        placena = "DA";
                    }

                    if(dostavljen == 1){
                        dostavljen = "DA";
                    } else {
                        dostavljen = "NE";
                    }
                    var redak = $('<tr>').append(
                        $('<td class="tableCell">').text(id),
                        $('<td class="tableCell">').text(cijenapkg),
                        $('<td class="tableCell">').text(kilaza),
                        $('<td class="tableCell">').text(isporuka),
                        $('<td class="tableCell">').text(sljedeciured),
                        $('<td class="tableCell">').text(dostavljen),
                        $('<td class="tableCell">').text(placena),
                        $('<td class="tableCell">').text(primatelj)
                    );
                    tablica.append(redak);
                }
                $("#tablicaPosiljke").dataTable({"pageLength": 8});
                $('.tableCell').each(function(){
                    var tekst = $(this).text();
                    if(tekst == 'DA'){
                        $(this).css('background','#baffbb');
                    }else if(tekst == 'NE') {
                        $(this).css('background','#ff95a3');
                    }
                })
            },
            error : function() {
                console.log("Error");
            } 
        });

        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/korisnici.php',
            type: 'GET',
            dataType: 'json',
            success: function (rezultat) {
                const users = $(rezultat);
                var i = 0;
                var count = users.length;
                var select = document.getElementById('korisnik');
                for(i;i<count;i++){
                    var id = users[i].korisnik_ID;
                    var imeprezime = users[i].ime + " " + users[i].prezime;
                    var option = document.createElement('option');
                    option.value = id;
                    option.innerHTML = imeprezime;
                    select.appendChild(option);
                }

            },
            error : function() {
                console.log("Error");
            } 
        });
    }

    if (naslov == "Moje pošiljke - primljene") {
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/html/registriraniKorisnik/dohvatiMojePrimljenePosiljke.php',
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
                    var sljedeciured = posiljke[i].sljedeci_ured;
                    var placena = posiljke[i].račun_zatražen;
                    var primatelj = posiljke[i].ime + " " + posiljke[i].prezime;

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
                        $('<td class="tableCell">').text(id),
                        $('<td class="tableCell">').text(cijenapkg),
                        $('<td class="tableCell">').text(kilaza),
                        $('<td class="tableCell">').text(isporuka),
                        $('<td class="tableCell">').text(sljedeciured),
                        $('<td class="tableCell">').text(dostavljen),
                        $('<td class="tableCell">').text(placena),
                        $('<td class="tableCell">').text(primatelj)
                    );
                    tablica.append(redak);
                }
                $("#tablicaPosiljke").dataTable({"pageLength": 8});
                $('.tableCell').each(function(){
                    var tekst = $(this).text();
                    if(tekst == 'DA'){
                        $(this).css('background','#baffbb');
                    }else if(tekst == 'NE') {
                        $(this).css('background','#ff95a3');
                    }
                })
            },
            error : function() {
                console.log("Error");
            } 
        });
    }

    if (naslov == "Moji računi") {
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/html/registriraniKorisnik/mojiRacuni.php',
            type: 'GET',
            dataType: 'json',
            success: function (rezultat) {
                const racuni = $(rezultat);
                const tablica = $('#tablicaRacuni');
                var select = document.getElementById('racuni');
                var neplaceniracuni = 0;
                var i = 0;
                var count = racuni.length;
                for(i;i<count;i++){
                    var id = racuni[i].račun_id;
                    var vr_izdavanja = racuni[i].vrijeme_izdavanja;
                    var rok_placanja = racuni[i].rok_plaćanja;
                    var placen = racuni[i].plaćen;
                    if(placen == 1){
                        placen = "DA";
                    } else {
                        placen = "NE";
                        neplaceniracuni++;
                        var option = document.createElement('option');
                        option.value = racuni[i].račun_id;
                        option.innerHTML = racuni[i].račun_id;
                        select.appendChild(option);
                    }
                    var i_obrade = racuni[i].iznos_obrade;
                    var cijena_posiljke = racuni[i].cijena_pošiljke;
                    var uk_cijena = racuni[i].ukupna_cijena;

                    var redak = $('<tr>').append(
                        $('<td class="tableCell">').text(id),
                        $('<td class="tableCell">').text(vr_izdavanja),
                        $('<td class="tableCell">').text(rok_placanja),
                        $('<td class="tableCell">').text(placen),
                        $('<td class="tableCell">').text(i_obrade),
                        $('<td class="tableCell">').text(cijena_posiljke),
                        $('<td class="tableCell">').text(uk_cijena)
                    );
                    tablica.append(redak);
                }
                $("#tablicaRacuni").dataTable({"pageLength": 8});
                if(neplaceniracuni < 1){
                    document.getElementById("racuni").disabled = true;
                    document.getElementById("platiracun").disabled = true;
                } else {
                    document.getElementById("racuni").disabled = false;
                    document.getElementById("platiracun").disabled = false;
                }
                $('.tableCell').each(function(){
                    var tekst = $(this).text();
                    if(tekst == 'NE'){
                        $(this).css('background','#ff95a3');
                    } else if (tekst == 'DA'){
                        $(this).css('background','#baffbb');
                    }
                })
            },
            error : function() {
                console.log("Error");
            } 
        });
    }

    if (naslov == "Upravljanje pošiljkama - kreirane") {
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/postanski_uredi.php',
            type: 'GET',
            dataType: 'json',
            success: function (rezultat) {
                const uredi = $(rezultat);
                const tablica = $('#tablicaUreda');
                var select_polaz = document.getElementById('polazni_id');
                var select_odr = document.getElementById('odredisni_id');
                var i = 0;
                var count = uredi.length;
                for(i;i<count;i++){
                    var id = uredi[i].ured_id;
                    var naziv = uredi[i].naziv;
                    var option = document.createElement('option');
                    var option2 = document.createElement('option');
                    option.value = id;
                    option.innerHTML = naziv;
                    option2.value = id;
                    option2.innerHTML = naziv;
                    select_polaz.appendChild(option);
                    select_odr.appendChild(option2);
                    var redak = $('<tr>').append(
                        $('<td class="tableCell">').text(id),
                        $('<td class="tableCell">').text(naziv)
                    );
                    tablica.append(redak);
                }
                $("#tablicaUreda").dataTable({"pageLength": 8});
            },
            error : function() {
                console.log("Error");
            } 
        });
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/html/administrator/dohvatiNovePosiljke.php',
            type: 'GET',
            dataType: 'json',
            success: function (rezultat) {
                const posiljke = $(rezultat);
                const tablica = $('#tablicaPosiljke');
                var select = document.getElementById('zapis_id');
                var i = 0;
                var count = posiljke.length;
                for(i;i<count;i++){
                    var id = posiljke[i].zapis_id;
                    var idp = posiljke[i].pošiljka_id;
                    var vrijeme = posiljke[i].vrijeme_slanja;
                    var suglasnost = posiljke[i].suglasnost;
                    var pocetni = posiljke[i].poštanski_ured_polazni_id;
                    var zadnji = posiljke[i].poštanski_ured_zadnji_id;
                    if(suglasnost == 1){
                        suglasnost = "DA";
                    } else {
                        suglasnost = "NE";
                    }
                    if(pocetni == null || zadnji == null){
                        var option = document.createElement('option');
                        option.value = id;
                        option.innerHTML = id;
                        select.appendChild(option);
                        var redak = $('<tr>').append(
                            $('<td class="tableCell">').text(id),
                            $('<td class="tableCell">').text(idp),
                            $('<td class="tableCell">').text(vrijeme),
                            $('<td class="tableCell">').text(suglasnost),
                            $('<td class="tableCell">').text(pocetni),
                            $('<td class="tableCell">').text(zadnji)
                        );
                        tablica.append(redak);
                    }
                    
                }
                $("#tablicaPosiljke").dataTable({"pageLength": 8});
                $('.tableCell').each(function(){
                    var tekst = $(this).text();
                    if(tekst == 'DA'){
                        $(this).css('background','#baffbb');
                    }else if(tekst == 'NE') {
                        $(this).css('background','#ff95a3');
                    }
                })
            },
            error : function() {
                console.log("Error");
            } 
        });
    }

    if (naslov == "Upravljanje pošiljkama - ADMIN") {
        document.getElementById("dodajcijenu").disabled = true;
        $("#cijena").on('input', function(){
            cijena = document.getElementById("cijena").value;
            if(cijena < 1){
                document.getElementById("dodajcijenu").disabled = true;
            } else {
                document.getElementById("dodajcijenu").disabled = false;
            }
        })
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/upravljanjePošiljkama.php',
            type: 'GET',
            dataType: 'json',
            success: function (rezultat) {
                const posiljke = $(rezultat);
                const tablica = $('#tablicaPosiljke');
                var select = document.getElementById('pošiljkaID');
                var i = 0;
                var count = posiljke.length;
                for(i;i<count;i++){
                    var id = posiljke[i].pošiljka_id;
                    var cijenapkg = posiljke[i].cijena_po_kg;
                    var kilaza = posiljke[i].kilaža;
                    var isporuka = posiljke[i].isporuka;
                    var dostavljen = posiljke[i].dostavljena;
                    var starting = posiljke[i].pocetni;
                    var next = posiljke[i].sljedeci;
                    var last = posiljke[i].zadnji;
                    var od = posiljke[i].prviime + " " + posiljke[i].prviprezime;
                    var za = posiljke[i].drugiime + " " + posiljke[i].drugiprezime;
                    var option = document.createElement('option');
                    option.value = id;
                    option.innerHTML = id;
                    select.appendChild(option);

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
                        $('<td class="tableCell">').text(id),
                        $('<td class="tableCell">').text(cijenapkg),
                        $('<td class="tableCell">').text(kilaza),
                        $('<td class="tableCell">').text(isporuka),
                        $('<td class="tableCell">').text(dostavljen),
                        $('<td class="tableCell">').text(starting),
                        $('<td class="tableCell">').text(next),
                        $('<td class="tableCell">').text(last),
                        $('<td class="tableCell">').text(od),
                        $('<td class="tableCell">').text(za)
                    );
                    tablica.append(redak);
                }
                $("#tablicaPosiljke").dataTable({"pageLength": 8});
                $('.tableCell').each(function(){
                    var tekst = $(this).text();
                    if(tekst == 'DA'){
                        $(this).css('background','#baffbb');
                    }else if(tekst == 'NE') {
                        $(this).css('background','#ff95a3');
                    }
                })
            },
            error : function() {
                console.log("Error");
            } 
        });
    }

    if (naslov == "Zahtjevi za računom") {
        document.getElementById("izdajRacun").disabled = true;
        $("#iznosobrade").on('input', function(){
            iznosobrade = document.getElementById("iznosobrade").value;
            if(iznosobrade < 1){
                document.getElementById("izdajRacun").disabled = true;
            } else {
                document.getElementById("izdajRacun").disabled = false;
            }
        })
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/zahtjeviRacun.php',
            type: 'GET',
            dataType: 'json',
            success: function (rezultat) {
                const zahtjevi = $(rezultat);
                const tablica = $('#tablicaZahtjevi');
                var i = 0;
                var count = zahtjevi.length;
                var select = document.getElementById('idzahtjev');
                for(i;i<count;i++){
                    var id = zahtjevi[i].zahtjev_id;
                    var idposiljke = zahtjevi[i].pošiljka_id;
                    var i_obrade = zahtjevi[i].iznos_obrade;
                    var cijena_posiljke = zahtjevi[i].cijena_pošiljke;
                    var uk_cijena = zahtjevi[i].ukupna_cijena;
                    var prihvacen = zahtjevi[i].prihvaćen;
                    console.log(prihvacen);
                    if(prihvacen == 0){
                        var option = document.createElement('option');
                        option.value = id;
                        option.innerHTML = id;
                        select.appendChild(option);

                        var redak = $('<tr>').append(
                            $('<td class="tableCell">').text(id),
                            $('<td class="tableCell">').text(i_obrade),
                            $('<td class="tableCell">').text(cijena_posiljke),
                            $('<td class="tableCell">').text(uk_cijena),
                            $('<td class="tableCell">').text(idposiljke)
                        );
                        tablica.append(redak);
                    } else if(prihvacen == 1){
                        var redak = $('<tr>').append(
                            $('<td class="tableCell">').text(id),
                            $('<td class="tableCell">').text(i_obrade),
                            $('<td class="tableCell">').text(cijena_posiljke),
                            $('<td class="tableCell">').text(uk_cijena),
                            $('<td class="tableCell">').text(idposiljke)
                        );
                        tablica.append(redak);
                    }
                }
                $("#tablicaZahtjevi").dataTable({"pageLength": 8});
            },
            error : function() {
                console.log("Error");
            } 
        });
    }

    if (naslov == "Upravljanje pošiljkama - Moderator") {
        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/upravljanjePošiljkamaModerator.php',
            type: 'GET',
            dataType: 'json',
            success: function (rezultat) {
                const posiljke = $(rezultat);
                const tablica = $('#tablicaPosiljke');
                var selectposiljka = document.getElementById('idposiljke');
                var selectposiljka2 = document.getElementById('idposiljke2');
                var i = 0;
                var count = posiljke.length;
                for(i;i<count;i++){
                    var id = posiljke[i].pošiljka_id;
                    var cijenapkg = posiljke[i].cijena_po_kg;
                    var kilaza = posiljke[i].kilaža;
                    var isporuka = posiljke[i].isporuka;
                    var dostavljen = posiljke[i].dostavljena;
                    var starting = posiljke[i].pocetni;
                    var next = posiljke[i].sljedeci;
                    var last = posiljke[i].zadnji;
                    var od = posiljke[i].prviime + " " + posiljke[i].prviprezime;
                    var za = posiljke[i].drugiime + " " + posiljke[i].drugiprezime;
                    if(next==last && isporuka == 0){
                        var option = document.createElement('option');
                        selectposiljka.appendChild(option);
                        option.value = id;
                        option.innerHTML = id;
                    }
                    if(next!=last && isporuka == 0){
                        var option2 = document.createElement('option');
                        option2.value = id;
                        option2.innerHTML = id;
                        selectposiljka2.appendChild(option2);
                    }

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
                        $('<td class="tableCell">').text(id),
                        $('<td class="tableCell">').text(cijenapkg),
                        $('<td class="tableCell">').text(kilaza),
                        $('<td class="tableCell">').text(isporuka),
                        $('<td class="tableCell">').text(dostavljen),
                        $('<td class="tableCell">').text(starting),
                        $('<td class="tableCell">').text(next),
                        $('<td class="tableCell">').text(last),
                        $('<td class="tableCell">').text(od),
                        $('<td class="tableCell">').text(za)
                    );
                    tablica.append(redak);
                }
                $("#tablicaPosiljke").dataTable({"pageLength": 8});
                $('.tableCell').each(function(){
                    var tekst = $(this).text();
                    if(tekst == 'DA'){
                        $(this).css('background','#baffbb');
                    }else if(tekst == 'NE') {
                        $(this).css('background','#ff95a3');
                    }
                })
            },
            error : function() {
                console.log("Error");
            } 
        });

        $.ajax({
            url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x018/php/postanski_uredi.php',
            type: 'GET',
            dataType: 'json',
            success: function (uredi) {
                const p_uredi = $(uredi);
                var selectured = document.getElementById('ured');
                var i = 0;
                var count = p_uredi.length;
                for(i;i<count;i++){
                    var id = p_uredi[i].ured_id;
                    var naziv = p_uredi[i].naziv;

                    var option = document.createElement('option');
                    option.value = id;
                    option.innerHTML = naziv;
                    selectured.appendChild(option);
                    
                }
            },
            error : function() {
                console.log("Error");
            } 
        });
    }

})