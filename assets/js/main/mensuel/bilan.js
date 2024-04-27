$(document).ready(function() {
    $('.promo3').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table3").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/mars21",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse3').text();
                $.post(base_url + 'Mensuel/marsthead', { mois: mois }, function(data) {
                    $('.camois3').children().eq(1).empty().append("");
                    $('.camois3').children().eq(1).empty().append("");
                    $('.camois3').children().eq(2).empty().append(data.tes);
                    $('.camois3').children().eq(3).empty().append(data.te);
                    $('.camois3').children().eq(4).empty().append(data.t);
                    $('.camois3').children().eq(5).empty().append(data.ratio);
    
                }, 'json');
            }
        });
    });


    $('.promo4').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table4").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/avril21",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse4').text();
                $.post(base_url + 'Mensuel/avrilthead', { mois: mois }, function(data) {
                    $('.camois4').children().eq(1).empty().append("");
                    $('.camois4').children().eq(1).empty().append("");
                    $('.camois4').children().eq(2).empty().append(data.tes);
                    $('.camois4').children().eq(3).empty().append(data.te);
                    $('.camois4').children().eq(4).empty().append(data.t);
                    $('.camois4').children().eq(5).empty().append(data.ratio);
    
                }, 'json');
            }
        });
    });

    $('.promo5').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table5").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/mai21",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse5').text();
                $.post(base_url + 'Mensuel/maithead', { mois: mois }, function(data) {
                    $('.camois5').children().eq(1).empty().append("");
                    $('.camois5').children().eq(1).empty().append("");
                    $('.camois5').children().eq(2).empty().append(data.tes);
                    $('.camois5').children().eq(3).empty().append(data.te);
                    $('.camois5').children().eq(4).empty().append(data.t);
                    $('.camois5').children().eq(5).empty().append(data.ratio);
    
                }, 'json');
            }
        });
    });

    $('.promo6').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table6").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/juin21",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse6').text();
                $.post(base_url + 'Mensuel/juinthead', { mois: mois }, function(data) {
                    $('.camois6').children().eq(1).empty().append("");
                    $('.camois6').children().eq(1).empty().append("");
                    $('.camois6').children().eq(2).empty().append(data.tes);
                    $('.camois6').children().eq(3).empty().append(data.te);
                    $('.camois6').children().eq(4).empty().append(data.t);
                    $('.camois6').children().eq(5).empty().append(data.ratio);
    
                }, 'json');
            }
        });
    });
    $('.promo7').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table7").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/juillet21",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse7').text();
                $.post(base_url + 'Mensuel/juilletthead', { mois: mois }, function(data) {
                    $('.camois7').children().eq(1).empty().append("");
                    $('.camois7').children().eq(1).empty().append("");
                    $('.camois7').children().eq(2).empty().append(data.tes);
                    $('.camois7').children().eq(3).empty().append(data.te);
                    $('.camois7').children().eq(4).empty().append(data.t);
                    $('.camois7').children().eq(5).empty().append(data.ratio);
    
                }, 'json');
            }
        });
    });

    $('.promo8').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table8").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/aout21",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse8').text();
                $.post(base_url + 'Mensuel/aoutthead', { mois: mois }, function(data) {
                    $('.camois8').children().eq(1).empty().append("");
                    $('.camois8').children().eq(1).empty().append("");
                    $('.camois8').children().eq(2).empty().append(data.tes);
                    $('.camois8').children().eq(3).empty().append(data.te);
                    $('.camois8').children().eq(4).empty().append(data.t);
                    $('.camois8').children().eq(5).empty().append(data.ratio);
    
                }, 'json');
            }
        });
    });

    $('.promo9').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table9").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/septembre21",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse9').val();
                $.post(base_url + 'Mensuel/septembrethead', { mois: mois }, function(data) {
                    $('.camois9').children().eq(1).empty().append("");
                    $('.camois9').children().eq(1).empty().append("");
                    $('.camois9').children().eq(2).empty().append(data.tes);
                    $('.camois9').children().eq(3).empty().append(data.te);
                    $('.camois9').children().eq(4).empty().append(data.t);
                    $('.camois9').children().eq(5).empty().append(data.ratio);
    
                }, 'json');
            }
        });
    });

    $('.promo10').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table10").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/octobre21",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse10').val();
                $.post(base_url + 'Mensuel/octobrethead', { mois: mois }, function(data) {
                    $('.camois10').children().eq(1).empty().append("");
                    $('.camois10').children().eq(1).empty().append("");
                    $('.camois10').children().eq(2).empty().append(data.tes);
                    $('.camois10').children().eq(3).empty().append(data.te);
                    $('.camois10').children().eq(4).empty().append(data.t);
                    $('.camois10').children().eq(5).empty().append(data.ratio);
    
                }, 'json');
            }
        });
    });

    $('.promo11').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table11").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/novembre21",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse11').val();
                $.post(base_url + 'Mensuel/novembrethead', { mois: mois }, function(data) {
                    $('.camois11').children().eq(1).empty().append("");
                    $('.camois11').children().eq(1).empty().append("");
                    $('.camois11').children().eq(2).empty().append(data.tes);
                    $('.camois11').children().eq(3).empty().append(data.te);
                    $('.camois11').children().eq(4).empty().append(data.t);
                    $('.camois11').children().eq(5).empty().append(data.ratio);
    
                }, 'json');
            }
        });
    });
    $('.promo12').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table12").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/decembre21",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse12').val();
                $.post(base_url + 'Mensuel/decembrethead', { mois: mois }, function(data) {
                    $('.camois12').children().eq(1).empty().append("");
                    $('.camois12').children().eq(1).empty().append("");
                    $('.camois12').children().eq(2).empty().append(data.tes);
                    $('.camois12').children().eq(3).empty().append(data.te);
                    $('.camois12').children().eq(4).empty().append(data.t);
                    $('.camois12').children().eq(5).empty().append(data.ratio);
    
                }, 'json');
            }
        });
    });

    $('.janv2022').on('click', function(e) {
        e.preventDefault();
        var Table = $(".tablejanvier").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/janvier22",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse12').val();
                $.post(base_url + 'Mensuel/janv2022thead', { mois: mois }, function(data) {
                    $('.camoisjanv').children().eq(1).empty().append("");
                    $('.camoisjanv').children().eq(1).empty().append("");
                    $('.camoisjanv').children().eq(2).empty().append(data.tes);
                    $('.camoisjanv').children().eq(3).empty().append(data.te);
                    $('.camoisjanv').children().eq(4).empty().append(data.t);
                    $('.camoisjanv').children().eq(5).empty().append(data.ratio);
    
                }, 'json');
            }
        });
    });
    
    $('.caannuelprevi').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        $.post(base_url + 'Mensuel/produitUserPreviannuel', { }, function(data) {
            $.alert({
                title: '',
                content: data,
                type: 'purple',
                columnClass: 'col-md-12',
                icon: 'fa fa-spinner fa-spin',
            });

        });
    });

    $('.caannuelreel').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        $.post(base_url + 'Mensuel/totalproduitreelannuel', { }, function(data) {
            $.alert({
                title: '',
                content: data,
                type: 'purple',
                columnClass: 'col-md-12',
                icon: 'fa fa-spinner fa-spin',
            });

        });
    });

    $('.caannuellivre').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        $.post(base_url + 'Mensuel/totalproduitlivreannuel', { }, function(data) {
            $.alert({
                title: '',
                content: data,
                type: 'purple',
                columnClass: 'col-md-12',
                icon: 'fa fa-spinner fa-spin',
            });

        });
    });

    $('.fevr2022').on('click', function(e) {
        e.preventDefault();
        var Table = $(".tablefevrier").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/fevrier22",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse12').val();
                $.post(base_url + 'Mensuel/fevr2022thead', { mois: mois }, function(data) {
                    $('.camoisfevrier').children().eq(1).empty().append("");
                    $('.camoisfevrier').children().eq(1).empty().append("");
                    $('.camoisfevrier').children().eq(2).empty().append(data.tes);
                    $('.camoisfevrier').children().eq(3).empty().append(data.te);
                    $('.camoisfevrier').children().eq(4).empty().append(data.t);
                    $('.camoisfevrier').children().eq(5).empty().append(data.ratio);
    
                }, 'json');
            }
        });
    });
    $('.mars2022').on('click', function(e) {
        e.preventDefault();
        var Table = $(".tablemars").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/mars22",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse12').val();
                $.post(base_url + 'Mensuel/mars2022thead', { mois: mois }, function(data) {
                    $('.camoismars').children().eq(1).empty().append("");
                    $('.camoismars').children().eq(1).empty().append("");
                    $('.camoismars').children().eq(2).empty().append(data.tes);
                    $('.camoismars').children().eq(3).empty().append(data.te);
                    $('.camoismars').children().eq(4).empty().append(data.t);
                    $('.camoismars').children().eq(5).empty().append(data.ratio);    
                }, 'json');
            }
        });
    });

    $('.avril2022').on('click', function(e) {
        e.preventDefault();
        var Table = $(".tableavril22").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/avril22",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse12').val();
                $.post(base_url + 'Mensuel/avril2022thead', { mois: mois }, function(data) {
                    $('.camoisavril').children().eq(1).empty().append("");
                    $('.camoisavril').children().eq(1).empty().append("");
                    $('.camoisavril').children().eq(2).empty().append(data.tes);
                    $('.camoisavril').children().eq(3).empty().append(data.te);
                    $('.camoisavril').children().eq(4).empty().append(data.t);
                    $('.camoisavril').children().eq(5).empty().append(data.ratio);    
                }, 'json');
            }
        });
    });


    $('.promomai').on('click', function(e) {
        e.preventDefault();
        var Table = $(".tablemai22").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/mai22",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse12').val();
                $.post(base_url + 'Mensuel/mai2022thead', { mois: mois }, function(data) {
                    $('.camoismai').children().eq(1).empty().append("");
                    $('.camoismai').children().eq(1).empty().append("");
                    $('.camoismai').children().eq(2).empty().append(data.tes);
                    $('.camoismai').children().eq(3).empty().append(data.te);
                    $('.camoismai').children().eq(4).empty().append(data.t);
                    $('.camoismai').children().eq(5).empty().append(data.ratio);    
                }, 'json');
            }
        });
    });

    $('.promojuin').on('click', function(e) {
        e.preventDefault();
        var Table = $(".tablejuin22").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/juin22",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse12').val();
                $.post(base_url + 'Mensuel/juin2022thead', { mois: mois }, function(data) {
                    $('.camoisjuin').children().eq(1).empty().append("");
                    $('.camoisjuin').children().eq(1).empty().append("");
                    $('.camoisjuin').children().eq(2).empty().append(data.tes);
                    $('.camoisjuin').children().eq(3).empty().append(data.te);
                    $('.camoisjuin').children().eq(4).empty().append(data.t);
                    $('.camoisjuin').children().eq(5).empty().append(data.ratio);    
                }, 'json');
            }
        });
    });

    $('.promojuillet').on('click', function(e) {
        e.preventDefault();
        var Table = $(".tablejuillet22").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/juillet22",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse12').val();
                $.post(base_url + 'Mensuel/juillet2022thead', { mois: mois }, function(data) {
                    $('.camoisjuillet').children().eq(1).empty().append("");
                    $('.camoisjuillet').children().eq(1).empty().append("");
                    $('.camoisjuillet').children().eq(2).empty().append(data.tes);
                    $('.camoisjuillet').children().eq(3).empty().append(data.te);
                    $('.camoisjuillet').children().eq(4).empty().append(data.t);
                    $('.camoisjuillet').children().eq(5).empty().append(data.ratio);    
                }, 'json');
            }
        });
    });
    $('.promoaout').on('click', function(e) {
        e.preventDefault();
        var Table = $(".tableaout22").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/aout22",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse12').val();
                $.post(base_url + 'Mensuel/aout2022thead', { mois: mois }, function(data) {
                    $('.camoisaout').children().eq(1).empty().append("");
                    $('.camoisaout').children().eq(1).empty().append("");
                    $('.camoisaout').children().eq(2).empty().append(data.tes);
                    $('.camoisaout').children().eq(3).empty().append(data.te);
                    $('.camoisaout').children().eq(4).empty().append(data.t);
                    $('.camoisaout').children().eq(5).empty().append(data.ratio);    
                }, 'json');
            }
        });
    });

    $('.promosept').on('click', function(e) {
        e.preventDefault();
        var Table = $(".tablesept2022").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/sept22",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse12').val();
                $.post(base_url + 'Mensuel/sept2022thead', { mois: mois }, function(data) {
                    $('.camoissept').children().eq(1).empty().append("");
                    $('.camoissept').children().eq(1).empty().append("");
                    $('.camoissept').children().eq(2).empty().append(data.tes);
                    $('.camoissept').children().eq(3).empty().append(data.te);
                    $('.camoissept').children().eq(4).empty().append(data.t);
                    $('.camoissept').children().eq(5).empty().append(data.ratio);    
                }, 'json');
            }
        });
    });

    $('.promoctobre').on('click', function(e) {
        e.preventDefault();
        var Table = $(".tableoct2022").DataTable({
            processing: true,
            searching: false,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "mensuel/oct22",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {                

            },
            initComplete: function(setting) {
                var mois = $('.date_collapse12').val();
                $.post(base_url + 'Mensuel/oct2022thead', { mois: mois }, function(data) {
                    $('.camoisoct').children().eq(1).empty().append("");
                    $('.camoisoct').children().eq(1).empty().append("");
                    $('.camoisoct').children().eq(2).empty().append(data.tes);
                    $('.camoisoct').children().eq(3).empty().append(data.te);
                    $('.camoisoct').children().eq(4).empty().append(data.t);
                    $('.camoisoct').children().eq(5).empty().append(data.ratio);    
                }, 'json');
            }
        });
    });
});
