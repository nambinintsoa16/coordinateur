<table class="table table-bordered table-bordered-bd-secondary tableGlobales table-stripted table-hover tableResult table-bordered table-striped">
            <thead>
                <tr class="bg-secondary text-white">
                    <th></th>
                    <th></th>
                    <th>Date</th>
                    <?php foreach ($jours as $value): ?>                         
                                <th class="text-center"><?= $value->Date?></th>                        
                    <?php endforeach ?>
                </tr> 
               <tr class="bg-primary text-white">                   
                    
                    <th>Code Page</th>
                    <th>Nom page</th>
                    <th>Total</th>
                     <?php foreach ($jours as $key): ?> 
                        <?php $facture = $this->accueil_model->etatParMatriculePrevisJour($key->Date);
                        $caprevi=0;
                            foreach ($facture as $facture) {
                                $caprevi += ($facture->Quantite * $facture->Prix_detail);
                            }?>
                        <th><?= number_format($caprevi, 0, ',', ' ') ?></th>                        
                    <?php endforeach ?>                    
                </tr>
                                       
            </thead>
            <tbody class="tbody text-center">  
   
            </tbody>
        </table>   

<script>
$(document).ready(function() {
    var Table= $(".tableResult").DataTable({
        searching: true,
        ordering: true,
        paging: false,
        processing: true,
        ajax: base_url + "Mensuel/DataParPage?date=<?=$date_select?>",
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        rowCallback: function (row, data) {

        },
        initComplete: function (setting) {
            stopload();
            
        }

    });


});
</script>