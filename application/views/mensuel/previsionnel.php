<div class="container col-md-12">
    <fieldset class="border p-1">
        <legend class="w-auto"><b class="text-sm"> ETAT PREVISIONNEL PAR MATRICULE</b></legend>
              <div class=" col-md-12">
                <div class="row">
                    <div class=" col-md-6">
                    <select class="form-control dateRecapS custom-select form-control-sm" id="date" style="width:100%;">
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
                 <div class=" col-md-6">
                   <button class="btn btn-primary btn-sm w-100" id="Valider">Valider</button>
                </div>
            </div>
        </div>
    </fieldset>    
    <div class=" table-responsive" id="data_containt">            
    </div>
</div>