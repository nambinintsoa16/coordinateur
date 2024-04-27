
<div class="contenair mt-1" >
    <div class="row ">
        <div class="col-md-12">
            <div class="card p-3  mt-1">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped dataTables dataTable" >
                        <thead class="bg-primary text-light text-center">
                            <tr>
                                <th>Client</th>
                                <th>Date de Commande</th>
                                <th>Date de livraison </th>
                                <th>contacts</th>
                                <th>Produit</th>
                                <th>P.U</th>
                                <th>Quantité</th>
                                <th>Montant</th>
                                <th>Lieu de livraison</th>
                                <!-- <th>OPLG </th> -->
                                <th>Statut</th>
                                
                                <th>Frais</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $data):?> 
                                <tr>
                                    <td><a href="<?= $data->lien_facebook?>" target="_blank"><?= $data->Nom?></td>
                                    <td><?= $data->date?></td>
                                    <td><?= $data->date_de_livraison?></td>
                                    <td><?= $data->contacts?></td>
                                    <td><?= $data->Code_produit?></td>
                                    <td class="text-right"><?=number_format($data->Prix_detail)?></td>
                                    <td class="text-center"><?= $data->Quantite?></td>
                                    <td><?= number_format($data->Quantite * $data->Prix_detail)?></td>
                                    <td><?= $data->lieu_de_livraison?></td>
                                    <!-- <td><?= $data->Matricule_personnel?></td> -->
                                    <td><?= $data->Status?></td>
                                    <td><?= $data->frais?></td>
                                </tr>
                            <?php endforeach;?> 
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>






<!--
    
        <div class="col-md-12" style="">
            <div class="table-responsive" style="background:#fff;overflow-x: scroll;">
                <table class="table dataTable" style="padding:0px 10px">
                        <thead>
                            <tr>
                                <th>Num Commande</th>
                                <th>Client</th>
                                <th>Date de Commande</th>
                                <th> date de livraison </th>
                                <th>lien facebook</th>
                                <th>contacts</th>
                                <th>Produit</th>
                                <th>P.U</th>
                                <th>Qtt</th>
                                <th>Lieu de livraison</th>
                                <th>OPLG </th>
                                <th>Statut</th>
                                <th>Quartier</th>
                                <th>ville</th>
                                <th>Frais</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($list as $value){?>
                            <tr>
                                <td><?= $value->Id_facture ?></td>
                                <td><?= $value->Nom ?></td>
                                <td><?= $value->Date ?></td>
                                <td><?= $value->date_de_livraison ?></td>
                                <td><?= $value->lien_facebook ?></td>
                                <td><?= $value->contacts ?></td>
                                <td><?php
                                $idprix=$value->Id_prix;
                                $sql = $this->db->query("SELECT `Designation` FROM `produit` , prix WHERE produit.Code_produit like prix.Code_produit AND prix.Id = '$idprix'");
                                $result = $sql->result();
                                foreach($result as $val){
                                    echo $val->Designation;
                                }
                                 ?></td>
                                <td><?= $value->Prix_detail ?></td>
                                <td><?= $value->Quantite ?></td>
                                <td><?= $value->lieu_de_livraison ?></td>
                                <td><?= $value->Matricule_personnel ?></td>
                                <td><?= $value->Status ?></td>
                                <td><?= $value->Quartier ?></td>
                                <td><?= $value->Ville ?></td>
                                <td><?= $value->frais ?></td>
                            </tr>

                        <?php } ?>
                        </tbody>
                </table>
            </div>
        </div>
  -->