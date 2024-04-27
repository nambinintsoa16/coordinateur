<div class="container col-md-12">
    <fieldset class="border p-1">
        <legend class="w-auto"><b class="text-sm"> ETAT MENSUEL PAR MATRICULE</b></legend>
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
            <div class=" table-responsive-lg">
                <table class="table table-bordered table-bordered-bd-secondary table-stripted table-hover tableResult table-bordered table-striped">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th class="text-center text-white">MATRICULE</th>
                            <th class="text-center text-white">OPLG</th>
                            <th class="text-center ">PREVI</th>
                            <th class="text-center ">REEL</th>
                            <th class="text-center ">LIVRE</th>
                            <th class="text-center text-white ">TAUX</th>
                        </tr>

                        <tr class="camois bg-secondary text-white p-3">
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center text-white totalprevisio"></th>
                            <th class="text-center text-white totalproduitreel"></th>
                            <th class="text-center text-white totalprolivre"></th>
                            <th class="text-center"></th>

                        </tr>
                    </thead>
                    <tbody class="tbody text-center">
                       
                    </tbody>
                </table>
            
    </div>

</div>