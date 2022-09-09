$(document).ready( function () {
    $('#myTable').DataTable({
        "order": [[ 0, "desc" ]],
        "language": {
            "info": "Prikazuje se _PAGE_ od _PAGES_ stranica/e",
            "emptyTable": "Nema podataka u tabeli",
            "aria": {
              "sortAscending": " - klikni/povratak na uzlazno sortiranje",
              "sortDescending": " - klikni/povratak na silazno sortiranje"
            },
            "paginate": {
              "first": "Prva stranica",
              "last": "Posljednja stranica",
              "next": "Sledeća stranica",
              "previous": "Prethodna stranica"
            },
            "infoEmpty": "Nema podataka za prikaz",
            "infoFiltered": " - Filtriranje iz _MAX_ zapisa",
            "lengthMenu": 'Prikaži <select>'+
                          '<option value="5">5</option>'+
                          '<option value="10">10</option>'+
                          '<option value="20">20</option>'+
                          '<option value="30">30</option>'+
                          '<option value="40">40</option>'+
                          '<option value="50">50</option>'+
                          '</select> zapisa',
            "sSearch": "Pretraga:",
            "sZeroRecords": "Nije pronađen nijedan odgovarajući zapis"
        }
    });
} );