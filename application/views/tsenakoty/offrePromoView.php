<div class="container">   
      <fieldset class="border p-1">
        <legend class="w-auto"><b class="text-sm">GOODIES</b></legend>
        <div class="row">
            <div class="col-md-6">
                
                    <select class="form-control dateRecap" style="width:100%;">
                        <?php
                        $data = $mois;
                        foreach ($mois as $key => $mois) :
                            if ($key == date("m")) :
                        ?>
-                                <option selected><?= $mois ?></option>
                            <?php else : ?>
                                <option><?= $mois ?></option>
                        <?php endif;
                        endforeach; ?>

                    </select>               
            </div>
            <div class="col-md-6">
                
                    <select class="form-control typePromo" style="width:100%;">
                        <option hidden></option>
                         <?php
                        $data = $type;
                        foreach ($type as $value) :
                            if ($key == date("m")) :
                        ?>
-                                <option selected><?= $value->Pr_Code_Promo ?></option>
                            <?php else : ?>
                                <option><?= $value->Pr_Code_Promo ?></option>
                        <?php endif;
                        endforeach; ?>
                        </select>               
            </div>
        </div>

    </fieldset>  
    <div class=" table-responsive-lg">
        <table class="table table-bordered table-stripted table-hover  tablePromo">
            <thead>
                <tr class="text-white" style="background-color: black;">
                    <th class="text-center">TOTAL</th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                </tr>
                <tr class="bg-primary text-white">
                    <th class="text-center">LISTE</th>
                    <th class="text-center">PREVISIONNEL</th>
                    <th class="text-center">RELLE</th>
                    <th class="text-center">LIVREE</th>
                </tr>
            </thead>
                <tbody class="tbody text-center">
                </tbody>
        </table>
            
    </div>

</div>
