  <div class="form-group contentTable dt-responsive">
    <div class="">
    <span class="text-center"><b>Liste des anciens clients avec achat</b></span>
    <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
         <fieldset class="border text-center"><label>Total CA:&nbsp; </label><b><?= number_format($totalancien_clts->Total, 0, '.', ',')?></b></fieldset>
          <thead class="bg-secondary text-white">
            <tr >
              <th class="">Nom client</th>
              <th class="text-center">CA</th>
              <th class="text-center">Fb</th>                                      
            </tr>
          </thead>
          <tbody class="tbody">  
          <?php foreach ($ancien_clts as $value): ?>
            <tr>  
              <td class="collapse"><?= $value->Code_client?></td>                  
              <td><a href="#" class="clientdetail"><?= $value->Compte_facebook?></a></td>
              <!-- <td> <?= number_format($value->Total, 0, '.', ',')?></td> -->
              <?php $key= $this->accueil_model->ca_ancien_clients($this->input->post('matricule'),$value->Code_client)?>
              <?php foreach ($key as $key): ?>
                <td><?= number_format($key->Total, 0, '.', ',')?></td>
              <?php endforeach ?> 
              
              <td><a href="<?= $value->lien_facebook?>" target="_blank"><i class="fab fa-facebook-square"></i></a></td>
            </tr>                    
          <?php endforeach ?>                     
                   
          </tbody>
    </table>
    </div>    
  <hr class="bg-secondary">
  <hr class="bg-danger">
  <span class="text-center"><b>Liste des nouveaux clients avec achat</b></span>
     <div class="">
    <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
          <fieldset class="border text-center"><label>Total CA:&nbsp; </label><b><?= number_format($totalnvx_clts->Total, 0, '.', ',')?></b></fieldset>
          
          <thead class="bg-secondary text-white">
            <tr >
              <th class="collapse"></th>
              <th class="">Nom client</th>
              <th class="text-center">CA</th>
              <th class="text-center">Fb</th>
                                                     
            </tr>
          </thead>
          <tbody class="tbody"> 
          <?php foreach ($nvx_clts as $value): ?>
          <tr>           
            <td class="collapse"><?= $value->Code_client?></td>      
            <td><a href="#" class="clientdetail"><?= $value->Compte_facebook?></a></td>
            <!-- <td class="=text-center"> <?= number_format($value->Total, 0, '.', ',')?></td> -->
            <?php $key= $this->accueil_model->ca_nvx_Clients($this->input->post('matricule'),$value->Code_client)?>
              <?php foreach ($key as $key): ?>
                <td><?= number_format($key->Total, 0, '.', ',')?></td>
              <?php endforeach ?> 
            <td><a href="<?= $value->lien_facebook?>" target="_blank"><i class="fab fa-facebook-square"></i></a></td>
          </tr>
                    
          <?php endforeach ?>                     
                   
          </tbody>
    </table>
    </div>   
  </div>
  <script>
    $(document).ready(function() {
     $(".clientdetail").on('click', function(e) {
         e.preventDefault();
        var parent = $(this).parent().parent();
        var client = parent.children().first().text();
        $.post(base_url + 'Accueil/client_details', { client: client }, function(data) {

            $.alert({
                title: '',
                content: data,
                columnClass: 'col-md-6',
                buttons: {
                Fermer: {
                    btnClass: 'btn-success ',
                },               
                },

                 onContentReady: function () {
                $(".historique").on('click', function(e) {
                  e.preventDefault();                
                var codeclient = $('.codeclient').text();
                 $.post(base_url + 'Accueil/historique_discu', { codeclient: codeclient }, function(data) {
                      $.alert({
                          title: codeclient,
                          content: data,
                          columnClass: 'col-md-6',
                          type: 'blue',
                          icon: 'fa fa-spinner fa-spin',
                              buttons: {
                              fermer: {
                                  btnClass: 'btn-red text-center', // multiple classes.
                                  
                              },
                          }

                      });
                  });
                });
                        
                 }  
                
            });
        });
     }); 
     
});
  </script>


    