$(document).ready(function() {
        $(".tableResult").DataTable({
        searching: true,
        ordering: true,
        paging: false,
        processing: false,

        //ajax: base_url + "Performance/etatAncienCltBody",
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        rowCallback: function (row, data) {

        },
        initComplete: function (setting) {
        }

    });
    
});