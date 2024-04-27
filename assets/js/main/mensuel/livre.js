$(document).ready(function() {
        loading();
    $.post(base_url+"Mensuel/DataLivre",function(data){
        $("#data_containt").empty().append(data);
        livre();
        stopload();
    }).fail(()=>{
        stopload();
    });
        
   $("#Valider").on("click",function(event){
      event.preventDefault();
      let date = $('#date option:selected').val();
       loading();
        $.post(base_url+"Mensuel/DataLivre",{date},function(data){
            $("#data_containt").empty().append(data);
            livre();
            stopload();
        }).fail(()=>{
            stopload();
        });
   });
            
  
    /*var Table = $(".tableGlobale").DataTable({
        searching: false,
        ordering: true,
        paging: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        ajax: base_url + "Mensuel/etatGlobal1",

        rowCallback: function(row, data) {
        },
        initComplete: function(setting) {
            var mois = $('.dateRecapS option:selected').val();
            $.post(base_url + 'Mensuel/dataWeek', { mois: mois }, function(data) {
                $('.camoiss').children().eq(0).empty().append("");
                $('.camois').children().eq(1).empty().append(data.tes);
                $('.camois').children().eq(2).empty().append(data.te);
                $('.camois').children().eq(3).empty().append(data.t);
                $('.camois').children().eq(4).empty().append(data.ratio);

            }, 'json');
          
        }
    });*/
    /*$('.dateRecapS').on('change', function(e) {
        e.preventDefault();
        var mois = $('.dateRecapS option:selected').val();
        Table.ajax.url(base_url + "Mensuel/etatGlobalMonth/" + mois).load();

    });*/

    // $('.annees').on('change', function(e) {
    //     e.preventDefault();
    //     var mois = $('.annees option:selected').val();
    //     Table.ajax.url(base_url + "Mensuel/months1/" + mois).load();
    //     $.post(base_url + 'Mensuel/dataWeek1', { mois: mois }, function(data) {
    //         $('.camois').children().eq(1).empty().append("");
    //         $('.camois').children().eq(1).empty().append("");
    //         $('.camois').children().eq(2).empty().append(data.tes);
    //         $('.camois').children().eq(3).empty().append(data.te);
    //         $('.camois').children().eq(4).empty().append(data.t);
    //         $('.camois').children().eq(5).empty().append(data.ratio);

    //     }, 'json');


    // });
    function livre(){
        $(".tbody td>a").on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var Matricule_personnel = parent.children().first().text();
        var index = $(this).parent().index();
        var date = $(".dataClass th").eq(index).text().trim();
        $.post(base_url + 'mensuel/produitLivre', {  Matricule_personnel: Matricule_personnel, date: date }, function(data) {

            $.alert({
                title: Matricule_personnel,
                content: data,
                columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-8',
            });
        });
    });

          $('.table').DataTable();
    }
    function loading() {
        var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: green;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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
