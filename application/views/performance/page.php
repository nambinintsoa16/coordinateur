<div class="container">
    <form method="POST" action="<?= base_url("Developpeur/performance/page") ?>" class="col-md-12">
        <fieldset class="border p-1">
            <legend class="w-auto"><b class="text-sm">STATISTIQUE PAGE</b></legend>
            <div class="form-group col-md-12">
                <div class="input-group">

                    <input type="date" class="form-control" value="<?php echo $date ?>" name="date">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-success but btn-success-sm p-1"> valider</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    <span class="date_collapse collapse"> <?php if ($date == "") {
                                                $date = date('Y-m-d');
                                            }
                                            echo $date; ?></span>
    <div class="form-group contentTable table-striped ">

        <table class="table table-hover table-bordered DataTables table-responsive-lg">
            <thead>
                <tr class="bg-secondary text-white">
                    <th class="collapse"></th>
                    <th class="collapse"></th>
                    <th style="font-size: 11px;">MATRICULE</th>
                    <th class="text-center" style="font-size: 11px;">OPLG</th>
                    <th class="text-center" style="font-size: 11px;">SITUATION_PG</th>
                    <th class="text-center" style="font-size: 11px;">DIS_CLT_REP_PG</th>
                    <th class="text-center" style="font-size: 11px;">DIS_CLT_WRT_PG</th>
                    <th class="text-center" style="font-size: 11px;">DIS_CLT_ASK_PG</th>
                    <th class="text-center" style="font-size: 11px;">ENV_CLT_VIS_TT</th>
                    <th class="text-center" style="font-size: 11px;">M1NTS_ABN_PAGE</th>
                    
                </tr>
            </thead>
            <tbody class="tbody">
                <?=$data?>
            </tbody>
        </table>
    </div>
</div>
