$(document).ready(function () {
    $('.produit').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text();
        $.post(base_url + 'Performance/produitUser', { date: date, matricule: matricule }, function (data) {
            $.alert(data);
        });

    });
    $('.totalproduit').on('click', function (e) {
        e.preventDefault();
        //var parent = $(this).parent().parent();
        //var matricule = parent.children().first().text();
        var date = $('.date_collapse').text();
        $.post(base_url + 'Performance/totalproduitUser', { date: date }, function (data) {
            $.alert({
                title: '',
                content: data,
            });
        });
    });

    $('.client').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text();
        $.post(base_url + 'Performance/liste_clients', { date: date, matricule: matricule }, function (data) {
            $.alert(data);
        });

    });
});
