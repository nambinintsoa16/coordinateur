$(document).ready(function() {
    var Table = $(".tablerecap").DataTable({
        paging:false,
        searching: false,
        ajax: base_url + "Livre/reelrecap",

        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/French.json"
        },
        rowCallback: function(row, data) {

        },
        initComplete: function(setting) {
            var mois = $('.dateEvent option:selected').val();
            $.post(base_url + 'Livre/datarecap', { mois: mois }, function(data) {
                $('.reel').children().eq(1).empty().append("");
                $('.reel').children().eq(2).empty().append(data.tes);
                $('.reel').children().eq(3).empty().append(data.te);
                $('.reel').children().eq(5).empty().append(data.tesx);
                $('.reel').children().eq(4).empty().append(data.t);
                $('.reel').children().eq(6).empty().append(data.test);

            }, 'json');
            eventT1(); 
            eventT2(); 
            eventS3();     
            eventS4();
            eventTotalS1();
            eventTotalS2();
            eventTotalS3();
            eventTotalS4();
        }
    });
    $('.dateEvent').on('change', function(e) {
        e.preventDefault();
        var mois = $('.dateEvent option:selected').val();
        Table.ajax.url(base_url + "Livre/reeltwo/" + mois).load();
        $.post(base_url + 'Livre/datarecap', { mois: mois }, function(data) {
            $('.reel').children().eq(1).empty().append("");
            $('.reel').children().eq(2).empty().append(data.tes);
            $('.reel').children().eq(3).empty().append(data.te);
            $('.reel').children().eq(5).empty().append(data.tesx);
            $('.reel').children().eq(4).empty().append(data.t);
            $('.reel').children().eq(6).empty().append(data.test);
           

        }, 'json');
        eventT1();
        eventT2();
        eventS3();
        eventS4();
        eventTotalS1();
        eventTotalS2();
        eventTotalS3();
        eventTotalS4();
    });

    function eventT1() {
        $('.reel1').on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var mois = $('.dateEvent option:selected').val();
            var Matricule_personnel = parent.children().first().text();           
            var date = $('.date_collapse').text().trim();
            $.post(base_url + 'Livre/produitreel', { mois: mois, Matricule_personnel: Matricule_personnel }, function(data) {
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

    function eventT2() {
        $('.reel2').on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var mois = $('.dateEvent option:selected').val();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Livre/produitS2', { date: date, Matricule_personnel: Matricule_personnel, mois: mois }, function(data) {
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

    function eventS3() {
        $('.reel3').on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var mois = $('.dateEvent option:selected').val();
            var Matricule_personnel = parent.children().first().text();           
            var date = $('.date_collapse').text().trim();
            $.post(base_url + 'Livre/produitS3', { mois: mois, Matricule_personnel: Matricule_personnel }, function(data) {
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

    function eventS4() {
        $('.reel4').on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var Matricule_personnel = parent.children().first().text();
            var mois = $('.dateEvent option:selected').val();
            var date = $('.date_collapse').text();
            $.post(base_url + 'Livre/produitS4', { date: date, Matricule_personnel: Matricule_personnel, mois: mois }, function(data) {
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

    function eventTotalS1(){
        $('.total1').on('click', function(e){
            e.preventDefault();
            var parent = $(this).parent().parent();
            var mois = $('.dateEvent option:selected').val();
            var Matricule_personnel = parent.children().first().text();           
            var date = $('.date_collapse').text().trim();
            $.post(base_url + 'Reel/totalpro1', { mois: mois, Matricule_personnel: Matricule_personnel }, function(data) {
                $.alert({
                    content: data,
                    type: 'purple',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });
        });
    }


    function eventTotalS2(){
        $('.total2').on('click', function(e){
              e.preventDefault();
            var parent = $(this).parent().parent();
            var mois = $('.dateEvent option:selected').val();
            var Matricule_personnel = parent.children().first().text();           
            var date = $('.date_collapse').text().trim();
            $.post(base_url + 'Reel/totalpro2', { mois: mois, Matricule_personnel: Matricule_personnel }, function(data) {
                $.alert({
                    content: data,
                    type: 'purple',
                    icon: 'fa fa-spinner fa-spin',
                    columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    containerFluid: true,
                });
            });
        });
    }

    function eventTotalS3(){
        $('.total3').on('click', function(e){
            e.preventDefault();
            alert('Non disponible!!');
        });
    }

    function eventTotalS4(){
        $('.total4').on('click', function(e){
            e.preventDefault();
            alert('Non disponible!!');
        });
    }
    

});