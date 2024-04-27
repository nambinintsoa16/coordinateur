$(document).ready(function(){

    $(".DataTables").DataTable({
        searching: false,
        ordering: true,
        paging: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });
    $('.produit').on('click', function(e) {
        e.preventDefault();
        let This = $(this);
		let parent = This.parent().parent();
		let codeproduit = parent.children().eq(1).text();
        console.log(codeproduit);
        $.post(base_url + 'Operatrice/nom_produit', { codeproduit: codeproduit }, function(data) {

            $.alert({
                title: '',
                content: data,
            });
        });
		
    });

    $('.client').on('click', function(e) {
        e.preventDefault();
       var parent = $(this).parent().parent();
        var codeclient = parent.children().eq(1).text();
        var type = "";
        var date = $('.date_collapse').text();
        $.post(base_url + 'Client/client_details', { date: date, codeclient: codeclient, type: type }, function(data) {
            $.alert({
                title: codeclient + " / " + type,
                content: data,
                columnClass: 'col-md-12',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',

            });
        });

    });

    
});