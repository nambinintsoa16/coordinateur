  <div class="form-group contentTable dt-responsive">
    <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
          <thead class="bg-primary text-white">
            
            <tr >
              <th class="text-center collapse"></th>
              <th class="">TOTAL</th>
              <th class="text-center"><?=$produit?></th>
              <th class="text-cente"><?=number_format($ca, 0, '.', ',')?></th>
                                                     
            </tr>
          </thead>
          <thead class="bg-secondary text-white">
            
            <tr >
              <th class="text-center collapse"></th>
              <th class="">PRODUITS</th>
              <th class="text-center">NOMBRE</th>
              <th class="text-cente">PRIX</th>
                                                     
            </tr>
          </thead>
          <tbody class="tbody">                     
                   <?=$content?>
          </tbody>
    </table>      
  </div>
  <script>
    $(document).ready(function() {
     $(".product").on('click', function(e) {
        alert();
     }); 
});
  </script>


    