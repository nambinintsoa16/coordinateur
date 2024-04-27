$(document).ready(function() {
    $(".DataTables").DataTable({
        searching: false,
        ordering: true,
        paging: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });

    $('.client7').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var type = "Achat après 7 jours";
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').val();
        $.post(base_url + 'nouveaux/liste_premier_achat', { date: date, matricule: matricule, type: type }, function(data) {
            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',

            });
        });
       
    });

    $('.client14').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var type = "";
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').val();
        $.post(base_url + 'nouveaux/liste_premier_achat14', { date: date, matricule: matricule, type: type }, function(data) {
            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',

            });
        });
       
    });

    $('.client28').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var type = "";
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').val();
        $.post(base_url + 'nouveaux/liste_premier_achat28', { date: date, matricule: matricule, type: type }, function(data) {
            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',

            });
        });
       
    });

    $('.client42').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var type = "";
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').val();
        $.post(base_url + 'nouveaux/liste_premier_achat42', { date: date, matricule: matricule, type: type }, function(data) {
            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',

            });
        });
       
    });

    $('.client43').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var type = "";
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').val();
        $.post(base_url + 'nouveaux/liste_premier_achat43', { date: date, matricule: matricule, type: type }, function(data) {
            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',

            });
        });
       
    });


});