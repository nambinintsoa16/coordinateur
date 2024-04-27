$(document).ready(function() {
    $(".DataTables").DataTable({
        searching: false,
        ordering: true,
        paging: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });

    $('.countnvcltac').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var type = "";
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'nouveaux/listeclientsAAC', { date: date, matricule: matricule, type: type }, function(data) {
            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-4 col-md-offset-4',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',

            });
        });
    });

    $('.countnvclts').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var type = "";
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'nouveaux/listeclients', { date: date, matricule: matricule, type: type }, function(data) {
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