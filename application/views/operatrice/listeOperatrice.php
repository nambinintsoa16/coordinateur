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
            <legend class="w-auto"><b class="text-sm">LISTE DES OPLG</b></legend>
          
        </fieldset>    
        
        <div class="col-md-12 m-0 p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-bordered-bd-secondary table-hover table-striped table-hover tableData">
                    <thead class="">

                        <tr class="perfomois bg-secondary text-white">
                            <th class="collapse"></th>
                            <th class="text-center text-white">PHOTO</th>
                            <th class="text-center text-white">MATRICULE</th>
                            <th class="text-center text-white">NOM & PRENOM</th>
                            <th class="text-center text-white">CONTACT</th>
                            <th class="text-center text-white">MOT DE PASSE</th>
                            <th class="text-center text-white ">CA MENSUEL LIVRE</th>
                        </tr>
                    </thead>
                    <tbody> 
                    <?php foreach ($oplInfo as  $value): ?>
                    <tr>
                        <td class="collapse"><?=substr($value->Matricule,2,5)?></td>
                        <td class="text-center"><img class="img-thumbnail" style="width: 50px ;height: 50px;object-fit: cover;border:3px solid #29235c;;" src="<?= PhotoUser_img_link($value->Matricule)?>"></td> 
                        <!--<td class="text-center "></td>-->
                        <td class="text-center matricule"><a href="#" class="matricuL" data-toggle='modal' data-target='#exampleModalCenter'><?=substr($value->Matricule,2,5)?></a></td>                        
                        <td class=""><?= strtoupper($value->Nom) ." ". $value->Prenom?></td>
                        <td class="text-center"><?= $value->Contact_du_personnel?></td>
                        <td class="text-center"><?= $value->Mode_de_pass_login?></td>
                   
                        <?php $facture=$this->accueil_model->etatParMatriculeLivre(date('Y-m'),substr($value->Matricule,2,5));
                            $ca=0;
                            foreach ($facture as $facture) {
                                $ca += ($facture->Quantite * $facture->Prix_detail);
                        }?>
                        <td class="text-right right"><a href="#" class="chiffre"><?= number_format($ca, 0, ',', ' ') ?></a></td>
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
                        <fieldset class="border bg-light p-1">
                            <legend class="w-auto"><b class="text-sm">V</b></legend>
                            <div class="col-md-12 m-auto">                                                                 
                                    
                            </div> 
                            <div class="col-md-12 info_opl">
                                    
                            </div>

                        </fieldset>
                    </form>
                    <div class="col-md-12 mt-2">
                        <div class="table-responsive w-100">
                            <table class="table table-striped table-bordered-bd-secondary table-responsive-lg table-hover tableResult table-head-bg-secondary">
                                <thead>
                                    <tr>
                                        <th class="text-sm text-center">PAGE</th>
                                        <th></th>
                                        <th class="text-sm text-center">CA_PREVI</th>
                                        <th class="text-sm text-center">CA_REEL</th>
                                        <th class="text-sm text-center">CA_LIVRE</th>  
                                        <th class="text-sm text-center">RATIO</th>                                      
                                    </tr>
                                </thead>
                                <tbody class="text-sm text-center" style="font-size: 10px !important;">
                                           
                                </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
