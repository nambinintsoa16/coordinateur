$(document).ready(function () {
    var Table = $(".tablesac").DataTable({
        processing: true,
        ajax: base_url + "Client/clientsacs",
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        rowCallback: function (row, data) {

        },
        initComplete: function (setting) {

        }
    });
    $('.validChoix').on('click', function (event) {
        event.preventDefault();
        var datas = [];
        $('.link').each(function () {
            if ($(this).hasClass("off") == false) {
                var param = $(this).attr('class').split(" ");
                datas.push(param[3]);
            }
        });
        var data = JSON.stringify(datas);
        Table.ajax.url(base_url + "Client/clientsacParam/?param=" + data).load();
    });
    $('.btn1').on('click', function (event) {
        event.preventDefault();
        var datas = [];
        $('.link').each(function () {
            if ($(this).hasClass("off") == false) {
                var param = $(this).attr('class').split(" ");
                datas.push(param[3]);
            }
        });
        var data = JSON.stringify(datas);
        var user = $('.opls option:selected').val();
        $.post(base_url + 'Client/relancer', { data: data, user: user }, function () {

        });
    });
});