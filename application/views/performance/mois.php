<div class="container">
    <fieldset class="border p-1">
        <legend class="w-auto"><b class="text-sm">  COMMENTAIRES MENSUELS</b></legend>
        <select class="form-control dateRecapS" style="width:100%">
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
    </fieldset>

    <div class="row m-0 p-0">
        <div class="col-md-12 m-0 p-0">
            <div class="table table-responsive-lg">
                <table class="table table-bordered table-stripted  table_performance">
                    <thead>

                        <tr class="perfomois bg-primary text-white">
                            <th style="font-size: 12px;" class="text-center text-white">TOTAL</th>
                            <th style="font-size: 12px;" class="text-center text-white"></th>
                            <th style="font-size: 12px;" class="text-center text-white totalprevisio"></th>
                            <th style="font-size: 12px;" class="text-center text-white totalproduitreel"></th>
                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                            <th style="font-size: 12px;" class="text-center text-white"></th>
                            <th style="font-size: 12px;" class="text-center text-white totalprolivre"></th>
                            <th style="font-size: 12px;" class="text-center text-white"></th>
                        </tr>

                        <tr class="bg-secondary text-white">
                            <th class="collapse"></th>
                            <th class="collapse"></th>
                            <th> Nom oplg</th>
                            <th class="text-center">Matricule</th>
                            <th class="text-center">Page</th>
                            <th class="text-center">Commentaires</th>
                            <th class="text-center">Clients</th>
                            <th class="text-center">Reponses</th>
                            <th class="text-center">Produits vendus</th>
                            <th class="text-center">Publications</th>
                        </tr>
                    </thead>
                    <tbody class="tbody text-center">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>