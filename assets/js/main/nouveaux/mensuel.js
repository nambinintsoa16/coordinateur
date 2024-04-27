$(document).ready(function() {
    var Table = $(".table_mensuel").DataTable({
        searching: false,
        ordering: true,
        paging: false,
        processing: true,

        ajax: base_url + "nouveaux/months",
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        rowCallback: function(row, data) {


        },
        initComplete: function(setting) {

            preventmois();
            preventcamois();
        }
    });
    $('.dateRecap').on('change', function(e) {
        e.preventDefault();
        var mois = $('.dateRecap option:selected').val();
        Table.ajax.url(base_url + "nouveaux/mois/" + mois).load();
        $.post(base_url + 'nouveaux/mois', { mois: mois }, function(data) {


        }, 'json');



    });

    function preventmois() {
        $('.listemois').on('click', function(e) {
            e.preventDefault(e);
            var parent = $(this).parent().parent();
            var type = "";
            var matricule = parent.children().first().text();
            var date = $('.date_collapse').text().trim();
            $.post(base_url + 'nouveaux/listeclientsmensuels', { date: date, matricule: matricule, type: type }, function(data) {
                $.alert({
                    title: matricule + " / " + type,
                    content: data,
                    columnClass: 'col-md-8 col-md-offset-4',
                    type: 'red',
                    icon: 'fa fa-spinner fa-spin',

                });
            });
        });
    }

    function preventcamois() {
        $('.listecamois').on('click', function(e) {
            e.preventDefault(e);
            var parent = $(this).parent().parent();
            var matricule = parent.children().first().text();
            var date = $('.date_collapse').text().trim();
            $.post(base_url + 'nouveaux/listeclientsAACmois', { date: date, matricule: matricule, }, function(data) {
                $.alert({
                    title: matricule,
                    content: data,
                    columnClass: 'col-md-8 col-md-offset-4',
                    type: 'red',
                    icon: 'fa fa-dollar fa-spin',

                });
            });
        });
    }

});