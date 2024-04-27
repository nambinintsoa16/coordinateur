$(document).ready(function () {
    var Table = $(".table_jaime").DataTable({
        searching: false,
        ordering: true,
        paging: false,

        ajax: base_url + "Performance/jaime_mois",

        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        rowCallback: function (row, data) {

        },
        initComplete: function (setting) {

            clientjm();
            clientjm_mois();
            clientSAC07_mois();
            clientAAC14_mois();
            clientAAC30_mois();
            clientAAC07_mois();

        }
    });
    $('.dateRecapS').on('change', function (e) {
        e.preventDefault();
        var mois = $('.dateRecapS option:selected').val();
        Table.ajax.url(base_url + "Performance/jaimes/" + mois).load();
        $.post(base_url + 'Performance/jaimes', { mois: mois }, function (data) {


        }, 'json');


    });

    function clientjm() {
        $(".clientjm").on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var type = "REA_CLT_J'AIME";
            var matricule = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Performance/listeclientsjaimemois', { type: type, mois: mois, matricule: matricule }, function (data) {
                $.alert({
                    title: matricule,
                    content: data,
                    columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1',

                });

            });
        });
    }

    function clientjm_mois() {
        $(".liste_mois").on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var type = "NOUVEAU CLIENT";
            var matricule = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Performance/listeclients_mois', { type: type, mois: mois, matricule: matricule }, function (data) {
                $.alert({
                    title: matricule + " / " + type,
                    content: data,
                    columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1',

                });

            });
        });
    }


    function clientSAC07_mois() {
        $(".clientSAC07").on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var type = "RELN_CLT_AAC07";
            var matricule = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Performance/listeclientsSAC07mois', { type: type, mois: mois, matricule: matricule }, function (data) {
                $.alert({
                    title: matricule + " / " + type,
                    content: data,
                    columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1',

                });

            });
        });
    }

    function clientAAC14_mois() {
        $(".clientAAC14").on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var type = "PROP_CLT_AAC07";
            var matricule = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Performance/listeclientsAAC14mois', { type: type, mois: mois, matricule: matricule }, function (data) {
                $.alert({
                    title: matricule + " / " + type,
                    content: data,
                    columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1',

                });

            });
        });
    }

    function clientAAC30_mois() {
        $(".clientAAC30").on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var type = "RELN_CLT_AAC30";
            var matricule = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Performance/listeclientsAAC30mois', { type: type, mois: mois, matricule: matricule }, function (data) {
                $.alert({
                    title: matricule + " / " + type,
                    content: data,
                    columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1',

                });

            });
        });
    }

    function clientAAC07_mois() {
        $(".clientAAC07").on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var type = "PROP_CLT_AAC07";
            var matricule = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Performance/listeclientsAAC7mois', { type: type, mois: mois, matricule: matricule }, function (data) {
                $.alert({
                    title: matricule + " / " + type,
                    content: data,
                    columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1',

                });

            });
        });
    }



});