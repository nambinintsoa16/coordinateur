$(document).ready(function() {
loding();
        var Table= $(".tableResult").DataTable({
        searching: true,
        ordering: true,
        paging: false,
        processing: true,
        ajax: base_url + "Mensuel/DataParPage",
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        rowCallback: function (row, data) {

        },
        initComplete: function (setting) {
            stopload();
            
        }

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
    


    $("#valide_selection").on('click',function(event){
        event.preventDefault();
        loding();
    
        let date = $("#date_select").val();
        $.get(base_url +"Mensuel/etat_page_data",{date},function(data){
            $("#data_containt").empty().append(data);
            stopload();
                /*/$('#Header').empty().append(data);
                Table.ajax.url(link);
                Table.ajax.reload();*/
        });
        
        
    });
    

    function loding(){ 
      //var htmls='<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #00B74A;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';  
      var htmls='<style>bodY {  margin: 0; padding: 0;  box-sizing: border-box;}.center {  height: 10px;  display: flex;  justify-content: center;  align-items: center;  background: #000;}.wave {  width: 5px;  height: 400px;  background: linear-gradient(45deg, cyan, #fff);  margin: 10px;  animation: wave 1s linear infinite;  border-radius: px;}.wave:nth-child(2) {  animation-delay: 0.1s;}.wave:nth-child(3) {  animation-delay: 0.2s;}.wave:nth-child(4) {  animation-delay: 0.3s;}.wave:nth-child(5) {  animation-delay: 0.4s;}.wave:nth-child(6) {  animation-delay: 0.5s;}.wave:nth-child(7) {  animation-delay: 0.6s;}.wave:nth-child(8) {  animation-delay: 0.7s;}.wave:nth-child(9) {  animation-delay: 0.8s;}.wave:nth-child(10) {  animation-delay: 0.9s;}@keyframes wave {  0% {    transform: scale(0);  }  50% {    transform: scale(1);  }  100% {  transform: scale(0);  }}</style><div class="center"><div class="wave"></div> <div class="wave"></div><div class="wave"></div>  <div class="wave"></div><div class="wave"></div><div class="wave"></div><div class="wave"></div><div class="wave"></div><div class="wave"></div><div class="wave"></div></div>'

;
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
