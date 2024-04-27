<style type="text/css">
    .table td, .table th {
/*    width: 200px !important;*/
    font-weight: 14px !important;
    font-size: 14px !important;
}
    .matricule{
        width: 150px !important;
    }
    .right{
        width: 150px !important;
    }
    .prenosm{
        width: 250px !important;
    }
</style>
<div class="container col-md-12">
        <fieldset class="border p-1">
            <legend class="w-auto"><b class="text-sm">LIVRAISON</b></legend>
          
        </fieldset>    
        
        <div class="col-md-12 m-0 p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-bordered-bd-light table-hover table-striped table-hover tableResult">
                    <thead class="">
                        <?php
                    $date = date("Y-m-d");
                    $dt = new dateTime();
                    $dt1 = new dateTime();
                    $dt2 = new dateTime();
                    $dt3 = new dateTime();
                    $dt4 = new dateTime();
                    $dt5 = new dateTime();
                    $dt6 = new dateTime();
                    $dt7 = new dateTime();
                    $dt1->modify('+2day');
                    $dt2->modify('+3day');
                    $dt3->modify('+4day');
                    $dt4->modify('+5day');
                    $dt5->modify('+6day');
                    $dt6->modify('+7day');                    
                    $dt7->modify('+8day');
                    $date1 = $dt1->format("Y-m-d");
                    $date2 = $dt2->format("Y-m-d");
                    $date3 = $dt3->format("Y-m-d");
                    $date4 = $dt4->format("Y-m-d");
                    $date5 = $dt5->format("Y-m-d");
                    $date6 = $dt6->format("Y-m-d");
                    $date7 = $dt7->format("Y-m-d");
                    ?>
                        <tr class="dataClass bg-secondary text-white">
                            <th class="collapse"></th>
                            <th class="text-center text-white">Matricule</th>
                            <th class="text-center text-white">Nom</th>
                            <th class=" aa"><a href="" class="text-white"><? echo $date1 ?></a></th>
                            <th class=" aa"><a href="" class="text-white"><? echo $date2 ?></a></th>
                            <th class=" aa"><a href="" class="text-white"><? echo $date3 ?></a></th>
                            <th class=" aa"><a href="" class="text-white"><? echo $date4 ?></a></th>
                            <th class=" aa"><a href="" class="text-white"><? echo $date5 ?></a></th> 
                            <th class=" aa"><a href="" class="text-white"><? echo $date6 ?></a></th>
                            <th class=" aa"><a href="" class="text-white"><? echo $date7 ?></a></th>                           
                        </tr>
                         <tr class=" bg-primary text-white">
                            <th class="collapse"></th>
                            <th class="text-center">Total</th>
                            <th></th>
                            <th class="text-right"><?=number_format($ca)?></th>
                            <th class="text-right"><?=number_format($ca1)?></th>
                            <th class="text-right"><?=number_format($ca2)?></th>
                            <th class="text-right"><?=number_format($ca3)?></th>
                            <th class="text-right"><?=number_format($ca4)?></th> 
                            <th class="text-right"><?=number_format($ca5)?></th>
                            <th class="text-right"><?=number_format($ca6)?></th>                           
                        </tr>
                    </thead>
                    <tbody> 
                   <?php foreach ($oplg as  $value): ?>
                    <tr>
                        <?php
                            $ca = 0;
                            $ca1 = 0;
                            $ca2 = 0;
                            $ca3 = 0;
                            $ca4 = 0;
                            $ca5 = 0;
                            $ca6 = 0;
                            $facture = $this->accueil_model->getCaLivraison($date1, $value->Matricule);
                            foreach ($facture as $facture) {
                                $ca += ($facture->Quantite * $facture->Prix_detail);
                            }
                            $factu = $this->accueil_model->getCaLivraison($date2, $value->Matricule);
                            foreach ($factu as $factu) {
                                $ca1 += ($factu->Quantite * $factu->Prix_detail);
                            }
                            $factur = $this->accueil_model->getCaLivraison($date3, $value->Matricule);
                            foreach ($factur as $factur) {
                                $ca2 += ($factur->Quantite * $factur->Prix_detail);
                            }
                            $facture1 = $this->accueil_model->getCaLivraison($date4, $value->Matricule);
                            foreach ($facture1 as $key) {
                                $ca3 += ($key->Quantite * $key->Prix_detail);
                            }
                            $facture2 = $this->accueil_model->getCaLivraison($date5, $value->Matricule);
                            foreach ($facture2 as $key) {
                                $ca4 += ($key->Quantite * $key->Prix_detail);
                            }
                            $facture3 = $this->accueil_model->getCaLivraison($date6, $value->Matricule);
                            foreach ($facture3 as $key) {
                                $ca5 += ($key->Quantite * $key->Prix_detail);
                            }
                            $facture4 = $this->accueil_model->getCaLivraison($date7, $value->Matricule);
                            foreach ($facture4 as $key) {
                                $ca6 += ($key->Quantite * $key->Prix_detail);
                            }
                        ?>
                        <td class="collapse"><?=$value->Matricule?></td>                        
                        <td class="text-center matricule"><?=substr($value->Matricule,0,7)?></a></td>                        
                        <td class=""><?= $value->Prenom?></td>
                        <td class="text-right aa"><a href="#" class="matricuL" data-toggle='modal' data-target='#exampleModalCenter'><?=number_format($ca)?></a></td>
                        <td class="text-right aa"><a href="#" class="matricuL" data-toggle='modal' data-target='#exampleModalCenter'><?=number_format($ca1)?></a></td>
                        <td class="text-right aa"><a href="#" class="matricuL" data-toggle='modal' data-target='#exampleModalCenter'><?=number_format($ca2)?></a></td>
                        <td class="text-right aa"><a href="#" class="matricuL" data-toggle='modal' data-target='#exampleModalCenter'><?=number_format($ca3)?></a></td>
                        <td class="text-right aa"><a href="#" class="matricuL" data-toggle='modal' data-target='#exampleModalCenter'><?=number_format($ca4)?></a></td>
                        <td class="text-right aa"><a href="#" class="matricuL" data-toggle='modal' data-target='#exampleModalCenter'><?=number_format($ca5)?></a></td>
                        <td class="text-right aa"><a href="#" class="matricuL" data-toggle='modal' data-target='#exampleModalCenter'><?=number_format($ca6)?></a></td>
                    </tr>
                    <?php endforeach ?>                       
                    </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                                    <div class="content">
            <div class="page-inner mt-3">
                <div class="row">
                    <form class="col-md-12">
                
                    </form>
                    <div class="col-md-12 mt-2">
                        <div class="table-responsive w-100">
                            <table class="table table-striped table-bordered-bd-secondary table-responsive-lg table-hover tableData table-head-bg-secondary">
                                <thead>
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
                                <tbody class="text-sm text-justify" style="font-size: 10px !important;">
                                           
                                </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
