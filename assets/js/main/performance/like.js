$(document).ready(function() {
    $('.client').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var type = "NOUVEAU_CLIENT";
        var date = $('.date_collapse').text();
        $.post(base_url + 'Performance/listeclients', { date: date, matricule: matricule, type: type }, function(data) {
            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-10',
                type: 'green',
                icon: 'fa fa-spinner fa-spin',

            });
        });

    });


    $('.clientjm').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var type = "REA_CLT_J'AIME";
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text().toLowerCase();
        $.post(base_url + 'Performance/listeclientsjaime', { date: date, matricule: matricule, type: type }, function(data) {
            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-10',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',

            });
        });

    });

    $('.clientaac7').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var type = "PROP_CLT_AAC07";
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text().trim();
        //$.post(base_url + 'Performance/PROP_CLT_AAC07', { date: date, matricule: matricule, type: type }, function(data) {
        $.post(base_url + 'Performance/like_detail', { date: date, matricule: matricule, type: type }, function(data) {
            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-10',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',

            });
        });

    });

    $('.clientaac14').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var type = "PROP_CLT_AAC14";
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text();
        $.post(base_url + 'Performance/PROP_CLT_AAC14', { date: date, matricule: matricule, type: type }, function(data) {
            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-10',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',

            });
        });

    });

    $('.clientsac07').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var type = "RELN_CLT_SAC07";
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text();
        $.post(base_url + 'Performance/RELN_CLT_SAC07', { date: date, matricule: matricule, type: type }, function(data) {

            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-10',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',

            });
        });

    });


    $('.clientaac30').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var type = "REAP_CLT_AAC30";
        var date = $('.date_collapse').text();
        $.post(base_url + 'Performance/REAP_CLT_AAC30', { date: date, matricule: matricule, type: type }, function(data) {
            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-9',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',
                animation: 'news',
            });
        });

    });

    $('.clientvnl').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var type = "TRTM_VTE_NNLIV";
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'Performance/TRTM_VTE_NNLIV', { date: date, matricule: matricule, type: type }, function(data) {
            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-10',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',

            });
        });

    });

    $('.appel').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var type = "APPEL";
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'Performance/countappel', { date: date, matricule: matricule, type: type }, function(data) {
            $.alert({
                title: matricule + " / " + type,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-10',
                type: 'red',
                icon: 'fa fa-spinner fa-spin',

            });
        });


    })
    $('.clientaac7s').on('click', function(e) {
        e.preventDefault();
        $('#myModal').modal('show').find('.modal-body').load($(this).attr('href'));
    });



});