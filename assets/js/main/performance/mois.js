$(document).ready(function () {
    var Table = $(".table_performance").DataTable({
        searching: false,
        ordering: true,
        paging: false,

        ajax: base_url + "Performance/months",

        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        rowCallback: function (row, data) {

        },
        initComplete: function (setting) {
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Mensuel/dataWeek', { mois: mois }, function (data) {
                $('.perfomois').children().eq(1).empty().append("");
                $('.perfomois').children().eq(2).empty().append("");
                $('.perfomois').children().eq(3).empty().append("");
                $('.perfomois').children().eq(4).empty().append("");
                $('.perfomois').children().eq(5).empty().append("");
                $('.perfomois').children().eq(6).empty().append("");
                $('.perfomois').children().eq(7).empty().append("");

            }, 'json');
            evenTcaprevi();
            evenTcareel();

        }
    });
    $('.dateRecapS').on('change', function (e) {
        e.preventDefault();
        var mois = $('.dateRecapS option:selected').val();
        Table.ajax.url(base_url + "Mensuel/months/" + mois).load();
        $.post(base_url + 'Mensuel/dataWeek', { mois: mois }, function (data) {
            $('.perfomois').children().eq(1).empty().append("");
            $('.perfomois').children().eq(2).empty().append("");
            $('.perfomois').children().eq(3).empty().append("");
            $('.perfomois').children().eq(4).empty().append("");
            $('.perfomois').children().eq(5).empty().append("");
            $('.perfomois').children().eq(6).empty().append("");
            $('.perfomois').children().eq(7).empty().append("");

        }, 'json');


    });

});