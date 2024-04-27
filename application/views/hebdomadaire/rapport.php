
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
                    $date = date("Y-m-d");
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
                        <th class="">MATRICULE</th>
                        <th class="">OPLG</th>
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
                        <th>GRAND TOTAL</th>
                        <th class=""></th>
                        <th class="text-center"><span href="#" class="text-white totalHebdo"><?echo number_format($totalhebdo, 0, ',', ' ') ?></span></th> 
                        <th class="text-center"><a href="#" class="text-white"><?echo number_format($cajour, 0, ',', ' ') ?></a></th>
                        <th class="text-center"><a href="#" class="text-white"><?echo number_format($tca, 0, ',', ' ') ?></a></th>
                        <th class="text-center"><a href="#" class="text-white"><?echo number_format($tca1, 0, ',', ' ') ?></a></th>
                        <th class="text-center"><a href="#" class="text-white"><?echo number_format($tca2, 0, ',', ' ') ?></a></th>
                        <th class="text-center"><a href="#" class="text-white"><?echo number_format($tca3, 0, ',', ' ') ?></a></th>
                        <th class="text-center"><a href="#" class="text-white"><?echo number_format($tca4, 0, ',', ' ') ?></a></th>
                        <th class="text-center"><a href="#" class="text-white"><?echo number_format($tca5, 0, ',', ' ') ?></a></th>
                    </tr>

                </thead>

                <tbody class="tbody">
                <?=$data?>
                </tbody>
            </table>
        </div>
    </div>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                                    <div class="content">
                    <div class="page-inner mt-3">
                        <div class="row">
                            <form class="col-md-12">
                                <fieldset class="border bg-light p-1">
                                <legend class="w-auto"><b class="text-sm">VENTE DU MOIS</b></legend>
                                <div class="col-md-12 m-auto">
                                                                 
                                    
                                </div>  
                                <div class="col-md-12 info_opl">
                                    
                                </div>

                                </fieldset>
                            </form>
                            <div class="col-md-12 mt-2">
                                <div class="table-responsive w-100">
                                    <table class="table table-striped table-bordered-bd-secondary table-responsive-lg table-hover tableResult table-head-bg-secondary">
                                        <thead>
                                            <tr>
                                                <th>DATE</th>
                                                <th class="text-sm text-center"></th>
                                                <th class="text-sm text-center">VB</th>
                                                <th class="text-sm text-center">VD</th>
                                                <th class="text-sm text-center">VO</th>
                                                <th class="text-sm text-center">VN</th>
                                                <th class="text-sm text-center">VM</th>
                                                <th class="text-sm text-center">VH</th>
                                                <th class="text-sm text-center">CT</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-sm text-center">
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
</div>
</div>
</div>
</div>
