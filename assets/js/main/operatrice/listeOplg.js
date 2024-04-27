$(document).ready(function() {
    $(".tableData").DataTable({
        searching: true,
        ordering: true,
        paging: false,
        processing: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }

    });
    $('.chiffre').on('click',function(e){
        e.preventDefault();
        var parent = $(this).parent().parent();
        var Matricule_personnel = parent.children().first().text();
        $.post(base_url + 'mensuel/produitLivres', {  Matricule_personnel: Matricule_personnel }, function(data) {

            $.alert({
                title: Matricule_personnel,
                content: data,
                columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-8',
            });
        });
    });

    Table = $(".tableResult").DataTable({
    processing: true,
    searching: false,
    paging: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });

    $('.matricuL').on('click', function(e){
    e.preventDefault();
    //$('.matricule_opl').empty().append(localStorage.getItem('matricule'));
    var matricule = $(this).text();    
    var link = base_url + "Operatrice/detailParMatriculeL?matricule=" + matricule;
    Table.ajax.url(link);
    Table.ajax.reload();
    $('.matricule_opl').empty().append(matricule); 
    });


    $('.matricuL').on('click', function(e){
        var matricule = $(this).text();  
        $.post(base_url + 'Hebdomadaire/details_operatrice', { matricule: matricule }, function(data) {
            $('.info_opl').empty().append(data);         
        });       
   }); 

});