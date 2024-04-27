$(document).ready(function(){
   
    $('.detail-page').on('click',function(event){
        event.preventDefault();
        chargement();
        let refnum = $(this).parent().parent().children().eq(0).text(); 
        let page_name = $(this).parent().parent().children().eq(2).text();
        $.post(base_url+"client/list_client_page_data",{refnum},function(data){
            closeDialog();
            $.alert({
                title: "Detail page : "+page_name,
                content: data,
                columnClass: 'col-md-6 col-md-offset-8 col-xs-4 col-xs-offset-8',
                containerFluid: true,
                
             });
            }).fail(()=>{
                alert('Erreur de chargement');
                closeDialog();
            });
    });


    function chargement() {
        var htmls = '<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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

    function closeDialog() {
        $('.jconfirm').remove();
    }
    $('#dataTable').dataTable({
        processing: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });
})