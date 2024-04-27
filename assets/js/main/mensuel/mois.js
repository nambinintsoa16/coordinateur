$(document).ready(function() {
    var Table = $(".table_mois").DataTable({
        searching: false,
        ordering: true,
        paging: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        ajax: base_url + "Mensuel/W1",

        rowCallback: function(row, data) {
        },
        initComplete: function(setting) {
            var mois = $('.dateRecapS option:selected').val();
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


    });

    function evenTcaprevi() {
        $(".caprevi").on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Mensuel/produitUserPrevi', { mois: mois, Matricule_personnel: Matricule_personnel }, function(data) {
                $.alert({
                    title: Matricule_personnel,
                    content: data,
                    type: 'blue',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-12 col-md-offset-8 col-xs-4 col-xs-offset-8',
                });

            });
        });
    }

    function evenTcareel() {
        $(".careel").on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Mensuel/produitUserReel', { mois: mois, Matricule_personnel: Matricule_personnel }, function(data) {
                $.alert({
                    title: Matricule_personnel,
                    content: data,
                    type: 'purple',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-12 col-md-offset-8 col-xs-4 col-xs-offset-8',
                });

            });
        });
    }

    function evenTcalivre() {
        $(".calivre").on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Mensuel/produitUserLivre', { mois: mois, Matricule_personnel: Matricule_personnel }, function(data) {
                $.alert({
                    title: Matricule_personnel,
                    content: data,
                    type: 'green',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-12 col-md-offset-8 col-xs-4 col-xs-offset-8',
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
                    type: 'blue',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    buttons: {
                        Fermer: {
                            btnClass: 'btn-success',
                        },               
                        },
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
                    type: 'red',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-4 col-md-offset-8 col-xs-4 col-xs-offset-8',
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
                });

            });
        });
    }
    function evenTproduit(){
        $('.detail').on('click',function(e){
            e.preventDefault();
            alert();
        })
    }
});
