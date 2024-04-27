$(()=>{
    $('.date').click(function(event){
        event.preventDefault()
        $this = $(this)
        let date = $this.text()
        let type = 'detail page'
        $.post(base_url+'Hebdomadaire/get_detail_ca_par_heure',{date,type},function(data){
            $('#data_content').empty().append(data)
            $("#modal_detail").modal("show")
        })
      
    })
    $('.detail_ca').click(function(event){
        event.preventDefault()
        $this = $(this)
        $parent = $this.parent()
        let date = $parent.parent().children().eq(0).find('a').text()
        let type = 'detail matricule'
        $.post(base_url+'Hebdomadaire/get_detail_ca_par_heure',{date,type},function(data){
            $('#data_content').empty().append(data)
            $("#modal_detail").modal("show")
        })
    })
})