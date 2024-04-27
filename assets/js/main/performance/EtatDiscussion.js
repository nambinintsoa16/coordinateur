$(document).ready(function() {
        $(".tableResult").DataTable({
        searching: true,
        ordering: true,
        paging: false,
        processing: true,

        //ajax: base_url + "Performance/discussionJournalieres",
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        rowCallback: function (row, data) {

        },
        initComplete: function (setting) {
        }

    });
 });