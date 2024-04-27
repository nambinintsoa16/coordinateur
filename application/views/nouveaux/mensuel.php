<div class="container">
    <fieldset class="border p-1">
        <legend class="w-auto"><b class="text-sm">  NOUVEAUX CLIENTS MENSUELS</b></legend>
        <select class="form-control dateRecap" style="width:100%">
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
                <table class="table table-bordered table-stripted  table_mensuel">
                    <thead>
                        <tr class="bg-secondary text-white">
                            <th style="font-size: 11px;">Matricule</th>
                            <th class="text-center" style="font-size: 11px;">OPLG</th>
                            <th class="text-center" style="font-size: 11px;">Nouveaux <br> clients</th>
                            <th class="text-center" style="font-size: 11px;">Clients AC</th>
                            <th class="text-center" style="font-size: 11px;">Ratio AC</th>
                            <th class="text-center" style="font-size: 11px;">Clients SAC</th>
                            <th class="text-center" style="font-size: 11px;">Ratio SAC</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
