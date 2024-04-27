$(document).ready(function() {
    $(".table_prime").DataTable({
        searching: true,
        ordering: true,
        paging: false
    });
    $('.prime').on('click',function(e){
    	e.preventDefault();
    	var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
    	 $.post(base_url + 'Performance/detailproduit', { matricule: matricule }, function (data) {
            $.alert({
                title: '',
                content: data,
                columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-10',
            });
        });
    });
});