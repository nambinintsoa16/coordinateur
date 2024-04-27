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
                    
                    <th>Matricule</th>
                    <th>Oplg</th>
                    <th></th>
                     <?php foreach ($jours as $key): ?> 
                        <?php $facture = $this->accueil_model->etatParMatriculePreviTotal($key->Date);
                        $ca=0;
                            foreach ($facture as $facture) {
                                $ca += ($facture->Quantite * $facture->Prix_detail);
                            }?>
                       <th><?= number_format($ca, 0, ',', ' ') ?></th>
                    <?php endforeach ?>                    
                </tr>
                                       
            </thead>
            <tbody class="tbody text-center">  

           <?php foreach ($datas as $value): ?> 
               <tr>
                <td><?=substr($value->Matricule, 2, 5);?></td>
                <td><?=$value->Prenom;?></td>
                <td></td>
                <?php  
            $reponse = "";        
            foreach ($jours as $key){
                $facture=$this->accueil_model->etatParMatriculePrevi($key->Date,substr($value->Matricule, 2, 5));
                    $caprevi=0;
                        foreach ($facture as $facture) {
                            $caprevi += ($facture->Quantite * $facture->Prix_detail);
                        }
                    $reponse .="<td><a href='#' class='livre'>".number_format($caprevi, 0, ',', ' ')."</a></td>";                      
               }?>
              <?=$reponse?>
                </tr>
                 <?php endforeach ?>    
            </tbody>
        </table>