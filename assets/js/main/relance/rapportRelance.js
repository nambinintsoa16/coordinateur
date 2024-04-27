$(document).ready(function() {
    var TableProduction = $(".tableData").DataTable({
        processing: false,
        searching: true,
        ordering: true,
        paging: true,
        //ajax: base_url + 'client/dataClient',
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        rowCallback: function(row, data) {
        },
        initComplete: function(setting) {
        }

    });
    $('.nompages').on('click', function(e){
    e.preventDefault();
    var parent = $(this).parent().parent();
    var matricule = parent.children().first().text();
    $('#myModal').modal('show')
    var link = base_url + "Hebdomadaire/relance_page?matricule=" + matricule;
    Table.ajax.url(link);
    Table.ajax.reload(); 
    });   
});