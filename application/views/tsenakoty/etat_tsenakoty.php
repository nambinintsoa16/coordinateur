<div class="container">
    <fieldset class="border p-1">
        <legend class="w-auto"><b class="text-sm"> ETAT TSENAKOTY</b></legend>
            <div class="col-md-12">
                
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

    </fieldset>    
        <div class=" table-responsive-lg">
            <table class="table table-bordered table-stripted table-hover table_mois">
                <thead>
                    <tr class="bg-secondary text-white">
                     	<th></th>
                        <th class="text-center" style="width:50%;">Client</th>
                        <th class="text-center" style="width:80%;">Produit</th>
                        <th class="text-center">Etat</th>
                        <th class="text-center">Lieu de livraison</th>
                        <th class="text-center">Date de livraison</th>
                    </tr>
                </thead>
                    <tbody class="tbody text-center">
                    </tbody>
                </table>
            
        </div>

</div>