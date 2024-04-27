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
});