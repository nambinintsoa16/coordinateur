   $(document).ready(function() {
      var Table = $('.tableGoodies').DataTable({
            processing: true,
            searching: false,
            ordering: true,
            paging: false,
            ajax: base_url + "Tsenakoty/listeproduitGoodies",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
           },
           initComplete: function(setting) {
            var mois = $('.dateRecap option:selected').val();
            $.post(base_url + 'Tsenakoty/dataHeader', { mois: mois }, function(data) {
                $('.datatr').children().eq(0).empty().append("");
                $('.datatr').children().eq(1).empty().append("TOTAL");
                $('.datatr').children().eq(2).empty().append(data.pao);
                $('.datatr').children().eq(3).empty().append(data.lipstick);
                $('.datatr').children().eq(4).empty().append(data.eversence);
                $('.datatr').children().eq(5).empty().append(data.fineline);
                $('.datatr').children().eq(6).empty().append(data.bonsoir);

            }, 'json');   
            evenTeversence();
            evenTpao();
            evenTlipstick();
            evenTfineline();
            evenTbonsoir();       

        }
        });

      $(".dateRecap").on('change', function(e){
        e.preventDefault();
        var mois = $('.dateRecap option:selected').val();
        Table.ajax.url(base_url + "Tsenakoty/listeproduitGoodie/" + mois).load();
        $.post(base_url + 'Tsenakoty/dataHeader', { mois: mois }, function(data) {
            $('.datatr').children().eq(0).empty().append("");
            $('.datatr').children().eq(1).empty().append("TOTAL");
            $('.datatr').children().eq(2).empty().append(data.pao);
            $('.datatr').children().eq(3).empty().append(data.lipstick);
            $('.datatr').children().eq(4).empty().append(data.eversence);
            $('.datatr').children().eq(5).empty().append(data.fineline);
            $('.datatr').children().eq(6).empty().append(data.bonsoir);

        }, 'json');
      });
        function evenTeversence(){
            $(".eversence").on('click', function(e) {
                e.preventDefault();
                var mois = $('.dateRecap option:selected').val();
                $.post(base_url + 'Tsenakoty/liste_Clients', { mois: mois }, function(data) {
                    $.alert({
                        title: "",
                        content: data,
                        type: 'blue',
                        icon: 'fa fa-spinner fa-spin',
                        columnClass: 'col-md-12 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    });

                });
                 
            });
        }

        function evenTpao(){
            $(".pao").on('click', function(e) {
                e.preventDefault();
                var mois = $('.dateRecap option:selected').val();
                $.post(base_url + 'Tsenakoty/listeClients', { mois: mois }, function(data) {
                    $.alert({
                        title: "",
                        content: data,
                        type: 'blue',
                        icon: 'fa fa-spinner fa-spin',
                        columnClass: 'col-md-12 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    });

                });
             
            });
        }
        function evenTlipstick(){
            $(".lipstick").on('click', function(e) {
                e.preventDefault();
                var mois = $('.dateRecap option:selected').val();
                $.post(base_url + 'Tsenakoty/listeClient', { mois: mois }, function(data) {
                    $.alert({
                        title: "",
                        content: data,
                        type: 'blue',
                        icon: 'fa fa-spinner fa-spin',
                        columnClass: 'col-md-12 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    });

                });
             
            });
        }

        function evenTbonsoir(){
            $(".bonsoir").on('click', function(e) {
                e.preventDefault();
                var mois = $('.dateRecap option:selected').val();
                $.post(base_url + 'Tsenakoty/client_list', { mois: mois }, function(data) {
                    $.alert({
                        title: "",
                        content: data,
                        type: 'blue',
                        icon: 'fa fa-spinner fa-spin',
                        columnClass: 'col-md-12 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    });

                });
             
            });
        }

        function evenTfinline(){
            $(".fineline").on('click', function(e) {
                e.preventDefault();
                var mois = $('.dateRecap option:selected').val();
                $.post(base_url + 'Tsenakoty/liste_Client', { mois: mois }, function(data) {
                    $.alert({
                        title: "",
                        content: data,
                        type: 'blue',
                        icon: 'fa fa-spinner fa-spin',
                        columnClass: 'col-md-12 col-md-offset-8 col-xs-4 col-xs-offset-8',
                    });

                });
             
            });
        }
    });