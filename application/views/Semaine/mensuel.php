<div class="container">
    <div class="row">
        <div class="form-group col-md-12">
            <fieldset class="border p-1">
                <legend class="w-auto"><b class="text-sm"> ETAT MENSUEL</b></legend>
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
        </div>
    </div>
    <div>
    </div>
    <fieldset class="border p-1 mt-2">
        <div class="table-responsive">
            <table class="table table_mois table-striped table-hover table-bordered mt-2">

                <thead>
                    <tr style="background-color:aquamarine" class="camois">
                        <th style="font-size: 12px;">TOTAL</th>
                        <th style="font-size: 12px;" class="text-center"></th>
                        <th style="font-size: 12px;" class="text-center"></th>
                        <th style="font-size: 12px;" class="text-center"></th>
                        <th style="font-size: 12px;" class="text-center"></th>
                    </tr>
                </thead>
                <thead class="thead-light text-center">

                    <tr>
                        <th style="font-size: 12px;" class="text-center">OPLG</th>
                        <th style="font-size: 12px;" class="text-center">MATRICULE</a></th>
                        <th style="font-size: 12px;" class="text-center"><a href="#" class="previ">VENTES_PREVI</a></th>
                        <th style="font-size: 12px;" class="text-center"><a href="#" class="reelles">VENTES_REELLES</a></th>
                        <th style="font-size: 12px;" class="text-center"><a href="#" class="livrees">VENTES_LIVREES</a></th>

                    </tr>
                </thead>
                <tbody class="tbody text-center" style="font-size:9px">

                </tbody>
            </table>
        </div>
    </fieldset>
</div>