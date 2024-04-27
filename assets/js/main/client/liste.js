$(document).ready(function() {



    var TableProduction = $(".tableClient").DataTable({

        processing: false,

        searching: true,

        ordering: true,

        paging: true,

        ajax: base_url + 'client/dataClient',

        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },

        rowCallback: function(row, data) {



        },

        initComplete: function(setting) {









        }

    });

});