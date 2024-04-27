<div class="container col-md-12">
    <fieldset class="border p-1">
        <legend class="w-auto"><b class="text-sm"> ETAT GLOBAL MENSUEL PREVISIONNEL</b></legend>
            <div class=" col-md-12">
                <select class="form-control dateRecapS" style="width:100%;">
                    <?php
                        $data = $mois;
                        foreach ($mois as $key => $mois) :
                            if ($key == date("m")) :
                        ?>
                             <option selected><?= $mois ?></option>
                            <?php else : ?>
                                <option><?= $mois ?></option>
                        <?php endif;
                    endforeach; ?>
            </select>               
               
            </div>
    </fieldset>    
    <div class=" table-responsive">
        <!-- <table class="table table-bordered table-stripted tableGlobaless table-responsive"> -->
        <table class="table table-bordered table-bordered-bd-secondary tableGlobales table-stripted table-hover tableResult table-bordered table-striped">
            <thead>
                <tr class="bg-secondary text-white">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Date</th>
                    <?php foreach ($jours as $value): ?>                         
                                <th class="text-center"><?= $value->Date?></th>                        
                    <?php endforeach ?>
                </tr> 
                <tr class="bg-primary text-white">
                    
                    <th>Matricule</th>
                    <th>Prénom</th>
                    <th>Code Page</th>
                    <th></th>
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
     <!--        <?php foreach ($oplg as $value): ?>                  
                <tr>                         
                    <td><?= substr($value->Matricule_personnel, 0, 7)?></td>
                    <td><?= strtoupper($value->Prenom)?></td> 
                    <?php foreach ($jours as $key): ?> 
                        <?php $facture = $this->accueil_model->etatParMatriculePrevis($key->Date, $value->Matricule_personnel);
                        $caprevi=0;
                            foreach ($facture as $facture) {
                                $caprevi += ($facture->Quantite * $facture->Prix_detail);
                            }?>
                        <td><?= number_format($caprevi, 0, ',', ' ') ?></td>                        
                    <?php endforeach ?>  
                </tr>
            <?php endforeach ?> -->
            </tbody>
        </table>            
    </div>

</div>