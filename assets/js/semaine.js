$(document).ready(function () {
    var Table = $(".table_rapport").DataTable({

        ajax: base_url + "Accueil/s1",

        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/French.json"
        },
        rowCallback: function (row, data) {


        },
        initComplete: function (setting) {
            var mois = $('.dateRecap option:selected').val();
            $.post(base_url + 'Accueil/dataWeeks', { mois: mois }, function (data) {
                $('.casemaine').children().eq(1).empty().append("");
                $('.casemaine').children().eq(2).empty().append(data.tes);
                $('.casemaine').children().eq(3).empty().append(data.te);
                $('.casemaine').children().eq(5).empty().append(data.tesx);
                $('.casemaine').children().eq(4).empty().append(data.t);
                $('.casemaine').children().eq(6).empty().append(data.test);
            }, 'json');
        }
    });


    $('.dateRecap').on('change', function (e) {
        e.preventDefault();
        var mois = $('.dateRecap option:selected').val();
        Table.ajax.url(base_url + "Accueil/month/" + mois).load();
        $.post(base_url + 'Accueil/dataWeeks', { mois: mois }, function (data) {
            $('.casemaine').children().eq(1).empty().append("");
            $('.casemaine').children().eq(2).empty().append(data.tes);
            $('.casemaine').children().eq(3).empty().append(data.te);
            $('.casemaine').children().eq(5).empty().append(data.tesx);
            $('.casemaine').children().eq(4).empty().append(data.t);
            $('.casemaine').children().eq(6).empty().append(data.test);
        }, 'json');

    });



});
