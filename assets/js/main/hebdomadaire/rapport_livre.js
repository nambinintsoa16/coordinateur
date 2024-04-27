$(document).ready(function() {
	 $(".DataTables").DataTable({
        searching: true,
        ordering: true,
        paging: false,
        processing: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }

    });
     /*$(".result").on('click', function(e) {
         e.preventDefault();
         loding();
        var parent = $(this).parent().parent();
        var codeOplg = $(this).text();
        $.post(base_url + 'Hebdomadaire/detailParMatriculeLivre', {codeOplg:codeOplg }, function(data) {

            $.alert({
                title: "",
                content: data,
                columnClass: 'col-md-12 col-md-offset-8 col-xs-4 col-xs-offset-8',
                boxWidth: '80%',
                useBootstrap: false,
                buttons: {
                    OK : {
                    text: 'Fermer',
                    btnClass: 'btn-red',
                    },
                }                
            });
            stopload();
        });
    });

    function loding(){ 
      //var htmls='<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #00B74A;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';  
      var htmls='<style>bodY {  margin: 0; padding: 0;  box-sizing: border-box;}.center {  height: 10px;  display: flex;  justify-content: center;  align-items: center;  background: #000;}.wave {  width: 5px;  height: 400px;  background: linear-gradient(45deg, cyan, #fff);  margin: 10px;  animation: wave 1s linear infinite;  border-radius: px;}.wave:nth-child(2) {  animation-delay: 0.1s;}.wave:nth-child(3) {  animation-delay: 0.2s;}.wave:nth-child(4) {  animation-delay: 0.3s;}.wave:nth-child(5) {  animation-delay: 0.4s;}.wave:nth-child(6) {  animation-delay: 0.5s;}.wave:nth-child(7) {  animation-delay: 0.6s;}.wave:nth-child(8) {  animation-delay: 0.7s;}.wave:nth-child(9) {  animation-delay: 0.8s;}.wave:nth-child(10) {  animation-delay: 0.9s;}@keyframes wave {  0% {    transform: scale(0);  }  50% {    transform: scale(1);  }  100% {  transform: scale(0);  }}</style><div class="center"><div class="wave"></div> <div class="wave"></div><div class="wave"></div>  <div class="wave"></div><div class="wave"></div><div class="wave"></div><div class="wave"></div><div class="wave"></div><div class="wave"></div><div class="wave"></div></div>';
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
        
    }*/
    $(".totalHebdo").on('click', function(e) {
        e.preventDefault();
        loding();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        $.post(base_url + 'Hebdomadaire/TotalproduitsLivres', { }, function(data) {

            $.alert({
                title: "",
                content: data,
                columnClass: 'col-md-12 col-md-offset-8 col-xs-4 col-xs-offset-8',
                boxWidth: '50%',
                useBootstrap: true,
                buttons: {
                    OK : {
                    text: 'Fermer',
                    btnClass: 'btn-red',
                    },
                }

                
            });
            stopload();
        });
    });

    Table = $(".tableResult").DataTable({
        processing: true,
        searching: false,
        paging: false,
          language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });

    $('.resultlivre').on('click', function(e){
    e.preventDefault();
    //$('.matricule_opl').empty().append(localStorage.getItem('matricule'));
    var matricule = $(this).text();    
    var link = base_url + "Hebdomadaire/detailParMatriculeL?matricule=" + matricule;
    Table.ajax.url(link);
    Table.ajax.reload();
    $('.matricule_opl').empty().append(matricule); 
    }); 

    $('.resultlivre').on('click', function(e){
        var matricule = $(this).text();  
        $.post(base_url + 'Hebdomadaire/details_operatrice', { matricule: matricule }, function(data) {
            $('.info_opl').empty().append(data);         
        }); 
    }); 
    $(".tbody td>a").on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var Matricule_personnel = parent.children().first().text();
        var index = $(this).parent().index();
        var date = $(".dataClass th").eq(index).text().trim();
        $.post(base_url + 'Hebdomadaire/produitlivre', { date: date, Matricule_personnel: Matricule_personnel }, function(data) {

            $.alert({
                title: Matricule_personnel,
                content: data,
                columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-8',
            });
        });

    });


         $(".produit").on('click', function(e) {
        e.preventDefault();
        loding();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        $.post(base_url + 'Hebdomadaire/TotalproduitLivre',{matricule : matricule }, function(data) {

            $.alert({
                title: "",
                content: data,
                columnClass: 'col-md-12 col-md-offset-8 col-xs-4 col-xs-offset-8',
                boxWidth: '50%',
                useBootstrap: true,
                buttons: {
                    OK : {
                    text: 'Fermer',
                    btnClass: 'btn-red',
                    },
                }
                
            });
            stopload();
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