<style>
    .aa {
        font-size: 8px;
    }
</style>
<div class="container col-md-12">

    <div class="row">

        <?php if ($uri[3] == "previsionnel") : ?>



            <fieldset class="border p-3 m-0 col-md-12 mb-3">

                <legend class="w-auto"><b class="text-sm m-2">Chiffre d'affaire hebdomadaire <?= $uri[3] ?></b></legend>


            </fieldset>
        <?php else : ?>
            <legend class="w-auto"><b class="text-sm m-2">Chiffre d'affaire hebdomadaire <?= $uri[3] ?></b></legend>
        <?php endif; ?>
        <div class="table table-responsive">
            <table class="table table-striped table-hover table-bordered table-responsive DataTables">
                <thead class="thead">
                    <?php
                    //$date = explode(' ', $dat);
                    $dt = new dateTime();
                    $dt1 = new dateTime();

                    $dt2 = new dateTime();

                    $dt3 = new dateTime();

                    $dt4 = new dateTime();

                    $dt5 = new dateTime();

                    $dt->modify('-1day');

                    $dt1->modify('-2day');

                    $dt2->modify('-3day');

                    $dt3->modify('-4day');

                    $dt4->modify('-5day');

                    $dt5->modify('-6day');

                    $dates = $dt->format("Y-m-d");

                    $date1 = $dt1->format("Y-m-d");

                    $date2 = $dt2->format("Y-m-d");

                    $date3 = $dt3->format("Y-m-d");

                    $date4 = $dt4->format("Y-m-d");

                    $date5 = $dt5->format("Y-m-d");

                    ?>


                    <tr class="bg-secondary dataClass  text-white">

                        <th class="collapse"></th>
                        <th class="">MATRICULE</th>
                        <th class="">OPLG</th>
                        <th class="">PAGE</th>
                        <th class="">TOTAL_HEBDO</th>
                        <th class=" aa"><a href="" class="text-white"><? echo $date ?><a></th>
                        <th class=" aa"><a href="" class="text-white"><? echo $dates ?><a></th>
                        <th class=" aa"><a href="" class="text-white"><? echo $date1 ?><a></th>
                        <th class=" aa"><a href="" class="text-white"><? echo $date2 ?><a></th>
                        <th class=" aa"><a href="" class="text-white"><? echo $date3 ?><a></th>
                        <th class=" aa"><a href="" class="text-white"><? echo $date4 ?><a></th>
                        <th class=" aa"><a href="" class="text-white"></a><? echo $date5 ?><a></th>
                    </tr>

                    <tr class="bg-primary text-white">
                        <th class="collapse"></th>
                        <th>GRAND TOTAL</th>
                        <th></th>
                        <th></th>
                        <th class="text-center"><a href="#" class="text-white"><?php echo number_format($totalhebdo, 0, ',', ' ') ?></a></th>
                        <th class="text-center"><a href="#" class="text-white"><?php echo number_format($cajour, 0, ',', ' ') ?></a></th>
                        <th class="text-center"><a href="#" class="text-white"><?php echo number_format($tca, 0, ',', ' ') ?></a></th>
                        <th class="text-center"><a href="#" class="text-white"><?php echo number_format($tca1, 0, ',', ' ') ?></a></th>
                        <th class="text-center"><a href="#" class="text-white"><?php echo number_format($tca2, 0, ',', ' ') ?></a></th>
                        <th class="text-center"><a href="#" class="text-white"><?php echo number_format($tca3, 0, ',', ' ') ?></a></th>
                        <th class="text-center"><a href="#" class="text-white"><?php echo number_format($tca4, 0, ',', ' ') ?></a></th>
                        <th class="text-center"><a href="#" class="text-white"><?php echo number_format($tca5, 0, ',', ' ') ?></a></th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?= $data ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
