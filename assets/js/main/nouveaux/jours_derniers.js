$(document).ready(function() {
    $(".DataTables").DataTable({
        searching: false,
        ordering: true,
        paging: false,
        processing: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });

    $('.countnvcltac').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        $.post(base_url + 'nouveaux/listeclientsAAC30', { matricule: matricule }, function(data) {
            $.alert({
                title: matricule,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',
                confirmButton: 'Okay',
                cancelButton: 'Cancel',


            });
        });
    });

    $('.countnvcltss').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'nouveaux/listeclients30', { date: date, matricule: matricule }, function(data) {
            $.alert({
                title: matricule,
                content: data,
                columnClass: 'col-md-4 col-md-offset-4',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',

            });
        });
    });
});