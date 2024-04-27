$(document).ready(function() {
    loading();
    var Table = $(".tableResult").DataTable({
        searching: false,
        ordering: true,
        paging: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        ajax: base_url + "Mensuel/etatParMatricule1",

        rowCallback: function(row, data) {
        },
        initComplete: function(setting) {
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Mensuel/dataWeek', { mois: mois }, function(data) {
                $('.camois').children().eq(1).empty().append("");
                $('.camois').children().eq(2).empty().append(data.tes);
                $('.camois').children().eq(3).empty().append(data.te);
                $('.camois').children().eq(4).empty().append(data.t);
                $('.camois').children().eq(5).empty().append(data.ratio);

            }, 'json');

            stopload();
            evenTcaprevi();
            evenTcareel();
            evenTcalivre();
            evenTtotalprevisio();
            evenTtotalreel();
            evenTtotallivre();
          
        }
    });
    $('.dateRecapS').on('change', function(e) {
        e.preventDefault();
        var mois = $('.dateRecapS option:selected').val();
        Table.ajax.url(base_url + "Mensuel/months/" + mois).load();
        $.post(base_url + 'Mensuel/dataWeek', { mois: mois }, function(data) {
            $('.camois').children().eq(1).empty().append("");
            $('.camois').children().eq(1).empty().append("");
            $('.camois').children().eq(2).empty().append(data.tes);
            $('.camois').children().eq(3).empty().append(data.te);
            $('.camois').children().eq(4).empty().append(data.t);
            $('.camois').children().eq(5).empty().append(data.ratio);

        }, 'json');
            evenTcaprevi();
            evenTcareel();
            evenTcalivre();
            evenTtotalprevisio();
            evenTtotalreel();
            evenTtotallivre();


    });

    $('.annees').on('change', function(e) {
        e.preventDefault();
        var mois = $('.annees option:selected').val();
        Table.ajax.url(base_url + "Mensuel/months1/" + mois).load();
        $.post(base_url + 'Mensuel/dataWeek1', { mois: mois }, function(data) {
            $('.camois').children().eq(1).empty().append("");
            $('.camois').children().eq(1).empty().append("");
            $('.camois').children().eq(2).empty().append(data.tes);
            $('.camois').children().eq(3).empty().append(data.te);
            $('.camois').children().eq(4).empty().append(data.t);
            $('.camois').children().eq(5).empty().append(data.ratio);

        }, 'json');
         stopload();
            evenTcaprevi();
            evenTcareel();
            evenTcalivre();
            evenTtotalprevisio();
            evenTtotalreel();
            evenTtotallivre();


    });

    function evenTcaprevi() {
        $(".caprevi").on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var matricule = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Mensuel/produitUserPrevi', {  matricule: matricule ,mois: mois}, function(data) {
                $.alert({
                    title: '',
                    content: data,
                    type: 'purple',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-8',
                });

            });
        });
    }

    function evenTcareel() {
        $(".careel").on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var matricule = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Mensuel/produitUserReel', { mois: mois, matricule: matricule }, function(data) {
                $.alert({
                    title: '',
                    content: data,
                    type: 'purple',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-8',
                });

            });
        });
    }

    function evenTcalivre() {
        $(".calivre").on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var matricule = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Mensuel/produitUserLivre', { mois: mois, matricule: matricule }, function(data) {
                $.alert({
                    title: '',
                    content: data,
                    type: 'purple',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-8',
                });

            });
        });
    }

    function evenTtotalprevisio() {
        $(".totalprevisio").on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            //var Prenom = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Mensuel/totalproduitprevi', { mois: mois }, function(data) {
                $.alert({
                    title: '',
                    content: data,
                    type: 'purple',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-8',
                });

            });
        });
    }

    function evenTtotalreel() {
        $(".totalproduitreel").on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            //var Prenom = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Mensuel/totalproduitreel', { mois: mois }, function(data) {
                $.alert({
                    title: '',
                    content: data,
                    type: 'purple',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-8',
                });

            });
        });
    }

    function evenTtotallivre() {
        $(".totalprolivre").on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            //var Prenom = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Mensuel/totalproduitlivre', { mois: mois }, function(data) {
                $.alert({
                    title: '',
                    content: data,
                    type: 'purple',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-8',
                });

            });
        });
    }

    function loading() {
    var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: red;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
    $.dialog({
            "title": "",
            "content": htmls,
            "show": true,
            "modal": true,
            "close": false,
            "closeOnMaskClick": false,
            "closeOnEscape": false,
            "dynamic": false,
            "height": 150,
            "fixedDimensions": true
        });
    }
    function stopload(){
          $('.jconfirm ').remove();
        
    }
    
});
