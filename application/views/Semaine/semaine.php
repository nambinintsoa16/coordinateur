<style>
    .center {
        margin: auto;
        width: 60%;

        padding: 10px;
    }
</style>
<div class="center text-center">
    <u>VENTE PREVISIONNELLE</u>
</div>
<div class="container">
    <div class="col-md-12">
        <div class="form-group">
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
        </div>
    </div>
</div>
<div>
    <table class="table table_rapport table-striped table-hover table-bordered">
        <thead>
            <tr class="casemainee">
                <th>TOTAL</th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <thead class="thead-light text-center">

            <tr>
                <th class="text-center">OPLG</th>
                <th class="text-center">MATRICULE</a></th>
                <th class="text-center"><a href="#" class="SE1">SEMAINE_1</a></th>
                <th class="text-center"><a href="#" class="SE2">SEMAINE_2</a></th>
                <th class="text-center"><a href="#" class="SE3">SEMAINE_3</a></th>
                <th class="text-center"><a href="#" class="SE4">SEMAINE_4</a></th>
                <th class="text-center"><a href="#" class="SE5">TOTAL</a></th>
            </tr>
        </thead>
        <tbody class="tbody text-center" style="font-size:9px">

        </tbody>
    </table>
</div>