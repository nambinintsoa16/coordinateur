$(document).ready(function () {
    var Table = $(".table_perfoMa").DataTable({
        searching: false,
        ordering: true,
        paging: false,

        ajax: base_url + "Performance/month",

        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/French.json"
        },
        rowCallback: function (row, data) {

        },
        initComplete: function (setting) {

        }
    });
    $('.dateRecapS').on('change', function (e) {
        e.preventDefault();
        var mois = $('.dateRecapS option:selected').val();
        Table.ajax.url(base_url + "Performance/datamonths/" + mois).load();
        $.post(base_url + 'Performance/datamonths', { mois: mois }, function (data) {


        }, 'json');


    });

});