$(document).ready(function() {
    $(".DataTables").DataTable({
        searching: true,
        ordering: true,
        paging: false,
        processing: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }

    });
    
    $(".tbody td>a").on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var Matricule_personnel = parent.children().first().text();
        var index = $(this).parent().index();
        var date = $(".dataClass th").eq(index).text().trim();
        $.post(base_url + 'Hebdomadaire/produitlivre', { date: date, Matricule_personnel: Matricule_personnel }, function(data) {

            $.alert({
                title: Matricule_personnel,
                content: data,
                columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-8',
            });
        });

    });
    $(".pageName").on('click', function(e) {
        e.preventDefault();
        var Code = $(this).text();
        $.post(base_url + 'Hebdomadaire/anarana_page', { Code: Code }, function(data) {

            $.alert({
                title: '',
                content: data,
            });
        });
    });
    $(".thead th>a").on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var index = $(this).parent().index();
        var date = $(".dataClass th").eq(index).text().trim();
        $.post(base_url + 'Hebdomadaire/totalpolivre', { date: date }, function(data) {

            $.alert({
                title: '',
                content: data,
                columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-8',
            });
        });
    });
    $(".nom_page").on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var prenom = parent.children().first().text();
        $.post(base_url + 'Hebdomadaire/page', { prenom: prenom }, function(data) {

            $.alert({
                title: '',
                content: data,
            });
        });
    });
    
});