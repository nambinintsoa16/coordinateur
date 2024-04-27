$(document).ready(function () {
    var Table = $(".tablepresence").DataTable({
        searching: false,
        ordering: true,
        paging: false,

        ajax: base_url + "Assiduite/mois",

        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        rowCallback: function (row, data) {

        },
        initComplete: function (setting) {

            detail();
            detailrecuperation();
            detailpresence()


        }

    });
    $('.dateRecapS').on('change', function (e) {
        e.preventDefault();
        var mois = $('.dateRecapS option:selected').val();
        Table.ajax.url(base_url + "Assiduite/months/" + mois).load();

    });

    $(".DataTables").DataTable({
        searching: true,
        ordering: true,
        paging: false
    });

    function detail() {
        $('.retard').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var matricule = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Assiduite/detailabsence', { mois: mois, matricule: matricule }, function (data) {
                $.alert({
                    title: matricule,
                    content: data,
                    columnClass: 'col-md-8 col-md-offset-3',

                });

            });

        });
    }

    function detailpresence() {
        $('.presence').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var matricule = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Assiduite/detailpresence', { mois: mois, matricule: matricule }, function (data) {
                $.alert({
                    title: matricule,
                    content: data,

                });
            });

        });
    }

    function detailrecuperation() {
        $('.recuperation').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var matricule = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Assiduite/detailrecuperation', { mois: mois, matricule: matricule }, function (data) {
                $.alert({
                    title: matricule,
                    content: data,

                });
            });

        });
    }
});