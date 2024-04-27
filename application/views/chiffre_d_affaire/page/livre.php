<?php
$this->load->model("accueil_model");
?>
<table class="table table-bordered table-bordered-bd-secondary tableGlobales table-stripted table-hover tableResult table-bordered table-striped">
            <thead>
                <tr class="bg-secondary text-white" id="Header">
                    <th></th>
                    <th></th>
                    <th>Date</th>
                    <?php foreach ($jours as $value): ?>                         
                        <th class="text-center"><?= $value->Date?></th>                        
                    <?php endforeach ?>
                </tr> 
               <tr class="bg-primary text-white" id="Header">                   
                    
                    <th>Code Page</th>
                    <th>Nom page</th>
                    <th></th>
                    <?php foreach ($jours as $key): ?> 
                        <?php $facture = $this->accueil_model->TotalDataParPageLivre($key->Date);
                        $ca=0;
                            foreach ($facture as $facture) {
                                $ca += ($facture->Quantite * $facture->Prix_detail);
                            }?>
                        <th><?= number_format($ca, 0, ',', ' ') ?></th>
                    <?php endforeach ?>                    
                </tr>
                                       
            </thead>
            <tbody class="tbody text-center">  
      
            </tbody>
        </table>        

<script>
$(document).ready(function() {
        const link =  base_url + "Mensuel/DataParPageLivre?date=<?=$date_select?>";
        let Table= $(".tableResult").DataTable({
        searching: true,
        ordering: true,
        paging: false,
        processing: true,
        ajax: link,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        rowCallback: function (row, data) {

        },
        initComplete: function (setting) {
           
            
        }

    });


});
</script>