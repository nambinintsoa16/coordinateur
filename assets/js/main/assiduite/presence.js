$(document).ready(function () {
    
    $(".DataTables").DataTable({
        searching: true,
        ordering: true,
        paging: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });
    $('.intervalle').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text();
        $.post(base_url + 'Assiduite/details_intervalle', { date: date, matricule: matricule }, function (data) {
            $.alert({
                title: '',
                content: data,

            });
        });

    });

    $('.prenom').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        $.post(base_url + 'Assiduite/timeline', { matricule: matricule }, function (data) {
            $.alert({
                title: matricule,
                content: data,
                columnClass: 'col-md-12',

            });
        });

    });



});

