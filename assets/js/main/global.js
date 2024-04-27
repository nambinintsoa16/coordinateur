$(document).ready(function() {
    $('.ca').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var mois = $('.dateRe option:selected').val();
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'Accueil/produitUser', { date: date, mois: mois, matricule: matricule }, function(data) {
            $.alert({
                title: '',
                content: data,
                type: 'purple',
                icon: 'fa fa-spinner fa-spin',
                columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                containerFluid: true,
                buttons: {
                Fermer: {
                    btnClass: 'btn-success',
                },               
                },

            });

        });

    });

    $('.car').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var mois = $('.dateRe option:selected').val();
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'Accueil/produit', { date: date, mois: mois, matricule: matricule }, function(data) {
            $.alert({
                title: '',
                content: data,
                type: 'purple',
                icon: 'fa fa-spinner fa-spin',
                columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                containerFluid: true,
                buttons: {
                Fermer: {
                    btnClass: 'btn-success',
                },               
                },
            });
        });

    });

    $('.reel').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var mois = $('.dateRe option:selected').val();
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'Accueil/produitUse', { date: date, mois: mois, matricule: matricule }, function(data) {
            $.alert({
                title: '',
                content: data,
                type: 'purple',
                icon: 'fa fa-spinner fa-spin',
                buttons: {
                Fermer: {
                    btnClass: 'btn-success',
                },               
                },
            });
        });

    });

    $('.confirmer').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        $.post(base_url + 'Accueil/produitUseconfirmer', { matricule: matricule }, function(data) {
            $.alert({
                title: '',
                content: data,
                type: 'purple',
                icon: 'fa fa-spinner fa-spin',
                columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                containerFluid: true,
            });
        });

    });


    $('.calivrejour').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'Accueil/calivredujour', { matricule: matricule, date: date }, function(data) {
            $.alert({
                title: '',
                content: data,
                type: 'purple',
                icon: 'fa fa-spinner fa-spin',
                columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                containerFluid: true,
            });
        });

    });

    $('.previlivre').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'Accueil/previlivre', { matricule: matricule, date: date }, function(data) {
            $.alert({
                title: '',
                content: data,
                type: 'purple',
                icon: 'fa fa-spinner fa-spin',
                columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                containerFluid: true,
            });
        });

    });

    $('.totalp').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        //var Prenom = parent.children().first().text();
        var mois = $('.dateRe option:selected').val();
        var date = $('.date_collapse').text();
        $.post(base_url + 'Accueil/totalp', { date: date, mois: mois }, function(data) {
            $.alert({
                title: '',
                content: data,
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',
                columnClass: 'col-md-4',
                containerFluid: true,
                buttons: {
                Fermer: {
                    btnClass: 'btn-success',
                },               
                },
                onContentReady: function () {
                $(".product").on('click', function(e) {
                var parent = $(this).parent().parent();
                var produit = parent.children().first().text();
                $.post(base_url + 'Accueil/detail_achat', { produit: produit }, function(data) {
                    $.alert({
                        title:'<fieldset style="font-size:12px;">'+ produit +'</fieldset>',
                        content: data,
                        columnClass: 'col-md-4',
                        containerFluid: true,
                        buttons: {
                        Fermer: {
                            btnClass: 'btn-success',
                        },               
                        },
                        onContentReady: function () {
                        $(".anarana").on('click', function(e) {
                        var parent = $(this).parent().parent();
                        var matricule = parent.children().first().text();
                        $.post(base_url + 'Accueil/prenom', { matricule: matricule }, function(data) {
                            $.alert({
                                title: '',
                                content: data,
                                columnClass: 'col-md-4',
                                containerFluid: true,
                                buttons: {
                                Fermer: {
                                    btnClass: 'btn-success',
                                },               
                                },
                                });
                            });
                        });
                                
                         }  
                        });
                    });
                });
                        
                 }  
            });
        });

    });

    $('.totalsomme').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        //var Prenom = parent.children().first().text();
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'Accueil/totalsomme', { date: date }, function(data) {
            $.alert({
                title: '',
                content: data,
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',
                columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                containerFluid: true,
            });
        });

    });

    $('.totalconfirmer').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        //var Prenom = parent.children().first().text();
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'Accueil/totalconfirmer', { date: date }, function(data) {
            $.alert({
                title: '',
                content: data,
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',
                columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                containerFluid: true,
            });
        });

    });

    $('.totalcalivre').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        //var Prenom = parent.children().first().text();
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'Accueil/totalpoduitlivre', { date: date }, function(data) {
            $.alert({
                title: '',
                content: data,
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',
                columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                containerFluid: true,
            });
        });

    });

    $('.totalpro').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        //var Prenom = parent.children().first().text();
        var mois = $('.dateRe option:selected').val();
        var date = $('.date_collapse').text();
        $.post(base_url + 'Accueil/totalpro', { date: date, mois: mois }, function(data) {
            $.alert({
                title: '',
                content: data,
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',
                columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                containerFluid: true,
                buttons: {
                Fermer: {
                    btnClass: 'btn-success',
                },               
                },
                onContentReady: function () {
                $(".produits").on('click', function(e) {
                var parent = $(this).parent().parent();
                var produit = parent.children().first().text();
                $.post(base_url + 'Accueil/detail_achats', { produit: produit }, function(data) {

                    $.alert({
                        title: '',
                        content: data,
                        });
                    });
                });
                        
                 }  
            });
        });

    });

    $('.totalpo').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        //var Prenom = parent.children().first().text();
        //var mois = $('.dateRe option:selected').val();
        var date = $('.date_collapse').text().trim();
        $.post(base_url + 'Accueil/totalpo', { date: date}, function(data) {
            $.alert({
                title: '',
                content: data,
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',
                //columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                buttons: {
                Fermer: {
                    btnClass: 'btn-success ',
                },               
                },
                onContentReady: function () {
                $(".products").on('click', function(e) {
                var parent = $(this).parent().parent();
                var produit = parent.children().first().text();
                $.post(base_url + 'Accueil/detail_achats_livre', { produit: produit }, function(data) {

                    $.alert({
                        title: '',
                        content: data,
                        });
                    });
                });
                        
                }
            });
        });

    });

    function eventTable() {
        $('.pro1').on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var mois = $('.dateRecap option:selected').val();
            var Matricule_personnel = parent.children().first().text();           
            var date = $('.date_collapse').text().trim();
            $.post(base_url + 'Livre/produit', { mois: mois, Matricule_personnel: Matricule_personnel }, function(data) {
                $.alert({
                    title: Matricule_personnel,
                    content: data,
                    type: 'purple',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }

    function eventTables() {
        $('.pro2').on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Livre/produits', { date: date, Matricule_personnel: Matricule_personnel, mois: mois }, function(data) {
                $.alert({
                    title: '',
                    content: data,
                    type: 'purple',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }

    var Table = $(".table_report").DataTable({
        paging:false,
        searching :false,
        ajax: base_url + "Livre/W1",

        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/French.json"
        },
        rowCallback: function(row, data) {

        },
        initComplete: function(setting) {
            var mois = $('.dateRecap option:selected').val();
            $.post(base_url + 'Livre/dataWeek', { mois: mois }, function(data) {
                $('.casema').children().eq(1).empty().append("");
                $('.casema').children().eq(2).empty().append(data.tes);
                $('.casema').children().eq(3).empty().append(data.te);
                $('.casema').children().eq(5).empty().append(data.tesx);
                $('.casema').children().eq(4).empty().append(data.t);
                $('.casema').children().eq(6).empty().append(data.test);

            }, 'json');
            eventTable();
            eventTables();
            eventTabl();
            eventTableau();
            eventTableauxx();
            eventTotal1();
            eventTotal2();
            eventTotal3();
            eventTotal4();
            eventTotal5();
            nompage();
        }
    });
    $('.dateRecap').on('change', function(e) {
        e.preventDefault();
        var mois = $('.dateRecap option:selected').val();
        Table.ajax.url(base_url + "Livre/months/" + mois).load();
        $.post(base_url + 'Livre/dataWeek', { mois: mois }, function(data) {
            $('.casema').children().eq(1).empty().append("");
            $('.casema').children().eq(2).empty().append(data.tes);
            $('.casema').children().eq(3).empty().append(data.te);
            $('.casema').children().eq(5).empty().append(data.tesx);
            $('.casema').children().eq(4).empty().append(data.t);
            $('.casema').children().eq(6).empty().append(data.test);
            eventTable();
            eventTables();
            eventTabl();
            eventTableau();
            eventTableauxx();
            eventTotal1();
            eventTotal2();
            eventTotal3();
            eventTotal4();
            eventTotal5();
            nompage();

        }, 'json');


    });

    function eventTabl() {
        $('.pro3').on('click', function(e) {
            e.preventDefault();
            var mois = $('.dateRecap option:selected').val();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Livre/produi', { date: date, Matricule_personnel: Matricule_personnel, mois: mois }, function(data) {
                $.alert({
                    title: '',
                    content: data,
                    type: 'purple',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }

    function eventTableau() {
        $('.pro4').on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Livre/produit4', { date: date, Matricule_personnel: Matricule_personnel, mois: mois }, function(data) {
                $.alert({
                    title: '',
                    content: data,
                    type: 'purple',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }

    function eventTableauxx() {
        $('.pro5').on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Livre/produitTotal', { date: date, Matricule_personnel: Matricule_personnel, mois: mois }, function(data) {
                $.alert({
                    title: '',
                    content: data,
                    type: 'purple',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }

    function eventTotal1() {
        $('.total1').on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Livre/totalpro1', { date: date, Matricule_personnel: Matricule_personnel, mois: mois }, function(data) {
                $.alert({
                    title: '',
                    content: data,
                    type: 'red',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }

    function eventTotal2() {
        $('.total2').on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Livre/totalpro2', { date: date, Matricule_personnel: Matricule_personnel, mois: mois }, function(data) {
                $.alert({
                    title: '',
                    content: data,
                    type: 'red',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }

    function eventTotal3() {
        $('.total3').on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Prenom = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Livre/totalpro3', { date: date, Prenom: Prenom, mois: mois }, function(data) {
                $.alert({
                    title: '',
                    content: data,
                    type: 'red',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }

    function eventTotal4() {
        $('.total4').on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Prenom = parent.children().first().text();
            var mois = $('.dateRe option:selected').val();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Livre/totalpro4', { date: date, Prenom: Prenom, mois: mois }, function(data) {
                $.alert({
                    title: '',
                    content: data,
                    type: 'red',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }

    function eventTotal5() {
        $('.total5').on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            //var Prenom = parent.children().first().text();
            var mois = $('.dateRecap option:selected').val();
            //var date = $('.date_collapse').text();
            $.post(base_url + 'Livre/totalpro5', { mois: mois }, function(data) {
                $.alert({
                    title: '',
                    content: data,
                    columnClass: 'col-md-12 col-md-offset-3',
                    type: 'red',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });

        });
    }

    /*function nompage(){
        $(".nompage").on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var prenom = parent.children().first().text();
            $.post(base_url + 'Hebdomadaire/pages', { prenom: prenom }, function(data) {
    
                $.alert({
                    title: '',
                    content: data,
                });
            });
        });
    }*/
    $(".DataTable").DataTable({
        searching: true,
        ordering: true,
        paging: false
    });


    Table = $(".tableproduit").DataTable({
    processing: true,
    searching: true,
    paging: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
    }
    });

    $(".nompages").on('click', function(e) {
        e.preventDefault();/*
        var parent = $(this).parent().parent();
        var prenom = parent.children().first().text();
        $.post(base_url + 'Hebdomadaire/page', { prenom: prenom }, function(data) {

            $.alert({
                title: '',
                content: data,
            });
        });*/
        $('#myModal').modal('show')
    });


    $(".detail").on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        $.post(base_url + 'Accueil/detail', { matricule: matricule }, function(data) {

            $.alert({
                title: '',
                content: data,
                columnClass: 'col-md-4',
                buttons: {
                Fermer: {
                    btnClass: 'btn-success ',
                },               
                },
                

            });
        });
    });

    Table = $(".tableperformance").DataTable({
    processing: true,
    searching: true,
    paging: false,
    info: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
    }
    });
    $('.nompage').on('click', function(e){
    e.preventDefault();
    var parent = $(this).parent().parent();
    var matricule = parent.children().first().text();
    $('#myModal').modal('show')
    var link = base_url + "Hebdomadaire/page?matricule=" + matricule;
    Table.ajax.url(link);
    Table.ajax.reload(); 
    });   

});