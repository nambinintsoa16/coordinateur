$(document).ready(function () {

    $('.lienn').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text();
        $.post(base_url + 'Accueil/OPL', { date: date, matricule: matricule }, function (data) {
            $.alert(data);
        });
    });
});

