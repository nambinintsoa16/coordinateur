<div class="container">
    <fieldset class="border p-1">
        <legend class="w-auto"><b class="text-sm"> ETAT MENSUEL</b></legend>
            <div class="row col-md-12">
                <div class="col-lg-6">
                    <select class="form-control dateRecapS" style="width:100%;">
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
                <div class="col-lg-6">
                    <select class="form-control  annees" style="width:100%;">
                        <?php
                        $data = $annees;
                        foreach ($annees as $key => $annees) :
                            if ($key == date("m")) :
                        ?>
                                <option selected><?= $annees ?></option>
                            <?php else : ?>
                                <option><?= $annees ?></option>
                        <?php endif;
                        endforeach; ?>

                    </select>
                </div>
            </div>

    </fieldset>

    
            <div class=" table-responsive-lg">
                <table class="table table-bordered table-stripted table_mois">
                    <thead>

                        <tr class="camois bg-primary text-white">
                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                            <th style="font-size: 12px;" class="text-center text-white"></th>
                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                            <th style="font-size: 12px;" class="text-center text-white"></th>
                        </tr>

                        <tr class="bg-secondary text-white">
                            <th style="font-size: 12px;" class="text-center">MATRICULE</th>
                            <th style="font-size: 12px;" class="text-center">OPLG</a></th>
                            <th style="font-size: 12px;" class="text-center"><a href="#" class="previ text-white">VENTES_PREVI</a></th>
                            <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles text-white">VENTES_REELLES</a></th>
                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">VENTES_LIVREES</a></th>
                            <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees text-white">TAUX (%)</a></th>

                        </tr>
                    </thead>
                    <tbody class="tbody">

                    </tbody>
                </table>
            
    </div>

</div>