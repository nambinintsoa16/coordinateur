$(document).ready(function () {
    var Table = $(".table_rapport").DataTable({
        paging: false,
        searching: true,

        ajax: base_url + "Semaine/W1",

        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        rowCallback: function (row, data) {


        },
        initComplete: function (setting) {
            var mois = $('.dateRecap option:selected').val();
            $.post(base_url + 'Semaine/dataWeek', { mois: mois }, function (data) {
                $('.casemainee').children().eq(1).empty().append("");
                $('.casemainee').children().eq(2).empty().append(data.tes);
                $('.casemainee').children().eq(3).empty().append(data.te);
                $('.casemainee').children().eq(5).empty().append(data.tesx);
                $('.casemainee').children().eq(4).empty().append(data.t);
                $('.casemainee').children().eq(6).empty().append(data.test);
            }, 'json');
            eventTable8();
            eventTables8();
            eventTabl8();
            eventTableau8();
            eventTableauxx8();
            eventTotala8();
            eventTotal2a8();
            eventTotal3a8();
            eventTotal4a8();
            eventTotal5a8();
            evenTca5();
            nompage();
        }
    });


    $('.dateRecap').on('change', function (e) {
        e.preventDefault();
        var mois = $('.dateRecap option:selected').val();
        Table.ajax.url(base_url + "Semaine/months/" + mois).load();
        $.post(base_url + 'Semaine/dataWeek', { mois: mois }, function (data) {
            $('.casemainee').children().eq(1).empty().append("");
            $('.casemainee').children().eq(2).empty().append(data.tes);
            $('.casemainee').children().eq(3).empty().append(data.te);
            $('.casemainee').children().eq(5).empty().append(data.tesx);
            $('.casemainee').children().eq(4).empty().append(data.t);
            $('.casemainee').children().eq(6).empty().append(data.test);
            ///////////////////////
        }, 'json');
         eventTable8();
            eventTables8();
            eventTabl8();
            eventTableau8();
            eventTableauxx8();
            eventTotala8();
            eventTotal2a8();
            eventTotal3a8();
            eventTotal4a8();
            eventTotal5a8();
            evenTca5();
            nompage();


    });


    function eventTable8() {
        $('.produit1').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Semaine/produit', { date: date, Matricule_personnel: Matricule_personnel, mois: mois }, function (data) {
                $.alert({
                    title: Matricule_personnel,
                    content: data,
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                    

                });
            });

        });
    }

    function eventTables8() {
        $('.produit2').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            $.post(base_url + 'Semaine/produits', { Matricule_personnel: Matricule_personnel, mois: mois }, function (data) {
                $.alert({
                    title: '',
                    content: data,
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }

    function eventTabl8() {
        $('.produit3').on('click', function (e) {
            e.preventDefault();
            var mois = $('.dateRecap option:selected').val();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Semaine/produi', { date: date, Matricule_personnel: Matricule_personnel, mois: mois }, function (data) {
                $.alert({
                    title: '',
                    content: data,
                });
            });

        });
    }
    function eventTableau8() {
        $('.produit4').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            $.post(base_url + 'Semaine/produit4', { Matricule_personnel: Matricule_personnel, mois: mois }, function (data) {
                $.alert({
                    title: '',
                    content: data,
                });
            });

        });
    }

    function eventTableauxx8() {
        $('.produit5').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Semaine/produitTotal', { date: date, Matricule_personnel: Matricule_personnel, mois: mois }, function (data) {
                $.alert({
                    title: '',
                    content: data,
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }

    function eventTotala8() {
        $('.SE1').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Prenom = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Semaine/totalpro1', { date: date, Prenom: Prenom, mois: mois }, function (data) {
                $.alert({
                    title: '',
                    content: data,
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }

    function eventTotal2a8() {
        $('.SE2').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Prenom = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Semaine/totalpro2', { date: date, Prenom: Prenom, mois: mois }, function (data) {
                $.alert({
                    title: '',
                    content: data,
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }

    function eventTotal3a8() {
        $('.SE3').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Prenom = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Semaine/totalpro3', { date: date, Prenom: Prenom, mois: mois }, function (data) {
                $.alert({
                    title: '',
                    content: data,
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }
    function eventTotal4a8() {
        $('.SE4').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Prenom = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Semaine/totalpro4', { date: date, Prenom: Prenom, mois: mois }, function (data) {
                $.alert({
                    title: '',
                    content: data,
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }
    function eventTotal5a8() {
        $('.SE5').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            //var Prenom = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            //var date = $('.date_collapse').text();
            $.post(base_url + 'Semaine/totalpro5', { mois: mois }, function (data) {
                $.alert({
                    title: '',
                    content: data,
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }

    function evenTca5() {
        $('.test1').on('click', function (e) {
            e.preventDefault();
            alert({
                title: '',
                content: 'Simple alert!',
            });
        });
    }

    function nompage(){
        $(".nompage").on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var prenom = parent.children().first().text();
            $.post(base_url + 'Hebdomadaire/pages', { prenom: prenom }, function(data) {
    
                $.alert({
                    title: '',
                    content: data,
                });
            });
        });
    }





});
