   $(document).ready(function() {
    alert();
      var Table = $('.tablePromo').DataTable({
            processing: true,
            paging: false,
            searching: false,
            ajax: base_url + "Tsenakoty/tablecapromotion",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            }
        });


    });