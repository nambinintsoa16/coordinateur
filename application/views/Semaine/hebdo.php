<div class="form-group">
    <style>
        .center {
            margin: auto;
            width: 60%;

            padding: 10px;
        }

        .button {

            width: 100%;
            font-size: 12px;
            padding-top: 1px;
            height: 20px;

        }
    </style>
    <div class="center text-center">
        Chiffre d'affaires prévisionnel hebdomadaire
    </div>
    <form method="post" action="<?= base_url("Developpeur/hebdo") ?>">
        <div class="form-row">
            <div class="col-md-8">
                <input type="date" class="form-control dateAutre text-center" style="padding:0px" value="<?php echo $date ?>" name="date">
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-success button"> valider</button>
            </div>
        </div>
    </form>
    <hr style="border:solid 2px black;">
    <span class="date_collapse collapse"> <?php if ($date == "") {
                                                $date = date('Y-m-d');
                                            }
                                            echo $date; ?></span>

    <table class="table table-striped table-hover table-bordered table-responsive">
        <thead>
            <tr style="background-color:aquamarine">
                <th>TOTAL</th>
                <th></th>
                <th class="text-center"><?php echo number_format($tca5, 0, ',', ' ') ?></th>
                <th class="text-center"><?php echo number_format($tca4, 0, ',', ' ') ?></th>
                <th class="text-center"><?php echo number_format($tca3, 0, ',', ' ') ?></th>
                <th class="text-center"><?php echo number_format($tca2, 0, ',', ' ') ?></th>
                <th class="text-center"><?php echo number_format($tca1, 0, ',', ' ') ?></th>
                <th class="text-center"><?php echo number_format($tca, 0, ',', ' ') ?></th>
                <th class="text-center"><?php echo number_format($cajour, 0, ',', ' ') ?></th>
            </tr>
        </thead>

        <thead class="thead-light">
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
            <tr>
                <th class="bg-warning">OPLG</th>
                <th class="bg-warning">MATRICULE</th>
                <th class="bg-warning texte-center">
                    <? echo $date5 ?>
                </th>
                <th class="bg-warning texte-center">
                    <? echo $date4 ?>
                </th>
                <th class="bg-warning texte-center">
                    <? echo $date3 ?>
                </th>
                <th class="bg-warning texte-center">
                    <? echo $date2 ?>
                </th>
                <th class="bg-warning texte-center">
                    <? echo $date1 ?>
                </th>
                <th class="bg-warning texte-center">
                    <? echo $dates ?>
                </th>
                <th class="bg-warning texte-center">CA_DU_JOUR</th>
            </tr>

        </thead>
        <tbody class="tbody">
            <?= $data ?>
        </tbody>
    </table>
</div>