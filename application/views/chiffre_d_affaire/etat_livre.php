<style>
    .aa {
        font-size: 8px;
    }
</style>
<div class="container">
    <div class="row">
        <form class="col-md-12">
            <fieldset class="border p-1">
		        <legend class="w-auto"><b class="text-sm">
                    Etat hébdomadaire livré</b>
                </legend>
	        </fieldset>
        </form>
                <div class="table table-responsive">
            <table class="table table-striped table-hover table-bordered table-responsive dataTables table_previsionnel">
                <thead class="thead">
                    <tr class="bg-primary text-white">
                        <th>GRAND TOTAL</th>
                        <th></th>
                        <th></th>
                        <!-- <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white"><?php echo number_format($totalhebdo, 0, ',', ' ') ?></a></th>-->
                        <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white"><?php echo number_format($tca5, 0, ',', ' ') ?></a></th>
                        <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white"><?php echo number_format($tca4, 0, ',', ' ') ?></a></th>
                        <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white"><?php echo number_format($tca3, 0, ',', ' ') ?></a></th>
                        <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white"><?php echo number_format($tca2, 0, ',', ' ') ?></a></th>
                        <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white"><?php echo number_format($tca1, 0, ',', ' ') ?></a></th>
                        <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white"><?php echo number_format($tca, 0, ',', ' ') ?></a></th>
                        <th class="text-center" style="font-size: 10px;"><a href="#" class="text-white"><?php echo number_format($cajour, 0, ',', ' ') ?></a></th>
                    </tr>
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
                        <th class="">OPLG</th>
                        <th class="">MATRICULE</th>
                        <th class="">TOTAL_HEBDO</th>
                        <th class=" aa"><? echo $date5 ?></th>
                        <th class="  aa"><? echo $date4 ?></th>
                        <th class=" aa"><? echo $date3 ?></th>
                        <th class=" aa "><? echo $date2 ?></th>
                        <th class=" aa"><? echo $date1 ?></th>
                        <th class=" aa"><? echo $dates ?></th>
                        <th class=" aa"><? echo $date ?></th>
                    </tr>
                </thead>
                <tbody class="tbody">
                </tbody>
            </table>
        </div>
    </div>
