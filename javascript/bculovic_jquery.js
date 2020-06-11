$(document).ready(function () {
    naslov = $(document).find("title").text();
    console.log(naslov);
    console.log("Dohvacam");
    if (naslov == "Korisnici") {
        $.ajax({
            url: '../php/baza.class.php?korisnici',
            type: 'GET',
            dataType: 'xml',
            success: function (korisnici) {
                console.log("Dohvaceno");
                const users = $(korisnici);
                const tablica = $('#tablicaKorisnici');
                users.find('user').each(function () {
                    var ime = $(this).find('ime').text();
                    var prezime = $(this).find('prezime').text();
                    var email = $(this).find('email').text();
                    var username = $(this).find('korisnicko_ime').text();

                    var redak = $('<tr>').append(
                        $('<td class="userIme">').text(ime),
                        $('<td class="userPrezime">').text(prezime),
                        $('<td class="userEmail" style="cursor:pointer;">').text(email),
                        $('<td class="userKorisnickoIme">').text(username)
                    );
                    tablica.append(redak);
                });
                $("#tablicaKorisnici").dataTable();
            },
            error : function() {
                console.log("Error");
            } 
        });
    }
})