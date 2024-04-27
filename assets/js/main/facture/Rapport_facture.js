$(document).ready(function(){
    table = $("#dataTable").DataTable({
        processing: true,
        paging: false,
        ajax: base_url + "Performance/liste_facture_data",
        language: {
            url: base_url + "assets/dataTableFr/french.json",
        },
       
        columnDefs: [

            {
                'searchable': false,
                'targets': [5]
            },
        ],
        buttons: [{
            extend: 'colvis',
            className: 'btn btn-warning text-white',
            collectionLayout: 'fixed four-column',
            text: '<i class="icon-eye"></i> Masque colonne',
            columns: ':gt(0)'
        }, {
            className: 'btn btn-primary text-white',
            text: '<i class="icon-printer"></i> Imprimer',
            extend: 'print',
            exportOptions: {
                modifier: {
                    page: 'all',
                    search: 'none'
                }
            },

        }, {
            className: 'btn btn-danger text-white',
            text: '<i class="icon-doc"></i> Export PDF',
            extend: 'pdf',
            exportOptions: {
                modifier: {
                    page: 'all',
                    search: 'none'
                }
            },

        }, {
            className: 'btn btn-success text-white',
            text: '<i class="icon-folder-alt"></i> Exporter',
            extend: 'excel',
            exportOptions: {
                modifier: {
                    page: 'all',
                    search: 'none'
                }
            },

        }],
        rowCallback: function(row, data) {
        
        },
        drawCallback: function(settings) {
            
        },
        initComplete: function(setting) {
           
        },
    });


    $("#show_data").on('click',function(event){
        event.preventDefault();
        let debut = $("#debut").val();
        let fin =$("#fin").val();
        let link = base_url + "Performance/liste_facture_data?debut="+debut+"&fin="+fin;
        table.ajax.url(link);
        table.ajax.reload();

    });
})