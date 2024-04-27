$(document).ready(function() {
    var Table = $(".table_mois").DataTable({
        searching: false,
        ordering: true,
        paging: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },

        ajax: base_url + "Tsenakoty/mois_actuel",

        rowCallback: function(row, data) {

        },
        initComplete: function(setting) {
            var mois = $('.dateRecap option:selected').val();
            /*$.post(base_url + 'Mensuel/dataWeek', { mois: mois }, function(data) {
               

            }, 'json');*/
           

        }
    });
    $('.dateRecap').on('change', function(e) {
        e.preventDefault();
        var mois = $('.dateRecap option:selected').val();
        Table.ajax.url(base_url + "Tsenakoty/months/" + mois).load();
        /*$.post(base_url + 'Mensuel/dataWeek', { mois: mois }, function(data) {
            

        }, 'json');*/


    });

   
});